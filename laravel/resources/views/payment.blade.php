@extends('layouts.app')





@section('menu')
<a class="btn ownbtn" href="#">Search Courses</a>
<a class="btn ownbtn" href="#">New Course Request</a>
@endsection

@section('content')

<div>
    <h type = "hidden" name = "price" value = "{{$price = 1000 * 100}}"> </h>
</div>
<div class = "row">
    <div class = "row-sm-6 col-sm-6">
    <form name="checkout" value = "card" method="POST" action="card" >
      @csrf
        <input name="p" type ="hidden" value = "{{$price}}">
        <input name="class" type ="hidden" value = "">
      <script type="text/javascript"   src="https://cdn.omise.co/omise.js"
        data-key="pkey_test_5irvp3eqbf7ybksdjlt"
        data-image="{{asset('img/favicon.png')}}"
        data-frame-label="EDITT payment"
        data-button-label="Pay with Credit/Debit"
        data-submit-label="Submit" 
        data-amount="{{$price}}" //money in thb that must *100 to
        data-currency="thb"
        >
      </script>
      <!--the script will render <input type="hidden" name="omiseToken"> for you automatically-->
    </form>

    <!-- data-key="YOUR_PUBLIC_KEY" -->
    </div>
    
    <div class = "col-sm-6">
        <form name = 'intercheckout' method="POST" action ="internet"  onclick="checkRadioButon()">
          @csrf  
            <input type="radio" id ="scb" name ="internet_bnk" onclick="checkRadioButon()" value="internet_banking_scb" > SCB<br>
            <input type="radio" id = "bbl" name ="internet_bnk" onclick="checkRadioButon()" value="internet_banking_bbl"> BBL<br>
            <input type="radio" id = "ktb" name ="internet_bnk" onclick="checkRadioButon()" value="internet_banking_ktb"> KTB<br>
            <input type="radio" id ="bay" name ="internet_bnk" onclick="checkRadioButon()" value="	internet_banking_bay">กรุงศรี<br>
            <input name="p" type ="hidden" value = "{{$price}}">
      <button type="submit" id="checkoutButton"  name="form2" disabled onclick = "()">Pay with internet banking</button>
           <script>
               
        function checkRadioButon() {  
            var checkRadio = document.querySelector( 
                'input[name="internet_bnk"]:checked'); 
              
            if(checkRadio == null) { 
                document.getElementById("checkoutButton").disabled = true;
            }
            else{
                document.getElementById("checkoutButton").disabled = false;
            }
        } 
    </script> 
        </form>
    </div>
</div>
@endsection

