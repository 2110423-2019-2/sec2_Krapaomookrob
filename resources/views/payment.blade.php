@extends('layouts.app')





@section('menu')
<a class="btn ownbtn" href="#">Search Courses</a>
<a class="btn ownbtn" href="#">New Course Request</a>
@endsection

<div>
<form name="checkoutForm" method="POST" action="result">
  @csrf
  <script type="text/javascript" src="https://cdn.omise.co/omise.js"
    data-key="pkey_test_5irvp3eqbf7ybksdjlt"
    data-image="http://bit.ly/customer_image"
    data-frame-label="Merchant site name"
    data-button-label="Pay now"
    data-submit-label="Submit"
    data-amount="10025" //money in thb that must *100 to
    data-currency="thb"
    >
  </script>
  <!--the script will render <input type="hidden" name="omiseToken"> for you automatically-->
</form>

<!-- data-key="YOUR_PUBLIC_KEY" -->
</div>
