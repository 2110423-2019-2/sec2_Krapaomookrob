@extends('layouts.forPayment')

@section('title', 'Courses payment')

@section('topic', 'Payment')



@section('content')
<div class = "col-lg-0">
    <h4 type = "hidden" name = "price" value = "{{$price = $totalprice * 100}}"></h4>
</div>
    <div class="card pb-2">
            <div class="card-body">
@if(!$isAdvertisement)
                <div class="row course-item mb-2 pb-2 bline">
                    <div class="col-lg">Tutor</div>
                    <div class="col-lg">Available Subjects</div>
                    <div class="col-lg">Area</div>
                    <div class="col-lg">Classes</div>
                    <div class="col-lg">Price/Start Date</div>
                </div>


@foreach ($responses as $response)
<div class="row course-item mb-2 pb-2 border-bottom">
                <div class="col-lg">
                    <strong>{{$response['tutor_name']}}</strong>

                  </div>
                  <div class="col-lg" >
                  @foreach ( $response['subjects'] as $subject)
                <li>{{ $subject }} </li>
            @endforeach
                  </div>
                  <div class="col-lg">{{$response['area']}}</div>
                  <div class="col-lg">
                  @foreach ( $response['days'] as $day)
                    {{ $day }}
            @endforeach
                    <br />
                    {{$response['time']}}
                    <br />
                    ({{$response['hour']}} hrs/class)
                </div>
                  <div class="col-lg">
                    {{$response['price']}} THB
                    <br />
                    Starts on {{$response['startDate']}}
                  </div>

</div>
@endforeach
@endif

@if($isAdvertisement)

                <div class="row course-item mb-2 pb-2 bline">
                  <div class="col-lg">Entries</div>
                  <div class="col-lg"></div>
                  <div class="col-lg"></div>
                  <div class="col-lg"></div>
                  <div class="col-lg"></div>
                </div>
              <div>Ads for course {{$course_id}}</div>
@endif


    <div class="row justify-content-end pr-5 mt-3">
      <div class="col-2 mr-0 pl-5" style="float: right; font-size:1.4em;">
        <p class="text-right">
          <strong>Summary</strong>
        </p>
      </div>

      <div class="col-2 mr-3">
        <p class="mt-1 mb-0 ml-2">
                Total Price
        </p>
        <p
          class="mt-0 mb-1 ml-2"
          style="color:rgb(242, 87, 87); font-size: 1.8em"
        >{{ $totalprice }} THB</p>

        </div>

    </div>
    </div>
</div>
<div class="card pb-2">
<div class = "row">
    <div class = "col-lg-2">
    </div>
    <div class = "col-lg-4">
    <div class="card">
      <div class="card-body pr-0">
        <h4 class="card-title">Pay with credit/debit</h4>

        <div class="d-flex flex-wrap">

            <form name= "checkout" value = "card" method="POST" action="/card" >
            @csrf
                <input name="p" type ="hidden" value = "{{$price}}">
                <input name="class" type ="hidden" value = "">
                <input name="paymentID" type ="hidden" value = "{{$payment_id}}">
                <input name="isAdvertisement" type ="hidden" value = "{{$isAdvertisement}}">
                <input name="courseId" type ="hidden" value = "{{$course_id}}">
            <script type="text/javascript"   src="https://cdn.omise.co/omise.js"
                data-key="pkey_test_5irvp3eqbf7ybksdjlt"
                data-image="{{asset('img/favicon.png')}}"
                data-frame-label="EDITT payment"
                data-button-label="Checkout"
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
            <form name = 'intercheckout' method="POST" action ="/internet" >
            @csrf
                <input type="radio" id ="scb" name ="internet_bnk" onclick="Button1()" value="internet_banking_scb" > SCB Easy Net<hr>
                <input  type="radio" id = "bbl" name ="internet_bnk" onclick="Button1()" value="internet_banking_bbl"> Bualuang iBanking<hr>
                <input  type="radio" id = "ktb" name ="internet_bnk" onclick="Button1()" value="internet_banking_ktb"> KTB Netbank<hr>
                <input type="radio" id ="bay" name ="internet_bnk" onclick="Button1()" value="internet_banking_bay"> Krungsri Online<br>
                <input name="p" type ="hidden" value = "{{$price}}">
                <input name="paymentID" type ="hidden" value = "{{$payment_id}}">
                <input name="isAdvertisement" type ="hidden" value = "{{$isAdvertisement}}">
                <input name="courseId" type ="hidden" value = "{{$course_id}}">
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
</div>
@endsection
