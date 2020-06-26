<?php

namespace App\Http\Controllers;

use App\Deskjob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\DB;

class DeskjobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'Hoi';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if (!empty($_GET['token'])) {
            $classroom = \App\Classroom::where(['user_id' => Auth::user()->id, 'token' => $_GET['token']])->first();
            if (empty($classroom)) {
                abort(404);
            }
        }else{
            abort(401);
        }

        return view('back-ui.deskjobs.create', compact('classroom'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|max:20',
            'classroom_id' => 'required',
            'petunjuk' => 'required',
            'file' => 'file|mimes:jpeg,png,jpg,docx,doc,pdf,rar,zip|max:2048',
            'due_date' => 'required|after:'.date('Y-m-d H:i'),
        ]);

        $deskjob = new \App\Deskjob;
        $deskjob->judul = $request->judul;
        $deskjob->user_id = Auth::user()->id;
        $deskjob->classroom_id = $request->classroom_id;
        $deskjob->petunjuk = $request->petunjuk;
        $deskjob->due_date = date('Y-m-d H:i:s', strtotime($request->due_date));
        $deskjob->slug = Str::random(10);

        if ($request->file('file_tugas')) {
            $file = $request->file('file_tugas')->store('deskjob_files', 'public');
            $deskjob->file_name = $request->file('file_tugas')->getClientOriginalName();
            $deskjob->file = $file;
         }

         $participants = \App\Participant::where(['classroom_id' => $request->classroom_id])->get();

         if ($deskjob->save()) {
             foreach ($participants as $key => $value) {
                $deskjob_users = new \App\Deskjob_user;
                $deskjob_users->user_id = $value->user_id;
                $deskjob_users->deskjob_id = $deskjob->id;
                $deskjob_users->save();
             }
         }

         
         return redirect()->route('deskjobs.show', $deskjob->slug)->with('status', 'Tugas berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deskjob  $deskjob
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $deskjob)
    {
        
        $deskjob = \App\Deskjob::where('slug', $deskjob)->first();

        if ($request->has('serahkanTugas')) {
            $request->validate([
                'file_tugas' => 'required|file|mimes:jpeg,png,jpg,docx,doc,pdf,rar,zip|max:2048',
                'catatan' => 'max:100'
            ]);
            
            $deskjob_users = \App\Deskjob_user::where(['user_id' => Auth::user()->id, 'deskjob_id' => $deskjob->id ])->first();
            $file = $request->file('file_tugas')->store('deskjob_user_files', 'public');
            $deskjob_users->file_name = $request->file('file_tugas')->getClientOriginalName();
            $deskjob_users->file = $file;
            $deskjob_users->status = 'sudah';
            if ($request->has('catatan')) {
                $deskjob_users->catatan = $request->catatan;
            }
            $deskjob_users->save();
             return redirect()->route('deskjobs.show', $deskjob->slug)->with('status', 'Tugas berhasil diserahkan');die;
        }

        return view('back-ui.deskjobs.detail', compact('deskjob'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deskjob  $deskjob
     * @return \Illuminate\Http\Response
     */
    public function edit(Deskjob $deskjob)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deskjob  $deskjob
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deskjob $deskjob)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deskjob  $deskjob
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deskjob $deskjob)
    {
        //
    }
}
