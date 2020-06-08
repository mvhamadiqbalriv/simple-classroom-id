@extends('layouts.back')
@section('title')
    Ubah User
@endsection
@section('content')
    <div class="row justify-content-md-center">
            <div class="col-xl-4 order-xl-2 col-centered">
                <div class="card card-profile">
                    <img src="{{asset('template/back-ui/img/theme/img-1-1000x600.jpg')}}" alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    <img src="{{asset('storage/'.$user->avatar)}}" width="150" height="150" style="object-fit: cover" class="rounded-circle">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center">
                                    <div>
                                        <span class="heading">10</span>
                                        <span class="description">Kelas</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <h5 class="h3">
                                {{$user->name}}
                            </h5>
                            <div class="h5 font-weight-300">
                                <i class="ni location_pin mr-2"></i>{{$user->address}}
                            </div>
                            <br>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ubahpassword">
                                Ubah password
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="ubahpassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ubah Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('users.change_password',$user->id)}} " method="post">
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Old Password" name="old_password" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="New Password" name="new_password" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="New Password Confrimation" name="conf_password" type="password">
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 order-xl-1">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('users.update', $user->id)}}" method="POST">
                            @csrf
                            <input type="hidden" value="PUT" name="_method">
                            <h6 class="heading-small text-muted mb-4">User information</h6>
                            <div class="pl-lg-4">
                                @if(session('success')) <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                                    <span class="alert-icon"><i class="ni ni-like-2"></i></span> {{session('success')}} 
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>@endif
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-name">Nama</label>
                                            <input type="text" id="input-name" class="form-control" placeholder="name" name="name" value="{{$user->name}}"> 
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-email">Email address</label>
                                            <input type="email" id="input-email" name="email" class="form-control"
                                                placeholder="email" value="{{$user->email}}"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-first-roles">Roles</label>
                                            <div class="custom-control custom-control-alternative custom-radio">
                                                <input class="custom-control-input" value="Admin" id="adminrole" name="roles" type="radio" {{($user->roles == 'Admin') ? 'checked' : null}}>
                                                <label class="custom-control-label" for="adminrole">
                                                    <span class="text-muted">Admin </span>
                                                </label>
                                            </div>
                                            <div class="custom-control custom-control-alternative custom-radio">
                                                <input class="custom-control-input" value="User" id="userrole" name="roles" type="radio" {{($user->roles == 'User') ? 'checked' : null}}>
                                                <label class="custom-control-label" for="userrole">
                                                    <span class="text-muted">User </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-phone">Phone</label>
                                            <input type="text" id="input-phone" class="form-control" placeholder="phone" name="phone"
                                                value="{{$user->phone}} ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Address</label>
                                            <textarea rows="4" cols="30" class="form-control" name="address" placeholder="address">{{$user->address}} </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-left">
                                    <button type="submit" class="btn btn-primary mt-4">Edit User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection