@extends('layouts.app')
@section('title', 'Variants')
@section('content')


    <div class="row">
        <div class="col-lg-12">
            <h1 class="text-center">Variants</h1>
            @if (session()->has('deleteMessage'))
                <div class="alert alert-warning">
                    {{ session()->get('deleteMessage') }}
                </div>
            @endif

            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Variant name</th>
                        <th scope="col">sap_product_code</th>
                        <th scope="col">web_product_code</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>


                    @foreach ($variants as $variant)
                        <tr>
                            <td scope="row">{{ $variant->name }}</td>
                            <td>{{ $variant->sap_product_code }}</td>
                            <td>{{ $variant->web_product_code }}</td>
                            <td><a href="/edit-product/{{ $variant->product_id }}" type="button"
                                    class="btn btn-primary ">Edit</a>
                            </td>
                            <td>
                                <form action="/delete-variant" method="post">
                                    @csrf
                                    <input type="text" name="productID" id="" value="{{ $variant->product_id }}"
                                        hidden>
                                    <input type="text" name="variantName" id="" value="{{ $variant->name }}"
                                        hidden>
                                    <button type="submit" type="button" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach


            </table>
        </div>
    </div>

@endsection
