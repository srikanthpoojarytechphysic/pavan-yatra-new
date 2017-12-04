@extends('layouts.app')


@section('styles')

@endsection
<link rel="stylesheet" href="{{URL::asset('css/snappysnippet.css')}}">
@section('content')
<div class="container" style="min-height:300px;">
  <div class="col-lg-12">
    <div class="success-msg">
      <h3 class="thank">Thank You</h3>
      <h5 class="thank-sub">Your Booking Has Been Done Successfully!</h5>
    </div>
  </div>
</div>
@endsection
