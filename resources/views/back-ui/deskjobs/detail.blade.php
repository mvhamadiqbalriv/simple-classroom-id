@extends('layouts.back')
@section('title')
{{$deskjob->judul}}
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('deskjob_detail', $deskjob) }}
@endsection
@section('content')
@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <span class="alert-text"><strong>Success!</strong> {{session('status')}} !</span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
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
                    {{$deskjob->petunjuk}} 
                </p>
                @if (!empty($deskjob->file))
                <a href=" {{asset('storage/'.$deskjob->file)}}" download>
                    <div class="border border-dark download-deskjob-file rounded"  data-toggle="tooltip" data-placement="bottom" title="Download">
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
                <div class="text-sm mb-2">
                    <span class="badge badge-dot mr-4 mb-3">
                        <i class="bg-{{($deskjob_user->status == 'sudah') ? 'success' : 'warning'}} "></i>
                        <span class="status"> {{$deskjob_user->status}} mengumpulkan </span>
                    </span>
                    @if ($deskjob_user->status == 'sudah')
                        <a href=" {{asset('storage/'.$deskjob->file)}}" download>
                            <div class="border border-dark download-deskjob-file rounded" >
                                <div class="container" style="margin: 10px auto;"> <i class="fa fa-file mr-2" style="color:black" aria-hidden="true"></i>
                                    {{$deskjob->file_name}} 
                                </div>
                            </div>
                        </a>
                    @elseif(date('Y-m-d H:i:s') <= $deskjob->due_date)
                    <div class="mb-3">
                        <b>Batas Waktu : </b>
                            <div class="due_date_run" style="display: inline-block"></div>
                    </div>
                    @elseif(date('Y-m-d H:i:s') > $deskjob->due_date )
                    <br>
                    <b style="color:black;background-color:yellow">Waktu pengumpulan telah berakhir</b>
                    <br>
                    @endif
                </div>
                <div>
                    @if ($deskjob_user->status == 'belum' && date('Y-m-d H:i:s') <= $deskjob->due_date)
                    <a href="#" data-toggle="modal" data-target="#kumpulkanTugas" class="btn btn-primary"> <i class="ni ni-send text-white mr-3"></i>Serahkan Tugas</a>
                    <div class="modal fade" id="kumpulkanTugas" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action=" {{route('deskjobs.serahkan_tugas', $deskjob->slug)}} " enctype="multipart/form-data" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                                <label for="file_tugas" class="form-control-label">File Tugas</label>
                                                <input class="form-control" type="file" name="file_tugas" id="file_tugas">
                                        </div>
                                        <div class="form-group">
                                                <label for="catatan" class="form-control-label">Catatan</label>
                                                <textarea class="form-control" type="text" name="catatan" id="catatan"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" name="serahkanTugas" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('template/back-ui/vendor/timezz/timezz.js')}}"></script>
    <script>
        var due_date = "<?php echo $deskjob->due_date ?>"
        console.log(due_date);
        new TimezZ('.due_date_run', {
            date: due_date,
            daysName: ' Hari',
            hoursName: ' Jam',
            minutesName: ' Menit',
            secondsName: ' Detik',
            numberTag: 'span',
            letterTag: 'i',
            stop: false, // 
        });
    </script>
@endsection