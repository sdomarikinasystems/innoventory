@extends('master.master_login')

@section('title')
Innoventory  - Login
@endsection

@section('contents')
<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Work+Sans&display=swap');
	body{
		font-family: 'work sans', sans-serif;
		/*background-image: url('https://images.pexels.com/photos/242236/pexels-photo-242236.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260');*/
		background-color: #F7F7F9;
		background-attachment: fixed;	
	}
	
	.login-container {
		width: 100%;
		margin: 12% auto;
	}
	
	h2, p {
		color: #fff;
	}
	
	p {
		margin-bottom: 0;
	}

	@media only screen and (max-width: 600px) {
  #pr_postion{
		margin-top: 0px !important;
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
		<div class="col-sm-6" style="padding: 20px; border-radius: 10px; background-color: #007DFF;">
			<p id="pr_postion">Procurement Management System</p>
			<h2 class="featurefont">INNOVENTORY</h2>
			<hr>
			<p>A project of the Schools Division Office - Marikina City <br> for School Year 2020-2021</p>
		</div>
		<div class="col-sm-6 col-left">
			<div class="card">
				<div class="card-body">
					<h5 class="mb-4 mt-0">Sign-in</h3>
					<form action="{{ route('proc_sign_protocol') }}" method="POST">
					   {{ csrf_field() }}
						<div class="row">
						<div class="col-lg-12">							
							<div class="form-group">
								<span class="float-right" id="em_val"></span>
								<label><i class="far fa-id-card"></i> DepEd Email</label>
								<input required="" onchange="email_validator()"  autocomplete="off" id="typed_email" type="email" placeholder="ex: person@deped.gov.ph" class="form-control form-control-lg" name="user_employee_id">
							</div>
						</div>
						<div class="col-lg-12 col-right">
							<div class="form-group">
								<label><i class="fas fa-shield-alt"></i> Password</label>
								<input required="" autocomplete="off" type="password" placeholder="Enter your password..." class="form-control form-control-lg" name="user_employee_password">
							</div>
						</div>
						<div class="col-lg-12">
							<button style="margin-top: 5px;" name="btn_login" id="btnsub" class="btn btn-primary float-right" type="submit">Sign in <i class="fas fa-arrow-right"></i></button>
						</div>				
					</form>
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