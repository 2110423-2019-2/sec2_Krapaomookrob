@extends('layouts.app')





@section('menu')
<a class="btn ownbtn" href="#">Search Courses</a>
<a class="btn ownbtn" href="#">New Course Request</a>
@endsection

@section('content')
<div class = "row">
    <div class = "row-sm-6 col-sm-6">
    <form name="checkout" value = "card" method="POST" action="card" >
      @csrf
      <script type="text/javascript"   src="https://cdn.omise.co/omise.js"
        data-key="pkey_test_5irvp3eqbf7ybksdjlt"
        data-image="{{asset('img/favicon.png')}}"
        data-frame-label="EDITT payment"
        data-button-label="Pay with Credit/Debit"
        data-submit-label="Submit" 
        data-amount="10025" //money in thb that must *100 to
        data-currency="thb"
        >
      </script>
      <!--the script will render <input type="hidden" name="omiseToken"> for you automatically-->
    </form>

    <!-- data-key="YOUR_PUBLIC_KEY" -->
    </div>
    
    <div class = "col-sm-6">
        <form name = 'intercheckout' method="POST" action ="internet">
          @csrf  
            <input type="radio" name ="internet_bnk" value="internet_banking_scb"> SCB<br>
            <input type="radio" name ="internet_bnk" value="internet_banking_bbl"> BBL<br>
            <input type="radio" name ="internet_bnk" value="internet_banking_ktb"> KTB<br>
            <input type="radio" name ="internet_bnk" value="	internet_banking_bay">กรุงศรี<br>
            
      <button type="submit" id="checkoutButton" name="form2">Pay with internet banking</button>
        </form>
    </div>
</div>
@endsection

