@extends('layouts.app')


@section('styles')

@endsection
<link rel="stylesheet" href="{{URL::asset('css/snappysnippet.css')}}">
@section('content')
<div class="row">
  <div class="container">
    <div class="col-lg-12" style="min-height:300px;">
      <form action="{{route('verify.payment.form',['ref_no' => Request::segment(4)])}}" method="POST">
      <!-- Note that the amount is in paise = 50 INR -->
      <script
          src="https://checkout.razorpay.com/v1/checkout.js"
          data-key="rzp_test_pKL2dR77Wf9ipw"
          data-amount="{{Session('totalfare',0)}}"
          data-buttontext="Pay with Razorpay"
          data-name="Merchant Name"
          data-description="Purchase Description"
          data-image="https://your-awesome-site.com/your_logo.jpg"
          data-prefill.name="Harshil Mathur"
          data-prefill.email="support@razorpay.com"
          data-theme.color="#f91942"
      ></script>
      <input type="hidden" value="Hidden Element" name="hidden">
      {{csrf_field()}}
      </form>
    </div>
  </div>
</div>
@endsection
