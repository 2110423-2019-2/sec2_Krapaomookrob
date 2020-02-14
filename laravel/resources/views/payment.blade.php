@extends('layouts.app')





@section('menu')
<a class="btn ownbtn" href="#">Search Courses</a>
<a class="btn ownbtn" href="#">New Course Request</a>
@endsection

@section('content')

<div class = "col-lg-3">

    <h3 style ="text-align: center;">Payment</h3>
    <h type = "hidden" name = "price" value = "{{$price = 1000 * 100}}"> </h>

</div>
<div class = "row ">
    <div class = "col-lg-1">
    </div>
    <div class = "col-lg-4">
    <div class="card">
      <div class="card-body pr-0">
        <h4 class="card-title">Pay with credit/debit</h4>

        <div class="d-flex flex-wrap">

            <form name= "checkout" value = "card" method="POST" action="card" >
            @csrf
                <input name="p" type ="hidden" value = "{{$price}}">
                <input name="class" type ="hidden" value = "">
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
                <br>
        <button class ="omise-checkout-button" type="submit" id="checkoutButton"  name="form2" disabled >Pay with internet banking</button>
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

@if (isset($error))
    <div class="alert alert-warning alert-dismissible fade show">
    {{ $error }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

