@extends('layouts.backendlayouts')


@section('backend')

<section id="profile">
    <div class="container mt-5 pt-3">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Edit Profile</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('show.profile.update') }} " method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <input value="{{auth()->user()->name}}" name="name" class="form-control my-2" placeholder="Your username" type="text">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <input value="{{auth()->user()->email}}" name="email" class="form-control my-2" placeholder="your email" type="text">
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <label for="">Profile Image
                                <input name="profile_img" class="form-control my-2"type="file">
                                @error('profile_img')
                                <span class="text-danger">{{$message}}</span>
                                 @enderror
                            </label><br>                        
                            <button class="btn btn-primary" type="submit">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Password Update</h3>
                        <div class="card-body">
                            <form action="{{ route("show.profile.password.update") }}" method="post">
                                @csrf
                                @method('put')
                                <input name="old" class="form-control my-2" placeholder="Old Password" type="password">
                                @error('old')
                                <span class="text-danger">{{$message}}</span>
                                 @enderror
                                <input name="password" class="form-control my-2" placeholder="New Password" type="password">
                                @error('password')
                                <span class="text-danger">{{$message}}</span>
                                 @enderror
                                <input name="password_confirmation" class="form-control my-2" placeholder="Confirm Password" type="password">
                                @error('password_confirmation')
                                <span class="text-danger">{{$message}}</span>
                                 @enderror
                                <button class="btn btn-primary" type="submit">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection