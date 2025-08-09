@extends('layouts.base')
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Post</h1>
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
                        <h3 class="card-title">{{  $post->id ? 'Edit Post' : 'Create Post'}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{  $post->id ? route('post.update',  $post->id) : route('post.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if( $post->id)
                            @method('PUT')
                        @endif
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">Post Title</label>
                                <input type="text" name="title" class="form-control {{$errors->has('title') ? 'is-invalid' : ''}}" id="title" placeholder="Enter Post Name" value="{{ old('title', $post->title)  }}">
                            </div>
                            @if($errors->has('title'))
                                <div class="text-danger mb-2">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control {{$errors->has('description') ? 'is-invalid' : ''}}">{{ old('description', $post->description) }}
                                </textarea>
                            </div>
                            @if($errors->has('description'))
                                <div class="text-danger mb-2">
                                    {{ $errors->first('description') }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="contact_phone_number"> Contact Phone Number</label>
                                <input type="text" name="contact_phone_number" class="form-control {{$errors->has('contact_phone_number') ? 'is-invalid' : ''}}" id="contact_phone_number" placeholder="Enter Contact Phone Number" value="{{ old('contact_phone_number', $post->contact_phone_number) }}">
                            </div>
                            @if($errors->has('contact_phone_number'))
                                <div class="text-danger mb-2">
                                    {{ $errors->first('contact_phone_number') }}
                                </div>
                            @endif


                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{  $post->id ? 'Update' : 'Create'}}</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection
