@extends('layouts.back')
@section('css')
    <style>
        .table-fixed{
            width: 100%;
        }
        .table-fixed tbody {
                height:260px;
                overflow-y:auto;
                width: 100%;
        }
        .table-fixed thead, 
        .table-fixed tbody {
            display:block;
        }
        .table-fixed tbody tr td{
            width: 100%;
        }
        </style>
@endsection
@section('title')
Kelas
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
    @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $classroom->user_id)
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <form action="{{route('classrooms.update', $classroom->id)}}" method="POST">
                    @csrf
                    <input type="hidden" value="PUT" name="_method">
                    <h6 class="heading-small text-muted mb-4">Kelas information | <i>Token : <strong>{{$classroom->token}} </strong></i></h6>
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
                    </div>
                </form>
            </div>
    </div>
    @endif
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Peserta Kelas</h3>
                            </div>
                            @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $classroom->user_id)
                            <div class="col text-right">
                                <a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#undangPeserta"><i class="fa fa-user-plus text-white"  aria-hidden="true"></i>&nbsp; Undang</a>
                                <div class="modal fade" id="undangPeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Masukan Username Peserta</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('classrooms.update', $classroom->token)}}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <div class="form-group">
                                                            <div class="input-group input-group-merge input-group-alternative mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                                                </div>
                                                                <input class="form-control" name="username" type="search" value="{{old('username', null)}}"
                                                                    placeholder="Username">
                                                            </div>
                                                            @error('username')
                                                            <span class="text-danger"><small><b><i>{{$message}}</i></b></small> </span>
                                                            @enderror
                                                            @if (session('msgParticipantE'))
                                                            <span class="text-danger"><small><b><i>{{session('msgParticipantE')}}</i></b></small> </span>
                                                            @endif
                                                            @if (session('msgParticipantS'))
                                                            <span class="text-success"><small><b><i>{{session('msgParticipantS')}}</i></b></small> </span>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" name="undangPeserta" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table table-fixed">
                            <tbody>
                                @foreach ($participant as $item)
                                <tr>
                                    <td>
                                        <div class="media align-items-center">
                                            <span class="avatar avatar-sm rounded-circle">
                                                <img alt="Image placeholder" src="{{asset('storage/'.$item->user->avatar)}} " width="36" height="36"
                                                style="object-fit: cover">
                                            </span>
                                            <div class="media-body  ml-2  d-none d-lg-block">
                                                <span class="mb-0 text-sm  font-weight-bold">{{$item->user->name}} </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                    @if (Auth::user()->roles == 'Admin' || Auth::user()->id == $classroom->user_id)
                                    <div class="dropdown">
                                        <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <form onsubmit="return confirm('Apakah anda yakin mengeluarkan user ini?')" class="d-inline"
                                                action="#" method="POST"> @csrf
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="submit" value="Delete" class="dropdown-item">
                                            </form>
                                        </div>
                                    </div>
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Social traffic</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Referral</th>
                                    <th scope="col">Visitors</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">
                                        Facebook
                                    </td>
                                    <td>
                                        1,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">60%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-danger" role="progressbar"
                                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">
                                        Facebook
                                    </td>
                                    <td>
                                        5,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">70%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-success" role="progressbar"
                                                        aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 70%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">
                                        Google
                                    </td>
                                    <td>
                                        4,807
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">80%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-primary" role="progressbar"
                                                        aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">
                                        Instagram
                                    </td>
                                    <td>
                                        3,678
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">75%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar"
                                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 75%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">
                                        twitter
                                    </td>
                                    <td>
                                        2,645
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">30%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-warning" role="progressbar"
                                                        aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"
                                                        style="width: 30%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
</div>
@endsection
@section('js')
    <script>
        // Change the selector if needed
        var $table = $('.table-fixed'),
        $bodyCells = $table.find('tbody tr:first').children(),
        colWidth;
        
        // Adjust the width of thead cells when window resizes
        $(window).resize(function() {
        // Get the tbody columns width array
        colWidth = $bodyCells.map(function() {
        return $(this).width();
        }).get();
        
        // Set the width of thead columns
        $table.find('thead tr').children().each(function(i, v) {
        $(v).width(colWidth[i]);
        });
        }).resize(); // Trigger resize handler
    </script>

    @if (session('msgParticipantE') || session('msgParticipantS') || $errors->has('token') )
    <script>
        $(function() {
                $('#undangPeserta').modal('show');
            });
    </script>
    @endif


@endsection