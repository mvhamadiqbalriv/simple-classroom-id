@extends('layouts.back')
@section('title')
Ubah User
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('classroom_edit', $classroom) }}
@endsection
@section('content')
<div class="row justify-content-md-center">
    <div class="col-xl-4">
        @if(session('successChangeAvatar')) <div
            class="alert alert-success alert-dismissible fade show text-center ava-change" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span> {{session('successChangeAvatar')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>@endif
        <div class="card card-profile">
            <img src="{{asset('template/back-ui/img/theme/img-1-1000x600.jpg')}}" alt="Image placeholder"
                class="card-img-top">
            <div class="card-body pt-0">
                <div class="row">
                    <div class="col">
                        <div class="card-profile-stats d-flex justify-content-center">
                            <div>
                                @error('avatar')
                                <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                @enderror
                                <span class="heading"> {{$classroom->nama_kelas}} </span>
                                <span class="description">{{$classroom->bidang_ilmu}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <p class="h5">
                        {{$classroom->deskripsi}}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <form action="{{route('classrooms.update', $classroom->id)}}" method="POST">
                    @csrf
                    <input type="hidden" value="PUT" name="_method">
                    <h6 class="heading-small text-muted mb-4">Kelas information</h6>
                    <div class="pl-lg-4">
                        @if(session('success')) <div class="alert alert-success alert-dismissible fade show text-center"
                            role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span> {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>@endif
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-name">Nama Kelas</label>
                                    <input type="text" id="input-name" class="form-control" placeholder="name"
                                        name="nama_kelas" value="{{$classroom->nama_kelas}}">
                                    @error('nama_kelas')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Bidang Ilmu</label>
                                    <input type="text" id="input-username" name="bidang_ilmu" class="form-control"
                                        placeholder="bidang_ilmu" value="{{$classroom->bidang_ilmu}}">
                                    @error('bidang_ilmu')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-control-label">Deskripsi</label>
                                    <textarea rows="4" cols="30" class="form-control" name="deskripsi"
                                        placeholder="deskripsi">{{$classroom->deskripsi}} </textarea>
                                    @error('deskripsi')
                                    <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="updateInformation" class="btn btn-primary mt-4">Edit
                                Kelas</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
</div>
@endsection
@section('js')
@if (session('notMatch') || $errors->has('new_password') || $errors->has('conf_password') ||
session('successChangePassword'))
<script>
    $(function() {
            $('#ubahpassword').modal('show');
        });
</script>
@endif
<script>
    $("#imageClick").click(function() {
            $("input[id='avatar']").click();
        });
</script>

@endsection