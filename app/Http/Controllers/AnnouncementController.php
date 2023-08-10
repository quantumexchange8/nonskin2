<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Auth;

class AnnouncementController extends Controller
{
    public function index(){
        $announcements = Announcement::latest()->where('status', 1)->get();
        return view('member.announcement', compact('announcements'));
    }
    public function list(){
        $announcements = Announcement::orderBy('updated_at', 'desc')->get();
        return view('admin.announcements.list', compact('announcements'));
    }
    public function create(){
        return view('admin.announcements.create');
    }

    public function store(Request $request, Announcement $announcement){
        // dd($request);

        $request->validate([
            'title'         => 'required',
            'content'       => 'required',
            'image'         => 'nullable|image|max:2048',
            'status'        => 'required',
            'start_date'    => 'nullable',
            'end_date'      => 'nullable',
        ]);

        $popup = $request->input('popup') === 'on' ? 1 : 0;
        $popup_once = $request->input('popup_once') === 'on' ? 1 : 0;

        if ($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/announcements'), $imageName);
        }
        if($request->input('id')){
            $announcement = Announcement::find($request->input('id'));
        }

        try {
        $announcement = Announcement::updateOrCreate(
            ['id' => $request->input('id')],
            [
                'title'         => $request->input('title'),
                'content'       => $request->input('content'),
                'status'        => $request->input('status'),
                'image'         => $announcement->image ?? $imageName ?? null,
                'start_date'    => $request->input('start_date'),
                'end_date'      => $request->input('end_date'),
                'popup'         => $popup,
                'popup_once'    => $popup_once,
                'created_by'    => $announcement->created_by ?? Auth::id(),
                'created_at'    => $announcement->created_at ?? now(),
                'updated_by'    => Auth::id(),
                'updated_at'    => now(),
            ]
        );

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // $imageName1 = time() . '.' . $image->getClientOriginalExtension();
            // $image->storeAs('images/products', $imageName1, 'public');
            $announcement->image = $imageName;
        }

        if($announcement->wasRecentlyCreated){
            return redirect()->route('announcements.list')->with('created', 'Announcement successfully created');
        }else{
            return redirect()->route('announcements.list')->with('updated', 'Announcement successfully updated');
        }
        } catch (\Throwable $th) {
            // dd($e);
            return redirect()->back()->withErrors(['error' => 'Something went wrong!']);
        }

    }
    public function edit(Announcement $announcement){

        return view('admin.announcements.edit', compact('announcement'));
    }
}
