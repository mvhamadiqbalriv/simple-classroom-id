<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClassroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classrooms = \App\Classroom::latest()->paginate(6);
        $filterKeyword = $request->get('keyword');
        
        if ($filterKeyword) {
            $classrooms = \App\Classroom::where('nama_kelas', 'LIKE', "%$filterKeyword%")->latest()->paginate(5);
        }

        return view('back-ui.classrooms.index', ['classrooms' => $classrooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-ui.classrooms.create');
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
            'nama_kelas' => 'required|max:20',
            'bidang_ilmu' => 'required|max:50',
            'deskripsi' => 'max:255',
        ]);

        $classroom = new \App\Classroom;

        $classroom->user_id = Auth::user()->id;
        $classroom->nama_kelas = $request->get('nama_kelas');
        $classroom->bidang_ilmu = $request->get('bidang_ilmu');
        $classroom->deskripsi = $request->get('deskripsi');
        $classroom->token = Str::random(8);

        $classroom->save();
        return redirect()->route('classrooms.create')->with('status', 'Kelas berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom = \App\Classroom::where('token', '=', $id)->first();
        return view('back-ui.classrooms.edit', ['classroom' => $classroom]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('updateInformation')) {
            $request->validate([
                'nama_kelas' => 'required|max:20',
                'bidang_ilmu' => 'required|max:50',
                'deskripsi' => 'max:100',
            ]);
    
            $classroom = \App\Classroom::findOrFail($id);
    
            $classroom->nama_kelas = $request->get('nama_kelas');
            $classroom->bidang_ilmu = $request->get('bidang_ilmu');
            $classroom->deskripsi = $request->get('deskripsi');

            $classroom->save();
            return redirect()->route('classrooms.show', $classroom->token)->with('success', 'Kelas berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\Classroom::findOrFail($id);
        $user->delete();
        return redirect()->route('classrooms.index')->with('success', 'Data berhasil dihapus');
    }

    public function create_participant(Request $request){

        $request->validate(['token' => 'required']);

        $classroom = \App\Classroom::where('token', '=', $request->token)->first();

        if (!$classroom) {
            return redirect()->route('classrooms.index')->with('msgParticipant', 'Token anda yang masukan
            belum terdaftar');
        }else {
            $participant = \App\Participant::where(['user_id' => Auth::user()->id, 'classroom_id' => $classroom->id])->first();
            if (!$participant) {
                $new_participant = new \App\Participant;

                $new_participant->user_id = Auth::user()->id;
                $new_participant->classroom_id = $classroom->id;

                $new_participant->save();
                return redirect()->route('classrooms.index')->with('msgParticipant', 'Kelas berhasil ditambahkan');
            }else{
                return redirect()->route('classrooms.index')->with('msgParticipant', 'Data berhasil dihapus');
            }
        }

    }

}
