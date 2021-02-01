@extends('master.master_login')
@section('contents')
<div class='container login-container'>
   <div class='row'>
      <div class='col-lg-6 titlebar' style='padding: 20px; border-radius: 10px; background: transparent;'>
         <h6 id='pr_postion' class='text-muted'>Procurement Management System</h6>
         <h1 class='featurefont mb-4 tridify'>INNOVENTORY</h1>
         <small class='text-muted'>A project of the Schools Division Office - Marikina City <br> for School Year 2020-2021</small>
      </div>
      <div class='col-lg-6 col-left'>
         <div class='card card-shadow'>
            <div class='card-body'>
               <?php 
                  if(empty(session('user_uname'))){
                  	?>
               <!-- LOGIN -->
               <h5 class='mb-4 mt-0'>
               Sign-in</h3>
               <form action='{{ route("proc_signin_protocol") }}' method='POST' autocomplete='off'>
                  {{ csrf_field() }}
                  <div class='row'>
                     <div class='col-lg-12'>
                        <div class='form-group'>
                           <span class='float-right' id='em_val'></span>
                           <label><i class='far fa-id-card'></i> DepEd Email</label>
                           <input required='' onchange='email_validator()'   autocomplete='off' id='typed_email' type='email' placeholder='ex: person@deped.gov.ph' class='form-control' name='user_employee_id'>
                        </div>
                     </div>
                     <div class='col-lg-12 col-right'>
                        <div class='form-group'>
                           <label><i class='fas fa-shield-alt'></i> Password</label>
                           <input required='' autocomplete='off' type='password'  placeholder='Enter your password...' class='form-control' name='user_employee_password'>
                        </div>
                     </div>
                     <div class='col-lg-12'>
                        <button style='margin-top: 5px;' name='btn_login' id='btnsub' class='btn btn-primary float-right' type='submit'>Sign in <i class='fas fa-arrow-right'></i></button>
                     </div>
               </form>
               <?php 
                  }else{
                  	?>
               <!-- LOAD SESSION -->
               <div class='mt-4 mb-4'>
               <h1 class='m-0 mb-3'><i class='far fa-user-circle'></i></h1>
               <h5 class='mb-0'><span class='text-muted'>Welcome back</span> <?php echo session('user_uname'); ?>!</h5>
               <p class='mb-3'>You're still logged-in to your innoventory account. Continue by clicking the button below.</p>		
               <form action='{{ route("proc_logout") }}' method='GET' >
               <a class='btn btn-primary mt-4' href='{{ route("dboard") }}'><i class='fas fa-arrow-circle-right'></i> Continue</a>
               <button class='btn btn-secondary mt-4' type='submit'><i class='fas fa-sign-out-alt'></i> Log-out</button>
               </form>
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
<script type='text/javascript'>
   function email_validator(){$("#typed_email").val().toLowerCase().includes("deped.gov.ph")?($("#em_val").html(""),$("#btnsub").prop("disabled",!1)):($("#em_val").html('<span style="color:red;">Not a valid deped email!</span>'),$("#btnsub").prop("disabled",!0))}
</script>
<center>
   <small style='display: inline-block; margin: 0; bottom: 0;  color: rgba(255,255,255,0.5); left: 0; right: 0; position: fixed; z-index: -1;'>Developed by SDO - Marikina ICTU</small>
</center>
@endsection