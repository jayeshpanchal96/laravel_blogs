@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="row justify-content-center">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-header">Add Blog</div>
                <div class="card-body">
                    <form method="post" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Categories</label>
                            <div class="col-sm-10">

                                <select name="categories[]" id="categories" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-2 col-label-form">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="content" id="content" rows="4"></textarea>
                            </div>
                        </div>



                        <div class="row mb-4">
                            <label class="col-sm-2 col-label-form">Image</label>
                            <div class="col-sm-10">
                                <input type="file" name="image" />
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" class="btn btn-primary" value="Add" />
                            <a href="/" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection('content')
