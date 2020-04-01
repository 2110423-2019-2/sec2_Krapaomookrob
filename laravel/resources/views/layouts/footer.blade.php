@php($user = auth() -> user())
<footer id = "footer" style = "background-color: black;color: white">
  <div class="container d-flex">
    <div class="row">
      <div class="col-2">
        <div class="font-weight-regular">EDITT</div>
      </div>
      <div class="col-2">
        {{-- <a href="#" class="font-weight-light">Contact Admin</a> --}}
        <button type="submit"  class="font-weight-light" data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target="#myModalContactAdmin">Contact Admin</button>
      </div>
      @if($user != null && $user->isTutor())
      <div class="col-2">
        <a href="/create-advertisement" class="font-weight-light" style="color:#fff;">Create Advertisement</a>
      </div>
      @endif
    </div>
  </div>
  <div class="modal fade" id="myModalContactAdmin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="background:  #55B3E0">
                <h4 id="myModalLabel" style="color: whitesmoke;">Contact Admin</h4>
                <button class="font-weight-bold" data-dismiss="modal" aria-label="Close">X</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body" style="color: black;">
                <form action="/report" enctype="multipart/form-data" method="post">
                  @csrf
                  <h6>Title</h6>
                  <input class="form-control px-3" id="title" type="text" name="title" autofocus></input>
                  <h6 style="padding-top:10px">Message</h6>
                  <textarea class="form-control px-3" id="message" type="text" name="message" autofocus></textarea>
                  <button class="btn ownbtn my-3 col-2 offset-9">Submit</button>
                </form>
              </div>
            </div>
        </div>
    </div>
</footer>
