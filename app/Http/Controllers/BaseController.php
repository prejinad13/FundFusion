<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    protected function commonData($view_path)
    {
        View::composer($view_path, function($view){

            $view->with('loggedInUser',auth()->user());
            $view->with('_base_route', property_exists($this, 'base_route')?$this->base_route:'');
            $view->with('_view_path', property_exists($this, 'view_path')?$this->view_path:'');
            $view->with('_panel', property_exists($this, 'panel')?$this->panel:'');
            $view->with('_permission', property_exists($this, 'permission')?$this->permission:'');
        });

        return $view_path;
    }
}
