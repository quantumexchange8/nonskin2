<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Validator;
Use Alert;
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

        $validator = Validator::make($request->all(), [
            'title'         => 'required',
            'content'       => 'required',
            'image'         => 'nullable|image|max:2048',
            'status'        => 'required',
            'start_date'    => 'nullable',
            'end_date'      => 'nullable',
        ]);

        if ($validator->fails()) {
            // Validation failed, return with errors and old input
            Alert::error('Failed', 'Please fill in all the required fill');
            return redirect()->back();
        }

        $popup = $request->input('popup') === 'on' ? 1 : 0;
        // $popup_once = $request->input('popup_once') === 'on' ? 1 : 0;

        if ($request->hasFile('image')){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images/announcements'), $imageName);
        }

        $announcement = new Announcement();
        $announcement->title   = $request->input('title');
        $announcement->content          = $request->input('content');
        $announcement->status = $request->input('status');
        $announcement->image       = $announcement->image ?? $imageName ?? null;
        $announcement->start_date       = $request->input('start_date');
        $announcement->end_date       = $request->input('end_date');
        $announcement->popup       = $popup;
        $announcement->popup_once       = 1;
        $announcement->created_by       = $announcement->created_by ?? Auth::id();
        $announcement->updated_by       = Auth::id();
        $announcement->save();

        Alert::success('Success', 'successfully created');
        return redirect()->route('announcements.list')->with('created', 'Announcement successfully created');
    }
    public function edit(Announcement $announcement){

        return view('admin.announcements.edit', compact('announcement'));
    }

    public function editSave(Request $request, Announcement $announcement)
    {
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

        try {
        $announcement = Announcement::updateOrCreate(
            ['id' => $announcement->id],
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
}
