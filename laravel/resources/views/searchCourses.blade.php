@extends('layouts.app')

@section('title', 'Search Courses - Even Die I am The Tutor')

@section('topic', 'Search Courses ')

@section('menu')
<a class="btn" style="background-color: #ffffff; border: solid 1px rgba(200,200,200, 0.6)" href="#">< Back</a>
<a class="btn ownbtn" href="#">New Course Request</a>
@endsection

@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body pr-0">
        <h4 class="card-title d-flex justify-content-center">Search Courses</h4>
        <div class="d-flex flex-wrap">
        
        
          <div id="stylized" class="myform">
              <form id="form" name="form" method="get" action="search">
                  
                  <div class="row">

                    <div class="column mx-4">
                        <h5> Tutor</h5>  
                        <div class="row ml-1">
                          <button class="mr-0 py-2 px-2" style="background-color: rgb(79, 182, 217); border-radius: 3px 0px 0px 3px; border: 0px" disabled>
                            <svg class="d-flex align-item-center justify-content-center" style="fill: white" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 20 20">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                            </svg>
                          </button>
                          <input class="ml-0 pl-2" style="border-radius: 0px 3px 3px 0px; border: solid 1px rgb(200,200,200); border-left: 0px" name="name" id="name" placeholder="Tutor's Name"/>
                        </div>
                        
                        </br>
                        
                        <h5> Area</h5>  
                          <div class="row ml-1">
                          <button class="mr-0 py-2 px-2" style="background-color: rgb(79, 182, 217); border-radius: 3px 0px 0px 3px; border: 0px" disabled>
                            <svg class="d-flex align-item-center justify-content-center" style="fill: white" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 20 20">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                            </svg>
                          </button>
                          <input class="ml-0 pl-2" style="border-radius: 0px 3px 3px 0px; border: solid 1px rgb(200,200,200); border-left: 0px" name="name" id="name" placeholder="Area/City/Province"/>
                        </div>
                    </div>
                    
                    <div class="column mx-4">
                        <h5>Subjects</h5>  
                        <div class="row ml-1">
                          <button class="mr-0 py-2 px-2" style="background-color: rgb(79, 182, 217); border-radius: 3px 0px 0px 3px; border: 0px" disabled>
                            <svg class="d-flex align-item-center justify-content-center" style="fill: white" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 20 20">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                            </svg>
                          </button>
                          <input class="ml-0 pl-2" style="border-radius: 0px 3px 3px 0px; border: solid 1px rgb(200,200,200); border-left: 0px" name="name" id="name" placeholder="Subject"/>
                        </div>
                        
                        </br>
                        
                    </div>

                  </div>

              </form>
          </div>
        

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
