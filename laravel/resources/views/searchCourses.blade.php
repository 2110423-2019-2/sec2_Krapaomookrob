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
    pointer-events:none;
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
    padding: 8px 10px;
  }
  .regnowbtn {
    width: 80%;
    border-radius: 5px;
    margin-top: 10px;
    margin-bottom: 2px;
  }
  .addtocartbtn {
    border: solid 1px rgb(200,200,200); 
    width: 80%;
    border-radius: 5px;
    margin-top: 2px;
    margin-bottom: 10px;
  }
  .addtocartbtn:hover {
    background-color: rgb(240,240,240);
  }
  tr{
    border-bottom: 1px solid rgb(200,200,200);
    border-collapse: collapse;
  }
  td { 
    padding: 5px;
  }
</style>


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body pr-0">
        <h4 class="card-title d-flex justify-content-center">Search Courses</h4>
          <div id="stylized" class="myform">
              <form action="javascript:updateSearchedCourses();">
                  
                  <div class="row my-2">

                    <div class="column mx-4">
                        <h5> Tutor</h5>  
                        <div class="row ml-1">
                          <button class="searchBtn">
                            <svg class="d-flex align-item-center justify-content-center" style="fill: white" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15" height="15" viewBox="0 0 20 20">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                            </svg>
                          </button>
                          <input list="tutorDataList" class="searchInput" name="tutor" id="tutor" placeholder="Tutor's Name" onkeyup="showResult(this.value, 'tutor', 'tutorList')"/>
                          <datalist id="tutorDataList">
                            <div id="tutorList"></div>
                          </datalist>
                        </div>
                        
                        </br>
                        
                        <h5> Area</h5>  
                          <div class="row ml-1">
                          <button class="searchBtn">
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
                          <button class="searchBtn">
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
                          <option value="6:00">6:00</option>
                          <option value="6:30">6:30</option>
                          <option value="7:00">7:00</option>
                          <option value="7:30">7:30</option>
                          <option value="8:00">8:00</option>
                          <option value="8:30">8:30</option>
                          <option value="9:00">9:00</option>
                          <option value="9:30">9:30</option>
                          <option value="10:00">10:00</option>
                          <option value="10:30">10:30</option>
                          <option value="11:00">11:00</option>
                          <option value="11:30">11:30</option>
                          <option value="12:00">12:00</option>
                          <option value="12:30">12:30</option>
                          <option value="13:00">13:00</option>
                          <option value="13:30">13:30</option>
                          <option value="14:00">14:00</option>
                          <option value="15:00">15:00</option>
                          <option value="16:00">16:00</option>
                          <option value="17:00">17:00</option>
                          <option value="18:00">18:00</option>
                          <option value="19:00">19:00</option>
                          <option value="20:00">20:00</option>
                          <option value="21:00">21:00</option>
                          <option value="22:00">22:00</option>
                        </select>
                      </div>

                      </br>
                      
                        <h5>Hours/Class</h5>  
                        <div class="row ml-1"  style="width: 220px">
                        <select id="time" name='time' class="dropdownInput" style="width: 100%">
                          <option value="ns">Not Specified</option>
                          <option value="0:30">0:30</option>
                          <option value="1:00">1:00</option>
                          <option value="1:30">1:30</option>
                          <option value="2:00">2:00</option>
                          <option value="2:30">2:30</option>
                          <option value="3:00">3:00</option>
                        </select>
                        </div>

                      </br>
                        <h5>No. of Class</h5>  
                        <div class="row ml-1"  style="width: 220px">
                        <input id="noClass" name='noClass' type="text" class="dropdownInput py-1" style="width: 100%" placeholder='Not Specified'>
                        </div>
                      
                      </br>
                        <h5>Max Price</h5>  
                        <div class="row ml-1"  style="width: 220px">
                        <input id="maxPrice" name='maxPrice' type="text" class="dropdownInput py-1" style="width: 100%" placeholder='Not Specified'>
                        </div>

                    </div>
                  </div>
                  <div class="col-lg-12" style="text-align: center;">
                    <button class="btn ownbtn px-5 py-2">Search Courses</button>
                  </div>
              </form>
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
    html = `
      <th width=15%>Tutor</th>
      <th width=15%>Available Subjects</th>
      <th width=15%>Areas</th>
      <th width=15%>Classes</th>
      <th width=15%>Price/Start Date</th>
      <th></th>`;
    return inHTMLRow(html);
  }

  function getHTMLRows(rowData) {
    tutor_profile = '<b>'+rowData.uname+'</b>' + '<button class="addtocartbtn btn py-0">Chat</button>';
    html = inHTMLCell(tutor_profile);
    html += inHTMLCell(rowData.area);
    html += inHTMLCell(rowData.sname);
    html += inHTMLCell(rowData.dname);
    var mydate = new Date(rowData.startDate);
    var strdate = mydate.toLocaleDateString('en-US');
    html += inHTMLCell('<b>' + rowData.price + ' THB<br>Starts on ' + strdate + '</b>');
    buttonGen = `
      <div class="column mx-0" style="text-align:center">
        <button class="regnowbtn btn ownbtn">Register Now</button>
        <button class="addtocartbtn btn">Add To Cart</button>
      </div>`
    html += inHTMLCell(buttonGen);
    return inHTMLRow(html);
  }

</script>

@endsection
