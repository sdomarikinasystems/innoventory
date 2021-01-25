@extends('master.master_login')

@section('title')
Innoventory  - Login
@endsection

@section('contents')
<style type="text/css">
	body{
		background-color: #F7F7F9;
		background-attachment: fixed;	
	}
	.login-container {
		width: 100%;
		margin: 12% auto;
	}
	
	p {
		margin-bottom: 0;
	}

	@media only screen and (max-width: 600px) {
  #pr_postion{
		margin-top: 0px !important;
	}
	.titlebar{
		text-align: center;
	}
}
	#pr_postion{
		margin-top: 60px;
	}

</style>

<script type="text/javascript">
    $("#mynavbar").css("display","none");
</script>

<div class="container login-container">
	<div class="row">
		<div class="col-sm-6 titlebar" style="padding: 20px; border-radius: 10px; background: transparent;">
			<h6 id="pr_postion" class="text-muted">Procurement Management System</h6>
			<h1 class="featurefont mb-4 tridify">INNOVENTORY</h1>
			<small class="text-muted">A project of the Schools Division Office - Marikina City <br> for School Year 2020-2021</small>
		</div>
		<div class="col-sm-6 col-left">
			<div class="card" style="box-shadow: 0px 2px 5px rgba(0,0,0,0.1);">
				<div class="card-body">

					<?php 
					if(empty(session("user_uname"))){
						?>
						<!-- LOGIN -->
						<h5 class="mb-4 mt-0">Sign-in</h3>
					<form action="{{ route('proc_sign_protocol') }}" method="POST" autocomplete="off">
					   {{ csrf_field() }}
						<div class="row">
						<div class="col-lg-12">							
							<div class="form-group">
								<span class="float-right" id="em_val"></span>
								<label><i class="far fa-id-card"></i> DepEd Email</label>
								<input required="" onchange="email_validator()"   autocomplete="off" id="typed_email" type="email" placeholder="ex: person@deped.gov.ph" class="form-control" name="user_employee_id">
							</div>
						</div>
						<div class="col-lg-12 col-right">
							<div class="form-group">
								<label><i class="fas fa-shield-alt"></i> Password</label>
								<input required="" autocomplete="off" type="password"  placeholder="Enter your password..." class="form-control" name="user_employee_password">
							</div>
						</div>
						<div class="col-lg-12">
							<button style="margin-top: 5px;" name="btn_login" id="btnsub" class="btn btn-primary float-right" type="submit">Sign in <i class="fas fa-arrow-right"></i></button>
						</div>				
					</form>
						<?php 
					}else{

						?>
						<!-- LOAD SESSION -->
						<div class="mt-4 mb-4">
							<h1 class="m-0 mb-3"><i class="far fa-user-circle"></i></h1>
							<h5 class="mb-0"><span class="text-muted">Welcome back</span> <?php echo session("user_uname"); ?>!</h5>
							<p class="mb-3">You're still logged-in to your innoventory account. Continue by clicking the button below.</p>
							<a class="btn btn-primary mt-4" href="{{ route('dboard') }}"><i class="fas fa-arrow-circle-right"></i> Continue</a>
						</div>
						<?php
					}
					?>
					</div>			
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function email_validator(){
		var typedemail = $("#typed_email").val().toLowerCase();
		if(!typedemail.includes("deped.gov.ph")){
			$("#em_val").html("<span style='color:red;'>Not a valid deped email!</span>");
			$("#btnsub").prop("disabled",true);
		}else{
			$("#em_val").html("");
			$("#btnsub").prop("disabled",false);
		}
	}
</script>
<!-- </div> -->

<center>
    <small style="display: inline-block; margin: 0; bottom: 0;  color: rgba(255,255,255,0.5); left: 0; right: 0; position: fixed; z-index: -1;">Developed by SDO - Marikina ICTU</small>
</center>
@endsection