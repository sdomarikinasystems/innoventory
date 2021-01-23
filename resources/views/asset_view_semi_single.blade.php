@extends('master.master')

@section('title')
Innoventory (Loading....)
@endsection

@section('contents')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item " aria-current="page"><a href="/innoventory/asset/registry">Asset Registry</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span class="a_navname a_itemdescription"></span></li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-3">
    <center>
    <div class="card" role="alert">
        <h1 class="mt-5 mb-5 text-muted" style="font-size: 20vh;"><i class="fas fa-image"></i></h1>
    </div>
    </center>
  </div>
  <div class="col-md-9">
    <div class="row">
      <div class="col-md-8">
        <small>Stock Number : <span class="a_stocknumber">0000</span></small>
    <h3 class="a_itemdescription mb-0">Item Name</h3>
     <h6 class="a_article text-muted mb-0"></h6>
    <h4 class="mt-0"><span class="badge badge-danger mt-2 mb-3">₱ <span class="a_unitvalue"></span></span></h4>
   
    <p class="mb-0 mt-3"><span class="text-muted">Unit of Mesure</span>: <span class="a_unitofmesure"></span></p>
    <p class="mb-0"><span class="text-muted">Accountable Officer</span>: <span class="a_incharge"></span></p>

      </div>
    </div>
    <table class="table table-bordered mt-3">
      <tbody>
        <tr>
          <td style="width: 20%;"><span class="text-muted"><i class="fas fa-map-marker-alt"></i> Location</span></td>
          <td> Room <strong class="a_roonum"></strong> in <strong class="a_offname"></strong> office.</td>
        </tr>
        <tr>
          <td style="width: 20%;"><span class="text-muted"><i class="far fa-building"></i> Station</span></td>
          <td class="a_station"></td>
        </tr>
      </tbody>
    </table>

    <div class="card mt-2">
      <div class="card-body">
        <h5>Remarks</h5>
        <p class="a_rem mb-0"></p>
      </div>
    </div>

  </div>
</div>
<center class="mt-4 mb-4">
  <a href="#" class="btn btn-light" id="btnshowallspecification"><i class="fas fa-sort-down"></i> Show all infomation</a>
<a href="#" class="btn btn-light" id="btnminimizeinfo" style="display: none;"><i class="fas fa-sort-up"></i> Minimize information</a>
</center>
<div id="allinfo" style="display: none;">
  <div class="card-deck mt-3"  >
  <div class="card">
    <div class="card-body">
      <h5 class="mb-3"><i class="fas fa-tag"></i> Specifications</h5>
       <table class="table table-striped table-bordered">
      <tr><td>Stock Number</td><td class="a_stocknumber"></td></tr>
       <tr><td>Article</td><td class="a_article"></td></tr>
       <tr><td>Description</td><td class="a_itemdescription"></td></tr>
      <tr><td>Unit of Mesure</td><td class="a_unitofmesure"></td></tr>
      <tr><td>Remarks</td><td class="a_rem"></td></tr>
       </table>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h5 class="mb-3"><i class="fas fa-receipt"></i> Funding</h5>
       <table class="table table-striped table-bordered">
     
<tr><td>Unit Value</td><td class="a_unitvalue"></td></tr>
 <tr><td>Balance Per Card</td><td class="a_balancepercard"></td></tr>
  <tr><td>On Hand Per Count</td><td class="a_onhandpercount"></td></tr>
   <tr><td>Shortage Overage</td><td class="a_shortageoverage"></td></tr>
       </table>
    </div>
  </div>
    <div class="card">
    <div class="card-body">
      <h5 class="mb-3"><i class="far fa-compass"></i> Location</h5>
       <table class="table table-striped table-bordered">
      <tr><td>Service Center</td><td class="a_offname"></td></tr>
       <tr><td>Room Number</td><td class="a_roonum"></td></tr>
        <tr><td>Station</td><td class="a_station"></td></tr>
         <tr><td>In-charge</td><td class="a_incharge"></td></tr>
       </table>
    </div>
  </div>
</div>



</div>


<script type="text/javascript">

   $("#btnshowallspecification").click(function(){
    $("#allinfo").css("display","block");
    $("#btnshowallspecification").css("display","none");
     $("#btnminimizeinfo").css("display","inline-block");
  })
  $("#btnminimizeinfo").click(function(){
    $("#allinfo").css("display","none");
     $("#btnshowallspecification").css("display","inline-block");
    $("#btnminimizeinfo").css("display","none");
  })

  GetSemiExpendableFullInfomation();
  function GetSemiExpendableFullInfomation(){
    var data_identification = <?php echo json_encode($_GET["asset_id"]); ?>;
    // alert(data_identification);
    $.ajax({
      type: "POST",
      url: "{{ route('stole_single_semi_expenable') }}",
      data: {_token: "{{ csrf_token() }}",d_id: data_identification},
      success: function(data){
        data = JSON.parse(data);

        $("title").html("SE : "+ data[0]["description"]);
        $(".a_stocknumber").html(data[0]["stock_number"]);
          $(".a_itemdescription").html(data[0]["description"]);
        $(".a_unitvalue").html(data[0]["unit_value"]);
        $(".a_article").html(data[0]["article"]);
        $(".a_unitofmesure").html(data[0]["unit_of_mesure"]);
        $(".a_balancepercard").html(data[0]["balance_per_card"]);
        $(".a_onhandpercount").html(data[0]["on_hand_per_count"]);
        $(".a_shortageoverage").html(data[0]["shortage_overage"]);
        $(".a_roonum").html(data[0]["room_number"]);
        $(".a_offname").html(data[0]["office"]);
        if(data[0]["remarks"] == ""){
            $(".a_rem").html("No remarks added.");
        }else{
          $(".a_rem").html(data[0]["remarks"]);
        }
         $(".a_station").html(data[0]["name"]);

         $(".a_incharge").html(data[0]["username"]);
        
      }
    })
  }
</script>
@endsection