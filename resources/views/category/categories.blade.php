@extends('layouts.app')
@section('title', 'Categories')
@section('content')


    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">Categories</h1>

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if (session()->has('deleteMessage'))
                <div class="alert alert-warning">
                    {{ session()->get('deleteMessage') }}
                </div>
            @endif

            <a href="{{ route('addCategory') }}" type="button" class="btn btn-success mb-4">Add Category</a>

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Category name</th>
                        <th scope="col">Meta title</th>
                        <th scope="col">Meta description</th>
                        <th scope="col">Meta keywords</th>
                        <th scope="col">Products</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($categories as $category)
                        <tr>
                            <td scope="row">{{ $category->name }}</td>
                            <td>{{ $category->meta_title }}</td>
                            <td>{{ Str::of($category->meta_description)->limit(20) }}</td>
                            <td>{{ Str::of($category->meta_keywords)->limit(20) }}</td>
                            <td><a href="{{ $category->id }}/products" type="button" class="btn btn-light">Products</a>
                            </td>
                            <td><a href="edit-category/{{ $category->id }}" type="button" class="btn btn-primary ">Edit</a>
                            </td>
                            <td>
                                <form action="delete-category" method="post">
                                    @csrf
                                    <input type="text" name="categoryID" id="" value={{ $category->id }} hidden>
                                    <button type="submit" type="button" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


            </table>
        </div>
    </div>

@endsection
