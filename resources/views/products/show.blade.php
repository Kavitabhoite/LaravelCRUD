@extends('layouts.app')

@section('main')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 mt-4">
                <div class="card p-4">
                    <p><b>Name : </b>{{ $product->name }}</p>     
                    <p><b>Description : </b>{{ $product->description }}</p>
                    <img src="/products/{{ $product->image }}" class="rounded" width="100%" />
                </div>
            </div>
        </div>
    </div>

@endsection