@extends('layouts.app')
@section('title', 'Edit Category')


@section('content')

    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">{{ $category->name }}</h1>


            <form action="/edit-category/{{ $category->id }}" method="post">
                <h2 class="mb-4">Edit Category</h2>
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                @endif

                @csrf

                <div class="row row-cols-lg-2 row-cols-1 gx-5">
                    <div class="col">
                        <div class="form-outline mb-4">
                            <input type="text" id="form2Example1" class="form-control" name="name"
                                value="{{ $category->name }}" />
                            <label class="form-label" for="form2Example1">Category name</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline mb-4">
                            <input type="text" id="form2Example1" class="form-control" name="title"
                                value="{{ $category->meta_title }}" />
                            <label class="form-label" for="form2Example1">Meta title</label>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-lg-2 row-cols-1 gx-5">
                    <div class="col">
                        <div class="form-outline mb-4">
                            <textarea name="description" id="form2Example1" class="w-100" rows="10">{{ $category->meta_description }}</textarea>
                            <label class="form-label" for="form2Example1">Meta description</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline mb-4">
                            <textarea name="keywords" id="form2Example1" class="w-100" rows="10">{{ $category->meta_keywords }}</textarea>
                            <label class="form-label" for="form2Example1">Meta keywords</label>
                        </div>
                    </div>
                </div>









                <button type="submit" type="button" class="btn btn-primary btn-block mb-4">Update</button>


            </form>


        </div>
    </div>

@endsection
