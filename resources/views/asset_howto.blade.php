@extends('master.master')

@section('title')
Innoventory - How To?
@endsection

@section('contents')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item active" aria-current="page"><a href="{{ route('dboard') }}">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">How to?</li>
	</ol>
</nav>


	 <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
	  <li class="nav-item">
	    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Step by Step Tutorial</a>
	  </li>
	  <li class="nav-item">
	    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Slides Tutorial</a>
	  </li>
	</ul>


	<div class="tab-content" id="pills-tabContent">
	  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

	  	<div class="container">
	  		<div class="mb-5">
	  			<h1>Simple Steps to Kickstart your Innoventory</h1>
	  			<p>This steps will guide you to into the Innoventory inventory process.</p>
	  		</div>
			<div class="row">
	  		<div class="col-md-4">
	  			<h1>1</h1>
  					<h5 class="text-primary">Encode Service Centers</h5>
  					<p class="mt-4">Encode all the service center of your assets with the specified information below.</p>
  					<ul>
  						<li>Service Center Name</li>
  						<li>Room Number</li>
						<li>Center Manager</li>
  					</ul>
  					<p class="mt-4">Encode all of these information one-by-one in Manage Service Center page.</p>
	  		</div>
	  		<div class="col-md-4">
<h1>2</h1>
  					<h5 class="text-primary">Upload Asset Registry</h5>
  					<p class="mt-4">After you encode your assets in your csv file like Capital Outlay (22 columns), Semi-Expendable (9 columns) you can now upload it in your Innoventory Asset Registry page.</p>

  					<h5 class="text-primary">Fixing Asset Registry Discrepancies</h5>
  					<p>After you upload your asset registry file, the system will inform you how many discrepancies you have in your Asset Registry. You will need to see this discrepancies so you know what information is missing in your Asset Registry CSV file.</p>

  					<h5 class="text-primary">Making your Station Ready for Inventory</h5>
					<p>Make sure you have zero(0) discrepancies and the system will tell you if you are ready for inventory by going to Innoventoy Dashboard.</p>
	  		</div>
	  		<div class="col-md-4">
<h1>3</h1>
  					<h5 class="text-primary">Print QR Stickers</h5>
  					<p class="mt-4">Go to your QR Stickers page to print all of your asset registry QR Stickers by checking them one-by-one, filtering, or selecting them all in "Select All" checkbox.</p>
  					<h5 class="text-primary">What asset will not be included in QR Strickers printing?</h5>
  					<p>Only LGU, Disposed asset(s), Missing Room Number and Service Center(s) are not included in your QR Generation Page.</p>
  					<h5 class="text-primary">What to do after printing all of my QR Stickers?</h5>
  					<p>Cut and place all individual stickers in their physical asset item(s).</p>
	  		</div>
	  		<div class="col-md-4">
<h1>4</h1>
  					<h5 class="text-primary">Start Inventory Scanning</h5>
  					<p class="mt-4">You can start inventory by going to the Inventory page. Click the "Start" to start inventory in the Inventory panel in the right side of Inventory page screen.</p>

  					<h5 class="text-primary">What equiptment do we need to prepare?</h5>
  					<ul>
  						<li>QR Scanner Device paired to your tabled device.</li>
  						<li>Tabled Device</li>
  					</ul>

  					<h5 class="text-primary">What to make sure while scanning all asset items?</h5>
  					<p>1. You started your inventory in Inventory page</p>
  					<p>2. Make sure that your current service center where you will be doing your scanning is selected in the service center selection box.</p>
  					<p>3. Ensure that your "Property / Stock Number" box is always selected while scanning else the scanned item code will not be inserted.</p>

  					<h5 class="text-primary">Sending All Scanned Data</h5>
  					<p>You can send scanned data by clicking the upper right green button called "Submit Inventory" and the system will permanently store your scanned data in your asset inventory page.</p>
	  		</div>
	  		<div class="col-md-4">
	  			<h1>5</h1>
  					<h5 class="text-primary">Print Appendix 66/73</h5>
  					<p>In the sidebar you will notice the "Reports" link. click it and you will see all the appendix report generation button.</p>

  					<h5 class="text-primary">Filter Month/Year</h5>
  					<p>The filter month/year helps you generate specific inventory dates data that will be displayed on your appendix (66/73).</p>
	  		</div>

	  	</div>	  		
	  	</div>

	  </div>
	  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vTRNVdhYm2QG6ncYqPDL0a9NrApyPIwZuiiaG6-WmiIEtoDCJuKUcIX57QvcE3wHHrOvRnFNUIPiQrJ/embed?start=false&loop=true&delayms=3000" frameborder="0" width="1440" height="839" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
	  </div>
	  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
	</div>

@endsection