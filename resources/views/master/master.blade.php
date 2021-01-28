<?php
$acc_badge = "";
$at = "";
if (session("user_uname") == "" || session("user_uname") == null) {
  ?>
  <script type="text/javascript">
  	window.location.href = "{{ route('proc_logout') }}";
  </script>
  <?php
}else{
	$at = session("user_type");
	switch (session("user_type")) {
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
<html lang="en">
<head>
<title>@yield('title')</title>
	<link rel='icon' href='{{ asset("images/sdo.ico") }}' type='image/x-icon'/ >
	<!-- CHARSET AND MOBILE VIEW -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<!-- JQUERY, POPPER, BOOTSRAP JS -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<!-- THEME -->
	<script src="https://kit.fontawesome.com/396c986df7.js" crossorigin="anonymous"></script>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
	<!-- DATA TABLE -->
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">

	<link type="text/javascript" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css"></link>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<style>
	.btn-text{
		padding: 0px !important;
		margin: 0px !important;
		min-width: 0px !important;
		display: inline !important;
	}
	.xload{
		left: 0;
		right: 0;
		top:0;
		bottom: 0;
		background-color: rgba(220, 221, 225,0.7);
		z-index: 100;
		width: 100%;
		height: 100%;
		position: fixed;
	}
	.card-body-sm{
		padding: 10px;
	}
/* width */
::-webkit-scrollbar {
  width: 4px;
}

/* Track */
::-webkit-scrollbar-track {
  background: white;
  border: 1px solid  #ededed; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #e6e6e6; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
.basic_link{
	text-decoration: none;

}

span.deleteicon {
    position: absolute;
  width: 94%;


}
span.deleteicon span {
	position: absolute;
	display: block;
	top: 11px;
	right: 10px;
	width: 25px;
	height: 25px;
	opacity: 0.5;
	background: url('https://icons.iconarchive.com/icons/iconsmind/outline/512/Close-icon.png') 0 -6px;
	background-size: contain;
	background-position:center;
	background-repeat:no-repeat;
	cursor: pointer;
}
   
@font-face {
  font-family: regularfontnew;
  src: url({{ asset('fonts/sanfrancisco_pro.ttf')  }});
}
body {
	font-family: regularfontnew;
}
	.modal-header{
		text-align: center;
	}
	.modal-header .modal-title{
		margin: 0 auto  !important;

	}
	.addtext_anim{
		animation-name: drop_slide !important;
		animation-duration: 0.3s !important;
		display: block !important;
	}
	@keyframes drop_slide{
		0%{
			opacity: 0;
			margin-top: -10px;
		}
		100%{

		}
	}

	.addcard_anim{
		animation-name: drop_slide_shadow !important;
		animation-duration: 1s !important;
		display: block !important;
	}
	@keyframes drop_slide_shadow{
		0%{
			opacity: 0;
			margin-top: -30px;
		}
		50%{
			box-shadow: 0px 10px 30px rgba(0,0,0,0.4);
		}
		100%{

		}
	}


	.close { 
  position: absolute; 
  right: 1rem;
}
	.announcement_card_body{
		overflow-x: hidden;
		overflow-y: auto;
		max-height: 80vh;
	}
	.announcement_card{
		width: 565px;
		margin:auto;
	}
	.card-shadow{
		box-shadow:0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
	}
	@media only screen and (max-width: 1366px) {
	.announcement_card{
		width: 100%;
		margin:auto;
	}
	.hideinmobile{
		display: none;	
	}


	}


	pre {
    white-space: pre-wrap;       /* Since CSS 2.1 */
    white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
    white-space: -pre-wrap;      /* Opera 4-6 */
    white-space: -o-pre-wrap;    /* Opera 7 */
    word-wrap: break-word;       /* Internet Explorer 5.5+ */
    font-family: regularfontnew;
    font-size: 16px;
}
	.btn{
		border-radius: 50px;
		border:none;
		min-width: 60px;
		padding-left: 20px;
		padding-right: 20px;
	}

	.alert{
		border-radius: 10px;
	}
	.clickablething:hover{
		cursor: pointer;
		border-color: #007DFF !important;
	}
	.card{
		border-radius: 10px !important;
		animation-name: scale-in;
		animation-duration: 0.3s;
		overflow:hidden;
		border-color: #EEEEF2 !important;
	}
	.card-header{
		background-color: #FAFAFC !important;
		border-color: #EEEEF2 !important;
	}
	.card-footer{
		border-color: #EEEEF2 !important;
		background-color: #FAFAFC !important;
	}

	.breadcrumb{
		border-radius: 20px !important;
		background-color: transparent;
		padding-left: 0px;
	}
	
	.modal-content{
		border-radius: 10px !important;
		border:none;
		animation-name: scale-in;
		animation-duration: 0.3s;
			box-shadow:0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
	}
	.btn:hover{
			box-shadow:0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
	}
	.dropdown-menu{
		border-radius: 10px !important;
			box-shadow:0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
		border-color: #EEEEF2 !important;
	}
	.nav-tabs .nav-item .nav-link{
		border-radius: 10px 10px 0px 0px;
		padding: 10px;
		padding-left: 20px;
		padding-right: 20px;
	}
	.form-control{
		border-radius: 30px !important;
		background-color: #F8F9FA;
		border:none;
		box-shadow:inset  0px 1px 3px rgba(0,0,0,0.2);


	}
	.sub-list-group {
		margin-top: 10px;
		list-style-type: none;
	}
	
	.sub-list-group > .sub-list {
		padding: 8px 0;
	}

.importwarning{
	display: none;
}
.invalidcolor{
	color: #FF3A30;
}
	.btn-primary{
		background-color: #007DFF;
	}
	.btn-success{
		background-color: #4DDB5E;
	}
	.btn-danger{
		background-color: #FF3A30;
	}
	.btn-secondary{
		color: black;
		background-color: #DEDEDE;
	}
	.btn-warning{
		background-color: #F6CB01;
	}
	.btn-light{
		background-color: #F0F0F2;
	}
	.alert-sm{
		padding: 10px;
	}
	.alert{
		border:none;
	}
	.alert-primary{
		background-color: #007DFF;
		color: white;
		text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
	}
	.alert-success{
		background-color: #4DDB5E;
		text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
		color: white;
	}
	.alert-danger{
		background-color: #FF3A30;
		text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
		color: white;
	}
	.alert-secondary{
		background-color: #FAFAFC  !important;
		color: white;
	}
	.alert-warning{
		background-color: #F6CB01;
		text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
		color: white;
	}
	.alert-info{
		background-color: #30A7D5;
		text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
		color: white;
	}
	.badge-primary{
background-color: #007DFF;
		color: white;
		text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
	}
	.badge-success{
		background-color: #4DDB5E;
		text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
		color: white;
	}
	.badge-danger{
		background-color: #FF3A30;
		text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
		color: white;
	}
	.badge-secondary{
		color: black !important;
		background-color: #DEDEDE;
		text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
		color: white;
	}
	.badge-warning{
		background-color: #F6CB01;
		text-shadow: 0px 0px 10px rgba(0,0,0,0.4);
		color: white;
	}
	.td_required{
		color: #FF3A30;
	}
	.td_optional{
		color: #007DFF;
	}
	.card-limited{
		height: 400px;
		overflow: scroll;
	}
			.hcover{
			transition: 0.2s all;
			display: inline-block;
			padding: 10px;
			border-radius: 15px;
			background-color: #007DFF;
			overflow: hidden;
			height: 50px;
			width: 50px;
			color: white;
			box-shadow: 0px 1px 2px rgba(0,0,0,0.2);
			cursor: pointer;
			margin-left: 5px;
			margin-right: 5px;
			color: white !important;
		}
		.hcover:hover{
			transform: scale(1.3);
			margin-top: -10px;
			box-shadow:0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
		text-shadow: 0px 2px 5px rgba(0,0,0,0.4);
		}
		.dock_parent{
			position: fixed;
			display: flex;
			justify-content: center;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
			padding: 10px;
			background-color: transparent;
			border-radius: 15px;
			margin-bottom: 5px !important;
			width: 100%;
		}
		.dock_itself{
			position: absolute;
			display: flex;
			justify-content: center;
			height: 72px;
			border: 1px solid rgba(0,0,0,0.1);
			bottom: 0;
			margin: auto;
			padding: 10px;
			padding-left: 7px;
			padding-right: 7px;
			background-color: white;
			border-radius: 20px;
			box-shadow:0px 2px 3px rgba(0,0,0,0.08),
		0px 10px 30px rgba(0,0,0,0.08);
			margin-bottom: 5px !important;
			width: auto;
		}
</style>
<script type="text/javascript">
	function urlify(text) {
		var urlRegex = /(https?:\/\/[^\s]+)/g;
		return text.replace(urlRegex, function(url) {
			return '<a href="' + url + '" target="_blank"><i class="fas fa-globe-africa"></i> ' + url + '</a>';
		})
	}
</script>
</head>
<body>
	@include('sweet::alert')
	<nav class="navbar navbar-expand-lg navbar-light bg-light" style="border-bottom: 1px solid rgba(0,0,0,0.05); 	box-shadow:0px 2px 3px rgba(0,0,0,0.01),
		0px 5px 10px rgba(0,0,0,0.03);">
	  <a class="navbar-brand" href="#"><span class="featurefont" style="color: #007DFF;">Innoventory</span> <small class="text-muted">by SDO - Marikina City</small></a>
	  <button id="btn_navsdietoggle" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	
	  <div class="collapse navbar-collapse" id="navbarSupportedContent">
	  	<!-- <form class="form-inline"> -->
		<!-- <input class="form-control mr-sm-2" type="search" placeholder="Quick Sight" aria-label="Search"> -->
		<!-- </form> -->
	    <ul class="navbar-nav mr-auto">

	    </ul>
	    <div class="dropdown">
	      <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i> <?php echo ucfirst(session("user_uname")) . " " . $acc_badge . ""; ?>
	      </a>
	    <form action="{{ route('proc_logout') }}" method="GET" class="form-inline my-2 my-lg-0">
	      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

			<a class="dropdown-item" href="{{ route('myaccount') }}"><i class="fas fa-user"></i> My Account</a>
	        <button class="dropdown-item" type="submit"><i class="fas fa-sign-out-alt"></i> Sign-out</button>

	        
	      </div>
	    </div>
	      </form>
	  
	  </div>
	</nav>
	<div class="container-fluid">
	<div class="row mt-3">
	
		<div class="col-lg-2 mb-3" id="sidebarmenu">
			<!-- START OF MENU -->
			<h6>CORE</h6>
			<ul class="list-group mb-3">
				<li class="list-group-item"><a href="{{ route('dboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
				<li class="list-group-item"><a href="{{ route('assetregistry') }}"><i class="fas fa-clipboard-check"></i> Asset Registry</a></li>
				<li class="list-group-item"><a href="{{ route('asset_scanned') }}"><i class="fas fa-search"></i> Inventory</a></li>
				<li class="list-group-item" style="display: none;"><a href="{{ route('goto_issuances') }}"><i class="fas fa-file-alt"></i> Issuances</a></li>
				<li class="list-group-item"><a href="{{ route('asset_disposed') }}"><i class="fas fa-trash"></i> Disposed Assets</a></li>
				<li class="list-group-item"><a data-toggle="collapse" href="#collapse1" onclick="GetServiceCentersForOption()"><i class="fas fa-chart-bar"></i> Reports <i class="float-right fas fa-sort-down"></i></a>
					<div id="collapse1" class="panel-collapse collapse in">
						<ul class="sub-list-group mb-3">
    <?php
      if(session("user_type") < "4" && session("user_type") != "2"){
        ?>
        <!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
    <li class="sub-list"><a href="#" data-toggle="modal" data-target="#m_generatereport" onclick="getcountofgen()"><i class="fas fa-file-pdf"></i> Appendix 73</a></li>

     <li class="sub-list"><a href="#" data-toggle="modal" data-target="#m_generatesemireports" onclick="getcountofgen()"><i class="fas fa-file-pdf"></i> Appendix 66</a></li>

    <?php } ?>



	<li class="sub-list"><a href="{{ route('manage_reports') }}"><i class="fas fa-layer-group"></i> Figures</a></li>
	<li class="sub-list"><a href="{{ route('reg_omissions') }}"><i class="fas fa-eraser"></i> Registry Omissions</a></li>
	<li class="sub-list"><a href=""><i class="fas fa-exchange-alt"></i> Returns to LGU</a></li>
	<li class="sub-list"><a href=""><i class="fas fa-question-circle"></i></i> Missing Assets</a></li>
	<li class="sub-list"><a href=""><i class="fas fa-money-bill"></i> Accountabilities</a></li>
	</ul>
	</div>
	</li>
	<li class="list-group-item"><a href="{{ route('asset_resources') }}"><i class="fas fa-folder"></i> Resources</a></li>
	</ul>


	<h6>ADD-ON</h6>
	<ul class="list-group mb-3">
			<?php
			if(session("user_type") < "4" && session("user_type") != "2"){
			?>
			<!-- NOT FOR TEACHERS -->					
			<li class="list-group-item"><a href="{{ route('usermanagement') }}"><i class="fas fa-users"></i> Manage Users</a></li>
			<?php
			}
			if(session("user_type") == "0" || session("user_type") == "1"){
			?>
			<!-- FOR ADMIN ONLY -->
			<!--<li class="list-group-item"><a href="/innoventory/manage/schools"><i class="fas fa-school"></i> Manage Schools</a></li>-->
				<?php
				}
				?>
			<?php
			if(session("user_type") < "4"){
				?>
				<!-- FOR SUPPLY OFFICER AND PROPERTY CUSTODIAN ONLY -->
				<li class="list-group-item"> <a href="{{ route('stationmy') }}"><i class="fas fa-warehouse"></i> Manage Service Centers</a></li>
				<li class="list-group-item"> <a href="{{ route('manage_reminders') }}"><i class="fas fa-bell"></i> Reminders</a></li>
				<li class="list-group-item"> <a href="{{ route('fetch_asset') }}"><i class="fas fa-qrcode"></i> QR Stickers</a></li>
				<?php
				}
			?>
		<li class="list-group-item"><a href="{{ route('ass_transhistory') }}"><i class="fas fa-history"></i> History</a></li>
		<a class="list-group-item" href="{{ route('gohow') }}"><i class="far fa-question-circle"></i> How to?</a>
		<li class="list-group-item"><a href="{{ route('abouts_sys') }}"><i class="fas fa-robot"></i> About the System</a></li>
	</ul>

		<!-- END OF MENU -->
<script type="text/javascript">
	(function ($) {
    $.fn.DuplicateWindow = function () {
        var localStorageTimeout = (5) * 1000; // 15,000 milliseconds = 15 seconds.
        var localStorageResetInterval = (1/2) * 1000; // 10,000 milliseconds = 10 seconds.
        var localStorageTabKey = 'my-application-browser-tab';
        var sessionStorageGuidKey = 'browser-tab-guid';

        var ItemType = {
            Session: 1,
            Local: 2
        };

        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }
        function getCookie(name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        function GetItem(itemtype) {
            var val = "";
            switch (itemtype) {
                case ItemType.Session:
                    val = window.name;
                    break;
                case ItemType.Local:
                    val = decodeURIComponent(getCookie(localStorageTabKey));
                    if (val == undefined)
                        val = "";
                    break;
            }
            return val;
        }

        function SetItem(itemtype, val) {
            switch (itemtype) {
                case ItemType.Session:
                    window.name = val;
                    break;
                case ItemType.Local:
                    setCookie(localStorageTabKey, val);
                    break;
            }
        }

        function createGUID() {
            this.s4 = function () {
                return Math.floor((1 + Math.random()) * 0x10000)
                  .toString(16)
                  .substring(1);
            };
            return this.s4() + this.s4() + '-' + this.s4() + '-' + this.s4() + '-' + this.s4() + '-' + this.s4() + this.s4() + this.s4();
        }
      function TestIfDuplicate() {
            //console.log("In testTab");
            var sessionGuid = GetItem(ItemType.Session) || createGUID();
            SetItem(ItemType.Session, sessionGuid);

            var val = GetItem(ItemType.Local);
            var tabObj = (val == "" ? null : JSON.parse(val)) || null;
            console.log(val);
            console.log(sessionGuid);
            console.log(tabObj);

            // If no or stale tab object, our session is the winner.  If the guid matches, ours is still the winner
            if (tabObj === null || (tabObj.timestamp < (new Date().getTime() - localStorageTimeout)) || tabObj.guid === sessionGuid) {
                function setTabObj() {
                    //console.log("In setTabObj");
                    var newTabObj = {
                        guid: sessionGuid,
                        timestamp: new Date().getTime()
                    };
                    SetItem(ItemType.Local, JSON.stringify(newTabObj));
                }
                setTabObj();
                setInterval(setTabObj, localStorageResetInterval);//every x interval refresh timestamp in cookie
                return false;
            } else {
                // An active tab is already open that does not match our session guid.
                return true;
            }
        }

        window.IsDuplicate = function () {
            var duplicate = TestIfDuplicate();
            //console.log("Is Duplicate: "+ duplicate);
            return duplicate;
        };

        $(window).on("beforeunload", function () {
            if (TestIfDuplicate() == false) {
                SetItem(ItemType.Local, "");
            }
        })
    }
    $(window).DuplicateWindow();
}(jQuery));

</script>
		</div>
		<div class="col-lg-10">
			@yield('contents')

		</div>
	</div>
	</div>


 <!-- REPORT GENERATION MODAL FOR APPENDIX 73 -->
		<form action="{{ route('group_asset') }}" method="GET">
  <div id="m_generatereport" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Generate Appendix 73</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ csrf_field() }}
           <input type='hidden' name='station_id' id='mygroupid'>
   		 <div class="form-group">
   		 	<div class="card card-shadow">
   		 		<div class="card-header">
   		 			Inventory Date
   		 		</div>
   		 		<div class="card-body">
   		 			 <div class="row">
          	<div class="col-sm-6">
          		<div>Year</div>
          		<select class="form-control" id="co_invyear" required="" name="inv_year"></select>
          	</div>
          	<div class="col-sm-6">
          		<div>Month</div>
          		<select class="form-control" id="co_invmonth" required="" name="inv_month"></select>
          	</div>
          </div>
   		 		</div>
   		 	</div>
   		 </div>

          <div class="form-group">
            <label>Room</label>
            <select class="form-control allservicenterrooms" id="co_service_center" onchange="getcountofgen()" name="my_room">
              <option>Sample</option>
            </select>
          </div>
             <div class="form-group">
            <label>Category</label>
            <select class="form-control" id="allcategoriesz" onchange="getcountofgen()" name="my_category">
              <option>Sample</option>
            </select>
          </div>
        
        <div class="card card-shadow mt-4 mb-4">
        	<div class="card-body">
        		 <label class="mt-0 mb-0 text-muted">Assets to be Generated</label>
		         <p class="mb-0 mt-0" id="asstobegennum">0 Item(s)</p>
        	</div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" id="continueenrep_btn" class="btn btn-primary">Generate</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</form>

<!-- REPORT GENERATION OF APPENDIX 66 -->
   	<form action="{{ route('goto_generate_appendix66') }}" method="GET">
    	<div class="modal" tabindex="-1" id="m_generatesemireports" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Generate Appendix 66</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          	{{ csrf_field() }}
           	<div class="form-group">
            	<div class="card card-shadow">
            		<div class="card-header">
            			Inventory Date
            		</div>
            		<div class="card-body">
            				<div class="row">
            				<div class="col-sm-6">
          		<div>Year</div>
          		<select class="form-control" id="se_invyear" required="" name="inv_year"></select>
          	</div>
          	<div class="col-sm-6">
          		<div>Month</div>
          		<select class="form-control" id="se_invmonth" required="" name="inv_month"></select>
          	</div>
            		</div>
            		</div>
            	</div>
        	</div>
			<div class="form-group">
				<label>Room</label>
				<select class="form-control allservicenterrooms" required="" name="my_room">
				<option>Sample</option>
				</select>
			</div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Generate</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

    </form>


<div class="dock_parent" style="display: none;">
	<div  class="dock_itself">
					<a class="hcover" data-placement="top" data-content="Station readiness, Announcements, Summaries" data-trigger="hover" title="Dashboard" href="{{ route('dboard') }}" style="background-color: #FF3A30;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-tachometer-alt"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Upload, Fix, Review Capital Outlay, Semi-Expendable, Supply asset(s)" data-trigger="hover" title="Asset Registry" href="{{ route('assetregistry') }}" style="background-color: #FF9400;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-clipboard-check"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Scan, Review Capital Outlay and Semi-Expendable inventory data" data-trigger="hover" title="Inventory" href="{{ route('asset_scanned') }}" style="background-color: #4DDB5E;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-search"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Recover or view all of your Capital Outlay and Semi-Expendable disposed assets" data-trigger="hover" title="Disposed Assets" href="{{ route('asset_disposed') }}" style="background-color: #F43A2B;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-trash"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Appendix 66 and 73, Figures, Registry Omissions, Returns to LGU, Missing Asset(s), Accountabilities" data-trigger="hover" title="Reports" href="" style="background-color: #5956D6;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-chart-bar"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Download and view all uploaded Capital Outlay, Semi-Expendable files" data-trigger="hover" title="Resources" href="{{ route('asset_resources') }}" style="background-color: #E46F00;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-folder"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Manage user account(s) of your station" data-trigger="hover" title="Manage Users" href="{{ route('usermanagement') }}" style="background-color: #0AB951;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-users"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Add, Delete and Manager your stations Service Centers" data-trigger="hover" title="Service Centers" href="{{ route('stationmy') }}" style="background-color: #025A56;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-warehouse"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Post reminders, announcements in Innoventory" data-trigger="hover" title="Reminders" href="{{ route('manage_reminders') }}" style="background-color: #FFB316;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-bell"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Generate QR Sticker printable" data-trigger="hover" title="QR Stickers" href="{{ route('fetch_asset') }}" style="background-color: #FF1B73;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-qrcode"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Access history logs of your Innoventory usage" data-trigger="hover" title="History" href="{{ route('ass_transhistory') }}" style="background-color: #1B8EF5;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-history"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Learn how to use Innoventory System" data-trigger="hover" title="How To?" href="{{ route('gohow') }}" style="background-color: #23C95B;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-question-circle"></i></span>
					</center>
					</a>
					<a class="hcover" data-placement="top" data-content="Information about the system version and description" data-trigger="hover" title="About" href="{{ route('abouts_sys') }}" style="background-color: #D548DF;">
					<center>
						<span style="font-size: 20px;"><i class="fas fa-robot"></i></span>
					</center>
					</a>


			</div>
</div>

	<script type="text/javascript">

		$('.hcover').popover({
    container: 'body'
  })
			$('.carddet').popover({
    container: 'body'
  })
		
		$(".modal-dialog").addClass("modal-dialog modal-dialog-centered");
		var resizedx = false;
		var is_hidden = false;
		DynamicView();
		$( window ).resize(function() {
		DynamicView();
		});


		function DynamicView(){
			var sc_width = $( document ).width();
			if(sc_width < 994){
				// mobile
				resizedx = true;
			}else{
				//big screen
				resizedx = true;
			}

				if(resizedx == true){
					if(sc_width < 994){
				// mobile
				$("#sidebarmenu").hide();
				resizedx = false;
				is_hidden = true;
			}else{
				//big screen
				$("#sidebarmenu").show();
					resizedx = false;
			}

				}
		}

$("#btn_navsdietoggle").click(function(){
var sc_width = $( document ).width();
	if(sc_width < 994){
		if(is_hidden == true){
		is_hidden = false;
		$("#sidebarmenu").show();
	}else{
		is_hidden = true;
		$("#sidebarmenu").hide();
	}
	}
	
})

				var hasgetted = false;
		function GetServiceCentersForOption(){
			if(hasgetted == false){

			var inp_sc_id = <?php  echo json_encode(session("user_school")); ?>;
			$.ajax({
				type : "POST",
				url: "{{ route('stole_getallservicecenters') }}",
				data: {_token:"{{ csrf_token() }}",station_id: inp_sc_id},
				success : function(data){
					$(".allservicenterrooms").html(data);
					Get_p2(inp_sc_id);
				}
			})
			}
		}

		function Get_p2(inp_sc_id){
			$.ajax({
				type:"POST",
				url: "{{ route('get_cat_gr') }}",
				data: {_token: "{{ csrf_token() }}",school_id: inp_sc_id},
				success : function(data){
					$("#allcategoriesz").html(data);
				}
			})

			hasgetted = true;
		}
		var dontoverload = false;
		function getcountofgen(){
			var soul_default_station = <?php echo json_encode(session("user_school")); ?>;
			

			if(dontoverload == false){
				getcoinyears();
						// GET CO INVENTORY YEARS
			function getcoinyears(){
				$.ajax({
					type:"POST",
					url: "{{ route('stole_all_years_with_inventory_capitaloutlay') }}",
					data: {_token: "{{ csrf_token() }}", station_id: soul_default_station},
					success: function(data){
						$("#co_invyear").html(data);
						getcoinvmonths();
					}
				})
			}
			// GET CO INVENTORY MONTHS
			function getcoinvmonths(){
				var prom_year = $("#co_invyear").val();
				$.ajax({
					type:"POST",
					url: "{{ route('stole_inventory_month_capital_outlay') }}",
					data: {_token: "{{ csrf_token() }}", station_id: soul_default_station, date_year: prom_year},
					success: function(data){
						$("#co_invmonth").html(data);
						getseinvyears();
					}
				})
			}
			// GET SE INVENTORY YEARS
			function getseinvyears(){
				$.ajax({
					type:"POST",
					url: "{{ route('stole_all_years_with_inventory_semiexpendable') }}",
					data: {_token: "{{ csrf_token() }}", station_id: soul_default_station},
					success: function(data){
						$("#se_invyear").html(data);
						getseinvmonths();
					}
				})
			}
			// GET SE INVENTORY MONTHS
			function getseinvmonths(){
					var prom_year = $("#se_invyear").val();
				$.ajax({
					type:"POST",
					url: "{{ route('stole_inventory_month_semiexpendable') }}",
					data: {_token: "{{ csrf_token() }}", station_id: soul_default_station, date_year:prom_year },
					success: function(data){
						$("#se_invmonth").html(data);
						dontoverload = true;
						loadservicecentersall();

					}
				})
			}
			}else{
				loadservicecentersall();
			}

		
			
			function loadservicecentersall(){

				var inp_co_invyear = $("#co_invyear").val();
				var inp_co_invmonth = $("#co_invmonth").val();
				$("#continueenrep_btn").css("display","none");
				$("#asstobegennum").html("Getting reports, please wait...");
				var inp_sc_id = <?php  echo json_encode(session("user_school")); ?>;
				var roomnum = $("#co_service_center").val();
				var category_class = $("#allcategoriesz").val();


				$.ajax({
					type: "POST",
					url: "{{ route('get_tobegen_repcount') }}",
					data: {_token:"{{ csrf_token() }}",rn:roomnum,
														cc:category_class,
														station_id:inp_sc_id,
														inv_year:inp_co_invyear,
														inv_month:inp_co_invmonth},
					success: function(data){
					if(data == "0"){
					$("#continueenrep_btn").css("display","none");
					$("#asstobegennum").html("The're no reports in the selected room and category.");
					}else{
					$("#continueenrep_btn").css("display","block");
					$("#asstobegennum").html(data + " item(s) to be included.");
					}
				}})
			}
		  }



		</script>
</body>
</html>
