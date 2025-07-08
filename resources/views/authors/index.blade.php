@extends('layouts.app')

@section('content')
<div class="container">
  <h2>Authors</h2>
  <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Add Author</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Name</th>
        <th>Biography</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($authors as $author)
      <tr>
        <td>{{ $author->name }}</td>
        <td>{{ $author->biography }}</td>
        <td>
          <a href="{{ route('authors.edit', $author) }}" class="btn btn-sm btn-warning">Edit</a>
          <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this author?')">Delete</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
