<?php
   if ( substr_count( $_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip' ) ) {
       ob_start( 'ob_gzhandler' );
   }
   else {
       ob_start();
   }
   $acc_badge = '';
   $at = '';
   if (session('user_uname') == '' || session('user_uname') == null) {
     ?>
<script type='text/javascript'>
   window.location.href = '{{ route("proc_logout") }}';
</script>
<?php
   }else{
   	$at = session('user_type');
   	switch (session('user_type')) {
   	case '0':
   	$acc_badge = '<small class="badge badge-primary" title="Administrator"><i class="fas fa-shield-alt"></i></small>';
   	break;
   	case '1':
   	$acc_badge = '<small class="badge badge-success" title="Supply Officer"><i class="fas fa-shield-alt"></i></small>';
   	break;
   	case '2':
   	$acc_badge = '<small class="badge badge-info" title="Principal"><i class="fas fa-user-shield"></i></small>';
   	break;
   	case '3':
   	$acc_badge = '<small class="badge badge-warning" title="Property Custodian"><i class="fas fa-user-lock"></i></small>';
   	break;
   	case '4':
   	$acc_badge = '<small class="badge badge-secondary" title="Division or Teaching Personnel"><i class="fas fa-user-friends"></i></small>';
   	break;
   	}
   }
   ?>
<!DOCTYPE html>
<html lang='en'>
   <head>
      <title>@yield('title')</title>
      <meta charset="UTF-8"> <meta name="description" content="ProcMS Inventory by SDO-Marikina City"> <meta name="keywords" content="Inventory System, DepEd Marikina, SDO Marikina, Procurement Management System, Innoventory"> <meta name="author" content="Virmil Talattad"> <link rel='icon' href='{{asset("images/sdo.ico")}}' type='image/x-icon'/ > <meta charset='utf-8'> <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'> <link rel='stylesheet' href='https://ajax.aspnetcdn.com/ajax/bootstrap/4.3.1/css/bootstrap.min.css'> <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script> <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script> <script src='https://ajax.aspnetcdn.com/ajax/bootstrap/4.3.1/bootstrap.min.js'></script> <script src='https://kit.fontawesome.com/396c986df7.js' crossorigin='anonymous'></script> <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css'> <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js'></script> <script type='text/javascript' src='https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js'></script> <script type='text/javascript' src='https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js'></script> <link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css'> <link href="https://fonts.cdnfonts.com/css/helvetica-neue-9?styles=49038" rel="stylesheet">
      <style>
       body{font-family:'Helvetica 35 Thin',sans-serif}.list-group{border:0 none}.list-group li{border:0 none}.list-group i{width:30px}.list-group-item{background-color:transparent;border-radius:40px!important;text-decoration:none!important;border:1px solid transparent!important}.list-group-item a{text-decoration:none!important}.list-group-item:hover{box-shadow:0 2px 3px rgba(0,0,0,.08),0 10px 30px rgba(0,0,0,.08);border-color:#eeeef2!important}.btn-text{padding:0!important;margin:0!important;min-width:0!important;display:inline!important}.xload{background:rgba(220,221,225,.7);left:0;right:0;top:0;bottom:0;z-index:100;width:100%;height:100%;position:fixed}.card-body-sm{padding:10px}::-webkit-scrollbar{width:4px}::-webkit-scrollbar-track{background:#fff;border:1px solid #ededed}::-webkit-scrollbar-thumb{background:#e6e6e6}::-webkit-scrollbar-thumb:hover{background:#555}.basic_link{text-decoration:none}span.deleteicon{position:absolute;width:94%}span.deleteicon span{position:absolute;display:block;top:11px;right:10px;width:25px;height:25px;opacity:.5;background:url(https://icons.iconarchive.com/icons/iconsmind/outline/512/Close-icon.png) 0 -6px;background-size:contain;background-position:center;background-repeat:no-repeat;cursor:pointer}.modal-header{text-align:center}.modal-header .modal-title{margin:0 auto!important}.addtext_anim{animation-name:drop_slide!important;animation-duration:.3s!important;display:block!important}@keyframes drop_slide{0%{opacity:0;margin-top:-10px}}.addcard_anim{animation-name:drop_slide_shadow!important;animation-duration:1s!important;display:block!important}@keyframes drop_slide_shadow{0%{opacity:0;margin-top:-30px}50%{box-shadow:0 10px 30px rgba(0,0,0,.4)}}.close{position:absolute;right:1rem}.announcement_card_body{overflow-x:hidden;overflow-y:auto;max-height:80vh}.announcement_card{width:565px;margin:auto}.card-shadow{box-shadow:0 2px 3px rgba(0,0,0,.08),0 10px 30px rgba(0,0,0,.08)}@media only screen and (max-width:1366px){.announcement_card{width:100%;margin:auto}.hideinmobile{display:none}}pre{font:16px 'Helvetica 35 Thin',sans-serif;white-space:pre-wrap;white-space:-moz-pre-wrap;white-space:-pre-wrap;white-space:-o-pre-wrap;word-wrap:break-word}.btn{border-radius:50px;border:none;min-width:60px;padding-left:20px;padding-right:20px}.alert{border-radius:10px}.clickablething:hover{cursor:pointer;border-color:#007dff!important}.card{border-radius:10px!important;animation-name:scale-in;animation-duration:.3s;overflow:hidden;border-color:#eeeef2!important}.card-header{background:#fafafc!important;border-color:#eeeef2!important}.card-footer{background:#fafafc!important;border-color:#eeeef2!important}.breadcrumb{background:0 0;border-radius:20px!important;padding-left:0}.modal-content{border-radius:10px!important;border:none;animation-name:scale-in;animation-duration:.3s;box-shadow:0 2px 3px rgba(0,0,0,.08),0 10px 30px rgba(0,0,0,.08)}.btn:hover{box-shadow:0 2px 3px rgba(0,0,0,.08),0 10px 30px rgba(0,0,0,.08)}.dropdown-menu{border-radius:10px!important;box-shadow:0 2px 3px rgba(0,0,0,.08),0 10px 30px rgba(0,0,0,.08);border-color:#eeeef2!important}.nav-tabs .nav-item .nav-link{border-radius:10px 10px 0 0;padding:10px;padding-left:20px;padding-right:20px}.form-control{background:#f8f9fa;border-radius:30px!important;border:none;box-shadow:inset 0 1px 3px rgba(0,0,0,.2)}.sub-list-group{list-style:none;margin-top:10px}.sub-list-group>.sub-list{padding:8px 0}.importwarning{display:none}.invalidcolor{color:#ff3a30}.btn-primary{background:#007dff}.btn-success{background:#4ddb5e}.btn-danger{background:#ff3a30}.btn-secondary{background:#dedede;color:#000}.btn-warning{background:#f6cb01}.btn-light{background:#f0f0f2}.alert-sm{padding:10px}.alert{border:none}.alert-primary{background:#007dff;color:#fff;text-shadow:0 0 10px rgba(0,0,0,.4)}.alert-success{background:#4ddb5e;text-shadow:0 0 10px rgba(0,0,0,.4);color:#fff}.alert-danger{background:#ff3a30;text-shadow:0 0 10px rgba(0,0,0,.4);color:#fff}.alert-secondary{background:#fafafc!important;color:#fff}.alert-warning{background:#f6cb01;text-shadow:0 0 10px rgba(0,0,0,.4);color:#fff}.alert-info{background:#30a7d5;text-shadow:0 0 10px rgba(0,0,0,.4);color:#fff}.badge-primary{background:#007dff;color:#fff;text-shadow:0 0 10px rgba(0,0,0,.4)}.badge-success{background:#4ddb5e;text-shadow:0 0 10px rgba(0,0,0,.4);color:#fff}.badge-danger{background:#ff3a30;text-shadow:0 0 10px rgba(0,0,0,.4);color:#fff}.badge-secondary{background:#dedede;color:#000!important;text-shadow:0 0 10px rgba(0,0,0,.4);color:#fff}.badge-warning{background:#f6cb01;text-shadow:0 0 10px rgba(0,0,0,.4);color:#fff}.td_required{color:#ff3a30}.td_optional{color:#007dff}.card-limited{height:400px;overflow:scroll}.hcover{background:#007dff;transition:.2s all;display:inline-block;padding:10px;border-radius:15px;overflow:hidden;height:50px;width:50px;color:#fff;box-shadow:0 1px 2px rgba(0,0,0,.2);cursor:pointer;margin-left:5px;margin-right:5px;color:#fff!important}.hcover:hover{transform:scale(1.3);margin-top:-10px;box-shadow:0 2px 3px rgba(0,0,0,.08),0 10px 30px rgba(0,0,0,.08);text-shadow:0 2px 5px rgba(0,0,0,.4)}.dock_parent{background:0 0;position:fixed;display:flex;justify-content:center;bottom:0;left:0;right:0;margin:auto;padding:10px;border-radius:15px;margin-bottom:5px!important;width:100%}.dock_itself{background:#fff;position:absolute;display:flex;justify-content:center;height:72px;border:1px solid rgba(0,0,0,.1);bottom:0;margin:auto;padding:10px;padding-left:7px;padding-right:7px;border-radius:20px;box-shadow:0 2px 3px rgba(0,0,0,.08),0 10px 30px rgba(0,0,0,.08);margin-bottom:5px!important;width:auto}.card-filtered{border:none!important;border-radius:10px!important;border:none!important;border-radius:10px!important;border:none!important;border-radius:10px!important}.heightwise{margin:auto;width:600px;margin:auto;width:600px}
      </style>
      <script type='text/javascript'>
         function urlify(a){return a.replace(/(https?:\/\/[^\s]+)/g,function(a){return'<a href="'+a+'" target="_blank"><i class="fas fa-globe-africa"></i> '+a+"</a>"})}
      </script>
   </head>
   <body>
      @include('sweet::alert')
      <!-- NAVBAR -->
    <nav class='navbar navbar-expand-lg navbar-light bg-light' style='border-bottom: 1px solid rgba(0,0,0,0.05); box-shadow:0px 2px 3px rgba(0,0,0,0.01), 0px 5px 10px rgba(0,0,0,0.03);'> <a class='navbar-brand' href='#'><span class='featurefont' style='color: #007DFF;'>Innoventory</span> <small class='text-muted'>by SDO - Marikina City</small></a> <button id='btn_navsdietoggle' class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'> <span class='navbar-toggler-icon'></span> </button> <div class='collapse navbar-collapse' id='navbarSupportedContent'> <ul class='navbar-nav mr-auto'> </ul> <div class='dropdown'> <a class='btn btn-light dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><i class='fas fa-user'></i> <?php echo ucfirst(session('user_uname')) . ' ' . $acc_badge; ?> </a> <form action='{{route("proc_logout")}}' method="GET" class="form-inline my-2 my-lg-0"> <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink'> <a class='dropdown-item' href='{{route("myaccount")}}'><i class='fas fa-user'></i> My Account</a> <button class='dropdown-item' type='submit'><i class='fas fa-sign-out-alt'></i> Sign-out</button> </div></div></form> </div></nav>
    <!-- SIDEBAR -->
      <div class='container-fluid'>
         <div class='row mt-3'>
            <div class='col-lg-2 mb-3' id='sidebarmenu'>
               <!-- START OF MENU -->
               <h6>CORE</h6>
               <ul class='list-group mb-3'>
                  <a class='list-group-item' href='{{ route("dboard") }}'><i class='fas fa-tachometer-alt'></i> <span class="text-muted">Dashboard</span></a>
                  <a class='list-group-item' href='{{ route("assetregistry") }}'><i class='fas fa-clipboard-check'></i> <span class="text-muted">Asset Registry</span></a>
                  <a class='list-group-item'  href='{{ route("asset_scanned") }}'><i class='fas fa-search'></i> <span class='text-muted'>Inventory</span></a>
                  <a class='list-group-item'  href='{{ route("asset_disposed") }}'><i class='fas fa-trash'></i> <span class='text-muted'>Disposed Assets</span></a>
                  <a class='list-group-item'  data-toggle='collapse' href='#collapse1' onclick='GetServiceCentersForOption()'><i class='fas fa-chart-bar'></i> <span class='text-muted'>Reports</span> <i class='float-right fas fa-sort-down'></i></a>
                  <div id='collapse1' class='panel-collapse collapse in'>
                     <ul class='sub-list-group mb-3'>
                        <?php
                           if(session('user_type') < '4' && session('user_type') != '2'){
                             ?>
                        <!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
                        <li class='sub-list'><a href='#' data-toggle='modal' data-target='#m_generatereport' onclick='getcountofgen()'><i class='fas fa-file-pdf'></i> <span class='text-muted'>Appendix 73</span></a>
                        <li class='sub-list'><a href='#' data-toggle='modal' data-target='#m_generatesemireports' onclick='getcountofgen()'><i class='fas fa-file-pdf'></i> <span class='text-muted'>Appendix 66</span></a><?php } ?>
                        <li class='sub-list'><a href='{{ route("manage_reports") }}'><i class='fas fa-layer-group'></i> <span class='text-muted'>Figures</span></a>
                        <li class='sub-list'><a href='{{ route("reg_omissions") }}'><i class='fas fa-eraser'></i> <span class='text-muted'>Registry Omissions</span></a>
                        <li class='sub-list'><a href=''><i class='fas fa-exchange-alt'></i> <span class='text-muted'>Returns to LGU</span></a>
                        <li class='sub-list'><a href=''><i class='fas fa-question-circle'></i></i> <span class='text-muted'>Missing Assets</span></a>
                        <li class='sub-list'><a href=''><i class='fas fa-money-bill'></i> <span class='text-muted'>Accountabilities</span></a>
                     </ul>
                  </div>
                  <a class='list-group-item' href='{{ route("asset_resources") }}'><i class='fas fa-folder'></i> <span class='text-muted'>Resources</span></a>
               </ul>
               <h6>ADD-ON</h6>
               <ul class='list-group mb-3'>
                  <?php
                     if(session('user_type') < '4' && session('user_type') != '2'){
                     ?>
                  <!-- NOT FOR TEACHERS -->					
                  <a class='list-group-item' href='{{ route("usermanagement") }}'><i class='fas fa-users'></i> <span class='text-muted'>Manage Users</span></a>
                  <?php
                     }
                     if(session('user_type') == '0' || session('user_type') == '1'){
                     ?>
                  <!-- FOR ADMIN ONLY -->
                  <!--<a href='/innoventory/manage/schools'><i class='fas fa-school'></i> Manage Schools</a>-->
                  <?php
                     }
                     ?>
                  <?php
                     if(session('user_type') < '4'){
                     	?>
                  <!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
                  <a class='list-group-item' href='{{ route("stationmy") }}'><i class='fas fa-warehouse'></i> <span class='text-muted'>Manage Service Centers</span></a>
                  <a class='list-group-item' href='{{ route("manage_reminders") }}'><i class='fas fa-bell'></i> <span class='text-muted'>Reminders</span></a>
                  <a class='list-group-item' href='{{ route("fetch_asset") }}'><i class='fas fa-qrcode'></i> <span class='text-muted'>QR Stickers</span></a>
                  <?php
                     }
                     ?>
                  <a class='list-group-item' href='{{ route("ass_transhistory") }}'><i class='fas fa-history'></i> <span class='text-muted'>History</span></a>
                  <a class='list-group-item' href='{{ route("gohow") }}'><i class='far fa-question-circle'></i> <span class='text-muted'>How to?</span></a>
                  <a class='list-group-item' href='{{ route("abouts_sys") }}'><i class='fas fa-robot'></i> <span class='text-muted'>About the System</span></a>
               </ul>
               <!-- END OF MENU -->
               <script type='text/javascript'>
                  !function(n){n.fn.DuplicateWindow=function(){var t=5e3,e=500,i="my-application-browser-tab",o={Session:1,Local:2};function s(n){var t="";switch(n){case o.Session:t=window.name;break;case o.Local:null==(t=decodeURIComponent(function(n){for(var t=n+"=",e=document.cookie.split(";"),i=0;i<e.length;i++){for(var o=e[i];" "==o.charAt(0);)o=o.substring(1,o.length);if(0==o.indexOf(t))return o.substring(t.length,o.length)}return null}(i)))&&(t="")}return t}function r(n,t){switch(n){case o.Session:window.name=t;break;case o.Local:!function(n,t,e){var i="";if(e){var o=new Date;o.setTime(o.getTime()+24*e*60*60*1e3),i="; expires="+o.toUTCString()}document.cookie=n+"="+(t||"")+i+"; path=/"}(i,t)}}function a(){var n=s(o.Session)||function(){return this.s4=function(){return Math.floor(65536*(1+Math.random())).toString(16).substring(1)},this.s4()+this.s4()+"-"+this.s4()+"-"+this.s4()+"-"+this.s4()+"-"+this.s4()+this.s4()+this.s4()}();r(o.Session,n);var i=s(o.Local),a=(""==i?null:JSON.parse(i))||null;if(console.log(i),console.log(n),console.log(a),null===a||a.timestamp<(new Date).getTime()-t||a.guid===n){function c(){var t={guid:n,timestamp:(new Date).getTime()};r(o.Local,JSON.stringify(t))}return c(),setInterval(c,e),!1}return!0}window.IsDuplicate=function(){return a()},n(window).on("beforeunload",function(){0==a()&&r(o.Local,"")})},n(window).DuplicateWindow()}(jQuery);
               </script>
            </div>
            <div class='col-lg-10'>
               @yield('contents')
            </div>
         </div>
      </div>
      <!-- REPORT GENERATION MODAL FOR APPENDIX 73 -->
      <form action='{{ route("group_asset") }}' method='GET'>
         <div id='m_generatereport' class='modal' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
               <div class='modal-content'>
                  <div class='modal-header'>
                     <h5 class='modal-title'>Generate Appendix 73</h5>
                     <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                     <span aria-hidden='true'>&times;</span>
                     </button>
                  </div>
                  <div class='modal-body'>
                     {{ csrf_field() }}
                     <input type='hidden' name='station_id' id='mygroupid'>
                     <div class='form-group'>
                        <div class='card card-shadow'>
                           <div class='card-header'>
                              Inventory Date
                           </div>
                           <div class='card-body'>
                              <div class='row'>
                                 <div class='col-sm-6'>
                                    <div>Year</div>
                                    <select class='form-control' id='co_invyear' required='' name='inv_year'></select>
                                 </div>
                                 <div class='col-sm-6'>
                                    <div>Month</div>
                                    <select class='form-control' id='co_invmonth' required='' name='inv_month'></select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class='form-group'>
                        <label>Room</label>
                        <select class='form-control allservicenterrooms' id='co_service_center' onchange='getcountofgen()' name='my_room'>
                           <option>Sample</option>
                        </select>
                     </div>
                     <div class='form-group'>
                        <label>Category</label>
                        <select class='form-control' id='allcategoriesz' onchange='getcountofgen()' name='my_category'>
                           <option>Sample</option>
                        </select>
                     </div>
                     <div class='card card-shadow mt-4 mb-4'>
                        <div class='card-body'>
                           <label class='mt-0 mb-0 text-muted'>Assets to be Generated</label>
                           <p class='mb-0 mt-0' id='asstobegennum'>0 Item(s)</p>
                        </div>
                     </div>
                  </div>
                  <div class='modal-footer'>
                     <button type='submit' id='continueenrep_btn' class='btn btn-primary'>Generate</button>
                     <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
      <!-- REPORT GENERATION OF APPENDIX 66 -->
      <form action='{{ route("goto_generate_appendix66") }}' method='GET'>
         <div class='modal' tabindex='-1' id='m_generatesemireports' role='dialog'>
            <div class='modal-dialog' role='document'>
               <div class='modal-content'>
                  <div class='modal-header'>
                     <h5 class='modal-title'>Generate Appendix 66</h5>
                     <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                     <span aria-hidden='true'>&times;</span>
                     </button>
                  </div>
                  <div class='modal-body'>
                     {{ csrf_field() }}
                     <div class='form-group'>
                        <div class='card card-shadow'>
                           <div class='card-header'>
                              Inventory Date
                           </div>
                           <div class='card-body'>
                              <div class='row'>
                                 <div class='col-sm-6'>
                                    <div>Year</div>
                                    <select class='form-control' id='se_invyear' required='' name='inv_year'></select>
                                 </div>
                                 <div class='col-sm-6'>
                                    <div>Month</div>
                                    <select class='form-control' id='se_invmonth' required='' name='inv_month'></select>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class='form-group'>
                        <label>Room</label>
                        <select class='form-control allservicenterrooms' required='' name='my_room'>
                           <option>Sample</option>
                        </select>
                     </div>
                  </div>
                  <div class='modal-footer'>
                     <button type='submit' class='btn btn-primary'>Generate</button>
                     <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
 <div class='dock_parent' style='display: none;'> <div class='dock_itself'> <a class='hcover' data-placement='top' data-content='Station readiness, Announcements, Summaries' data-trigger='hover' title='Dashboard' href='{{route("dboard")}}' style='background-color: #FF3A30;'> <center> <span style='font-size: 20px;'><i class='fas fa-tachometer-alt'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Upload, Fix, Review Capital Outlay, Semi-Expendable, Supply asset(s)' data-trigger='hover' title='Asset Registry' href='{{route("assetregistry")}}' style='background-color: #FF9400;'> <center> <span style='font-size: 20px;'><i class='fas fa-clipboard-check'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Scan, Review Capital Outlay and Semi-Expendable inventory data' data-trigger='hover' title='Inventory' href='{{route("asset_scanned")}}' style='background-color: #4DDB5E;'> <center> <span style='font-size: 20px;'><i class='fas fa-search'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Recover or view all of your Capital Outlay and Semi-Expendable disposed assets' data-trigger='hover' title='Disposed Assets' href='{{route("asset_disposed")}}' style='background-color: #F43A2B;'> <center> <span style='font-size: 20px;'><i class='fas fa-trash'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Appendix 66 and 73, Figures, Registry Omissions, Returns to LGU, Missing Asset(s), Accountabilities' data-trigger='hover' title='Reports' href='' style='background-color: #5956D6;'> <center> <span style='font-size: 20px;'><i class='fas fa-chart-bar'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Download and view all uploaded Capital Outlay, Semi-Expendable files' data-trigger='hover' title='Resources' href='{{route("asset_resources")}}' style='background-color: #E46F00;'> <center> <span style='font-size: 20px;'><i class='fas fa-folder'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Manage user account(s) of your station' data-trigger='hover' title='Manage Users' href='{{route("usermanagement")}}' style='background-color: #0AB951;'> <center> <span style='font-size: 20px;'><i class='fas fa-users'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Add, Delete and Manager your stations Service Centers' data-trigger='hover' title='Service Centers' href='{{route("stationmy")}}' style='background-color: #025A56;'> <center> <span style='font-size: 20px;'><i class='fas fa-warehouse'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Post reminders, announcements in Innoventory' data-trigger='hover' title='Reminders' href='{{route("manage_reminders")}}' style='background-color: #FFB316;'> <center> <span style='font-size: 20px;'><i class='fas fa-bell'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Generate QR Sticker printable' data-trigger='hover' title='QR Stickers' href='{{route("fetch_asset")}}' style='background-color: #FF1B73;'> <center> <span style='font-size: 20px;'><i class='fas fa-qrcode'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Access history logs of your Innoventory usage' data-trigger='hover' title='History' href='{{route("ass_transhistory")}}' style='background-color: #1B8EF5;'> <center> <span style='font-size: 20px;'><i class='fas fa-history'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Learn how to use Innoventory System' data-trigger='hover' title='How To?' href='{{route("gohow")}}' style='background-color: #23C95B;'> <center> <span style='font-size: 20px;'><i class='fas fa-question-circle'></i></span> </center> </a> <a class='hcover' data-placement='top' data-content='Information about the system version and description' data-trigger='hover' title='About' href='{{route("abouts_sys")}}' style='background-color: #D548DF;'> <center> <span style='font-size: 20px;'><i class='fas fa-robot'></i></span> </center> </a> </div></div>
      <script type='text/javascript'>
         // FOR DYNAMIC VIEW
        $(".hcover").popover({container:"body"}),$(".carddet").popover({container:"body"}),$(".modal-dialog").addClass("modal-dialog modal-dialog-centered");var resizedx=!1,is_hidden=!1;function DynamicView(){var e=$(document).width();1==(resizedx=!0)&&(e<994?($("#sidebarmenu").hide(),resizedx=!1,is_hidden=!0):($("#sidebarmenu").show(),resizedx=!1))}DynamicView(),$(window).resize(function(){DynamicView()}),$("#btn_navsdietoggle").click(function(){$(document).width()<994&&(1==is_hidden?(is_hidden=!1,$("#sidebarmenu").show()):(is_hidden=!0,$("#sidebarmenu").hide()))});
         		var hasgetted = false;
         function GetServiceCentersForOption(){
         	if(hasgetted == false){
         
         	var inp_sc_id = <?php  echo json_encode(session('user_school')); ?>;
         	$.ajax({
         		type : 'POST',
         		url: '{{ route("stole_getallservicecenters") }}',
         		data: {_token:'{{ csrf_token() }}',station_id: inp_sc_id},
         		success : function(data){
         			$('.allservicenterrooms').html(data);
         			Get_p2(inp_sc_id);
         		}
         	})
         	}
         }
         function Get_p2(inp_sc_id){
         	$.ajax({
         		type:'POST',
         		url: '{{ route("get_cat_gr") }}',
         		data: {_token: '{{ csrf_token() }}',school_id: inp_sc_id},
         		success : function(data){
         			$('#allcategoriesz').html(data);
         		}
         	})
         	hasgetted = true;
         }
         var dontoverload = false;
         function getcountofgen(){
         	var soul_default_station = <?php echo json_encode(session('user_school')); ?>;
         	if(dontoverload == false){
         		getcoinyears();
         				// GET CO INVENTORY YEARS
         	function getcoinyears(){
         		$.ajax({
         			type:'POST',
         			url: '{{ route("stole_all_years_with_inventory_capitaloutlay") }}',
         			data: {_token: '{{ csrf_token() }}', station_id: soul_default_station},
         			success: function(data){
         				$('#co_invyear').html(data);
         				getcoinvmonths();
         			}
         		})
         	}
         	// GET CO INVENTORY MONTHS
         	function getcoinvmonths(){
         		var prom_year = $('#co_invyear').val();
         		$.ajax({
         			type:'POST',
         			url: '{{ route("stole_inventory_month_capital_outlay") }}',
         			data: {_token: '{{ csrf_token() }}', station_id: soul_default_station, date_year: prom_year},
         			success: function(data){
         				$('#co_invmonth').html(data);
         				getseinvyears();
         			}
         		})
         	}
         	// GET SE INVENTORY YEARS
         	function getseinvyears(){
         		$.ajax({
         			type:'POST',
         			url: '{{ route("stole_all_years_with_inventory_semiexpendable") }}',
         			data: {_token: '{{ csrf_token() }}', station_id: soul_default_station},
         			success: function(data){
         				$('#se_invyear').html(data);
         				getseinvmonths();
         			}
         		})
         	}
         	// GET SE INVENTORY MONTHS
         	function getseinvmonths(){
         			var prom_year = $('#se_invyear').val();
         		$.ajax({
         			type:'POST',
         			url: '{{ route("stole_inventory_month_semiexpendable") }}',
         			data: {_token: '{{ csrf_token() }}', station_id: soul_default_station, date_year:prom_year },
         			success: function(data){
         				$('#se_invmonth').html(data);
         				dontoverload = true;
         				loadservicecentersall();
         
         			}
         		})
         	}
         	}else{
         		loadservicecentersall();
         	}
         	function loadservicecentersall(){
         
         		var inp_co_invyear = $('#co_invyear').val();
         		var inp_co_invmonth = $('#co_invmonth').val();
         		$('#continueenrep_btn').css('display','none');
         		$('#asstobegennum').html('Getting reports, please wait...');
         		var inp_sc_id = <?php  echo json_encode(session('user_school')); ?>;
         		var roomnum = $('#co_service_center').val();
         		var category_class = $('#allcategoriesz').val();
         
         
         		$.ajax({
         			type: 'POST',
         			url: '{{ route("get_tobegen_repcount") }}',
         			data: {_token:'{{ csrf_token() }}',rn:roomnum,
         												cc:category_class,
         												station_id:inp_sc_id,
         												inv_year:inp_co_invyear,
         												inv_month:inp_co_invmonth},
         			success: function(data){
         			if(data == '0'){
         			$('#continueenrep_btn').css('display','none');
         			$('#asstobegennum').html("The're no reports in the selected room and category.");
         			}else{
         			$('#continueenrep_btn').css('display','block');
         			$('#asstobegennum').html(data + ' item(s) to be included.');
         			}
         		}})
         	}
           }
      </script>
   </body>
</html>