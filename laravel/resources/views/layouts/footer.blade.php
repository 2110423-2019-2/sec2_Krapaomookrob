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
                <div class="form-group px-3">
                  <h6>Message</h6>
                  <textarea class="form-control px-3" id="reportMessage" type="text" name="reportMessage" autofocus></textarea>
                </div>
                <div class="modal-body">
                    <div class="modal-footer" id="modal_footer">
                        {{-- <input id="btnSubmit" href="#" name="btnSubmit" value="submit" class="btn ownbtn" type="submit"> --}}
                        <a href="/" id="btnSubmit" class="btn btn-default-border-blk">Donate</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@section('content')
<div class="container">
  <form action="/profile" enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')
    </div>
</div>
@endsection