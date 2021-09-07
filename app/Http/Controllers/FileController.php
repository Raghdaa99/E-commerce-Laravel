<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\File;
use Illuminate\Http\Request;

class FileController extends Controller
{

    public function index()
    {
        $files = File::latest()->paginate(5);
        return view('complaints.index',compact('files'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('complaints.create');
    }


    /**
     * Show the application dashboard.
     *
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
    public function destroy(File $file)
    {
        $file->delete();

        return redirect()->route('complaints.index')
            ->with('success','Complaint deleted successfully');

    }
}
