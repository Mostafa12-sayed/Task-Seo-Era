@extends('layouts.base')
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create User</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $user->id ? 'Edit User' : 'Create User'}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ $user->id ? route('user.update', $user->id) : route('user.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if($user->id)
                            @method('PUT')
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" name="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" id="username" placeholder="Enter User Name" value="{{ old('username',$user->username)  }}">
                            </div>
                            @if($errors->has('username'))
                                <div class="text-danger mb-2">
                                    {{ $errors->first('username') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" name="email" class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" id="exampleInputEmail1" placeholder="Enter email" value="{{ old('email',$user->email) }}">
                            </div>
                            @if($errors->has('email'))
                                <div class="text-danger mb-2">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="mobile_number">Phone Number</label>
                                <input type="text" name="mobile_number" class="form-control {{$errors->has('mobile_number') ? 'is-invalid' : ''}}" id="mobile_number" placeholder="Enter Mobile Number" value="{{ old('mobile_number',$user->mobile_number) }}">
                            </div>
                            @if($errors->has('mobile_number'))
                                <div class="text-danger mb-2">
                                    {{ $errors->first('mobile_number') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" id="exampleInputPassword1" value="{{old('password')}}" placeholder="Password">
                            </div>
                            @if($errors->has('password'))
                                <div class="text-danger mb-2">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ $user->id ? 'Update' : 'Create'}}</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
