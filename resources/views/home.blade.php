@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        
                        <div class="col col-md-4"><b>Blogs</b></div>
                        <div class="col col-md-4"><input class="date form-control" name="search_date" type="text"></div>
                        <div class="col col-md-4">
                            <a href="{{ route('blogs.create') }}" class="btn btn-success btn-sm float-end">New Blog</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Categories</th>
                            <th>Description</th>
                            <th>Created at</th>
                           
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($data) > 0)

                        @foreach($data as $row)
                            @php
                             $catNames =categoryNameByids($row->category_ids);
                            @endphp
        
                            <tr>
                                <td><img src="{{ asset('images/' . $row->image) }}" width="75" /></td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $catNames }}</td>
                                <td>{{ $row->content }}</td>
                                <td>{{ date('d-M-y',strtotime($row->created_at)) }}</td>
                                
                            </tr>
        
                        @endforeach
        
                    @else
                        <tr>
                            <td colspan="5" class="text-center">No Data Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
               

                </div>
            </div>
        </div>
    </div>
@endsection
