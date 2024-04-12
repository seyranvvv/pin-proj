@extends('layouts.app')
@section('title', 'Products')
@section('description', '')


@section('content')
    <h1>hi</h1>
    @dump($errors)
    <h1>create</h1>
    <form method="POST" action="{{ route('product.store') }}">
        @csrf
        <label for="article">Article</label>
        <input type="text" name="article" id="article">
        <label for="name">Name</label>
        <input type="text" name="name" id="name">
        <label for="status">Status</label>
        <select name="status" id="status">
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}">{{ $status->name() }}</option>
            @endforeach
        </select>
        <br>
        <label for="data">Key</label>
        <input type="text" name="data[0][key]" id="data">
        <label for="data">Vaalue</label>
        <input type="text" name="data[0][value]" id="data">
        <br>
        <label for="data">Key</label>
        <input type="text" name="data[1][key]" id="data">
        <label for="data">Vaalue</label>
        <input type="text" name="data[1][value]" id="data">
        <input type="submit" value="Submit">
    </form>
    <br>
    <h1>hi</h1>
    @dump($errors)
    <br>
    @dump($products->toArray())
@endsection
