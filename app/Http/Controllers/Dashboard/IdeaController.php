<?php

namespace App\Http\Controllers\Dashboard;

use Throwable;
use App\Models\Idea;
use App\Models\Sector;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Idea\AddFormRequest;
use App\Http\Requests\Idea\EditFormRequest;

class IdeaController extends BaseController
{
    protected $base_route = 'dashboard.ideas';
    protected $view_path  = 'new-dashboard.ideas';
    protected $panel      = 'Idea';
    protected $permission = 'idea';

    public function __construct()
    {
        $this->middleware(['is_investee', 'kyc_verified'])
             ->only(['index','create','store','show','edit','update','delete','changeStatus']);
    }

    public function index()
    {
        $data['data'] = Idea::where('investee_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view(parent::commonData($this->view_path . '.index'), compact('data'));
    }

    public function create()
    {
        $data['investment_sectors'] = Sector::all();
        return view(parent::commonData($this->view_path . '.create'), compact('data'));
    }

    public function store(AddFormRequest $request)
    {
        try {
            $videoLink = $this->handleVideoUpload($request, null);

            $request->request->add([
                'investee_id' => Auth::user()->id,
                'slug'        => Str::slug($request->name),
                'video_link'  => $videoLink,
            ]);

            $idea = Idea::create($request->except('video_file'));

            if ($request->get('investment_sectors')) {
                $idea->sectors()->attach($request->input('investment_sectors'));
            }

        } catch (Throwable $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route . '.index');
        }

        Session::flash('success', Str::singular($this->panel) . ' Is Successfully Saved');
        return redirect()->route($this->base_route . '.index');
    }

    public function show(string $id)
    {
        $data = [];
        try {
            $data['data'] = Idea::findOrFail($id);
        } catch (Throwable $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route . '.index');
        }
        return view(parent::commonData($this->view_path . '.show'), compact('data'));
    }

    public function edit(string $id)
    {
        $data = [];
        $data['investment_sectors'] = Sector::all();
        try {
            $data['data'] = Idea::findOrFail($id);
        } catch (Throwable $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route . '.index');
        }
        return view(parent::commonData($this->view_path . '.edit'), compact('data'));
    }

    public function update(EditFormRequest $request, string $id)
    {
        try {
            $idea      = Idea::findOrFail($id);
            $videoLink = $this->handleVideoUpload($request, $idea->video_link);

            $request->request->add([
                'slug'       => Str::slug($request->name),
                'video_link' => $videoLink,
            ]);

            $idea->update($request->except('video_file'));

            if ($request->get('investment_sectors')) {
                $idea->sectors()->sync($request->input('investment_sectors'));
            } else {
                $idea->sectors()->detach();
            }

        } catch (Throwable $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route . '.index');
        }

        Session::flash('success', Str::singular($this->panel) . ' Is Successfully Updated');
        return redirect()->route($this->base_route . '.index');
    }

    public function changeStatus($id)
    {
        try {
            $idea      = Idea::findOrFail($id);
            $newStatus = ($idea->status == 'open') ? 'closed' : 'open';
            $idea->update(['status' => $newStatus]);
        } catch (Throwable $e) {
            Session::flash('error', $e->getMessage());
            return redirect()->route($this->base_route . '.index');
        }
        Session::flash('success', Str::singular($this->panel) . ' Is Successfully Updated');
        return redirect()->route($this->base_route . '.index');
    }

    public function destroy(string $id)
    {
        return redirect()->back();
    }

    /**
     * Handle video URL retrieval.
     * Returns the final video_link value to store.
     */
    private function handleVideoUpload($request, $existingVideoLink): string
    {
        return $request->input('video_link') ?? '';
    }
}