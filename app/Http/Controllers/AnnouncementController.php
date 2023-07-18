<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index(){
        // dd('test');
        $announcements = Announcement::latest()->where('status', 1)->get();
        return view('member.announcement', compact('announcements'));
    }
    public function list(){
        $announcements = Announcement::latest()->get();
        return view('admin.announcements.list', compact('announcements'));
    }
    public function create(){
        return view('admin.announcements.create');
    }

    public function store(Request $request)
    {
        $announcement = Announcement::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'content'       => $request->input('content'),
                'status'        => $request->input('status'),
                'popup'         => $request->input('popup'),
                'popup_once'    => $request->input('popup_once'),
                'created_at'    => $request->input('created_at'),
                'updated_at'    => $request->input('updated_at'),
                'created_by'    => $request->input('created_by'),
                'updated_by'    => $request->input('updated_by'),
            ]
        );

        // Additional logic if needed

        return response()->json(['message' => 'Announcement created/updated successfully']);
    }
}
