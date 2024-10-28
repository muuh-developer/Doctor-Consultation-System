<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Specialist;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        // Get the logged-in specialist's ID
        // $specialistId = Auth::id();
        $usertype = auth()->user()->usertype;


        // Fetch notifications specific to the logged-in specialist
        $notifications = Notification::all();

        return view('notifications.index', compact('notifications','usertype','user'));
    }
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);

        // Check if the logged-in user is authorized to delete the notification
        if ($notification->user_id != auth()->id()) {
            return redirect()->back()->with('error', 'You are not authorized to delete this notification.');
        }

        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }
}
