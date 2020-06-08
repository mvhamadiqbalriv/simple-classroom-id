@extends('layouts.back')

@section('title')
    Tambah User
@endsection
@section('content')

<div class="container">
        <!-- Table -->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card bg-secondary border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        @if(session('status')) <div class="alert alert-success text-center">{{session('status')}} </div>@endif
                        <form role="form" action="{{route('users.store')}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Name" name="name" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Email" name="email" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Password Confrimation" name="password_confirmation" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-control-alternative custom-radio">
                                    <input class="custom-control-input" value="Admin" id="adminrole" name="roles" type="radio">
                                    <label class="custom-control-label" for="adminrole">
                                        <span class="text-muted">Admin </span>
                                    </label>
                                </div>
                                <div class="custom-control custom-control-alternative custom-radio">
                                    <input class="custom-control-input" value="User" id="userrole" name="roles" type="radio">
                                    <label class="custom-control-label" for="userrole">
                                        <span class="text-muted">User </span>
                                    </label>
                                </div>
                            </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-square-pin"></i></span>
                                        </div>
                                        <textarea name="address" class="form-control" id="" cols="30" rows="3">Alamat</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-tablet-button"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Phone Number" name="text" type="number">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 mb-2">
                                        <img id="image_preview_container" src="#" alt="preview image"
                                            width="200" height="200" style="object-fit: cover">
                                    </div>
                                    <div class="input-group input-group-merge input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-image"></i></span>
                                        </div>
                                        <input class="form-control" id="avatar" name="avatar" type="file">
                                    </div>
                                </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-4">Create account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script type="text/javascript">
        $(document).ready(function (e) {
            
            $('#image_preview_container').hide();
            $('#avatar').change(function(){
              
                let reader = new FileReader();
                reader.onload = (e) => { 
                  $('#image_preview_container').attr('src', e.target.result); 
                  $('#image_preview_container').show();
                }
                reader.readAsDataURL(this.files[0]); 
     
            });
        });
     
    </script>
@endsection