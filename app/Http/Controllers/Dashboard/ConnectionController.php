<?php

namespace App\Http\Controllers\Dashboard;

use Throwable;
use App\Models\Connection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Notifications\ConnectionRequestNotification;

class ConnectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function connect(Request $request, $id)
    {
        $sender   = Auth::user();
        $receiver = User::findOrFail($id);

        if ($sender->id === $receiver->id) {
            return back()->with('error', 'You cannot connect with yourself.');
        }

        $exists = Connection::where(function ($q) use ($sender, $receiver) {
            $q->where('sender_id', $sender->id)->where('receiver_id', $receiver->id);
        })->orWhere(function ($q) use ($sender, $receiver) {
            $q->where('sender_id', $receiver->id)->where('receiver_id', $sender->id);
        })->first();

        if ($exists) {
            $msg = match($exists->status) {
                'pending'  => 'Connection request already sent.',
                'accepted' => 'You are already connected.',
                'rejected' => 'Your connection request was rejected.',
                default    => 'Connection already exists.',
            };
            return back()->with('warning', $msg);
        }

        try {
            Connection::create([
                'sender_id'   => $sender->id,
                'receiver_id' => $receiver->id,
                'status'      => 'pending',
            ]);

            $senderRole = $sender->roles()->first()->name;
            $link = $senderRole === 'investee'
                ? route('dashboard.investment.investee.profile', $sender->id)
                : route('dashboard.investment.investor.profile', $sender->id);

            $receiver->notify(new ConnectionRequestNotification($sender, 'sent you a connection request', $link));

            return back()->with('success', 'Connection request sent to ' . $receiver->name . '!');

        } catch (Throwable $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function accept($id)
    {
        try {
            $connection = Connection::where('receiver_id', Auth::id())
                ->where('sender_id', $id)
                ->where('status', 'pending')
                ->firstOrFail();

            $connection->update(['status' => 'accepted']);

            $sender       = User::findOrFail($id);
            $receiverRole = Auth::user()->roles()->first()->name;
            $link = $receiverRole === 'investee'
                ? route('dashboard.investment.investee.profile', Auth::id())
                : route('dashboard.investment.investor.profile', Auth::id());

            $sender->notify(new ConnectionRequestNotification(
                Auth::user(),
                'accepted your connection request',
                $link
            ));

            return back()->with('success', 'Connection accepted!');

        } catch (Throwable $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function decline($id)
    {
        try {
            $connection = Connection::where('receiver_id', Auth::id())
                ->where('sender_id', $id)
                ->where('status', 'pending')
                ->firstOrFail();

            $connection->update(['status' => 'rejected']);

            return back()->with('success', 'Connection request declined.');

        } catch (Throwable $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function notifications()
    {
        $notifications = Auth::user()->notifications()->paginate(15);
        Auth::user()->unreadNotifications->markAsRead();
        return view('new-dashboard.notifications.index', compact('notifications'));
    }

    public function markRead($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return response()->json(['success' => true]);
    }

    public function profileModal($id)
    {
        $user = User::with('sectors')->findOrFail($id);
        return view('new-dashboard.notifications.profile-modal', compact('user'));
    }
}