@extends('layouts.app')


@section('title', 'Add Product')


@section('content')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">{{ $product->name }}</h1>

            <form action="/edit-product/{{ $product->id }}" method="post">
                <h2>Edit product</h2>
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger" role="alert">:message</div>')) !!}
                @endif

                @csrf

                <div class="row row-cols-lg-2 row-cols-1 gx-5">
                    <div class="col">
                        <div class="form-outline mb-4">
                            <input type="text" id="form2Example1" class="form-control" name="name"
                                value="{{ $product->name }}" />
                            <label class="form-label" for="form2Example1">Product name</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-outline mb-4">
                            <input type="text" id="form2Example1" class="form-control" name="slug"
                                value="{{ $product->slug }}" />
                            <label class="form-label" for="form2Example1">Slug</label>
                        </div>
                    </div>
                </div>





                <div class="form-outline mb-4">

                    <div class="row row-cols-lg-2 row-cols-1">
                        <div class="col">
                            <h3>Add categories</h3>
                            @foreach ($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $category->name }}"
                                        id="{{ str_replace(' ', '-', strtolower($category->name)) }}" name="categories[]">
                                    <label class="form-check-label"
                                        for="{{ str_replace(' ', '-', strtolower($category->name)) }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="col">
                            <h3>Unlink categories</h3>
                            @foreach ($productCategories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $category->name }}"
                                        id="{{ str_replace(' ', '-', strtolower($category->name)) }}"
                                        name="categoriesDelete[]">
                                    <label class="form-check-label"
                                        for="{{ str_replace(' ', '-', strtolower($category->name)) }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>



                </div>



                <div class="form-outline mb-4">

                    <div class="row row-cols-lg-2 row-cols-1">

                        <div class="col">
                            <h3>Add Variants</h3>

                            <div class="form-outline mb-4">
                                <input type="number" id="variantNum" class="form-control" min="1" />
                                <label class="form-label" for="variantNum">Select number of variants</label>
                            </div>

                            <div id="variantTextFields">

                                <div class="row row-cols-3 mb-4">

                                    <div class="col">
                                        <div class="form-outline mb-4"> <input type="text" name="variantName[]"
                                                class="form-control" /> <label class="form-label">Variant Name</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline mb-4"> <input type="text" name="sapProductCode[]"
                                                class="form-control" /> <label class="form-label">SAP product code</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-outline mb-4"> <input type="text" name="webProductCode[]"
                                                class="form-control" /> <label class="form-label">Web product code</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col">
                            <h3>Unlink Variants</h3>
                            @foreach ($productVariants as $variant)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $variant->name }}"
                                        id="{{ str_replace(' ', '-', strtolower($variant->name)) }}"
                                        name="variantsDelete[]">
                                    <label class="form-check-label"
                                        for="{{ str_replace(' ', '-', strtolower($variant->name)) }}">
                                        {{ $variant->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>



                </div>



                <button type="submit" type="button" class="btn btn-primary btn-block mb-4">Update</button>


            </form>


        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#variantNum").val(1);
        });
        $("#variantNum").on('input', function() {


            var loopAmt = $(this).val();
            let variantFields = "";

            for ($i = 0; $i < loopAmt; $i++) {
                variantFields +=
                    '<div class="row row-cols-3 mb-4"> <div class="col"> <div class="form-outline mb-4"> <input type="text" name="variantName[]" class="form-control" /> <label class="form-label">Variant Name</label> </div> </div> <div class="col"> <div class="form-outline mb-4"> <input type="text" name="sapProductCode[]" class="form-control" /> <label class="form-label">SAP product code</label> </div> </div> <div class="col"> <div class="form-outline mb-4"> <input type="text" name="webProductCode[]" class="form-control" /> <label class="form-label">Web product code</label> </div> </div> </div>';
            }

            $("#variantTextFields").html(variantFields);



        });
    </script>

@endsection
