@extends('layouts.app')

ิ@section('title', 'My Shopping Cart')

@section('topic', 'Cart')

@section('menu')

    <a href="#" class="btn ownbtn px-5">Back</a>

@endsection

@section('content')
    {{-- content of cart --}}
    <div class="card pb-3">
        <div class="card-body" style="border-bottom: solid 1px rgba(200,200,200,0.6)">
            <h4 class="card-title">Courses in Cart</h4>
            <div class="row mt-3 mb-4 bline">
                <div class="col-lg">Tutor</div>
                <div class="col-lg">Available Subjects</div>
                <div class="col-lg">Areas</div>
                <div class="col-lg">Classes</div>
                <div class="col-lg">Price/Start Date</div>
                <div class="col-lg"></div>
            </div>
            
            <div class="row course-item">
                <div class="col-lg">P'Ligma<br/>Chula Engineering</div>
                <div class="col-lg">Math, Physics, Programming, English</div>
                <div class="col-lg">Nonthaburi Tha Phra, BangkokBTS Skytrain, BangkokMRT, Bangkok …1 More</div>
                <div class="col-lg">
                    Sat-Sun                 <br/>
                    13:00-15:00             <br/>
                    (2 hrs/class)           <br/>
                    4 Classes,              <br/>
                    Individual
                </div>
                <div class="col-lg">4000 THB<br/>
                    Starts on 19/09/2019</div>
                <div class="col-lg">
                    <div id="app">
                        <remove-button button-text="Remove" v-bind:class="[activeCancel]"></remove-button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-end pr-5 mt-3">
            
            <div class="col-2 mr-0 pl-5" style="float: right; font-size:1.4em;">
                <p class="text-right"><strong>Summary</strong></p>
            </div>

            <div class="col-2 mr-3">
                <p class="mt-1 mb-0 ml-2">
                    WTF x Courses      <br>
                    Total Price        <br>
                </p>
                <p class="mt-0 mb-1 ml-2" style="color:rgb(242, 87, 87); font-size: 1.8em">9000 THB</p>
                <button class="btn-lg coutbtn px-5">Checkout</button>
            </div>
            
        </div>
        
    </div>

@endsection
    


