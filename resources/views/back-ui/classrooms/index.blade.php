@extends('layouts.back')
@section('add_data')
    <a href="{{route('classrooms.create')}} " class="btn btn-sm btn-neutral">Tambah Kelas</a>
@endsection
@section('title')
    Kelas
@endsection
@section('breadcrumb')
    {{ Breadcrumbs::render('classroom') }}
@endsection
@section('content')
<div class="row ">
    <div class="col-xl-4 col-md-6 mt--3">
        <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                <div class="form-group mb-0" action="{{route('classrooms.index') }} ">
                    <div class="input-group input-group-alternative input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control" name="keyword" value="{{Request::get('keyword')}}" placeholder="Search" type="text">
                    </div>
                </div>
                <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </form>
        </div>
</div>
<div class="row mt-4">
    @if ($classrooms->isEmpty())
    <div class="container text-center mt-6 mb-6">
        <span>Maaf tidak ada data yang ditemukan</span>
    </div>
    @endif
    @foreach ($classrooms as $item)
    <div class="col-xl-3 col-md-6">
        <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="h2 font-weight-bold mb-0">{{$item->nama_kelas}} </span>
                        <h5 class="card-title text-uppercase text-muted mb-0">{{$item->bidang_ilmu}} </h5>
                    </div>
                    <div class="col-auto">
                        <div class="dropdown">
                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <a class="dropdown-item" href="{{route('classrooms.show', $item->token)}} " class="btn btn-primary btn-sm">Show & Edit</a>
                                <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                                    action="{{route('classrooms.destroy', $item->id)}}" method="POST"> @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="submit" value="Delete" class="dropdown-item">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mt-5 mb-0 text-sm">
                            <span class="text-nowrap">{{$item->user->name}}</span>
                </p>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection