@extends('layouts.app')

@section('content')
<form accept="{{route('sentemail.store')}}" method="post" enctype="multipart/form-data">
  @csrf
    <div class="mb-3">
      <input name="title" class="form-control" placeholder="Title">
    </div>
   
    <div class="mb-3">
   <textarea name="content" placeholder="Content" class="form-control"></textarea>
    </div>
    <div class="mb-3">
        <input name="link" class="form-control" placeholder="Link">
      </div>
    <div class="mb-3">
        <input type="file" name="image" class="form-control" placeholder="Link" >
      </div>
   
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
    
@endsection