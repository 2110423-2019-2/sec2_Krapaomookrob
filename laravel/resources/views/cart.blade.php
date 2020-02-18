@extends('layouts.app')

ิ@section('title', 'My Shopping Cart')

@section('topic', 'Cart')

@section('menu')

    <a href="#" class="btn ownbtn px-5">Back</a>

@endsection

@section('content')
    {{-- content of cart --}}
    
    <div class="card pb-2">
        <div class="card-body">
            <h4 class="card-title">Courses in Cart</h4>
            <div class="row mt-3 mb-2 bline">
                <div class="col-lg">Tutor</div>
                <div class="col-lg">Available Subjects</div>
                <div class="col-lg">Areas</div>
                <div class="col-lg">Classes</div>
                <div class="col-lg">Price/Start Date</div>
                <div class="col-lg"></div>
            </div>
            
            <div id='app'>
                <cart-item button-type="cancelbtn"></cart-item>
            </div>
        </div>
        
    </div>
    
<div class = "row ">
    <h1 type = "hidden" name = "price" value = "{{$price = CartItem:totalPrice * 100}}"> </h1>
    <h1 type = "hidden" name = "paymentID" value = "{{$paymentID = 1}}"> </h1>
    <div class = "col-lg-1">
    </div>
    <div class = "col-lg-4">
    <div class="card">
      <div class="card-body pr-0">
        <h4 class="card-title">Pay with credit/debit</h4>

        <div class="d-flex flex-wrap">

            <form name= "checkout" value = "card" method="POST" action="card" onclick="checkOutCart()" >
            @csrf
                <input name="p" type ="hidden" value = "{{$price}}">
                <input name="pid" type ="hidden" value = "{{$paymentID}}">
            <script type="text/javascript"   src="https://cdn.omise.co/omise.js"
                data-key="pkey_test_5irvp3eqbf7ybksdjlt"
                data-image="{{asset('img/favicon.png')}}"
                data-frame-label="EDITT payment"
                data-button-label="check out"
                data-submit-label="Submit"
                data-amount="{{$price}}" //money in thb that must *100 to
                data-currency="thb"
                >
            </script>

            </form>
            </div>
        </div>
    </div>
    </div>

    <div class = "col-lg-4">
        <div class="card">
        <div class="card-body pr-0">
            <h4 class="card-title">Pay with internet banking</h4>
            <br>
            <div class="d-flex flex-wrap">
            <form name = 'intercheckout' method="POST" action ="internet" >
            @csrf
                <input type="radio" id ="scb" name ="internet_bnk" onclick="Button1()" value="internet_banking_scb" > SCB Easy Net<hr>
                <input  type="radio" id = "bbl" name ="internet_bnk" onclick="Button1()" value="internet_banking_bbl"> Bualuang iBanking<hr>
                <input  type="radio" id = "ktb" name ="internet_bnk" onclick="Button1()" value="internet_banking_ktb"> KTB Netbank<hr>
                <input type="radio" id ="bay" name ="internet_bnk" onclick="Button1()" value="internet_banking_bay"> Krungsri Online<br>
                <input name="p" type ="hidden" value = "{{$price}}">
                <input name="pid" type ="hidden" value = "{{$paymentID}}">
                <br>
        <button class ="omise-checkout-button" type="submit" id="checkoutButton" onclick="checkOutCart()"  name="form2" disabled >Pay with internet banking</button>
            <script>
                function Button1() {
                var checkRadio = document.querySelector('input[name="internet_bnk"]:checked');

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
        </div>
    </div>
</div>

@endsection
    
<script>

    // declare delete cart function here
    function checkOutCart() {
      console.log("delete cookie!");
      Vue.cookie.delete("cart");
    }
</script>

