@extends('layouts.app')
@section('title', 'Products')
@section('description', '')


@section('content')
    <h1>hi</h1>

    @dump($errors)
    <h1>edit</h1>
    <form method="POST" action="{{ route('product.update', $product) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="" id="">
        <label for="article">Article</label>
        <input value="{{ $product->article }}" type="text" name="article" id="article">
        <label for="name">Name</label>
        <input value="{{ $product->name }}" type="text" name="name" id="name">
        <label for="status">Status</label>
        <select name="status" id="status">
            @foreach ($statuses as $status)
                <option @if ($status->value == $product->status) selected @endif value="{{ $status->value }}">{{ $status->name() }}</option>
            @endforeach
        </select>
        @foreach ($product->data as $d)
            <br>
            <label for="data">Key</label>
            <input value="{{ $d['key'] }}" type="text" name="data[{{ $loop->index }}][key]">
            <label for="data">Value</label>
            <input value="{{ $d['value'] }}" type="text" name="data[{{ $loop->index }}][value]" id="data">
        @endforeach
        <input type="submit" value="Submit">
        <br>
    </form>
    <br>
    @dump($product->toArray())
@endsection
