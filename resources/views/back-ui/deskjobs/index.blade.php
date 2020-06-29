@extends('layouts.back')
@section('title')
    Tugas
@endsection
@section('breadcrumb')
{{ Breadcrumbs::render('deskjobs') }}
@endsection
@section('content')
<div class="row">
        <div class="col">
            <div class="card bg-default shadow">
                <div class="card-header bg-transparent border-0">
                    <h3 class="text-white mb-0">Tugas</h3>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush">
                        <thead class="thead-dark">
                            <tr>
                                <th>Judul</th>
                                <th>Kelas</th>
                                <th>Deadline</th>
                                <th>Status pengumpulan</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($deskjob_users as $item)  
                            <tr>
                                <td>
                                    <a href=" {{route('deskjobs.show', $item->deskjob->slug)}} " style="color:white;font-weight:bold;font-size:15px;">{{$item->deskjob->judul}}</a>
                                    
                                </td>
                                <td>
                                    <a href="{{route('classrooms.show', $item->deskjob->classroom->token)}}" style="color:white">{{$item->deskjob->classroom->nama_kelas}}</a>
                                    
                                </td>
                                <td>
                                    {{tanggal_indonesia(date('Y-m-d', strtotime($item->deskjob->due_date))) }} Jam {{date('H:i', strtotime($item->deskjob->due_date))}}
                                    @if (date('Y-m-d H:i:s') > $item->deskjob->due_date)
                                        <div class="text-danger" style="display: inline-block">(Berakhir)</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-dot mr-4 mb-3">
                                        <i class="bg-{{($item->status == 'sudah') ? 'success' : 'warning'}} "></i>
                                        <span class="status"> {{$item->status}}</span>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-default py-4">
                <nav aria-label="...">
                    <ul class="pagination justify-content-end mb-0">
                        {{$deskjob_users->appends(Request::all())->links()}}
                    </ul>
                </nav>
                </div>
            </div>
        </div>
    </div>
@endsection