@extends('layouts.app')

@section('content')
<div class="container">
  <h2>{{ isset($book) ? 'Edit Book' : 'Add Book' }}</h2>

  <form method="POST" action="{{ isset($book) ? route('books.update', $book) : route('books.store') }}">
    @csrf
    @if(isset($book)) @method('PUT') @endif

    <div class="mb-3">
      <label>Title</label>
      <input name="title" class="form-control" value="{{ old('title', $book->title ?? '') }}" required>
    </div>

    <div class="mb-3">
      <label>Author</label>
      <select name="author_id" class="form-control" required>
        @foreach($authors as $author)
        <option value="{{ $author->id }}" {{ isset($book) && $book->author_id == $author->id ? 'selected' : '' }}>
          {{ $author->name }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label>Publish Date</label>
      <input type="date" name="publish_date" class="form-control" value="{{ old('publish_date', $book->publish_date ?? '') }}" required>
    </div>

    <button class="btn btn-success">{{ isset($book) ? 'Update' : 'Save' }}</button>
  </form>
</div>
@endsection
