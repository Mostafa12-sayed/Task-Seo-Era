@extends('layouts.base')
@section('header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Users </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@endsection
@section('content')

    <section class="content">

        <div class="row">

            <div class="col-12">

                <x-data-table title="Posts" route="{{route('post.create')}}">
                    <table id="example2" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($posts as $post)
                            <tr>
                                <td>{{$post->title}}</td>
                                <td>{{$post->created_at->diffForHumans()}}</td>
                                <td>{{$post->user->username}}</td>
                                <td>
                                    <a href="{{route('post.edit', $post->id)}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <form action="{{route('post.destroy', $post->id)}}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; padding: 0; cursor: pointer;">
                                            <i class="fa-solid fa-trash" style="color: #f00a0a;"></i>
                                        </button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Posts found</td>
                            </tr>
                        @endforelse
                        </tbody>

                    </table>
                </x-data-table>

            </div>

        </div>
        <!-- /.row -->

    </section>
@endsection
