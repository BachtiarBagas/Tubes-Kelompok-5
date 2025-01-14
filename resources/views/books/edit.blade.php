@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Title</label>
        <input type="text" name="title" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Author</label>
        <input type="text" name="author" class="form-control" required>
    </div>
    <div class="form-group">
        <label>Year</label>
        <input type="number" name="year" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success mt-3">Save</button>
</div>
</form>
@endsection
