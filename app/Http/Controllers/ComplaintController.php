<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\File;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::latest()->paginate(5);
        return view('complaints.index',compact('files'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('complaints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'filenames' => 'required',
            'filenames.*' => 'mimes:doc,pdf,docx,zip,png,jpg'
        ]);
        $complaint = new Complaint();
        $complaint->details = $request->detail;
        $complaint->save();

        if ($request->hasfile('filenames')) {
            foreach ($request->file('filenames') as $file) {
                $name = time() . '.' . $file->extension();
                $file->move(public_path() . '/files/', $name);
//                $data[] = $name;
                $file = new File();
                $file->complaint_id = $complaint->id;
                $file->filenames = $name;
                $file->save();
            }
        }





        return back()->with('success', 'Data Your files has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        $complaint->delete();

        return redirect()->route('complaints.index')
            ->with('success','Complaint deleted successfully');
    }
}
