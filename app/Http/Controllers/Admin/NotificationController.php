<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->where('type', 'admin_notification')
            ->latest()
            ->paginate(10);

        // Always return the view for this method
        return view('admin.notifications.index', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== auth()->id() || $notification->type !== 'admin_notification') {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'Notification marked as read');
    }

    public function markAllAsRead()
    {
        Notification::where('user_id', auth()->id())
            ->where('type', 'admin_notification')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        if (request()->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return back()->with('success', 'All notifications marked as read');
    }

    public function unreadCount()
    {
        $count = Notification::where('user_id', auth()->id())
            ->where('type', 'admin_notification')
            ->where('is_read', false)
            ->count();

        return response()->json(['count' => $count]);
    }

    public function recent()
    {
        $notifications = Notification::where('user_id', auth()->id())
            ->where('type', 'admin_notification')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'type' => $notification->type,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'link' => $notification->link,
                    'is_read' => $notification->is_read,
                    'created_at' => Carbon::parse($notification->created_at)->diffForHumans()
                ];
            });

        return response()->json(['notifications' => $notifications]);
    }
} 