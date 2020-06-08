@extends('layouts.back')
@section('add_data')
    <a href="{{route('users.create')}} " class="btn btn-sm btn-neutral">Tambah User</a>
@endsection
@section('content')
    <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">List users</h3>
                    </div>
                    <form action="{{route('users.index')}}">
                        <div class="col-md-2 col-lg-3 col-sm-4">
                            <div class="input-group input-group-sm mb-3">
                                <input type="text" class="form-control" value="{{Request::get('keyword')}}" name="keyword" placeholder="Cari berdasarkan nama" aria-label="Cari berdasarkan nama"
                                    aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-addon2">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="container-fluid">
                        @if(session('success')) <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                            <span class="alert-icon"><i class="ni ni-like-2"></i></span> {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>@endif
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Role</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($users as $user) 
                                <tr>
                                    <th scope="row">
                                        <div class="media align-items-center">
                                            <a href="#" class="avatar rounded-circle mr-3">
                                                <img alt="Image placeholder" width="48" height="48" style="object-fit: cover" src="{{asset('storage/'.$user->avatar)}}">
                                            </a>
                                            <div class="media-body">
                                                <span class="name mb-0 text-sm">{{$user->name}} </span>
                                            </div>
                                        </div>
                                    </th>
                                    <td>
                                        {{$user->email}}
                                    </td>
                                    <td>
                                        {{$user->address}}
                                    </td>
                                    <td>
                                        {{$user->phone}}
                                    </td>
                                    <td>
                                        <span class="badge badge-dot mr-4">
                                            <i class="bg-{{($user->roles == 'Admin') ? 'warning' : 'success'}}"></i>
                                            <span class="status">{{$user->roles}} </span>
                                        </span>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="{{route('users.edit',$user->id)}}" class="btn btn-primary btn-sm">Edit</a>
                                                <form onsubmit="return confirm('Delete this user permanently?')" class="d-inline"
                                                    action="{{route('users.destroy', $user->id )}}" method="POST"> @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="submit" value="Delete" class="dropdown-item">
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer py-4">
                        <nav aria-label="...">
                            <ul class="pagination justify-content-end mb-0">
                                {{$users->appends(Request::all())->links()}}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
@endsection