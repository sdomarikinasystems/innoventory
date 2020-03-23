<?php $__env->startSection('title'); ?>
CDTRS Online Portal
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>

<style type="text/css">
		#nodeToRenderAsPDF{
			font-family: times roman !important;
		}
		.indent_0x{
			margin-left: 15px;
		}
		.indent_1x{
			margin-left: 50px;
		}
		.indent_2x{
			margin-left: 100px;
		}
		.centerTextFixed{
			width: 95%;
			margin-left: 15px;
			margin-right: 15px;
			margin-bottom: 5px;
			text-align: center;
		}
		.theinput{
			border:none;
			border-bottom: 1px solid black;
		}
		.row{
			padding-top: 0px !important;
			margin-top: 0px !important;
		}
		.col-sm-6{
			padding-top: 0px !important;
			margin-top: 0px !important;
		}
		hr{
			padding: 0px !important;
			margin: 0px !important;
			border-top: 1px solid rgba(0,0,0,0.1);
		}
		.rightborder{
			border-right: 1px solid rgba(0,0,0,0.1);
		}
		tr{
			margin: 0 !important;
			padding: 2px !important;
		}
		td{
			margin: 0 !important;
			padding: 2px !important;
		}
		th{
			margin: 0 !important;
			padding: 2px !important;
		}
		.lined{
			border: none;
			border-bottom: 1px solid black;
			width: 274px;
			text-align: center;
		}
		@media  print{
			#tohide{
				display: none;
			}
		}
	</style>

<div class="jumbotron jumbotron-fluid" style="background-color: #2c3e50; color:  #ecf0f1;" id="tohide">
    <div class="container">
        <h1 class="display-4 ultrathin">Online Form 6 Printing</h1>
        <!-- <p>Leave report database id : <?php echo e($Leave_id); ?></p> -->
        <a href="#" class="btn btn-light" onclick="window.print()"><i class="fas fa-print"></i> Print</a>
    </div>
</div>

<div class="container" id="nodeToRenderAsPDF" style="padding-top: 20px; padding-bottom: 20px; padding-left: 75px; padding-right: 75px;">
    <center>
        <span>FORM 6</span>
        <h4>APPLICATION FOR LEAVE</h4>

    </center>
    <span>CSC Form No 6<br>
	Revised 1984</span>
    <table class="table table-bordered">
        <tr>
            <td>
                <h6><span class="lbl_detail">1.</span> OFFICE / AGENCY<br>
				<strong  class="indent_0x"><?php echo strtoupper(session("user_company")); ?></strong>
				</h6>
            </td>
            <td>
                <h6><span class="lbl_detail">2.</span> LAST<br>
				<strong class="indent_0x"><?php echo session("user_lastname"); ?></strong>
				</h6>
            </td>
            <td>
                <h6>FIRST<br>
				<strong class="indent_0x"><?php echo session("user_firstname"); ?></strong>
				</h6>
            </td>
            <td>
                <h6>MIDDLE<br>
				<strong class="indent_0x"><?php echo session("user_middlename"); ?></strong>
				</h6>
            </td>
        </tr>
        <tr>
            <td>
                <h6><span class="lbl_detail">3.</span> DATE OF FILING</br>
				<strong class="indent_0x" id="id_dateoffiling"></strong>
				</h6>
            </td>
            <td colspan="2">
                <h6><span class="lbl_detail">4.</span> POSITION</br>
				<strong class="indent_0x" id="id_position"></strong>
				</h6>
            </td>
            <td>
                <h6><span class="lbl_detail">5.</span> SALARY MONTHLY</br>
				<strong class="indent_0x" id="id_salary"><?php echo number_format(session("user_basicpay"),2); ?></strong>
				</h6>
            </td>
        </tr>
    </table>
    <center>
        <!-- <span>DETAILS OF APPLICATION<br></span> -->
        <span class="lbl_detail">DETAILS OF APPLICATION</span>
    </center>
    <hr>
    <div class="row">
        <div class="col-sm-6 rightborder">

            <h6 class="indent_0x"><span class="lbl_detail">6.</span> a) TYPE OF LEAVE</h6>
            <div class="indentbox">
                <span class="indent_1x"><input id='id_vacationleave' type="checkbox" disabled="" name=""> Vacation<br></span>
                <label class="indent_2x">
                    <input type="radio" disabled="" id="vac_leave_toseek" name="va_leave"> To Seek Employment</label class="indent_1x">
                <br>
                <label class="indent_2x">
                    <input type="radio" disabled="" id="vac_leave_other" name="va_leave"> Others (Specify)
                    <input type="text" readonly class="lined" style="width: 100%;" name="va_otherspecifyreason" id="va_leave_other_reason">
                </label>
                <br>
                <label class="indent_1x">
                    <input id="id_sickleave" type="checkbox" disabled="" name=""> Sick</label>
                <br>
                <label class="indent_1x">
                    <input id="id_maternity" type="checkbox" disabled="" name=""> Maternity</label>
                <br>
                <label class="indent_1x">
                    <input id="id_others" type="checkbox" disabled="" name=""> Others (Specify)
                    <input type="text" readonly class="lined" name="" style="width: 100%;" id="id_leavetype">
                </label>
                <br>
                <h6 class="indent_0x">c) NUMBER OF WORKING DAYS APPLIED FOR</h6>
                <input class="centerTextFixed theinput" id="id_numberofworkingdays" type="text" readonly name="">
                <br>
                <h6 class="indent_0x">INCLUSIVE DATES</h6>
                 <input class="centerTextFixed theinput" id="id_inclusivedates" type="text" readonly name="">
            </div>

            <br>
            <br>
        </div>
        <div class="col-sm-6" style="padding-left: 20px;">
            <h6><span class="lbl_detail">6.</span> b) WHERE LEAVE WILL BE SPENT:</h6>

            <div class="indentbox">
                <span><span class="lbl_detail">1.</span> IN CASE OF VACATION LEAVE
                <br>
                </span>
                <labe class="indent_0x">
                    <input type="radio" disabled="" id="vac_1" name="vacl_ltype"> Within the Philippines</label>
                    <br>
                    <label class="indent_0x">
                        <input type="radio" disabled="" id="vac_2" name="vacl_ltype"> Abroad (Specify)</label>
                    <input class="centerTextFixed theinput" id="vac_specify" type="text" readonly name="">
                    <h6><span class="lbl_detail">2.</span> IN CASE OF SICK LEAVE</h6>
                    <label class="indent_0x">
                        <input id="id_sick_reason_inhospital" type="radio" disabled="" name=""> In Hospital</label>
                    <input class="centerTextFixed theinput" id="id_sick_location_inhos" type="text" readonly name="">
                    <label class="indent_0x">
                        <input id="id_sick_reason_outpatient" type="radio" disabled="" name=""> Out Patient (Specify)</label>
                    <input class="centerTextFixed theinput" id="id_sick_location_outpat" type="text" readonly name="">
                    <br>
                    <br>
                    <h6 class="indent_0x"><span class="lbl_detail">d)</span> COMMUTATION</h6>
                    <label class="indent_0x">
                        <input type="radio" checked="checked" name="commutation" disabled=""> Requested
                        <input disabled="" class="indent_0x" type="radio" disabled="" name="commutation"> Not Requested</label>
                    <br>
                    <br>
                    <br>
                    <center>
                        <input style="width: 60%;" class="centerTextFixed theinput" type="text" readonly name="">
                        <br>Signature of Applicant
                    </center>
            </div>
        </div>
    </div>

    <hr>
    <center>
        <!-- <h6>DETAILS OF ACTION OF APPLICATION</h6> -->
        <span class="lbl_detail">DETAILS OF ACTION OF APPLICATION</span>
    </center>
    <hr>
    <div class="row">
        <div class="col-sm-6 rightborder">
            <h6 class="indent_0x"><span class="lbl_detail">7.</span> a) CERTIFICATION OF LEAVE CREDITS as of</h6>
            <div class="indentbox">
                <input class="centerTextFixed theinput" type="text" readonly="" id="id_leavebalasof" name="">
                <table class="table table-bordered" style="text-align: center;">
                    <tr>
                        <th>Vacation</th>
                        <th>Sick</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td id="id_bal_vacationleave">0</td>
                        <td id="id_bal_sickleave">0</td>
                        <td id="id_bal_total">0</td>
                    </tr>
                    <tr>
                        <td>Days</td>
                        <td>Days</td>
                        <td>Days</td>
                    </tr>
                </table>
                <span class="indent_0x">Leave Balance as of <?php echo date("F d, Y"); ?></span>
                <table class="table table-bordered" style="text-align: center;">
                    <tr>
                        <th>Vacation</th>
                        <th>Sick</th>
                        <th>Total</th>
                    </tr>

                    <tr>
                        <td id="id_currbal_vacationleave">0</td>
                        <td id="id_currbal_sickleave">0</td>
                        <td id="id_currbal_total">0</td>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <center>
                <input style="width: 60%;" class="centerTextFixed theinput" type="text" readonly name="">
                <h6><strong id="id_hrofficername">Lorem Ipsum</strong><br>
				<span id="id_hrofficerposition">Lorem Ipsum</span></h6>

            </center>
        </div>
        <div class="col-sm-6">
            <h6><span class="lbl_detail">7.</span> b) RECOMMENDATION</h6>
            <div class="indentbox">
                <label class="indent_0x">
                    <input type="checkbox" disabled="" name=""> Approval</label>
                <br>
                <label class="indent_0x">
                    <input type="checkbox" disabled="" name=""> Dissaproval due to</label>
                <br>
                <textarea readonly class="indent_0x"  style="width: 100%; resize: none;" rows="4">

                </textarea>
            </div>
            <br>
            <br>
            <br>

            <!-- <center> -->
            <div style="position: absolute; bottom: 0; left: 0; right: 0; text-align: center;">
                <input style="width: 60%;" class="centerTextFixed theinput" type="text" readonly name="">
                <h6><strong id="id_recommendationname">Lorem Ipsum</strong><br><span id="id_recommendationposition">Lorem Ipsum</span></h6>

            </div>
            <!-- </center> -->
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-sm-6">
            <h5><span class="lbl_detail">7.</span> c) APPROVED FOR:</h5>
            <div class="indentbox">
                <label>
                	<input type="text" style="border:none; border-bottom: 1px solid black; text-align:center;" readonly="" id="id_paiddays" name=""> days with pay
                </label>
                <label>
                	<input type="text" style="border:none; border-bottom: 1px solid black; text-align:center;" readonly="" id="id_unpaiddays" name=""> days without pay
                </label>
                <label>
                    <input type="text" style="border:none; border-bottom: 1px solid black; text-align:center;" readonly="" name=""> other (Specify)
                </label>
            </div>
        </div>
        <div class="col-sm-6">
            <h5><span class="lbl_detail">7.</span> b) DISSAPROVED DUE TO:</h5>
            <div class="indentbox">
                <textarea id="id_dissapproveddueto" readonly class="indent_0x" style="width: 100%; resize: none;" rows="4"></textarea>
            </div>
        </div>
    </div>
    <br>
    <center>

        <h6><strong id="id_footersignatoryname">Lorem</strong><br><span id="positionoffootersignatory">Ipsum<br></span></h6>

    </center>
</div>

<script type="text/javascript">
	GetForm6DetailById();
	function GetForm6DetailById(){
		var Leave_id= <?php echo json_encode($Leave_id); ?>;
		$.ajax({
			type: "POST",
			url: "form6_getinfo",
			data: {_token: "<?php echo e(csrf_token()); ?>",lr_id:Leave_id},
			success: function(data){
				data = JSON.parse(data);

                var form6status = data[0]["status"];


				DateFormatter("#id_dateoffiling",data[0]["date_of_filling"],"F d, Y");
                DateFormatter("#id_leavebalasof",data[0]["date_of_filling"],"F d, Y");

				$("#id_position").html(data[0]["position"]);
				var leavetype = data[0]["leave_type"];
                if(form6status == 2){
                    $("#id_leavetype").val("Leave Without Pay");
                }else{
                  switch(leavetype){
                    case "Sick Leave":
                        $("#id_sickleave").prop("checked",true);
                    break;
                    case "Service Credit":
                        $("#id_sickleave").prop("checked",true);
                    break;
                    case "Leave Without Pay":
                        $("#id_leavetype").val("Leave Without Pay");
                    break;
                }  
                }
                 var dayswithpay = parseInt(data[0]["paid_days"]);
    			 var unpaiddays = parseInt(data[0]["unpaid_days"]);
                 
                 if(form6status == 2){
                    unpaiddays += dayswithpay;
                    dayswithpay = 0;
                 }
				$("#id_paiddays").val(dayswithpay);
				$("#id_unpaiddays").val(unpaiddays);

				$("#id_numberofworkingdays").val(parseInt(data[0]["paid_days"]) + parseInt(data[0]["unpaid_days"]));
				if(data[0]["date_from"] == data[0]["date_to"]){
					DateFormatter("#id_inclusivedates",data[0]["date_from"],"F d, Y");
				}else{
					$("#id_inclusivedates").val(data[0]["date_from"] + " to " + data[0]["date_to"]);
				}
				var leave_subtype = data[0]["sick_incase"];

				switch(leave_subtype){
					case "In Hospital":
                            $("#id_sick_reason_inhospital").prop("checked",true);
						$("#id_sick_location_inhos").val(data[0]["sick_incase_reason"]);
					break;
					case "Out Patient":
                            $("#id_sick_reason_outpatient").prop("checked",true);
						$("#id_sick_location_outpat").val(data[0]["sick_incase_reason"]);
					break;
				}
                // SET FOOTER SIGNATORY INFORMATION
                var user_type = <?php echo json_encode(session("company_cdtrstype")); ?>;
                var hr_officer = <?php echo json_encode(session("company_hr")); ?>;
                var admin_officerv = <?php echo json_encode(session("company_adminv")); ?>;
                var school_principal = <?php echo json_encode(session("company_principal")); ?>;
                var division_oic = <?php echo json_encode(session("company_oic")); ?>;
                if(user_type == "0"){
                    // DIVISION CDTRS 
                    // SIGN BY OIC
                     $("#id_footersignatoryname").html(division_oic);
                     $("#positionoffootersignatory").html("OIC, Office of the Schools Division Superintentdent");
                      $("#id_recommendationname").html(admin_officerv);
                    $("#id_recommendationposition").html("Administrative Office V");
                }else{
                    // SCHOOL CDTRS
                    // SIGN BY ADMIN OFFICER V
                     $("#id_footersignatoryname").html(admin_officerv);
                     $("#positionoffootersignatory").html("Administrative Office V");
                    $("#id_recommendationname").html(school_principal);
                    $("#id_recommendationposition").html("School Principal");
                }
                    $("#id_hrofficername").html(hr_officer);
                    $("#id_hrofficerposition").html("Administrative Officer IV - HRMO");
                  GetLeaveBalances(leavetype,dayswithpay,form6status);
                  if(form6status == 2){
                    $("#id_dissapproveddueto").val(data[0]["reason_of_dissaprove"]);
                  }
			}
		})
	}

    function GetLeaveBalances(lvtype,tominus,stat){
        $.ajax({
            type : "POST",
            url : "get_leave_bals",
            data: {_token: "<?php echo e(csrf_token()); ?>"},
            success: function(data){
               data = JSON.parse(data);
               var my_sickleave = data[0]["sick_leave"];
               var my_servicecredit = data[0]["service_credit"];
               var my_vacationleave = data[0]["vacation_leave"];

               $("#id_bal_vacationleave").html(my_vacationleave);
               $("#id_bal_sickleave").html(my_sickleave);
               $("#id_bal_total").html((parseFloat(my_vacationleave) + parseFloat(my_sickleave)).toFixed(3));

                var mycurr_sickleave = my_sickleave;
               var mycurr_servicecredit = my_servicecredit;
               var mycurr_vacationleave = my_vacationleave;

               if(stat != 2){
                 switch(lvtype){
                case "Sick Leave":
                    mycurr_sickleave -= tominus;
                break;
                case "Service Credit":
                    mycurr_sickleave -= tominus;
                break;
               }
               }

                $("#id_currbal_vacationleave").html(my_vacationleave);
               $("#id_currbal_sickleave").html(mycurr_sickleave);
               $("#id_currbal_total").html((parseFloat(my_vacationleave) + parseFloat(mycurr_sickleave)).toFixed(3));

            }
        })
    }

	function DateFormatter(theid,thedate,theformat){
		$.ajax({
			type: "POST",
			url: "formatdate_now",
			data: {_token: "<?php echo e(csrf_token()); ?>",fdate:thedate,ffromat:theformat},
			success: function(data){
				$(theid).html(data);
                $(theid).val(data);
			}
		})
	}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('master.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>