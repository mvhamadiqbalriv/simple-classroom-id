@extends('layouts.back')
@section('title')
    Tambah Tugas
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('deskjobs_create') }}
@endsection
@section('content')

<div class="container">
    <!-- Table -->
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card bg-secondary border-0">
                <div class="card-body px-lg-5 py-lg-5">
                    @if(session('status')) <div class="alert alert-success text-center">{{session('status')}} </div>
                    @endif
                    <form action="{{route('deskjobs.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul" class="form-control-label">Judul</label>
                            <input class="form-control" type="text" value="{{old('judul', null)}}" name="judul" placeholder="Judul Tugas" id="judul">
                            @error('judul')
                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="judul" class="form-control-label">Kelas</label>
                            <input type="hidden" class="form-control" name="classroom_id" value=" {{$classroom->id}} " id="">
                            <input type="text" class="form-control" value=" {{$classroom->nama_kelas}} " id="" readonly>
                            @error('classroom_id')
                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="petunjuk" class="form-control-label">Petunjuk</label>
                            <textarea name="petunjuk" class="form-control" id="petunjuk" cols="20" rows="7">{{old('petunjuk')}} </textarea>
                            @error('petunjuk')
                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="file" class="form-control-label">File</label>
                            <input class="form-control" type="file" name="file_tugas" id="file">
                            @error('file_tugas')
                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="example-datetime-local-input" class="form-control-label">Batas Waktu</label>
                            <input class="form-control" name="due_date" type="datetime-local" value=" {{old('due_date', null)}} " id="example-datetime-local-input">
                            @error('due_date')
                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                            @enderror
                        </div>
                        <div class="text-center">
                            <button type="submit" name="tambahTugas" class="btn btn-primary mt-4">Tambah Tugas</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection