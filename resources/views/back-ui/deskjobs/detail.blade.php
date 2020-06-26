@extends('layouts.back')
@section('title')
{{$deskjob->judul}}
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('deskjob_detail', $deskjob) }}
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                    <h3 class="card-title">{{$deskjob->judul}} 
                    </h3>
                <div class="media align-items-center mb-3" >
                    <i class="ni ni-hat-3 text-dark mr-3" style="width:30px;height:30px;font-size:25px;text-align:center;" data-toggle="tooltip" data-placement="top" title="Kelas"></i>
                    <div class="media-body">
                        <span class="name mb-0 text-sm"> <div style="color:grey;font-size:12px;font-weight:bold"> {{$deskjob->classroom->nama_kelas}} </div> </span>
                    </div>
                </div>
                <div class="media align-items-center">
                    <a href="#" class="avatar-authors rounded-circle mr-3">
                        <img alt="Image placeholder" src="{{asset('storage/'.$deskjob->user->avatar)}} " data-toggle="tooltip" data-placement="top" title="Author">
                    </a>
                    <div class="media-body">
                        <span class="name mb-0 text-sm"><a href=" {{url('users', $deskjob->user->username)}} " style="color:grey;font-size:12px;font-weight:bold">{{$deskjob->user->name}}</a> </span>
                    </div>
                </div>
                <br>
                <p class="card-text">
                    {{$deskjob->petunjuk}} Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur, quia. Ipsa alias sit harum odit magnam enim et, inventore labore excepturi eum sapiente quasi dolor unde nihil, reprehenderit natus voluptatem.
                </p>
                @if (!empty($deskjob->file))
                <a href=" {{asset('storage/'.$deskjob->file)}}" download>
                    <div class="border border-dark download-deskjob-file"  data-toggle="tooltip" data-placement="bottom" title="Download">
                        <div class="container" style="margin: 10px auto;"> <i class="fa fa-file mr-2" style="color:black" aria-hidden="true"></i>
                            {{$deskjob->file_name}} 
                        </div>
                    </div>
                </a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title">Kumpulkan Tugas</h3>
                <div>
                    <a href="#" class="btn btn-primary"> <i class="ni ni-send text-white mr-3"></i>Serahkan Tugas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection