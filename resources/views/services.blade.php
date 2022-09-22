@extends('layouts.front')

@section('content')
<form action="{{route('services.store')}}" method="post">
    @csrf
    <div class="mb-3">
      
      <input type="name" class="form-control"  name="name" placeholder="Name">
    
    </div>
    <div class="mb-3">
      
      <input type="name" class="form-control"  name="address" placeholder="Address">
    
    </div>
    <div class="mb-3">
      
      <input type="email" class="form-control"  name="email" placeholder="Email">
    
    </div>
    <div class="mb-3">
      
     <textarea name="message" class="form-control" id="" cols="30" rows="10" placeholder="message"></textarea>
    </div>
   
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection