@extends('layouts.app')

@section('title', 'Search Courses - Even Die I am The Tutor')

@section('topic', 'Search Courses ')

@section('menu')
<a class="btn" style="background-color: #ffffff; border: solid 1px rgba(200,200,200, 0.6)" href="#">< Back</a>
<a class="btn ownbtn" href="#">New Course Request</a>
@endsection

@section('content') 
<style>
  .searchBtn{
    border: 0px;
    background-color: rgb(79, 182, 217); 
    border-radius: 3px 0px 0px 3px; 
    margin-right: 0px;
    padding: 10px;
  }
  .searchInput{
    border: solid 1px rgb(200,200,200); 
    border-radius: 0px 3px 3px 0px; 
    border-left: 0px;
    margin-left: 0px;
    padding-left: 10px;
  }
  .dropdownInput{
    border: solid 1px rgb(200,200,200); 
    border-radius: 3px; 
    padding: 5.5px 10px;
  }
</style>


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body pr-0">
        <h4 class="card-title d-flex justify-content-center">Search Courses</h4>
        <div class="d-flex flex-wrap">
        
        
          <div id="stylized" class="myform">
              <form action="javascript:updateSearchedCourses();">
                  
                  <div class="row my-2" >

                    <div class="column mx-4">
                        <h5> Tutor</h5>  
                        <div class="row ml-1">
                          <button class="searchBtn" disabled>
                            <svg class="d-flex align-item-center justify-content-center" style="fill: white" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 20 20">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                            </svg>
                          </button>
                          <input class="searchInput" name="tutor" id="tutor" placeholder="Tutor's Name"/>
                        </div>
                        
                        </br>
                        
                        <h5> Area</h5>  
                          <div class="row ml-1">
                          <button class="searchBtn" disabled>
                            <svg class="d-flex align-item-center justify-content-center" style="fill: white" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 20 20">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                            </svg>
                          </button>
                          <input list="areaDataList" class="searchInput" name="area" id="area" placeholder="Area/City/Province" onkeyup="showResult(this.value, 'area', 'areaList')"/>
                          <datalist id="areaDataList">
                            <div id="areaList"></div>
                          </datalist>
                        </div>
                    </div>
                    
                    <div class="column mx-4">
                        <h5>Subjects</h5>  
                        <div class="row ml-1">
                          <button class="searchBtn" disabled>
                            <svg class="d-flex align-item-center justify-content-center" style="fill: white" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 20 20">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                            </svg>
                          </button>
                          <input list="subjectDataList" class="searchInput" name="subject" id="subject" placeholder="Subject" onfocus="showResult('all', 'subject', 'subjectList')"/>
                          <datalist id="subjectDataList">
                            <div id="subjectList"></div>
                          </datalist>
                        </div>
                    </div>
                          
                    <div class="column mx-4">
                        <h5>Day</h5>  
                        <div class="row ml-1"  style="width: 220px">
                        <select id="day" name="day" class="dropdownInput" style="width: 100%">
                          <option value="ns">Not Specified</option>
                          <option value="sunday">Sunday</option>
                          <option value="monday">Monday</option>
                          <option value="tuesday">Tuesday</option>
                          <option value="wednesday">Wednesday</option>
                          <option value="thursday">Thursday</option>
                          <option value="friday">Friday</option>
                          <option value="saturday">Saturday</option>
                        </select>
                      </div>
                    </div>

                    <div class="column mx-4">
                        <h5>Time</h5>  
                        <div class="row ml-1"  style="width: 220px">
                        <select id="time" name='time' class="dropdownInput" style="width: 100%">
                          <option value="ns">Not Specified</option>
                    
                        </select>
                      </div>
                    </div>
                  </div>
                  <button class="btn ownbtn justify-item-center">Search Courses</button>
              </form>
          </div>
        

        </div>
      </div>
    </div>
  </div>
</div>

<br><br>
<h1>Search Results</h1>

<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body pr-0">
          <div id="searchResults"></div>  
      </div>
    </div>
  </div>
</div>


<script>
    function showResult(str, field, listName) {
      if (str.length==0) {
        // document.getElementById(listName).innerHTML="";
        return;
      }
      if (window.XMLHttpRequest) {
        xmlhttp=new XMLHttpRequest();
      } else { 
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById(listName).innerHTML= xmlhttp.responseText; 
        }
      }
      xmlhttp.open("GET","search-courses/search?"+field+"="+str, true);
      xmlhttp.send();
    }
</script>


<script>
  function updateSearchedCourses(){
    if (window.XMLHttpRequest) {
      xmlhttp=new XMLHttpRequest();
    } else { 
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    tutor = document.getElementById('tutor').value;
    area = document.getElementById('area').value;
    subject = document.getElementById('subject').value;
    day = document.getElementById('day').value;
    time = document.getElementById('time').value;
    
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        showTable(xmlhttp.responseText); 
      }
    }
    xmlhttp.open("GET","search?tutor="+tutor+"&area="+area+"&subject="+subject+"&day="+day+"&time="+time, true);
    xmlhttp.send();
  }
  
  function showTable(response){
    var array = JSON.parse(response);
    html = getTableHeader();
    for (i = 0; i < array.length; i++) {
      html += getHTMLRows(array[i]);
    }
    document.getElementById('searchResults').innerHTML=inHTMLTable(html);
  }

  function inHTMLTable(str){
    return '<table style="width:100%">' + str + '</table>';
  }
  function inHTMLRow(str){
    return '<tr>' + str + '</tr>';
  }
  function inHTMLCell(str){
    return '<td>' + str + '</td>';
  }
  function inHTMLHeader(str){
    return '<th>' + str + '</th>';
  }
  function getTableHeader(){
    html = ''
    for (i of ['Tutor', 'Available Subjects', 'Areas', 'Classes', 'Price/Start Date']){
      html += inHTMLHeader(i);
    }
    return inHTMLRow(html);
  }

  function getHTMLRows(rowData) {
    html = inHTMLCell(rowData.tutor);
    html += inHTMLCell(rowData.area);
    html += inHTMLCell(rowData.sname);
    html += inHTMLCell(rowData.dname);
    html += inHTMLCell(rowData.price);
    return inHTMLRow(html);
  }

</script>

@endsection
