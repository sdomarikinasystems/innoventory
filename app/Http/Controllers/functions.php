<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Contracts\Cache\Repository;
use DateTime;
use DatePeriod;
use DateInterval;
Use Alert;
class functions extends Controller
{
    public function usermanagement(){
      return view("usermanagement");
    }
    public function assetregistry(){
        return view("assetregistry");
    }
    public function assetuploadresult(){
        return view("assetuploadresult");
    }
    public function asset_disposed(){
       return view("asset_disposed");
    }
    public function asset_view(){
      return view("assetview");
    }
    public function group_asset(){
      return view("assetgrouping");
    }
    public function printapp66(){
      return view("doc_appendix66");
    }
      public function asset_scanned(){
      return view("assetscanned");
    }
    public function view_all_unencludedassets(){
      return view("asset_noentry");
    }
    public function asklogin(){
       return view("login");
    }
    public function proc_logout(){
      session()->flush();
      return redirect('/');
    }
    public function dboard(){
      return view("asset_dash");
    }
    public function stationmy(){
       return view("mystation");
    }
    public function manstat(){
      return view("managestations");
    }
    public function lod_discrep_indetail(){
       return view("asset_discrepancies");
    }
    public function ass_transhis(){
      return view("asset_trans_history");
    }
    public function sta_amanagement(){
      return view("asset_stations");
    }
    public function go_abouts(){
      return view("asset_abouts");
    }
    public function myaccount(){
      return view("myaccount");
    }
    public function asset_resources(){
      return view("asset_resources");
    }

    public function manage_utilities(){
      return view("asset_utilities");
    }
    public function manage_reports(){
      return view("asset_reports");
    }
    public function manage_reminders(){
      return view("asset_reminders");
    }
    public function goto_assetdl(){
       return view("asset_reportdownload");
    }
    public function goto_omitts(){
        return view("asset_omitted");
    }
    public function goto_howto(){
      return view("asset_howto");
    }
    public function goto_regoms(){
       return view("asset_omissionreport");
    }
    public function fly_semi_expendable_validationpage(){
      return view("asset_semivalidation");
    }

    // FUNCTIONS
    public function fire_reset_account_password(Request $req){
      $reset_account_password = $this->send(["tag"=>"RESET_ACCOUNT_PASSWORD_BYADMIN",
        "accid"=>$this->sdmenc($req["employeeid"]),
        "empnum"=>$this->sdmenc($req["employeenumber"])]);
      return $this->quick_result($reset_account_password,"usermanagement");
    }

    public function look_my_semiexpendable_omitted(){

    }
    public function look_my_semiexpendable_descrepancies(Request $req){
        $semiex = $this->send(["tag"=>"GET_ALL_SEMI_EXPENDIBLE_BY_STATION","station_id"=>$this->sdmenc($req["station_id"])]);

      $toecho = "";
      $desccount = 0;
      switch ($req["layout"]) {
        case 'count':
         for ($i=0; $i < count($semiex); $i++) {
            $has_desc = false;
            $sem_article = htmlentities($semiex[$i]["article"]);
        $sem_description = htmlentities($semiex[$i]["description"]);
        $sem_stocknumber = htmlentities($semiex[$i]["stock_number"]);
        $sem_unitofmesure = htmlentities($semiex[$i]["unit_of_mesure"]);
        $sem_unitval = htmlentities($semiex[$i]["unit_value"]);
        $sem_balpercard = htmlentities($semiex[$i]["balance_per_card"]);
        $sem_onhandper = htmlentities($semiex[$i]["on_hand_per_count"]);
        $sem_remarks = htmlentities($semiex[$i]["remarks"]);
        if($sem_article == "" || $sem_article == null){
        $has_desc = true;
        }
        else{$existing = true;}
        if($sem_description == "" || $sem_description == null){
        $has_desc = true;
        }
        else{$existing = true;}
        if($sem_stocknumber == "" || $sem_stocknumber == null){
          $has_desc = true;
        }
        else{$existing = true;}
        if($sem_unitofmesure == "" || $sem_unitofmesure == null){
          $has_desc = true;
        }
        else{$existing = true;}
        if($sem_unitval == "" || $sem_unitval == null){
        $has_desc = true;
        }
        else{$existing = true;}
        if($sem_balpercard == "" || $sem_balpercard == null){
          $has_desc = true;
        }
        else{$existing = true;}
         if(  $has_desc ){
$desccount ++;
         }
         }

        
          $toecho  = $desccount ;
          break;
        case 'table':
                for ($i=0; $i < count($semiex); $i++) {

        $discrepancyList = "";
        $sem_article = htmlentities($semiex[$i]["article"]);
        $sem_description = htmlentities($semiex[$i]["description"]);
        $sem_stocknumber = htmlentities($semiex[$i]["stock_number"]);
        $sem_unitofmesure = htmlentities($semiex[$i]["unit_of_mesure"]);
        $sem_unitval = htmlentities($semiex[$i]["unit_value"]);
        $sem_balpercard = htmlentities($semiex[$i]["balance_per_card"]);
        $sem_onhandper = htmlentities($semiex[$i]["on_hand_per_count"]);
        $sem_remarks = htmlentities($semiex[$i]["remarks"]);
        if($sem_article == "" || $sem_article == null){
        $discrepancyList .=  "Missing Article" . "<br>";
        }
        else{$existing = true;}
        if($sem_description == "" || $sem_description == null){
        $discrepancyList .=  "Missing Description" . "<br>";
        }
        else{$existing = true;}
        if($sem_stocknumber == "" || $sem_stocknumber == null){
        $discrepancyList .=  "<strong>Missing Stock Number (Not Inserted)</strong>" . "<br>";
        }
        else{$existing = true;}
        if($sem_unitofmesure == "" || $sem_unitofmesure == null){
        $discrepancyList .=  "Missing Unit of Mesure" . "<br>";
        }
        else{$existing = true;}
        if($sem_unitval == "" || $sem_unitval == null){
        $discrepancyList .=  "Missing Unit value" . "<br>";
        }
        else{$existing = true;}
        if($sem_balpercard == "" || $sem_balpercard == null){
        $discrepancyList .=  "Missing Balance per Card" . "<br>";
        }
        else{$existing = true;}

       if($discrepancyList != ""){
          $toecho .= "<tr>
            <td>" . ($i + 1) . "</td>
            <td>";
            if($sem_article == ""){ $toecho .= "<i class='invalidcolor'>Missing</i>";
            }else{ $toecho .= $sem_article; } $toecho .= "</td>
            <td>";
            if($sem_description == ""){ $toecho .= "<i class='invalidcolor'>Missing</i>";
          }else{ $toecho .= $sem_description; }
             $toecho .= "</td>
            <td>";
            if($sem_stocknumber == ""){ 
               $acceptable = false;
               $toecho .= "<i class='invalidcolor'>Missing</i>";
          }else{ $toecho .= $sem_stocknumber; }
             $toecho .= "</td>
            <td>";

            if($sem_unitofmesure == ""){ $toecho .= "<i class='invalidcolor'>Missing</i>";
          }else{ $toecho .= $sem_unitofmesure; }
             $toecho .= "</td>
            <td>";
            if($sem_unitval == ""){ $toecho .= "<i class='invalidcolor'>Missing</i>";
          }else{ $toecho .= $sem_unitval; }
            $toecho .= "</td>
             <td>"; if($sem_balpercard == ""){ $toecho .= "<i class='invalidcolor'>Missing</i>";
          }else{ $toecho .= $sem_balpercard; }$toecho .= "</td>
            <td>" . $discrepancyList ."</td>
          </tr>";
        }
      }
          break;
      }

      return $toecho;
    }
    public function look_semi_expendable_bystation(Request $req){
      $semiex = $this->send(["tag"=>"GET_ALL_SEMI_EXPENDIBLE_BY_STATION","station_id"=>$this->sdmenc($req["station_id"])]);

      $toecho = "";

      for ($i=0; $i < count($semiex); $i++) { 
        $toecho .= "
        <tr>
        <td>" . $semiex[$i]["article"] .  "</td>
        <td>" . $semiex[$i]["description"] . "</td>
        <td>" . $semiex[$i]["stock_number"] . "</td>
        <td>" . $semiex[$i]["unit_of_mesure"] . "</td>
        <td>" . $semiex[$i]["unit_value"] . "</td>
        <td>" . $semiex[$i]["balance_per_card"] . "</td>
        <td>" . $semiex[$i]["on_hand_per_count"] . "</td>
        <td>" . $semiex[$i]["remarks"] . "</td>
        <td>" . '
                    <div class="dropdown ">
              <a class="btn btn-sm btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Action
              </a>
            
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#semidispose"><i class="fas fa-trash"></i> Dispose</a>
              </div>
            </div>

        '. "</td>
        </tr>
        ";
      }

      return $toecho;
    }
    public function look_all_ofmy_service_center(Request $req){
      $out = $this->send(["tag"=>"GET_ALL_SERVICE_CENTERS_MYSTATION","station_id"=>$this->sdmenc($req["station_id"])]);
      $toecho = "";

      for ($i=0; $i < count($out); $i++) { 
         $toecho .= "<option value='" . $out[$i]["id"] . "'>" . $out[$i]["office"] . "-" . $out[$i]["room_number"]  . "</option>";
      }

      return $toecho;
    }
    public function fire_add_semi_expendible(Request $req){
       
      $SchoolID = $this->sdmenc($req["sc_id"]);
      $upload_CSVFILE = $req->file('thecsvfile');
      $file = fopen($upload_CSVFILE, "r");
      $toecho = "";


      // SELECT ALL EXISTING SEMI EXPENDABLE
      $AllSemiExpendable = $this->send(["tag"=>"GET_ALL_SEMI_EXPENDIBLE_BY_STATION","station_id"=>$this->sdmenc(session("user_school"))]);

      // return json_encode($AllSemiExpendable);

      $tbl_discrepancies = "";
      $tbl_assetnofound = "";

      $miss_col = 0;
      $overall_assets = 0;
      $perfect_data = 0;
      $asset_inserted = 0;
      $not_inserted = 0;
      $exactsamecount = 0;
      $rot_count = 0;
      $omittedass = 0;
      $asset_updated = 0;

      $UploadedData = array();


      while (($getData = fgetcsv($file, 10000, ",")) !== false){
        if( $rot_count != 0){
          // BLANKER 
          $getData[7] = "";

        $existing = false;
        $datacount = 0;
        $hasmiss = false;
        $is_perfect = true;
        $acceptable = true;
        $has_existing_stock_number = false;
        $discrepancyList = "";

        $sem_article = htmlentities($getData[0]);
        $sem_description = htmlentities($getData[1]);
        $sem_stocknumber = htmlentities($getData[2]);
        $sem_unitofmesure = htmlentities($getData[3]);
        $sem_unitval = htmlentities($getData[4]);
        $sem_balpercard = htmlentities($getData[5]);
        $sem_onhandper = htmlentities($getData[6]);
        $sem_shortover = htmlentities($getData[7]);
        $sem_remarks = htmlentities($getData[8]);

        array_push($UploadedData,  $sem_article . $sem_description . $sem_stocknumber . $sem_unitofmesure .  $sem_unitval . $sem_balpercard . $sem_onhandper . $sem_shortover . $sem_remarks);

        // SEE IF HAS EXACT SAME
        
        $exact_same = false;
        $data_match = 0;

          for ($ix=0; $ix < count($AllSemiExpendable); $ix++) { 
          $is_exact = true; 

          //CHECK IF HAS EXISTING STOCK NUMBER
          if($sem_stocknumber  != "" && $sem_stocknumber != null){
              if($sem_stocknumber == $AllSemiExpendable[$ix]["stock_number"] ){
                $has_existing_stock_number = true;
              }
          }
          
          if($sem_article !== $AllSemiExpendable[$ix]["article"] || $sem_description !== $AllSemiExpendable[$ix]["description"] || $sem_stocknumber !== $AllSemiExpendable[$ix]["stock_number"] || $sem_unitofmesure !== $AllSemiExpendable[$ix]["unit_of_mesure"] || $sem_unitval !== $AllSemiExpendable[$ix]["unit_value"] || $sem_balpercard !== $AllSemiExpendable[$ix]["balance_per_card"] || $sem_onhandper !== $AllSemiExpendable[$ix]["on_hand_per_count"] || $sem_shortover !== $AllSemiExpendable[$ix]["shortage_overage"] || $sem_remarks !== $AllSemiExpendable[$ix]["remarks"]){
             $is_exact = false;
          }

          if($is_exact == true){
            // THE DATA HAS MATCH
            $exact_same = true;
            $data_match ++;
          }
        }

        if($data_match ==0){
          // DATA IS NEW AND FRESH

        }

        
        if($sem_article == "" || $sem_article == null){
          $hasmiss = true;
          $discrepancyList .=  "Missing Article" . "<br>";
        }
        else{$existing = true;$datacount++;}
        if($sem_description == "" || $sem_description == null){
          $hasmiss = true;
          $discrepancyList .=  "Missing Description" . "<br>";
        }
        else{$existing = true;$datacount++;}
        if($sem_stocknumber == "" || $sem_stocknumber == null){
          $hasmiss = true;
          $discrepancyList .=  "<strong>Missing Stock Number (Not Inserted)</strong>" . "<br>";
        }
        else{$existing = true;$datacount++;}
        if($sem_unitofmesure == "" || $sem_unitofmesure == null){
          $hasmiss = true;
          $discrepancyList .=  "Missing Unit of Mesure" . "<br>";
        }
        else{$existing = true;$datacount++;}
        if($sem_unitval == "" || $sem_unitval == null){
          $hasmiss = true;
          $discrepancyList .=  "Missing Unit value" . "<br>";
        }
        else{$existing = true;$datacount++;}
        if($sem_balpercard == "" || $sem_balpercard == null){
          $hasmiss = true;
          $discrepancyList .=  "Missing Balance per Card" . "<br>";
        }
        else{$existing = true;$datacount++;}


        // Counstruct Discrepancy

        if($discrepancyList != ""){
          $tbl_discrepancies .= "<tr>
            <td>" . ($rot_count +1) ."</td>
            <td>";
            if($sem_article == ""){ $tbl_discrepancies .= "<i class='invalidcolor'>Missing</i>";
            }else{ $tbl_discrepancies .= $sem_article; } $tbl_discrepancies .= "</td>
            <td>";
            if($sem_description == ""){ $tbl_discrepancies .= "<i class='invalidcolor'>Missing</i>";
          }else{ $tbl_discrepancies .= $sem_description; }
             $tbl_discrepancies .= "</td>
            <td>";
            if($sem_stocknumber == ""){ 
               $acceptable = false;
               $tbl_discrepancies .= "<i class='invalidcolor'>Missing</i>";
          }else{ $tbl_discrepancies .= $sem_stocknumber; }
             $tbl_discrepancies .= "</td>
            <td>";

            if($sem_unitofmesure == ""){ $tbl_discrepancies .= "<i class='invalidcolor'>Missing</i>";
          }else{ $tbl_discrepancies .= $sem_unitofmesure; }
             $tbl_discrepancies .= "</td>
            <td>";
            if($sem_unitval == ""){ $tbl_discrepancies .= "<i class='invalidcolor'>Missing</i>";
          }else{ $tbl_discrepancies .= $sem_unitval; }
            $tbl_discrepancies .= "</td>
             <td>"; if($sem_balpercard == ""){ $tbl_discrepancies .= "<i class='invalidcolor'>Missing</i>";
          }else{ $tbl_discrepancies .= $sem_balpercard; }$tbl_discrepancies .= "</td>
            <td>" . $discrepancyList ."</td>
          </tr>";
        }
        

        if($existing == true && $datacount >= 1){
          // Prove that there's exisiting data
           $overall_assets++;
        }else{
          // NO EXISTING DATA
          $acceptable = false;
        }
        if($exact_same == true){
          //HAS EXACT SAME
          $acceptable = false;
          $exactsamecount++;
        }
        if($datacount == 6){
           $perfect_data++;
        }
        if($existing == true && $hasmiss == true){
          // has exisiting data but mussing column(s)
            $miss_col ++;
        }

        if($acceptable == true){
          // INSERT DATA
        
           if($has_existing_stock_number){
            // UPDATE DATA ONLY
             $insert_assetdata = $this->send(["tag"=>"UPDATE_SEMI_EXPENDABLE_DATA",
                                              "sem_article"=>$this->sdmenc($sem_article),
                                              "sem_description"=>$this->sdmenc($sem_description),
                                              "sem_stocknumber"=>$this->sdmenc($sem_stocknumber),
                                              "sem_unitofmesure"=>$this->sdmenc($sem_unitofmesure),
                                              "sem_unitval"=>$this->sdmenc($sem_unitval),
                                              "sem_balpercard"=>$this->sdmenc($sem_balpercard),
                                              "sem_onhandper"=>$this->sdmenc($sem_onhandper),
                                              "sem_shortover"=>$this->sdmenc($sem_shortover),
                                              "sem_remarks"=>$this->sdmenc($sem_remarks),
                                              "station_id"=>$this->sdmenc(session("user_school")),
                                              "serv_center_id"=>$this->sdmenc($req["service_center_id"])],true);
             $asset_updated++;
           }else{
            // ADD NEW DATA TO SEMI EXPENDABLE
             $insert_assetdata = $this->send(["tag"=>"ADD_NEW_SEMI_EXPENDABLE",
                                              "sem_article"=>$this->sdmenc($sem_article),
                                              "sem_description"=>$this->sdmenc($sem_description),
                                              "sem_stocknumber"=>$this->sdmenc($sem_stocknumber),
                                              "sem_unitofmesure"=>$this->sdmenc($sem_unitofmesure),
                                              "sem_unitval"=>$this->sdmenc($sem_unitval),
                                              "sem_balpercard"=>$this->sdmenc($sem_balpercard),
                                              "sem_onhandper"=>$this->sdmenc($sem_onhandper),
                                              "sem_shortover"=>$this->sdmenc($sem_shortover),
                                              "sem_remarks"=>$this->sdmenc($sem_remarks),
                                              "station_id"=>$this->sdmenc(session("user_school")),
                                              "serv_center_id"=>$this->sdmenc($req["service_center_id"])],true);
              $asset_inserted ++;
           }
          

           $toecho .= json_encode($insert_assetdata);

        }else{
          $not_inserted ++;
        }
        }
        $rot_count++;
      }


            for ($i=0; $i < count($AllSemiExpendable); $i++) { 
        $hmat = true;
          for($x = 0; $x < count($UploadedData);$x ++){
              $unifieds = $AllSemiExpendable[$i]["article"] . $AllSemiExpendable[$i]["description"]  .  $AllSemiExpendable[$i]["stock_number"] . $AllSemiExpendable[$i]["unit_of_mesure"]  . $AllSemiExpendable[$i]["unit_value"] . $AllSemiExpendable[$i]["balance_per_card"] . $AllSemiExpendable[$i]["on_hand_per_count"] .  $AllSemiExpendable[$i]["shortage_overage"] . $AllSemiExpendable[$i]["remarks"];


              if( $unifieds == $UploadedData[$x]){
                 $hmat = false;
              }
          }

          if($hmat == true){
            $omittedass ++;
             $tbl_assetnofound .= "
              <tr>
               <td>" .$omittedass  .  "</td>
                <td>" . $AllSemiExpendable[$i]["article"] .  "</td>
                 <td>" . $AllSemiExpendable[$i]["description"] . "</td>
                  <td>" . $AllSemiExpendable[$i]["stock_number"] . "</td>
                   <td>" . $AllSemiExpendable[$i]["unit_of_mesure"] . "</td>
                    <td>" . $AllSemiExpendable[$i]["unit_value"] . "</td>
                     <td>" . $AllSemiExpendable[$i]["balance_per_card"] . "</td>
                      <td>" . $AllSemiExpendable[$i]["on_hand_per_count"] . "</td>
                       <td>" . $AllSemiExpendable[$i]["shortage_overage"] . "</td>
                        <td>" . $AllSemiExpendable[$i]["remarks"] . "</td>
              </tr>
             ";
          }
      }


      $toecho .= "<br>-------------<br>";
        $toecho .= "OVERALL ASSETS : " .  $overall_assets . "<br>";
        $toecho .= "PERFECT DATA : " . $perfect_data . "<br>";
        $toecho .= "ASSET WITH COLUMNS : " . $miss_col . "<br>";
        $toecho .= "ASSET INSERTED : " . $asset_inserted . "/" . $overall_assets . "<br>";
        $toecho .= "ASSET UPDATED : " . $asset_updated . "<br>";
        $toecho .= "ASSET OMITTED : n/a<br>";
        $toecho .= "ASSET NOT INSERTED : " . $not_inserted . "<br>";
        $toecho .= "ASSET THAT HAS EXACT SAME : " . $exactsamecount . "<br>";

      $guessExtension = $upload_CSVFILE->getClientOriginalExtension();
      $origname = $upload_CSVFILE->getClientOriginalName();
      $NewFileName = str_replace(" ", "",session("user_school")) . "--" . date("F_d_Y-g_i_a") . "." . $guessExtension;

      $ResourceFileUpload = $this->send(["tag"=>"index_upload_asset_csv",
                                              "file_name"=>$this->sdmenc($NewFileName),
                                              "st_id"=>$this->sdmenc(session("user_school")),
                                              "empid"=>$this->sdmenc(session("user_eid")),
                                              "realname"=>$this->sdmenc($origname),
                                              "file_format"=>$this->sdmenc($guessExtension)],true);

      $upload_CSVFILE->move(public_path() . "/uploads/",   $NewFileName);

      return redirect()->route("goto_semi_expendable_validationpage",[
        "overallassets"=>$overall_assets,
        "perfectdata"=>$perfect_data,
        "missingcolumns"=>$miss_col,
        "insertedassets"=>$asset_inserted,
        "exactsame"=>$exactsamecount,
        "notinserted"=>$not_inserted,
        "ass_withdesc"=>$tbl_discrepancies,
        "ass_nofount"=>$tbl_assetnofound,
        "ass_omitted"=> $omittedass,
        "ass_updated"=> $asset_updated]);
    }

    public function fire_preview_csv_semiexpendable(Request $req){
       $csv_file = $req->file('thecsvfile');
      $file = fopen($csv_file, "r");
           $toecho= "";
          $previewcount = 0;
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
            if( $previewcount  != 0 && count($getData) <= 9){

               $toecho .= "<tr>";

               for($i =0; $i < 9;$i++){
                  $toecho .= "<td>" . $getData[$i] . "</td>";
               }

               $toecho .= "</tr>";
               
                if( $previewcount >= 3){
                  break;
                }

            }
             $previewcount++;
           }

           if($toecho == ""){
         $toecho = "
          <tr>
          <td>Semi Expendable CSV file is not valid.</td>
          </tr>
          ";
           }else{
            $toecho = "
             <tr>
              <th colspan='9' class='td_required'><small><i class='fas fa-dot-circle'></i></small> <span class='text-muted'>Required Data</span></th>
             </tr>
             <tr>
              <th colspan='9' class='td_optional'><small><i class='fas fa-dot-circle'></i></small> <span class='text-muted'>Optional Data</span></th>
             </tr>

             <tr>
          <th class='td_required'><small><i class='fas fa-dot-circle'></i></small></th>
          <th class='td_required'><small><i class='fas fa-dot-circle'></i></small></th>
          <th class='td_required'><small><i class='fas fa-dot-circle'></i></small></th>
          <th class='td_required'><small><i class='fas fa-dot-circle'></i></small></th>
          <th class='td_required'><small><i class='fas fa-dot-circle'></i></small></th>
          <th class='td_required'><small><i class='fas fa-dot-circle'></i></small></th>
          <th class='td_optional'><small><i class='fas fa-dot-circle'></i></small></th>
          <th class='td_optional'><small><i class='fas fa-dot-circle'></i></small></th>
          <th class='td_optional'><small><i class='fas fa-dot-circle'></i></small></th>
          </tr>
          <tr>
          <th>Article</th>
          <th>Description</th>
          <th>Stock Number</th>
          <th>Unit of Mesure</th>
          <th>Unit Value</th>
          <th>Balance Per Card</th>
          <th>On Hand Per Count</th>
          <th>Shortage/Overage</th>
          <th>Remarks</th>
          </tr>
          " . $toecho;
           }

           return $toecho;

    }
    public function fire_add_new_semi_expendable_registry(){
      $toret = $this->send(["tag"=>"ADD_NEW_SEMI_EXPENDABLE"]);
    }
    public function rep_all_om_ass(Request $req){
    $tag = $this->sdm_encrypt("report_all_omitted_assets",PKEY);

      $reason = $this->sdm_encrypt("2",PKEY);

     $propertynumber = $this->sdm_encrypt("",PKEY);
      if(isset($req["propertynumber"])){
         $propertynumber = $this->sdm_encrypt($req["propertynumber"],PKEY);
      }
     $remarks = $this->sdm_encrypt($req["remarks"],PKEY);

     
      $station_id = $this->sdm_encrypt(session("user_school"),PKEY);

      $user_eid = $this->sdm_encrypt(session("user_eid"),PKEY);

      $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
        "reason"=>$reason,
         "propertynumber"=>$propertynumber,
          "remarks"=>$remarks,
          "user_eid"=>$user_eid,
           "station_id"=>$station_id,
      ]]);
      $output =$this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);
      
        Alert::success("All Asset Reported!");
     return redirect()->route("gotoomitted");
    }
      public function display_omitted_of_station(Request $req){
      $tag = $this->sdm_encrypt("disp_om_ass_rebysta",PKEY);

      $mystation = $this->sdm_encrypt($req["selected_realid"],PKEY);
      $usertype = $this->sdm_encrypt(session("user_type"),PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
            "mystation"=>$mystation,
            "usertype"=>$usertype,
        ]]);
      $output = json_decode($this->sdm_decrypt($result->getBody()->getContents() ,PKEY),true);
      $toecho = "";

      for ($i=0; $i < count($output); $i++) { 

$reason = "";

switch ($output[$i]["om_reason"]) {

  case '0':
   $reason = "Updated Property Number";
    break;
   case '1':
   $reason = "Double Insertion of Property Number";
    break;
   case '2':
   $reason = "Others";
    break;
    default:
   $reason = "Unidentified Reason";
    break;
}

  $reason .= "<hr>";
        if($output[$i]["om_remarks"] != ""){
          $reason .= "<pre><i class='far fa-comment-alt'></i> " . $output[$i]["om_remarks"] . "</pre>";
        }

        if($output[$i]["om_usereid"] != ""){
          $reason .= "<pre><i class='fas fa-portrait'></i> EMPLOYEE ID #" . $output[$i]["om_usereid"] . "</pre>";
        }
        if($output[$i]["om_timestamp"] != ""){
          $reason .= "<hr><span class='text-muted'>" . date("F d, Y g:i a",strtotime($output[$i]["om_timestamp"])) ."</span>";
        }

        



        $toecho .= "
        <tr>
        <td>" . $output[$i]["property_number"] . "</td>
        <td>" . $output[$i]["asset_item"] . "</td>
        <td>" . $output[$i]["current_condition"] . "</td>
        <td>" . $output[$i]["service_center"] . "</td>
        <td>" . $output[$i]["room_number"] . "</td>
         <td>" . '<button class="btn btn-link"   data-html="true"  title="Reason" data-toggle="popover" data-trigger="hover" data-content="' . $reason .'">View Reason</button>' . "</td>
        ";
      
     
      }
      return    $toecho;

    }

    public function rep_om_sing(Request $req){
      $tag = $this->sdm_encrypt("report_omitted_now_singleton",PKEY);

      $idofassetinregistry = $this->sdm_encrypt($req["idofassetinregistry"],PKEY);
      $reason = $this->sdm_encrypt($req["reason"],PKEY);

     $propertynumber = $this->sdm_encrypt("",PKEY);
      if(isset($req["propertynumber"])){
         $propertynumber = $this->sdm_encrypt($req["propertynumber"],PKEY);
      }

      $remarks = $this->sdm_encrypt("",PKEY);
      if(isset($req["remarks"])){
         $remarks = $this->sdm_encrypt($req["remarks"],PKEY);
      }
     
      $station_id = $this->sdm_encrypt(session("user_school"),PKEY);

      $user_eid = $this->sdm_encrypt(session("user_eid"),PKEY);

      $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
       "idofassetinregistry"=>$idofassetinregistry,
        "reason"=>$reason,
         "propertynumber"=>$propertynumber,
          "remarks"=>$remarks,
          "user_eid"=>$user_eid,
           "station_id"=>$station_id,
      ]]);
      $output =$this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);
      
        Alert::success("Asset Reported!");
     return redirect()->route("gotoomitted");
    }
    public function get_station_in_statuses(){
       $tag = $this->sdm_encrypt("getstastatus",PKEY);
   $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      ]]);
      $output = json_decode($this->sdm_decrypt($xresult->getBody()->getContents(),PKEY),true);
 $toecho = "";
      for ($i=0; $i < count($output); $i++) { 

        $isready = $output[$i]["pref_value"] ;
        if ($isready == "Ready") {
           $isready = '<span style="color: #44bd32;"><i class="far fa-check-circle"></i> Ready</span>';
        }else{
           $isready = '<span style="color: #c23616;"><i class="far fa-times-circle"></i> Not Ready</span>';
        }
       $toecho .= "<tr>
        <td>" . $output[$i]["name"] . "</td>
        <td><strong>" . $isready. "</strong></td>
       </tr>";
      }
      return $toecho;
    }
    public function get_ser_fqrs(Request $req){
  $tag = $this->sdm_encrypt("get_ser_fqrs",PKEY);
   $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
      ]]);
      $output = json_decode($this->sdm_decrypt($xresult->getBody()->getContents(),PKEY),true);

      $toecho = "<option selected value='all|all'>Show All</option>";

      for ($i=0; $i < count($output); $i++) { 
       $toecho .= "<option value='" . $output[$i]["office"] . "|" . $output[$i]["room_number"] . "'>" . $output[$i]["office"] . " (" . $output[$i]["room_number"] . ")" . "</option>";
      }
      return $toecho;
    }
    public function get_qr_as_sbyer(Request $req){
     $tag = $this->sdm_encrypt("getassqrbyroomfilter",PKEY);

      $service_center = $this->sdm_encrypt($req["service_center"],PKEY);
      $room_number = $this->sdm_encrypt($req["room_number"],PKEY);

      $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
      "service_center"=>$service_center,
      "room_number"=>$room_number,
      ]]);

      $out_res = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);
      $output = json_decode($out_res,true);

      $toecho = "";
      for ($i=0; $i < count($output); $i++) { 
       $toecho .= '
<tr>
          <td>
            <div class="form-check">
              <input data-propno="' . $output["$i"]["property_number"] . '" class="form-check-input checkbox_y" type="checkbox" value="" id="defaultCheck1">
            </div>
          </td>
          <td>' . $output["$i"]["property_number"] . '</td>
          <td>' . $output["$i"]["asset_item"] . '</td>
          <td>' . $output["$i"]["asset_classification"] . '</td>
          <td>' . $output["$i"]["current_condition"] . '</td>
          <td>' . $output["$i"]["service_center"] . '</td>
          <td>' . $output["$i"]["room_number"] . '</td>
        </tr>

       ';
      }

      return $toecho;
    }
    public function get_report(Request $req){
      $tag = $this->sdm_encrypt("grep_bygroup",PKEY);
      $columnname = $this->sdm_encrypt($req["columnname"],PKEY);
      $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "colname"=>$columnname,
      "station_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
      ]]);
      $output = json_decode($this->sdm_decrypt($xresult->getBody()->getContents(),PKEY),true);
      $toecho = "";


      for ($i=0; $i < count($output); $i++) { 
        $toecho .= "<tr>";
$colval = "";

        if( $req["columnname"] != "date_of_acquisition"){
// NORMAL 
          $colval =   $output[$i][$req["columnname"]] ;
}else{
  // CONVERTED 
          $colval =   date("Y",strtotime($output[$i][$req["columnname"]])) ;
}

          $toecho .= "<td>" . $colval . "</td>";

          $toecho .= "<td>


         <div class='dropdown'>
           <a class='btn btn-light dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
           " . $output[$i]["valcount"] . "
           </a>
         
           <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
             <a class='dropdown-item' href='#' data-toggle='modal' data-target='#modal_assetview' data-colname='" . $req["columnname"] ."' data-colval='" . $colval  . "' onclick='fetchallassets(this)'><i class='fas fa-binoculars'></i> View</a>
            <form action='" . route("tprint") . "' method='get' style='display:none;' target='_blank'>" . csrf_field() . "
            <input type='hidden' value='" . $req["columnname"] . "' name='colname'>
            <input type='hidden' value='" . $colval  . "' name='colval'>
           <button class='dropdown-item' type='submit'>Download CSV</button>
            </form>
           </div>
         </div>


       </td>
        </tr>";
      }
      return $toecho ;
    }
    public function extgroupedconts(Request $req){
      $tag = $this->sdm_encrypt("getextractedgrouprep",PKEY);
      $column_name = $this->sdm_encrypt($req["column_name"],PKEY);
      $column_value = $this->sdm_encrypt($req["column_value"],PKEY);
         $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "school_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
      "column_name"=>$column_name,
      "column_value"=>$column_value,
      ]]);
      $output = json_decode($this->sdm_decrypt($xresult->getBody()->getContents(),PKEY),true);
     $toecho = "";


      $isown = false;
      if($req["station_number"] == session("user_school")){
        $isown = true;
      }

     for ($i=0; $i < count($output); $i++) { 
         $toecho .= "
        <tr>
        <td>" . $output[$i]["property_number"] . "</td>
        <td>" . $output[$i]["asset_item"] . "</td>
        <td>" . $output[$i]["asset_classification"] . "</td>
        <td>" . $output[$i]["current_condition"] . "</td>
        <td>" . $output[$i]["service_center"] . "</td>
        <td>" . $output[$i]["room_number"] . "</td>
        <td>
        ";

        if( $isown){
    $toecho .= "
        <div class='dropdown'>
        <a class='btn btn-primary btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Action
        </a>

        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>


        <form action='" . route("asset_view") . "' method='GET' target='_blank'>
        <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
        <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
        </form>

        ";
         if(session("user_type") < "4"){
      $toecho .= "<a class='dropdown-item' href='#' data-toggle='modal' onclick='OpenAssetToDispose(this)' data-asset_id='" . $output[$i]["id"] . "' data-target='#m_remove'>Dispose</a>
      </div>
      </div>
      </td>
      </tr>
      ";
      }
}else{
   $toecho .= "
        <div class='dropdown'>
        <a class='btn btn-light btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Action
        </a>

        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>


        <form action='" . route("asset_view") . "' method='GET' target='_blank'>
        <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
        <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
        </form>

        ";
}
     }
     return  $toecho;
    }
    public function get_tobegen_repcount(Request $req){
      $tag = $this->sdm_encrypt("get_tobegenCount",PKEY);

      $rn = $this->sdm_encrypt($req["rn"],PKEY);
      $cc = $this->sdm_encrypt($req["cc"],PKEY);
      
      $station_id = $this->sdm_encrypt($req["station_id"],PKEY);

      $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "school_id"=>$station_id,
      "rn"=>$rn,
      "cc"=>$cc,
      ]]);

      $output = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);

      return $output;
    }
    public function findnewservcen(){
       $tag = $this->sdm_encrypt("findservicecenternew",PKEY);
         $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "station_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
      ]]);

        $output = json_decode($this->sdm_decrypt($xresult->getBody()->getContents(),PKEY),true);
        $toecho = "";
        for ($i=0; $i < count($output); $i++) { 

          if($output[$i]["service_center"] != "none"){
             $toecho .= "<tr>
            <td>" . $output[$i]["service_center"] . "</td>
            <td>" . $output[$i]["room_number"] . "</td>
            <td>" . $output[$i]["holding_items"] . "</td>
          </tr>";
          }
         
        }
        return $toecho;
    }
    public function impallfoundsercen(){
       $tag = $this->sdm_encrypt("importallservice_centers",PKEY);
         $client = new \GuzzleHttp\Client();
          $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "station_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
      ]]);
        $output = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);
        // return $output;
        if($output == "true"){
          Alert::success("All Service Centers has been imported!");
            return redirect()->route("stationmy");
        }else{
          Alert::error("Failed to import service centers!");
            return redirect()->route("stationmy");
        }
    }
    public function passchange(Request $req){
        $tag = $this->sdm_encrypt("passchangenow",PKEY);

        $olpas = $this->sdm_encrypt($req["olpas"],PKEY);
        $newpas = $this->sdm_encrypt($req["newpas"],PKEY);
        $renewpas = $this->sdm_encrypt($req["renewpas"],PKEY);

      if($newpas == $renewpas){
        $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "empid"=>$this->sdm_encrypt(session("user_eid"),PKEY),
        "olpas"=>$olpas,
         "newpas"=>$newpas,
      ]]);
        $mynameschool = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);

        if($mynameschool == "true"){
          Alert::success("Password Updated!");
          return redirect()->route("myaccount");
        }else{
          Alert::error("Old password do not match.");
          return redirect()->route("myaccount");
        }
      }else{
        Alert::error("New password do not match.");
        return redirect()->route("myaccount");
      }
    }
    public function count_all_created_asset_loc(){
      $tag = $this->sdm_encrypt("count_allcreated_assloc",PKEY);
      $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
         "school_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
      ]]);
     $output = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);
     return $output;
    }
    public function edit_sc_info(Request $req){
      $tag = $this->sdm_encrypt("editscinf",PKEY);
      $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "st_id"=>$this->sdm_encrypt($req["st_id"],PKEY),
         "school_id"=>$this->sdm_encrypt($req["school_id"],PKEY),
          "st_name"=>$this->sdm_encrypt($req["st_name"],PKEY),
      ]]);
     $mynameschool = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);
      Alert::success("Station Updated!");
     return redirect()->route("sta_amanagement");
    }
    public function delstationnow(Request $req){
      $tag = $this->sdm_encrypt("del_st_now",PKEY);

      $st_id =  $this->sdm_encrypt($req["st_id"],PKEY);
      $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "st_id"=>$st_id,
      ]]);
     $mynameschool = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);
      Alert::success("Station Deleted!");
     return redirect()->route("sta_amanagement");
    }
    public function view_all_st_names(Request $req){
      $tag = $this->sdm_encrypt("view_all_station_names",PKEY);
      $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
      ]]);
     $mynameschool = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);
      return $mynameschool;
    }

    public function addnewsta_xnow(Request $req){
      $tag = $this->sdm_encrypt("station_new_add",PKEY);
      $st_name =  $this->sdm_encrypt($req["st_name"],PKEY);
      $st_id =  $this->sdm_encrypt($req["st_id"],PKEY);

            $client = new \GuzzleHttp\Client();
            $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "st_name"=>$st_name,
        "st_id"=>$st_id,
      ]]);
      $mynameschool = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);
      if($mynameschool  == "true"){
        Alert::success("Station added!");
      }else if($mynameschool == "exist"){
        Alert::error("Station already exist!");
      }else{
        Alert::error("Unable to add station!");
      }
     
      return redirect()->route("sta_amanagement");
    }
    public function get_school_fullname(Request $req){

      $sc_id =  $this->sdm_encrypt($req["stationid"],PKEY);
      $tag = $this->sdm_encrypt("get_sc_name",PKEY);
            $client = new \GuzzleHttp\Client();
            $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "sc_id"=>$sc_id,
      ]]);
      $mynameschool = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);

      return $mynameschool;
    }
    public function search_asstov(Request $req){
     $tag = $this->sdm_encrypt("search_histo",PKEY);
     $search_keyword = $this->sdm_encrypt($req["searchkey"],PKEY);
     $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "search_keyword"=> $search_keyword,
      ]]);
      $result = $this->sdm_decrypt( $result->getBody()->getContents(),PKEY);
      return  $result;
    }
 public function get_export_history(){
      $tag = $this->sdm_encrypt("get_exporthist",PKEY);
      $station_id = $this->sdm_encrypt(session("user_school"),PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=> $station_id,
      "employee_id"=>$this->sdm_encrypt(session("user_eid"),PKEY),
      ]]);
      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $output = json_decode($output,true);
      $toecho = "";
      for($i = 0 ; $i < count($output);$i++){
        $toecho .= "<tr>
        
         <td>" .$output[$i]["total_csv"]  . "</td>
         <td>" . $output[$i]["inserted"] . "</td>
         <td>" . $output[$i]["updated"]  . "</td>
          <td>" . $output[$i]["incomplete"]  . "</td>
          <td>" . $output[$i]["notinserted"]  . "</td>
           <td>" . date("F d, Y g:i a",strtotime($output[$i]["timestamp"]))  . "</td>
        </tr>";
      }


      
       return $toecho;
    }
    public function get_trhisto(){
      $tag = $this->sdm_encrypt("gettrahistory",PKEY);
      $station_id = $this->sdm_encrypt(session("user_school"),PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=> $station_id,
      "employee_id"=>$this->sdm_encrypt(session("user_eid"),PKEY),
      ]]);
      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $output = json_decode($output,true);
      $toecho = "";
      for($i = 0 ; $i < count($output);$i++){
        $toecho .= "<tr>
        
         <td>" . date("F d, Y g:i a",strtotime( $output[$i]["timestamp"])) . "</td>
         <td>" . $output[$i]["action_taken"] . "</td>
         <td>" . $output[$i]["username"] . "</td>
        </tr>";
      }
       return $toecho;
    }
    public function lod_dis_indetail(Request $req){
       $tag = $this->sdm_encrypt("get_discrepancies_indetail",PKEY);
      $station_id = $this->sdm_encrypt($req["stationid"],PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=> $station_id,
      ]]);
      $toecho = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
       return $toecho;
    }
    public function inventory_checkif_ready(){
     $tag = $this->sdm_encrypt("inventory_checkif_ready",PKEY);
      $station_id = $this->sdm_encrypt(session("user_school"),PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=> $station_id,
      ]]);
      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);


    $toecho = "";
      if($output == "Ready"){
        $toecho = "
      <h2><i style='color: #009432;' class='fas fa-check-circle'></i> Ready!</h2>
      <p class='text-muted mb-0'>There are zero discrepancies in your Asset Registry, you're now eligible to use the <i class='fas fa-mobile-alt'></i> Innoventory App!</p>
      ";
      }else{
        $toecho = "
      <h2><i style='color: #EA2027;' class='fas fa-times-circle'></i> Not Ready for Inventory.</h2>
      <p class='text-muted mb-0'>The inventory can't start yet because you still have discrepancies in your Asset Registry.</p>
      ";
      }
       return $toecho;
     
    }
    public function loadassetvalsum(Request $re){

      $station_id = $this->sdm_encrypt($re["selected_realid"],PKEY);

      $total_assets = "0";
      $discrepancies = "0";
      $last_login = "0";
      $last_trans = "0";
      $omittedcount = "0";
      // GET TOTAL ASSETS COUNT IN CLOUD
      $tag = $this->sdm_encrypt("get_total_assets",PKEY);
      // $station_id = $this->sdm_encrypt(session("user_school"),PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=> $station_id,
      ]]);
      $total_assets = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $total_assets = number_format(  $total_assets);
      // GET ASSET DISCREPANCY COUNT
      $tag = $this->sdm_encrypt("read_asset_discrepancy",PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=> $station_id,
      ]]);
      $discrepancies = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      // GET LAST LOGIN TO THE SYSTEM 

      if($re["selected_realid"]  == session("user_school")){
 $tag = $this->sdm_encrypt("get_last_login",PKEY);
      $user_eid = $this->sdm_encrypt(session("user_eid"),PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "employee_id"=>$user_eid,
      ]]);
$last_login = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      }else{
        $last_login = "Private";
      }
      
       if($re["selected_realid"]  == session("user_school")){
//GET LAST TRANSACTION DATE
      $tag = $this->sdm_encrypt("get_last_act_log",PKEY);
      $station_id = $this->sdm_encrypt(session("user_school"),PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=> $station_id,
      "employee_id"=>$this->sdm_encrypt(session("user_eid"),PKEY),
      ]]);
      
      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $last_trans = $output;
       }else{
        $last_trans = "Private";
       }
       // GET OMITTED COUNT
        $tag = $this->sdm_encrypt("get_omitted_count",PKEY);
         $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "st_id"=>$this->sdm_encrypt($re["selected_realid"],PKEY),
      ]]);

      $omittedcount = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);

          $is_own = false;
    if($re["selected_realid"]  == session("user_school")){
    $is_own = true;
    }else{
    $is_own = false;
    }

 if($last_login == ""){
          $last_login = "No Record";
      }
      if($last_trans == ""){
          $last_trans = "No Record";
      }
       $toecho = "<tr>
            <td>" . $total_assets . "</td>
            <td>
              <form action='../../lod_disc_indetail' method='get'>
              <input type='hidden' value='" . $is_own . "' name='isown'>
               <input type='hidden' value='" . $re["selected_realid"] . "' name='stationid'>
              <button type='submit' class='btn btn-link btn-sm' title='Click to view discrepancies in detail.'>" . $discrepancies . "</button>
              </form>
            </td>
            <td><a href='" . route('gotoomitted') . "'>" . $omittedcount . "</a></td>
            <td>" . $last_login . "</td>
             
            
          </tr>";
          return $toecho;
    }
    public function get_om_itms_astbls(Request $req){
      $tag = $this->sdm_encrypt("load_om_itms",PKEY);
      $station_id = $this->sdm_encrypt(session("user_school"),PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=> $station_id,
      ]]);
      $output = json_decode($this->sdm_decrypt($result->getBody()->getContents(),PKEY),true);
      $toecho = "";
          for($i = 0 ;$i < count($output);$i++){
              $toecho .= "<tr>
                <td>" . $output[$i]["property_number"] . "</td>
                <td>" . $output[$i]["asset_item"] . "</td>
                <td>" . $output[$i]["asset_classification"] . "</td>
                <td>" . $output[$i]["current_condition"] . "</td>
                <td>" . $output[$i]["asset_location"] . "</td>
                <td>" . $output[$i]["room_number"] . "</td>
              ";

   $toecho .= "
        <td><div class='dropdown'>
        <a class='btn btn-link btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Action
        </a>

        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>


        <form action='" . route("asset_view") . "' method='GET' target='_blank'>
        <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
        <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
        </form>

         <a class='dropdown-item' href='#' data-toggle='modal' data-target='#modal_report_asset' data-rid='" . $output[$i]["id"] . "' onclick='setup_omitted_report_id(this)' ><i class='fas fa-flag'></i> Report</a>

         
        </td>


</tr>
        ";
         // <a class='dropdown-item' href='#' data-toggle='modal' data-target='#modal_ignoresingleton' data-rid='" . $output[$i]["id"] . "' onclick='setup_omitted_report_id(this)' ><i class='fas fa-thumbs-down'></i> Ignore Omitted Asset</a>

          }
      return $toecho;
    }
    public function ignore_single_omitted(Request $req){
      $tag = $this->sdm_encrypt("ignore_single_omitt",PKEY);
      $station_id = $this->sdm_encrypt(session("user_school"),PKEY);
       $asset_id = $this->sdm_encrypt($req["asset_id"],PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=> $station_id,
      "asset_id"=>$asset_id,
      ]]);
      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      if ($output == "true") {
        Alert::success("Successfully ignored!");
        return redirect()->route("gotoomitted");
      }else{
        Alert::error("Error in ignoring the asset!");
        return redirect()->route("gotoomitted");
      }
    }

    public function clearallomitted(Request $req){
      $tag = $this->sdm_encrypt("clear_omitted_assets_now",PKEY);
      $station_id = $this->sdm_encrypt(session("user_school"),PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=> $station_id,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      if ($output == "true") {
        Alert::success("All omitted asset(s) ignored successfully!");
        return redirect()->route("gotoomitted");
      }else{
        Alert::error("Error in ignoring omitted asset(s)!");
        return redirect()->route("gotoomitted");
      }
    }
    public function lodstaprefx(Request $req){
        $tag = $this->sdm_encrypt("lod_sta_prefx",PKEY);
        $station_id = $this->sdm_encrypt(session("user_school"),PKEY);
        $client = new \GuzzleHttp\Client();
         $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "station_id"=> $station_id,
        ]]);
        
        $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
          $output  = json_decode($output,true);
          $toecho = "";
          for($i = 0 ;$i < count($output);$i++){
              $toecho .= "<tr>
                <td>" . $output[$i]["pref_name"] . "<br><small class='text-muted'>" . $output[$i]["pref_description"] . "</small></td>
                <td>" . $output[$i]["pref_value"] . "</td>
              </tr>";
          }
          return $toecho;
    }
    public function removelocation(Request $req){
              $tag = $this->sdm_encrypt("remolocnow",PKEY);
        $loc_id = $this->sdm_encrypt($req["loc_id"],PKEY);
        $client = new \GuzzleHttp\Client();
         $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "loc_id"=>$loc_id,
        ]]);
        
        $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);

        if($output == "true"){
          Alert::success("Removed!");
          return redirect()->route("stationmy");
        }else{
          Alert::warning("Unable to Remove!");
          return redirect()->route("stationmy");
        }
    }

    public function addnewassloc(Request $req){
        $tag = $this->sdm_encrypt("addnewassetlocation",PKEY);
        $xstation = $this->sdm_encrypt($req["xstation"],PKEY);
        $xoffice = $this->sdm_encrypt($req["xoffice"],PKEY);
        $xroomnum = $this->sdm_encrypt($req["xroomnum"],PKEY);
        $xincharge = $this->sdm_encrypt($req["incharge"],PKEY);

        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "xstation"=> $xstation,
        "xoffice"=> $xoffice,
        "xroomnum"=>$xroomnum,
        "xincharge"=>$xincharge,
        ]]);
        
        $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);

        if($output == "true"){
          Alert::success("Location added!");
          return redirect()->route("stationmy");
        }else if($output == "exist"){
          Alert::warning("Location already exist!");
          return redirect()->route("stationmy");
        }else{
          Alert::error("Unable to add location");
          return redirect()->route("stationmy");
        }
    }
    public function get_futh_val_ass_reg(Request $req){
        $tag = $this->sdm_encrypt("get_last_import_log",PKEY);
        $client = new \GuzzleHttp\Client();
         $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "st_name"=> $st_name,
        "st_id"=> $st_id,
        ]]);
        $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
        return $output;
    }
    public function get_all_last_upload_log(){
      $tag = $this->sdm_encrypt("get_last_import_log",PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
      "tag"=>$tag,
      "station_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
      ]]);
      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      if($output != "false"){
         $output = json_decode( $output,true);
            $output[0]["timestamp"] = date("F d, Y g:i a",strtotime($output[0]["timestamp"]));
             $output = json_encode( $output);
      }
      return $output;
    }

    public function new_station(Request $req){
   $tag = $this->sdm_encrypt("add_new_station",PKEY);
      $st_name = $this->sdm_encrypt($req["st_name"],PKEY);
      $st_id = $this->sdm_encrypt($req["st_id"],PKEY);
       $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "st_name"=> $st_name,
        "st_id"=> $st_id,
      ]]);
          $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      Alert::success("Station Added Successfully!");
      return redirect()->route("manstat");
    }
    public function stat_del_now(Request $req){
      $tag = $this->sdm_encrypt("stat_deletion_technology",PKEY);
      $sc_id_todelete = $this->sdm_encrypt($req["sc_id_todel"],PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "sc_id_todel"=> $sc_id_todelete,
      ]]);
      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      Alert::success("School Removed successfully!");
      return redirect()->route("manstat");
    }
    public function load_stat_enc(){
      $tag = $this->sdm_encrypt("lod_all_enc_station",PKEY);
        $client = new \GuzzleHttp\Client();
         $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
      ]]);
          $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
          $output  = json_decode($output,true);
          $toecho = "";
          for($i = 0 ;$i < count($output);$i++){
              $toecho .= "<tr>
                <td>" . $output[$i]["name"] . "</td>
                <td>" . $output[$i]["school_id"] . "</td>
                <td>
                  <button class='btn btn-sm btn-danger' data-toggle='modal' data-sc_id='" . $output[$i]["id"] . "' onclick='openremoveschool(this)' data-target='#modal_delsc'>Remove</button>
                </td>
              </tr>";
          }
          return     $toecho;
    }
    public function lodasslocenc(){
      $tag = $this->sdm_encrypt("loadallassetlocation",PKEY);
      $station_id =  $this->sdm_encrypt(session("user_school"),PKEY);
      $user_type =  $this->sdm_encrypt(session("user_type"),PKEY);
        $client = new \GuzzleHttp\Client();
         $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "user_school"=>$station_id,
        "user_type"=>$user_type,
      ]]);
          $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
          $output  = json_decode($output,true);
          $toecho = "";
          for($i = 0 ;$i < count($output);$i++){
            $scname = $output[$i]["name"];
            if($scname == ""){
              $scname = "Unknown";
            }
              $toecho .= "<tr>
                <td>" . $output[$i]["office"] . "</td>
                <td>" . $output[$i]["room_number"] . "</td>
                <td>";

                // GET STATION ACCOUNT NAMES 
                  $tag = $this->sdm_encrypt("get_employeename_byeid",PKEY);
                  $client = new \GuzzleHttp\Client();
                  $res_2 = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
                  "tag"=>$tag,
                  "empid"=>$this->sdm_encrypt($output[$i]["incharge_eid"],PKEY),
                   "station_id"=>$station_id,
                  ]]);

                  $out_2 = $this->sdm_decrypt($res_2->getBody()->getContents(),PKEY);
                  if($out_2 == ""){
                     $toecho .= "<span class='text-muted'>(none)<span>";
                  }else{
                     $toecho .=  $out_2 ;
                  }
                $toecho .= "</td>
                <td>

                <div class='dropdown'>
                  <a class='btn btn-primary btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                    action
                  </a>
                
                  <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>

                    <a class='dropdown-item' data-toggle='modal' data-target='#editservicecentermodal' href='#' onclick='showupdateincharge(this)' data-cont_id='" . $output[$i]["locid"] ."'
                                                          data-servicecen='" .  $output[$i]["office"] . "'
                                                          data-roomnum='" .  $output[$i]["room_number"] . "'
                                                          data-incha='" .  $output[$i]["incharge_eid"] . "'>Edit</a>

                     <a data-toggle='modal' data-target='#myremovelocmodal' class='dropdown-item' onclick='showremovelocmodal(this)' data-cont_id='" . $output[$i]["locid"] ."' href='#'>Remove</a>
                  </div>
                </div>

               
                </td>
              </tr>";
          }
          return $toecho;
    }
    public function chainsecnow(Request $req){
      $tag = $this->sdm_encrypt("changeinchargenowplease",PKEY);
       $id_of_something = $this->sdm_encrypt($req["id_of_something"],PKEY);
       $incharge = $this->sdm_encrypt($req["incharge"],PKEY);

        $edit_servicenter = $this->sdm_encrypt(htmlentities($req["edit_servicenter"]),PKEY);
         $edit_roomnumber = $this->sdm_encrypt(htmlentities($req["edit_roomnumber"]),PKEY);
      $client = new \GuzzleHttp\Client();
      $res_2 = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "id_of_something"=> $id_of_something,
        "incharge"=>$incharge,
        "edit_servicenter"=>$edit_servicenter,
        "edit_roomnumber"=>$edit_roomnumber,
      ]]);
      $output = $this->sdm_decrypt($res_2->getBody()->getContents(),PKEY);

      if($output == "true"){
              Alert::success("Person In-Charge Updated!");
                return redirect()->route("stationmy");
            }else{
              Alert::error("Failed to update!");
                return redirect()->route("stationmy");
            }
    }
    public function addrem(Request $req){
         $tag = $this->sdm_encrypt("addnewreminder",PKEY);
      $title = htmlentities( $this->sdm_encrypt($req["remindertitle"],PKEY));
      $desc =  htmlentities($this->sdm_encrypt($req["reminderdeadline"],PKEY));
      $deadline =  $this->sdm_encrypt("none",PKEY);
      if(isset($req["reminderdescription"])){
         $deadline =  $this->sdm_encrypt($req["reminderdescription"],PKEY);
      }
     
      $audiencetype =  $this->sdm_encrypt($req["remindwhocansee"],PKEY);
      $reminderorigineid = $this->sdm_encrypt(session("user_eid"),PKEY);
            $client = new \GuzzleHttp\Client();
            $res_2 = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
                  "tag"=>$tag,
                  "remindertitle"=>$title,
                  "reminderdeadline"=>$desc,
                  "reminderdescription"=>$deadline,
                  "remindwhocansee"=>$audiencetype,
                 "reminderorigineid"=>$reminderorigineid,
            ]]);

            $output = $this->sdm_decrypt($res_2->getBody()->getContents(),PKEY);
            if($output == "true"){
              Alert::success("New Reminder Added!");
                return redirect()->route("manage_reminders");
            }else{
              Alert::error("Failed to add reminder!");
                return redirect()->route("manage_reminders");
            }
    }
   public function getremorgi(){
     $tag = $this->sdm_encrypt("getallreminderbyoriginnoe",PKEY);
      $reminderorigineid = $this->sdm_encrypt(session("user_eid"),PKEY);
            $client = new \GuzzleHttp\Client();
            $res_2 = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
                  "tag"=>$tag,
                  "reminderorigineid"=>$reminderorigineid,
            ]]);
            $output = json_decode($this->sdm_decrypt($res_2->getBody()->getContents(),PKEY),true);
            $toecho = "";

            for ($i=0; $i < count($output); $i++) { 
             $toecho .= "
             <tr>
              <td><div class='dropdown'>
                    <a class='btn btn-links  dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                     " . $output[$i]["title"] . "
                    </a>
                  
                    <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                      <a class='dropdown-item' data-toggle='modal' data-target='#modal_delete' onclick='opendeletereminder(this)' data-oid='" . $output[$i]["id"] . "' href='#'><i class='far fa-trash-alt'></i> Delete</a>
                    </div>
                  </div></td>
              <td>" . $output[$i]["description"] . "</td>
              <td>";

              if($output[$i]["deadline"] != ""){
                $toecho .= date("F d, Y g:i a",strtotime($output[$i]["deadline"]));
              }else{
                $toecho .= "N/A";
              }

              $toecho .= "</td>
              <td>" . date("F d, Y g:i a",strtotime($output[$i]["dateposted"])). "</td>
             </tr>";
            }
           return  $toecho;
   }
   public function findservcount(Request $req){
    $tag = $this->sdm_encrypt("getservicecentercount",PKEY);
    $client = new \GuzzleHttp\Client();
    $res_2 = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "station_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
    ]]);
    $output = $this->sdm_decrypt($res_2->getBody()->getContents(),PKEY);
    return $output;
   }
   public function lodnewannounce(Request $req){
   $tag = $this->sdm_encrypt("getrecentreminders",PKEY);
      $reminderorigineid = $this->sdm_encrypt(session("user_type"),PKEY);

      $typeofget = $this->sdm_encrypt($req["typeofget"],PKEY);
            $client = new \GuzzleHttp\Client();
            $res_2 = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
                  "tag"=>$tag,
                  "reminderorigineid"=>$reminderorigineid,
                  "typeofget"=>$typeofget,
                  "userid"=>$this->sdmenc(session("user_eid"))
            ]]);
            $orig = $this->sdm_decrypt($res_2->getBody()->getContents(),PKEY);
            $output = json_decode($orig ,true);
            $toecho = "";
            for ($i=0; $i < count($output); $i++) { 


              $remtype = $output[$i]["viewtype"];
              switch ( $remtype) {
                 case '0':
                 $remtype = "Admin";
                  break;
                case '1':
                 $remtype = "Property Supply Officer";
                  break;
                case '2':
                 $remtype = "Principals";
                  break;
                  case '3':
                 $remtype = "Property Custodians";
                  break;
                  case '4':
                 $remtype = "Center Managers";
                  break;
              }
                $toecho .= "
                  <div class='card mb-3 announcement_card'>
                    <div class='card-body'>
                    <p class='float-right'><small style='color:#007DFF;'><i class='fas fa-globe-asia'></i> " .strtoupper( $remtype) ."</small></p>
                      <p><strong><i class='fas fa-user-circle'></i> " . $output[$i]["username"] ."</strong>
                        <br><span class='text-muted' title='" . date("m/d/y g:i a",strtotime($output[$i]["dateposted"] ))  . "'>" . $this->DateExplainder($output[$i]["dateposted"]) . "</span>
                      </p>
                      <h5>" . $output[$i]["title"] . "</h5>
                     <pre style='font-family:segoe ui;' class='card-subtitle'>" . $output[$i]["description"] . " </pre>
                    </div>
                  </div>
                ";
            }
           return $toecho;
   }
   public function delremthis(Request $req){

     $tag = $this->sdm_encrypt("deltereminderbyid",PKEY);
      $reminderid = $this->sdm_encrypt($req["reminderidx"],PKEY);
            $client = new \GuzzleHttp\Client();
            $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
                  "tag"=>$tag,
                  "reminderid"=>$reminderid,
            ]]);
           $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
            if($output == "true"){
              Alert::success("Deleted!");
                return redirect()->route("manage_reminders");
            }else{
              Alert::error("Failed to delete reminder!");
                return redirect()->route("manage_reminders");
            }
   }
    public function centerman_selection(){
      $toecho = "";
       $station_id =  $this->sdm_encrypt(session("user_school"),PKEY);

           $tag = $this->sdm_encrypt("get_station_acc_names",PKEY);
                  $client = new \GuzzleHttp\Client();
                  $res_2 = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
                  "tag"=>$tag,
                  "station_id"=>$station_id,
                  ]]);
 $out_2 = $this->sdm_decrypt($res_2->getBody()->getContents(),PKEY);
                  $out_2 = json_decode($out_2,true);
  $toecho .= "<option selected disabled value=''>Select who's in-charge</option>";
        for ($xc=0; $xc < count($out_2); $xc++) { 
        // GET STATION ACCOUNT NAMES 
              
                 
        
                  for ($xc=0; $xc < count($out_2); $xc++) { 
                    $toecho .= "<option value='" . $out_2[$xc]["employee_id"] . "'>" . $out_2[$xc]["username"] . "</option>";
                  }
             
                
        }
          return $toecho;
    }
    public function proc_sign_protocol(Request $req){
        $tag = $this->sdm_encrypt("proc_login",PKEY);
        $depedemail = strtolower($req["user_employee_id"]);
        if(strripos($depedemail, "deped.gov.ph") !== false){
          $user_employee_id = $this->sdm_encrypt( $depedemail,PKEY);
        $user_employee_password = $this->sdm_encrypt($req["user_employee_password"],PKEY);
         $client = new \GuzzleHttp\Client();
         $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "empid"=> $user_employee_id,
        "emppass"=> $user_employee_password,
      ]]);
          $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
          // $output = json_encode($output);
          // return $output;
          if($output == "false"){
            //WRONG CREDENTIALS
          Alert::error("Username and/or password is incorrect.");
           return redirect('/');
          }else{
            // $output = json_decode($output,true);
            $output = json_decode($output,true);
            // return   $output;

            // GET MY SCHOOL NAME FULL 
               $tag = $this->sdm_encrypt("get_sc_name",PKEY);
            $client = new \GuzzleHttp\Client();
            $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "sc_id"=> $this->sdm_encrypt($output[0]["station_id"],PKEY),
      ]]);
            $mynameschool = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);
            session(['user_uname'=>$output[0]["username"]]);
            session(['user_eid'=>$output[0]["employee_id"]]);
            session(['user_type'=>$output[0]["acc_type"]]);
            session(['user_depedemail'=>$output[0]["depedemail"]]);
            session(['user_school'=>$output[0]["station_id"]]);
            session(['user_schoolname'=> $mynameschool]);
            //RIGHT CREDENTIALS
           return redirect()->route("dboard");
          }
        }else{
          Alert::error("Email must be a DepEd Email.");
          return  $output;
           return redirect('/');
        }
        
    }

    public function get_asc_not_included(Request $req){
      $tag = $this->sdm_encrypt("get_asc_not_inc",PKEY);
      $asset_station = $this->sdm_encrypt($req["station_info"],PKEY);
              $client = new \GuzzleHttp\Client();
         $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "sn"=> $asset_station,
      ]]);
     $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
     $output = json_decode($output,true);
     $toecho = "";
     for ($i=0; $i < count($output); $i++) { 
        if($output[$i]["property_number"] != "none"){
            $toecho .= "
        <tr>
        <td>" . $output[$i]["property_number"] . "</td>
        <td>" . $output[$i]["asset_item"] . "</td>
        <td>" . $output[$i]["asset_classification"] . "</td>
        <td>" . $output[$i]["current_condition"] . "</td>
        <td>" . $output[$i]["service_center"] . "</td>
        <td>" . $output[$i]["room_number"] . "</td>
        <td>
        ";

  
   $toecho .= "
        <div class='dropdown'>
        <a class='btn btn-link btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Action
        </a>

        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>


        <form action='" . route('asset_view') . "' method='GET' target='_blank'>
        <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
        <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
        </form>

        ";

        }
          
      
     }
     return $toecho;
    }

    public function get_not_entry_scannedassets(Request $req){
      $tag = $this->sdm_encrypt("get_no_ent_sca",PKEY);
        $station_number = $this->sdm_encrypt($req["station_number"],PKEY);
        $client = new \GuzzleHttp\Client();
         $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "sn"=> $station_number,
      ]]);
     $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
     return $output;
    }
     public function g_sca_ttitms(Request $req){
      $tag = $this->sdm_encrypt("g_sca_ttitmsxx",PKEY);
        $station_number = $this->sdm_encrypt($req["station_number"],PKEY);
        $client = new \GuzzleHttp\Client();
         $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "sn"=> $station_number,
      ]]);
     $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
     return $output;

    }
    public function get_sc_occudates(Request $req){
      $tag = $this->sdm_encrypt("get_sc_occudatesxx",PKEY);
        $station_number = $this->sdm_encrypt($req["station_number"],PKEY);
        $client = new \GuzzleHttp\Client();
         $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "sn"=> $station_number,
      ]]);
     $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
     return $output;

    }
    public function get_ass_scanned(Request $req){
        $tag = $this->sdm_encrypt("getallscanneditems",PKEY);
        $station_number = $this->sdm_encrypt($req["station_number"],PKEY);
         $client = new \GuzzleHttp\Client();
        $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "sn"=> $station_number,
      ]]);
     $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $output = json_decode($output,true);
     $toecho = "";

  

      $isown = false;
      if($req["station_number"] == session("user_school")){
        $isown = true;
      }


      for ($i=0; $i < count($output); $i++) { 
        if($output[$i]["property_number"] != "none"){
                  $toecho .= "
        <tr>
        <td>" . $output[$i]["property_number"] . "</td>
        <td>" . $output[$i]["asset_item"] . "</td>
        <td>" . $output[$i]["current_condition"] . "</td>
        <td>" . $output[$i]["service_center"] . "</td>
        <td>" . $output[$i]["room_number"] . "</td>
        <td>" . $output[$i]["scanned_date"] . "</td>
       <td>
        ";

   $toecho .= "
        <div class='dropdown'>
        <a class='btn btn-link btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Action
        </a>

        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>


        <form action='" . route("asset_view") ."' method='GET' target='_blank'>
        <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
        <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
        </form>
</td>
        ";

        }

      }
     return $toecho;
    }
     public function bionic_page_count(Request $req){
      $rn = $this->sdm_encrypt($req["rn"],PKEY);
      $cat = $this->sdm_encrypt($req["cat"],PKEY);
      $tag = $this->sdm_encrypt("log_ass_filt",PKEY);
       $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "fil_roomnum"=>$rn,
        "fil_category"=>$cat,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $output = json_decode($output,true);
         $lc_count = 0;
         $pagecount = 0;
        for ($i=0; $i < count($output); $i++) { 
        $lc_count++;

       if($lc_count > 16){
        $pagecount++;
        $lc_count = 0;
       }
      }
      $tag = $this->sdm_encrypt("view_ass_grouped",PKEY);
       $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "fil_roomnum"=>$rn,
        "fil_category"=>$cat,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $output = json_decode($output,true);
         // for ($x=0; $x < 50; $x++) { 
      for ($i=0; $i < count($output); $i++) { 
          $lc_count++;
          if($lc_count > 16){
$pagecount++;
        $lc_count = 0;
          }
      
      }
      return  $pagecount;
    }
    public function generate_asset_report_printout(Request $req){
      $rn = $this->sdm_encrypt($req["rn"],PKEY);
      $cat = $this->sdm_encrypt($req["cat"],PKEY);



      $tag = $this->sdm_encrypt("log_ass_filt",PKEY);

       $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "fil_roomnum"=>$rn,
        "fil_category"=>$cat,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $output = json_decode($output,true);
         $lc_count = 0;
         $pagecount = 0;
      $toecho = '

<table id="page_' .  $pagecount  . '" >
<tr class="borderless">
<th colspan="11">
<div style="text-align: right;">Appendix 66</div>
<div style="text-align: center; margin-top: -35px;">
  <h4 style="margin-bottom: 0px;"><img src="' . asset('images/deped.png') . '" style="height: 80px; width: 80px;"><br>REPORT ON THE PHYSICAL COUNT OF INVENTORIES<br>OFFICE SUPPLIES/CONSUMABLES</h4>
  <small style="margin-bottom: 50px;">(Type of Inventory Item)<br><br>
  <strong>As at ______________________</strong></small>
</div>
<div style="text-align: left;">
  <small>
    <strong>
      Fund Cluster:____________________________<br>
      For which____________________________, <u>(Official Designation)</u>, <u>(Entity Name)</u> is accountable, having assumed such accountability on <u>Date of Assumption</u>.
    </strong>
  </small>
</div>

</th>
</tr>

  <tr>
    <th rowspan="2">Article</th>
    <th rowspan="2">Description</th>
    <th rowspan="2">Stock Number</th>
    <th rowspan="2">Unit of Measure</th>
    <th rowspan="2">Unit Value</th>
    <th>Balance per Card</th>
    <th>On Hand Per Count</th>
    <th colspan="2">Shortage/Overage</th>
    <th rowspan="2">Remarks</th>
  </tr>
  <tr>
    <th><small>(Quantity)</small></th>
    <th><small>(Quantity)</small></th>
    <th><small>Quantity</small></th>
    <th><small>Value</small></th>
  </tr>



      ';
   
      // for ($x=0; $x < 50; $x++) { 
        for ($i=0; $i < count($output); $i++) { 
        $lc_count++;

       if($lc_count > 16){
$pagecount++;
        $lc_count = 0;
        $toecho .= '
</table>
<br>
<br>
<table id="page_' .  $pagecount  . '" >
<tr>
    <th rowspan="2">Article</th>
    <th rowspan="2">Description</th>
    <th rowspan="2">Stock Number</th>
    <th rowspan="2">Unit of Measure</th>
    <th rowspan="2">Unit Value</th>
    <th>Balance per Card</th>
    <th>On Hand Per Count</th>
    <th colspan="2">Shortage/Overage</th>
    <th rowspan="2">Remarks</th>
  </tr>
  <tr>
    <th><small>(Quantity)</small></th>
    <th><small>(Quantity)</small></th>
    <th><small>Quantity</small></th>
    <th><small>Value</small></th>
  </tr>
        ';


       }
        $toecho .= '<tr>
         <td>' . $output[$i]["uacs_object_code"] . '</td>
          <td>' . $output[$i]['asset_item'];

          $linecount = intval(strlen($output[$i]['asset_item']) / 101);
          $lc_count += $linecount;

          $toecho .= '</td>
          <td></td>
        
          <td>' . $output[$i]['unit_of_measure'] . '</td>
            <td style="text-align:right;">' . number_format($output[$i]['cost_of_acquisition'],2) . '</td>
                 <td style="text-align:center;">1</td>
                 <td style="text-align:center;">1</td>
                   <td style="text-align:center;">0</td>
                     <td style="text-align:right;"></td>
                        <td>' . $output[$i]['remarks'] . '</td>
      </tr>';
    
      }

      // }


      $tag = $this->sdm_encrypt("view_ass_grouped",PKEY);
       $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "fil_roomnum"=>$rn,
        "fil_category"=>$cat,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $output = json_decode($output,true);
         // for ($x=0; $x < 50; $x++) { 
      for ($i=0; $i < count($output); $i++) { 
          $lc_count++;
          if($lc_count > 16){
$pagecount++;
        $lc_count = 0;
        $toecho .= '
</table>
<br>
<br>
<table id="page_' .  $pagecount  . '" >
<tr>
    <th rowspan="2">Article</th>
    <th rowspan="2">Description</th>
    <th rowspan="2">Stock Number</th>
    <th rowspan="2">Unit of Measure</th>
    <th rowspan="2">Unit Value</th>
    <th>Balance per Card</th>
    <th>On Hand Per Count</th>
    <th colspan="2">Shortage/Overage</th>
    <th rowspan="2">Remarks</th>
  </tr>
  <tr>
    <th><small>(Quantity)</small></th>
    <th><small>(Quantity)</small></th>
    <th><small>Quantity</small></th>
    <th><small>Value</small></th>
  </tr>
        ';
     
          }

            $mysortage = (int)($output[$i]["quantity"] - $output[$i]["balance_per_card"]);
            if($mysortage < 0){
              $mysortage = 0;
            }

            $life_price = $this->compute_lifeprice($output[$i]["date_of_acquisition"],
                                            $output[$i]["cost_of_acquisition"],
                                            $mysortage,
                                            $output[$i]["estimated_total_life_years"]);

 $toecho .= "<tr>
           <td>"  . $output[$i]["uacs_object_code"] . "</td>
           <td>" . $output[$i]["group_name"] . "</td>
          <td></td>
           
         <td>" . $output[$i]["unit_of_measure"] . "</td>
        <td style='text-align:right;'>" . number_format($output[$i]["cost_of_acquisition"],2) . "</td>          
            <td style='text-align:center;'>" .  $output[$i]["balance_per_card"] . "</td>
            <td style='text-align:center;'>" . $output[$i]["quantity"] . "</td>
            <td  style='text-align:center;'>" .    $mysortage ."</td>
            <td style='text-align:right;'>" . number_format($life_price,2) . "</td>
            <td></td>
      </tr>";

      
      }
    // }

  
      $toecho .= '

  <tr  class="bottom_field">
    <td class="fronter">
      Prepared by:
      <br><br><br>
      Property/School Custodian
    </td>
    <td>
      Certified Corrected by:
      <center>
        __________________________________<br>
        Signature over Printed Name of<br>Inventory Committee Chair and Members
      </center>
    </td>
    <td>
      Approved by:
      <br><br><br>
      <center>
        Principal/School Head
      </center>
    </td>
    <td colspan="3">
      Noted:
      <center>
        __________________________________<br>
        Signature over Printed Name of Head of<br>Agency/Entity or Authorized Representative
      </center>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td class="laster">
      Verified by:
      <center>
        __________________________________<br>
        Signature over Printed Name of COA<br>Representative
      </center>
    </td>
  </tr>
  </table>
      ';

$this->RecordLog("a02");
      return  $toecho;
    }
    public function ungroup_items(Request $req){

      $tag = $this->sdm_encrypt("ungroup_item_now",PKEY);
      $groupname = $this->sdm_encrypt($req["groupname"],PKEY);
      $groupnumber = $this->sdm_encrypt($req["groupnumber"],PKEY);
      $category = $this->sdm_encrypt($req["category"],PKEY);

      $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "groupname"=>$groupname,
        "groupnumber"=>$groupnumber,
        "category"=>$category,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      return  $output;
    }
    public function viewassetgrouped(Request $req){
      $tag = $this->sdm_encrypt("view_ass_grouped",PKEY);
       $rnum = $this->sdm_encrypt($req["rnum"],PKEY);
       $catname = $this->sdm_encrypt($req["catname"],PKEY);
        $station_id= $this->sdm_encrypt($req["station_id"],PKEY);
        
       $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "fil_roomnum"=>$rnum,
        "fil_category"=>$catname,
        "station_id"=>$station_id,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $output = json_decode($output,true);
      $toecho = "";
      for ($i=0; $i < count($output); $i++) { 
       $toecho .= "<tr>
           <td><a href='#' onclick='OpenUngroupItems(this)'
            data-gname='" . $output[$i]["group_name"] . "'
            data-rnum='" . $output[$i]["room_number"] . "'
            data-assclass='" . $output[$i]["asset_classification"] . "'
             data-toggle='modal' data-target='#ungroup_modal'>Ungroup</a></td>
           <td>" . $output[$i]["group_name"] . "</td>
          <td>" . $output[$i]["assets_included"]. "</td>
           
         <td></td>
        <td></td>          
            <td></td>
            <td>" . $output[$i]["quantity"] . "</td>
      </tr>";
      }
      return         $toecho;
    }

    public function add_new_asset_group(Request $req){
      $tag = $this->sdm_encrypt("add_new_group",PKEY);
      $ass_gname = $this->sdm_encrypt(strtoupper(htmlentities($req["ass_gname"])),PKEY);
      $ass_propnum = $this->sdm_encrypt($req["ass_propnum"],PKEY);
      $ass_roomnum = $this->sdm_encrypt($req["ass_roomnum"],PKEY);
      $ass_assclass = $this->sdm_encrypt($req["ass_assclass"],PKEY);
      $ass_ass_balpercard = $this->sdm_encrypt($req["ass_balpercard"],PKEY);

      $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "ass_gname"=>$ass_gname,
        "ass_propnum"=>$ass_propnum,
        "ass_roomnum"=>$ass_roomnum,
        "ass_assclass"=>$ass_assclass,
        "ass_balpercard"=>$ass_ass_balpercard,
      ]]);
        $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
        return  $output;
    }

    public function lod_asset_filtered(Request $req){

      $tag = $this->sdm_encrypt("log_ass_filt",PKEY);
       $rnum = $this->sdm_encrypt($req["rnum"],PKEY);
       $catname = $this->sdm_encrypt($req["catname"],PKEY);

       $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "fil_roomnum"=>$rnum,
        "fil_category"=>$catname,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $output = json_decode($output,true);
      $toecho = "";
      for ($i=0; $i < count($output); $i++) { 
       $toecho .= "<tr>
         <td><input type='checkbox' class='asset_item_check' data-oid='" . $output[$i]["id"]  . "' 


         data-dateofaq='" . $output[$i]["date_of_acquisition"]  . "'
         data-totlifey='" . $output[$i]["estimated_total_life_years"]  . "'
         data-unitofmea='" . $output[$i]["unit_of_measure"]  . "'

          data-itemname='" . $output[$i]["asset_item"]  . "' data-propnum='" . $output[$i]["property_number"] . "' data-assetitem='" . $output[$i]["asset_item"] . "'></td>
          <td><small>" . $output[$i]["asset_item"] . "</small></td>
          <td><small>" . $output[$i]["property_number"] . "</small></td>
        
          <td>" . $output[$i]["unit_of_measure"] . "</td>
          <td><small>" . date("F d, Y",strtotime($output[$i]["date_of_acquisition"])) . "</small></td>
          <td>" . $output[$i]["estimated_total_life_years"] . "</td>


            <td><small>" . $output[$i]["current_condition"] . "</small></td>
                 <td><small>" . $output[$i]["service_center"] . "</small></td>
                 <td>1</td>
      </tr>";
      }
      return  $toecho;
    }
    public function add_a_new_user(Request $req){

      $depedemail = strtolower($req["x_depedemail"]);
      if(strpos($depedemail, "@deped.gov.ph") !== false){
        $tag = $this->sdm_encrypt("a_new_account_now",PKEY);

      $x_username = $this->sdm_encrypt(htmlentities($req["x_username"]),PKEY);
      $x_selectedschool = $this->sdm_encrypt($req["x_selectedschool"],PKEY);
      $x_empid = $this->sdm_encrypt($req["x_empid"],PKEY);
      $x_usertype = $this->sdm_encrypt($req["x_usertype"],PKEY);
      $x_pass = $this->sdm_encrypt($req["x_empid"],PKEY);
      $x_repass = $this->sdm_encrypt($req["x_empid"],PKEY);
  $x_depedemail= $this->sdm_encrypt($depedemail,PKEY);
      if($x_pass == $x_repass){
         $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "x_username"=>$x_username,
        "x_selectedschool"=>$x_selectedschool,
        "x_empid"=>$x_empid,
        "x_usertype"=>$x_usertype,
        "x_pass"=>$x_pass, 
        "x_depedemail"=>$x_depedemail,
      ]]);
      $output =  $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      // return $result->getBody()->getContents();
      $this->RecordLog("a04");
      switch ($output) {
        case 'true':
          Alert::success("User Account successfully created.");
           return redirect()->route("usermanagement");
          break;
        case 'false':
          Alert::error("Error creating account.");
           return redirect()->route("usermanagement");
          break;
          case 'exist':
          Alert::error("DepEd Email or Employee ID already taken.");
           return redirect()->route("usermanagement");
          break;
      }
    }else{
      Alert::error("Password do not match.");
           return redirect()->route("usermanagement");

    }
  }else{
  Alert::error("Email must be a DepEd Email.");
           return redirect()->route("usermanagement");
  }
     
    }
    public function archive_an_asset(request $req){
      $tag = $this->sdm_encrypt("archive_an_asset",PKEY);
      $asset_id = $this->sdm_encrypt($req["asset_id"],PKEY);
      $asset_archive_type = $this->sdm_encrypt($req["asset_archive_type"],PKEY);

       $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "asset_id"=>$asset_id,
        "asset_archive_type"=>$asset_archive_type,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $this->RecordLog("a03");
      if($output == "true"){
         Alert::success("Asset has been archived!");
           return redirect()->route("assetregistry");
         }else{
           Alert::error("Cannot archive asset.");
           return redirect()->route("assetregistry");
         }
    }

    public function get_cat_gr(request $req){
      $tag = $this->sdm_encrypt("get_categories_grouped",PKEY);
        $school_id = $this->sdm_encrypt($req["school_id"],PKEY);
       $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "station_id"=>$school_id,
      ]]);

       $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $output = json_decode($output,true);
      $toecho = "";
      for ($i=0; $i < count($output); $i++) { 
       $toecho .= "<option>" . $output[$i]["cat_name"] ."</option>";
      }
      return  $toecho;
    }

    public function get_roo_gr(request $req){
      $tag = $this->sdm_encrypt("get_room_grouped",PKEY);
        $school_id = $this->sdm_encrypt($req["school_id"],PKEY);
       $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "station_id"=>$school_id,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $output = json_decode($output,true);
      $toecho = "";
      for ($i=0; $i < count($output); $i++) { 
       $toecho .= "<option>" . $output[$i]["room_number"] ."</option>";
      }
      return  $toecho;
    }


    public function restore_an_asset(request $req){
      $tag = $this->sdm_encrypt("restore_an_asset",PKEY);
      $asset_id = $this->sdm_encrypt($req["asset_id"],PKEY);

       $client = new \GuzzleHttp\Client();
       $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "asset_id"=>$asset_id,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $this->RecordLog("a07");
      if($output == "true"){
         Alert::success("Asset restored!");
           return redirect()->route("asset_disposed");
         }else{
           Alert::error("Cannot restore asset.");
           return redirect()->route("asset_disposed");
         }
    }
    public function get_acc_info_edit(request $req){
    $tag = $this->sdm_encrypt("get_emp_info_for_edit",PKEY);
    $emp_id = $this->sdm_encrypt($req["emp_id"],PKEY);
         $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "emp_id"=>$emp_id,
      ]]);

      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);

      return $output;
    }
    public function edit_the_user_info(Request $req){
      $depedemail = strtolower($req["x_depedemail"]);
      if(strpos($depedemail, "@deped.gov.ph") !== false){
  $tag = $this->sdm_encrypt("user_edit_info",PKEY);

      $x_username = $this->sdm_encrypt(htmlentities($req["x_username"]),PKEY);
      $x_selectedschool = $this->sdm_encrypt($req["x_selectedschool"],PKEY);
      $x_empid = $this->sdm_encrypt($req["x_empid"],PKEY);
      $x_usertype = $this->sdm_encrypt($req["x_usertype"],PKEY);
      $x_userid= $this->sdm_encrypt($req["empid"],PKEY);
      $x_depedemail= $this->sdm_encrypt($depedemail,PKEY);

      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "x_username"=>$x_username,
        "x_selectedschool"=>$x_selectedschool,
        "x_empid"=>$x_empid,
        "x_usertype"=>$x_usertype,
           "x_userid"=>$x_userid,
             "x_depedemail"=>$x_depedemail,
      ]]);
      $output =  $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      // return json_encode( $output);
      $this->RecordLog("a06");
      switch ($output) {
        case 'true':
          Alert::success("Changes has been saved.");
           return redirect()->route("usermanagement");
          break;
        case 'false':
          Alert::error("Error editing account.");
           return redirect()->route("usermanagement");
          break;
      }
      }else{
          Alert::error("Email must be a DepEd Email.");
           return redirect()->route("usermanagement");
      }
    
    }
    public function delete_the_user(Request $req){
      $empid =  $this->sdm_encrypt($req["empid"],PKEY);
      $tag = $this->sdm_encrypt("user_delete",PKEY);
       $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "x_userid"=>$empid,
      ]]);
      $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
      $this->RecordLog("a05");
      Alert::success("User Account has been deleted!");
           return redirect()->route("usermanagement");
    }

     public function load_all_school_names(){

  $tag = $this->sdm_encrypt("load_all_sc_names",PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
      ]]);
      $output = json_decode($this->sdm_decrypt($result->getBody()->getContents(),PKEY),true);

        $toecho = "";
 for ($i=0; $i < count($output); $i++) { 

  if(session("user_type") == "0" || session("user_type") == "1"){
    $toecho .= "<option value='" . $output[$i]["id"] . "'>" . $output[$i]["name"] . "</option>";
  }else{
    if($output[$i]["id"] == session("user_school")){
       $toecho .= "<option value='" . $output[$i]["id"] . "'>" . $output[$i]["name"] . "</option>";
       break;
    }
  }
  
 }
    echo $toecho;
    }

    public function display_all_employees(){
      $tag = $this->sdm_encrypt("get_registered_user",PKEY);
       $user_type = $this->sdm_encrypt(session("user_type"),PKEY);
       $school_id = $this->sdm_encrypt(session("user_school"),PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "user_type"=>$user_type,
        "school_id"=>$school_id,
      ]]);
      $output = json_decode($this->sdm_decrypt($result->getBody()->getContents(),PKEY),true);
      $toecho = "";
 for ($i=0; $i < count($output); $i++) { 
  if(session("user_depedemail") == $output[$i]["depedemail"] || session("user_type") >= $output[$i]["type"]){

  }else{
  $usertype = "";

//   $my_isverif = "";
// switch ($output[$i]["is_verified"]) {
//   case '0':
//     $my_isverif  = "<span class='badge badge-warning'>Pending</span>";
//     break;
//     case '1':
//     $my_isverif  =  "<span class='badge badge-success'>Verified</span>";
//     break;
// }
  switch ($output[$i]["type"]) {
    case '0':
      $usertype = "Admin";
      break;
      case '1':
      $usertype = "Division Supply Officer";
      break;
      case '2':
      $usertype = "Principal";
      break;
      case '3':
      $usertype = "Property Custodian";
      break;
       case '4':
      $usertype = "Center Manager";
      break;
  }
  $toecho .= "<tr>

    <td>"  . $output[$i]["username"] . "<br><small class='text-muted'>#" . $output[$i]["employee_id"] . "</small></td>
    <td>"  . $usertype . "</td>
<td>"  . $output[$i]["schoolname"] . "</td>

";

if($output[$i]["scanned_date"] != ""){
  $toecho .= "<td>" . date("F d, Y g:i",strtotime($output[$i]["scanned_date"])) . "</td>";
}else{
   $toecho .= "<td>No transaction</td>";
}


if(session("user_depedemail") == $output[$i]["depedemail"] || session("user_type") >= $output[$i]["type"]){
$toecho .="

<td>" . 
 '
<div class="dropdown ">
  <a class="btn disabled btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </a>

</div>
 '
 . "</td>

  </tr>";
}else{
  $toecho .="

<td>" . 
 '
<div class="dropdown">
  <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Action
  </a>

  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" data-empid="' . $output[$i]["acc_id"] . '" onclick="lod_editacc(this)" data-toggle="modal" data-target="#m_edit" href="#"><i class="fas fa-edit"></i> Edit Account</a>

     <a class="dropdown-item" data-empnumber="' . $output[$i]["employee_id"] . '" data-empid="' . $output[$i]["acc_id"] . '" onclick="lod_resetpass(this)" data-toggle="modal" data-target="#m_resetpass" href="#"><i class="fas fa-sync"></i> Reset Password</a>

    <a class="dropdown-item" data-empid="' . $output[$i]["acc_id"] . '" onclick="lod_deleteacc(this)" data-toggle="modal" data-target="#m_delete" href="#"><i class="fas fa-trash"></i> Delete</a>
  </div>
</div>
 '
 . "</td>

  </tr>";
}
}
 }

 return $toecho;
    }
     public function asset_disp_disposed(Request $req){
 $tag = $this->sdm_encrypt("display_disposed_assets_reg",PKEY);
 $id_of_something = $this->sdm_encrypt($req["id_of_something"],PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
            "id_of_something"=>$id_of_something,
        ]]);
      $output = json_decode($this->sdm_decrypt($result->getBody()->getContents() ,PKEY),true);
      $toecho = "";
      for ($i=0; $i < count($output); $i++) { 
          $toecho .= "
            <tr>
                <td>";
                switch ($output[$i]["status"]) {
                  case '1':
                          $toecho .= "<strong style='color: #c0392b;'>" . $output[$i]["property_number"] . "</strong>";
                    break;
                      case '2':
                          $toecho .= "<strong style='color: #27ae60;'>" . $output[$i]["property_number"] . "</strong>";
                    break;
                      case '3':
                          $toecho .= "<strong style='color: #2980b9;'>" . $output[$i]["property_number"] . "</strong>";
                    break;
                      case '4':
                          $toecho .= "<strong style='color: #8e44ad;'>" . $output[$i]["property_number"] . "</strong>";
                    break;
                  
                  default:
                    # code...
                    break;
                }
                $toecho .="</td>
                <td>" . $output[$i]["asset_item"] . "</td>
                <td>" . $output[$i]["asset_classification"] . "</td>
                <td>" . $output[$i]["current_condition"] . "</td>
                 <td>" . $output[$i]["service_center"] . "</td>
                    <td>" . $output[$i]["room_number"] . "</td>
                <td>

                <div class='dropdown'>
                <a class='btn btn-primary btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                Action
                </a>

                <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink'>

                <form action='" . route("asset_view") . "' method='GET'>
                <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
                  <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
                </form>

                <a class='dropdown-item' href='#' data-toggle='modal' onclick='OpenAssetToDispose(this)' data-asset_id='" . $output[$i]["id"] . "' data-target='#m_remove'><i class='fas fa-trash-restore-alt'></i> Restore</a>

                </div>
                </div>
                </td>
                </tr>
          ";
      }
      return $toecho;

     }
    public function preview_csv(Request $req){
      $csv_file = $req->file('thecsvfile');
      $file = fopen($csv_file, "r");
          $toecho = "
          <tr>

          <th>Office Type</th>
          <th>Regional Office/ Division Office</th>
          <th>Asset Classification</th>
          <th>Asset Sub Class</th>
          <th>UACS Object Code</th>
          <th>Asset Item</th>
          <th>Manufacturer</th>
          <th>Model</th>
          <th>Serial Number</th>
          <th>Specification</th>
          <th>Property Number</th>
          <th>Unit of Measure</th>
          <th>Current Condition</th>
          <th>Source of Fund</th>
          <th>Cost of Acquisition</th>
          <th>Date of Acquisition</th>
          <th>Estimated Total Life Years</th>
          <th>Name of Accountable Officer</th>
          <th>Asset Location</th>
          <th>Service Center</th>
          <th>Room Number</th>
          <th>Remarks</th>

          </tr>
          ";
          $previewcount = 0;
          while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){

            if(count($getData) < 22){
              $toecho = "";
              break;
            }else if( $previewcount  != 0){

               $toecho .= "<tr>";

               for($i =0; $i < 22;$i++){
                  $toecho .= "<td>" . $getData[$i] . "</td>";
               }

               $toecho .= "</tr>";
               
                if( $previewcount >= 3){
                  break;
                }

            }
             $previewcount++;
           }

           return $toecho;

    }
    public function my_asset_full(Request $req){
      $tag = $this->sdm_encrypt("get_asset_all_info",PKEY);
      $asset_id = $this->sdm_encrypt($req["asset_id"],PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
            "asset_id"=>$asset_id,
      ]]);

      $output = json_decode($this->sdm_decrypt($result->getBody()->getContents() ,PKEY),true);
        $output[0]["cost_of_acquisition"] = number_format($output[0]["cost_of_acquisition"],2);
      return $output;
    }
    public function display_all_encoded_assets(Request $req){
      $tag = $this->sdm_encrypt("display_all_assets",PKEY);

      $mystation = $this->sdm_encrypt($req["selected_realid"],PKEY);
      $usertype = $this->sdm_encrypt(session("user_type"),PKEY);
      $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
            "mystation"=>$mystation,
            "usertype"=>$usertype,
        ]]);
      $output = json_decode($this->sdm_decrypt($result->getBody()->getContents() ,PKEY),true);
      $toecho = "";

      $isown = false;
      if($req["selected_realid"] == session("user_school")){
        $isown = true;
      }


      for ($i=0; $i < count($output); $i++) { 
        $toecho .= "
        <tr>
        <td>" . $output[$i]["property_number"] . "</td>
        <td>" . $output[$i]["asset_item"] . "</td>
        <td>" . $output[$i]["specification"] . "</td>
        <td>" . $output[$i]["current_condition"] . "</td>
        <td>" . $output[$i]["service_center"] . "</td>
        <td>" . $output[$i]["room_number"] . "</td>
        <td>
        ";
if( $isown){
    $toecho .= "
        <div class='dropdown'>
        <a class='btn btn-primary btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Action
        </a>

        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink'>


        <form action='" . route("asset_view") . "' method='GET' >
        <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
        <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
        </form>

        ";
         if(session("user_type") < "4"){
      $toecho .= "<a class='dropdown-item' href='#' data-toggle='modal' onclick='OpenAssetToDispose(this)' data-asset_id='" . $output[$i]["id"] . "' data-target='#m_remove'><i class='fas fa-trash'></i> Dispose</a>
      </div>
      </div>
      </td>
      </tr>
      ";
      }
}else{
   $toecho .= "
        <div class='dropdown'>
        <a class='btn btn-light btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Action
        </a>

        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink'>


        <form action='" . route("asset_view") . "' method='GET'>
        <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
        <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
        </form>

        ";
}
      
     
      }
      return    $toecho;

    }


    public function tryprint(Request $req){
     
   $tag = $this->sdm_encrypt("getextractedgrouprep",PKEY);
      // ADDING PROCESS 
     $cname = $req["colname"];
      $columnname = $this->sdm_encrypt($cname ,PKEY);
      $colval = $this->sdm_encrypt($req["colval"],PKEY);
       $client = new \GuzzleHttp\Client();
      $xresult = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
        "tag"=>$tag,
        "column_name"=>$columnname,
        "column_value"=>$colval,
        "school_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
      ]]);
  $output = $this->sdm_decrypt($xresult->getBody()->getContents(),PKEY);
      // END - ADDING PROCESS
 return view("asset_reportdownload",["thedata"=>$output,"cname"=>$cname]);
    }
    public function upresnow(Request $req){
      $tag = $this->sdm_encrypt("index_upload_asset_csv",PKEY);
       $photo = $req->file('thefile');
      $guessExtension = $photo->getClientOriginalExtension();
      $origname = $photo->getClientOriginalName();
      $newfilename = str_replace(" ", "",session("user_school")) . "--" . date("F_d_Y-g_i_a") . "." . $guessExtension;
      
        $destinationpath = public_path("/uploads/");
      $req->file("thefile")->move($destinationpath,$newfilename );


      $client = new \GuzzleHttp\Client();
            $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
              "tag"=>$tag,
              "file_name"=>$this->sdm_encrypt($newfilename,PKEY),
              "st_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
              "empid"=>$this->sdm_encrypt(session("user_eid"),PKEY),
              "realname"=>$this->sdm_encrypt($origname,PKEY),
              "file_format"=>$this->sdm_encrypt($guessExtension,PKEY),
            ]]);

     
       Alert::success("Asset Uploaded.");
       return redirect()->route("asset_resources");

    }

    public function uploadassetregistrycsv(Request $req){
      $output = "";
      $tag = $this->sdm_encrypt("get_all_assets_pr",PKEY);

      $sc_id = $this->sdm_encrypt($req["sc_id"],PKEY);
        $photo = $req->file('thecsvfile');

          $file = fopen($photo, "r");
          $toecho = "";
            $previewcount = 0;
            $blankcols = 0;
            $inserted_new = 0;
            $inserted_alreadyexisting = 0;
            $inserted_not = 0;
            $tots = 0;
            $valid_header = 1;
            $asset_signature = array();
            $asset_signature_existing = array();
             $asset_signature_existing_id = array();

      $tag = $this->sdm_encrypt("get_all_pn_in_ir",PKEY);
            // GET EXISITING ASSETS 
             $client = new \GuzzleHttp\Client();
      $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
            "station_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
        ]]);
      $output = json_decode($this->sdm_decrypt($result->getBody()->getContents() ,PKEY),true);

      for ($i=0; $i < count($output); $i++) { 
        if($output[$i]["property_number"] != ""){
           array_push( $asset_signature_existing, $output[$i]["property_number"]);
           array_push( $asset_signature_existing_id, $output[$i]["id"]);
        }
       
      }
// return $asset_signature_existing;
      $tag = $this->sdm_encrypt("add_new_item_registry",PKEY);
            $prop_alreasyexist = array();
            $mylogs = "";
              $fieldsx = array("Office Type","Office Name","Asset Classification","Asset Sub Class","UACS Code","Asset Item Name","Manufacturer","Model Name","Serial Number","Specification","Property Number","Unit of Measure","Current Condition","Source Of Fund","Cost of Acquisition","Date of Aquisition","Estimated Total Life Years","Name of Accountable Officer","Asset Location","Service Center","Room Number","Remarks");

          while (($getData = fgetcsv($file, 10000, ",")) !== false){
            $already_there = false;

            if($getData[10] != ""){
            if(in_array($getData[10],$prop_alreasyexist) !== false){
              $already_there = true;
            }else{
              array_push($prop_alreasyexist,  $getData[10]);
            }
            }
           
          if($previewcount != 0 && $valid_header == 1 && $getData[10] != "" && $getData[10] != null && $already_there == false){
            $tots++;
            $missinglog = "";
      

        $has_disc = false;
        $has_propertynum = false;
        $fieldwithvals = 0;
        for($i =0; $i < count($fieldsx);$i++){
          if($getData[$i] == "" || $getData[$i] == null ){
            if($fieldsx[$i] != "Remarks" && $fieldsx[$i] != "Cost of Acquisition"){
               $missinglog .= "Missing " . $fieldsx[$i] . "<br>";
               $has_disc = true;
            }
              

          }else{
           $fieldwithvals++;
          }
          if($i == 10){
            if($getData[10] == "" || $getData[10] == null ){
            $has_propertynum = false;
          }else{
            $has_propertynum = true;
          }
          }
        }

        if($fieldwithvals > 5 && $has_propertynum == false){
          $tots ++;
        }
          if($has_disc){
                $blankcols++;
          }
        $office_type = $this->sdm_encrypt(htmlentities($getData[0]),PKEY);
        $office_name = $this->sdm_encrypt(htmlentities($getData[1]),PKEY);
        $asset_classification = $this->sdm_encrypt(htmlentities($getData[2]),PKEY);
        $asset_sub_class = $this->sdm_encrypt(htmlentities($getData[3]),PKEY);
        $uacs_object_code = $this->sdm_encrypt(htmlentities($getData[4]),PKEY);
        $asset_item = $this->sdm_encrypt(htmlentities($getData[5]),PKEY);
        $manufacturer = $this->sdm_encrypt(htmlentities($getData[6]),PKEY);
        $model = $this->sdm_encrypt(htmlentities($getData[7]),PKEY);
        $serial_number = $this->sdm_encrypt(htmlentities($getData[8]),PKEY);
        $specification = $this->sdm_encrypt(htmlentities($getData[9]),PKEY);
        $property_number = $this->sdm_encrypt(htmlentities($getData[10]),PKEY);
        $unit_of_measure = $this->sdm_encrypt(htmlentities($getData[11]),PKEY);
        $current_condition = $this->sdm_encrypt(htmlentities($getData[12]),PKEY);
        $source_of_fund = $this->sdm_encrypt(htmlentities($getData[13]),PKEY);
        $cost_of_acquisition = $this->sdm_encrypt(htmlentities($this->parse_number($getData[14])),PKEY);
        $date_of_acquisition = $this->sdm_encrypt(date("Y-m-d",strtotime($getData[15])),PKEY);
        $estimated_total_life_years = $this->sdm_encrypt(htmlentities($getData[16]),PKEY);
        $name_of_accountable_officer = $this->sdm_encrypt(htmlentities($getData[17]),PKEY);
        $asset_location = $this->sdm_encrypt(htmlentities($getData[18]),PKEY);
        $service_center = $this->sdm_encrypt(htmlentities($getData[19]),PKEY);
        $room_number = $this->sdm_encrypt(htmlentities($getData[20]),PKEY);
        $remarks = $this->sdm_encrypt(htmlentities($getData[21]),PKEY);

        $client = new \GuzzleHttp\Client();
            $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
            "property_number"=>$property_number,
            "asset_item"=>$asset_item,
            "office_type"=>$office_type,
            "office_name"=>$office_name,
            "asset_classification"=>$asset_classification,
            "asset_sub_class"=>$asset_sub_class,
            "uacs_object_code"=>$uacs_object_code,
            "manufacturer"=>$manufacturer,
            "model"=>$model,
            "serial_number"=>$serial_number,
            "specification"=>$specification,
            "current_condition"=>$current_condition,
            "source_of_fund"=>$source_of_fund,
            "cost_of_acquisition"=>$cost_of_acquisition,
            "date_of_acquisition"=>$date_of_acquisition,
            "estimated_total_life_years"=>$estimated_total_life_years,
            "name_of_accountable_officer"=>$name_of_accountable_officer,
            "asset_location"=>$asset_location,
            "remarks"=>$remarks,
            "unit_of_measure"=>$unit_of_measure,
            "service_center"=>$service_center,
            "room_number"=>$room_number,
            "sc_id"=> $sc_id,
        ]]);
                $mysignature = $this->sdm_decrypt($property_number,PKEY);
               if($mysignature != ""){
                 array_push($asset_signature, $mysignature);
               }
          $is_inserted = "";
            $output = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
        

        $hasinsertednew = false;
             if($output == "1"){
               $is_inserted = "Added";
                 $hasinsertednew = true;
                $inserted_new++;
             }else if($output == "2"){
               $is_inserted = "Updated";

             }else if($output == "3"){
               $is_inserted = "Not Inserted";
             }

            if($missinglog != ""){
               $mylogs .= "<tr><td>" . $getData[10] . "</td><td>" . $getData[5] . "</td><td>" .  $missinglog . "</td></tr>";
            }else if($output == "1" &&   $hasinsertednew == false){
                $inserted_new++;
            }else if($output == "2"){
                $inserted_alreadyexisting++;
            }else if($output == "3"){
                $mylogs .= "<tr><td>" . $getData[10] . "</td><td>" . $getData[5] . "</td><td> Not inserted.</td></tr>";
            }
            }else if($previewcount == 0 && $valid_header == 0){
              return $previewcount  . " and " . $valid_header;

            }else if( $already_there  == true){
                $mylogs .= "<tr><td>" . $getData[10] . "</td><td>" . $getData[5] . "</td><td> Property number is not unique (NOT INSERTED).</td></tr>";
                $inserted_not ++;
                $tots++;
            }else{
        $has_propertynum = false;
        $fieldwithvals = 0;
        for($i =0; $i < count($fieldsx);$i++){
          if($getData[$i] != "" && $getData[$i] != null ){
           $fieldwithvals++;
          }
          if($i == 10){
            if($getData[10] == "" || $getData[10] == null ){
            $has_propertynum = false;
          }else{
            $has_propertynum = true;
          }
          }
        }
        if($fieldwithvals > 5 && $has_propertynum == false){
          $tots ++;
           $inserted_not ++;
            $mylogs .= "<tr><td>" . $getData[10] . "</td><td>" . $getData[5] . "</td><td> Please add the property number of this item (NOT INSERTED).</td></tr>";
              }
            }
              $previewcount ++;
           }
           $tag = $this->sdm_encrypt("add_to_historylogs",PKEY);

           //ADD TO LOG HISTORY
          $client = new \GuzzleHttp\Client();
          $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
          "tag"=>$tag,
          "lg_total_csv"=>$this->sdm_encrypt($tots,PKEY),
          "lg_inserted"=>$this->sdm_encrypt($inserted_new,PKEY),
          "lg_update"=>$this->sdm_encrypt($inserted_alreadyexisting,PKEY),
          "lg_incomplete"=>$this->sdm_encrypt($blankcols,PKEY),
          "lg_notinserted"=>$this->sdm_encrypt($inserted_not,PKEY),
          "lg_station_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
            "lg_origin"=>$this->sdm_encrypt(session("user_eid"),PKEY),
          ]]);
           // return $result->getBody()->getContents();
$this->RecordLog("a01");


// ANALYZE WHATS NOT HERE COMPARED TO LAST TIME
$nothere = "";
$omitted_count = 0;

$omitted_tbl = "";

  for ($i=0; $i < count($asset_signature_existing); $i++) { 
     $signature = $asset_signature_existing[$i];
     $item_id = $asset_signature_existing_id[$i];
     if(!in_array($signature, $asset_signature)){
      $nothere .=  $signature . " ";
      $omitted_count++;
         $tag = $this->sdm_encrypt("get_asset_info_singleton",PKEY);
            // GET EXISITING ASSETS 
          $client = new \GuzzleHttp\Client();
          $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
          "tag"=>$tag,
          "data_id"=>$this->sdm_encrypt($item_id,PKEY),
          "station_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
          ]]);
          $out_res = json_decode($this->sdm_decrypt(  $result->getBody()->getContents(),PKEY),true);
          $omitted_tbl .="
        <tr>
        <td>" . $out_res[0]["property_number"] . "</td>
        <td>" . $out_res[0]["asset_item"] . "</td>
        <td>" . $out_res[0]["asset_classification"] . "</td>
        <td>" . $out_res[0]["current_condition"] . "</td>
        <td>" . $out_res[0]["service_center"] . "</td>
        <td>" . $out_res[0]["room_number"] . "</td>
        <td>";

          $omitted_tbl .= "
          <div class='dropdown'>
          <a class='btn btn-link btn-sm dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
          Action
          </a>

          <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
          <form action='" . route('asset_view') . "' method='GET' target='_blank'>
          <input type='hidden' value='" . $out_res[0]["id"] . "' name='asset_id'>
          <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
          </form>
          </div>
          </td>";
     }
  }
         $guessExtension = $photo->getClientOriginalExtension();
         $origname = $photo->getClientOriginalName();
         $newfilename = str_replace(" ", "",session("user_school")) . "--" . date("F_d_Y-g_i_a") . "." . $guessExtension;


  $tag = $this->sdm_encrypt("index_upload_asset_csv",PKEY);
      $client = new \GuzzleHttp\Client();
            $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
            "file_name"=>$this->sdm_encrypt($newfilename,PKEY),
            "st_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
             "empid"=>$this->sdm_encrypt(session("user_eid"),PKEY),
             "realname"=>$this->sdm_encrypt($origname,PKEY),
                "file_format"=>$this->sdm_encrypt($guessExtension,PKEY),
        ]]);
            $photo->move(public_path() . "/uploads/",   $newfilename);

            // RUN PROPERTY NUMBER SEPARATION TECHNOLOGY
            $tag = $this->sdm_encrypt("run_separation_tech",PKEY);
            $client = new \GuzzleHttp\Client();
              $resultxm = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
              "tag"=>$tag,
              "st_id"=>$this->sdm_encrypt(session("user_school"),PKEY)
            ]]);
            $outx = $this->sdm_decrypt($resultxm->getBody()->getContents(),PKEY);

              // return $outx;
            Alert::success("Asset Uploaded.");
            return redirect()->route("assetuploadresult",["i_newly"=>$inserted_new,"i_existing"=>$inserted_alreadyexisting,"i_not"=>$inserted_not,"i_logs"=>$mylogs,"i_incomplete"=>$blankcols,"total_assets"=>$tots,"nothere"=>$nothere,"omcount"=>$omitted_count,"om_logs"=>$omitted_tbl]);
    }
     public function load_res_all_bylatest(){

      $tag = $this->sdm_encrypt("get_uploaded_assets_allstation_bylatest",PKEY);
      $client = new \GuzzleHttp\Client();
            $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
        ]]);

      $output = json_decode($this->sdm_decrypt($result->getBody()->getContents(),PKEY),true);
      $toecho = "";
      for ($i=0; $i < count($output); $i++) { 
        $toecho .= "<tr>
<td>" . $output[$i]["name"] . "</td>

          <td>";
          switch($output[$i]["fileformat"]){
           case "csv":
             $toecho .= '<h4><i class="fas fa-file-csv"></i></h4>';
           break;
            case "pdf":
             $toecho .= '<h4><i class="far fa-file-pdf"></i></h4>';
           break;
            case "docx":
             $toecho .= '<h4><i class="fas fa-file-word"></i></h4>';
           break;
            case "xlsx":
             $toecho .= '<h4><i class="fas fa-table"></i></h4>';
           break;
           case 'xls':
             $toecho .= '<h4><i class="far fa-file-excel"></i></h4>';
             break;
            case "txt":
             $toecho .= '<h4><i class="far fa-sticky-note"></i></h4>';
           break;
            }
            $toecho .= "</td><td><a download='" . $output[$i]["realname"] . "' href='" . asset( '/uploads/' . $output[$i]["filename"]) . "'>" .  $output[$i]["realname"];
            $toecho .= "</a></td>
           <td>";


           if ($output[$i]["username"] == "") {
              $toecho .= "Not Available";
           }else{
            $toecho .= $output[$i]["username"];
           }

           $toecho .= "</td>
            <td><small class='float-right text-muted'>" . $this->DateExplainder($output[$i]["dateuploaded"]) ."</small>" . date("F d, Y g:i a",strtotime($output[$i]["dateuploaded"])) . "</td>
     
        </tr>";
      }

      return $toecho;
    }
    public function lodresups(){

      $tag = $this->sdm_encrypt("get_uploaded_assets",PKEY);
      $client = new \GuzzleHttp\Client();
            $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
            "st_id"=>$this->sdm_encrypt(session("user_school"),PKEY),
        ]]);

      $output = json_decode($this->sdm_decrypt($result->getBody()->getContents(),PKEY),true);
      $toecho = "";
      for ($i=0; $i < count($output); $i++) { 
        $toecho .= "<tr>


          <td>";
          switch($output[$i]["fileformat"]){
           case "csv":
             $toecho .= '<h4><i class="fas fa-file-csv"></i></h4>';
           break;
            case "pdf":
             $toecho .= '<h4><i class="far fa-file-pdf"></i></h4>';
           break;
            case "docx":
             $toecho .= '<h4><i class="fas fa-file-word"></i></h4>';
           break;
            case "xlsx":
             $toecho .= '<h4><i class="fas fa-table"></i></h4>';
           break;
           case 'xls':
             $toecho .= '<h4><i class="far fa-file-excel"></i></h4>';
             break;
            case "txt":
             $toecho .= '<h4><i class="far fa-sticky-note"></i></h4>';
           break;

            }

            $toecho .= "</td><td>  <a download='" . $output[$i]["realname"] . "' href='" . asset( '/uploads/' . $output[$i]["filename"]) . "'>" .  $output[$i]["realname"];
            $toecho .= "</a></td>
           <td>" . $output[$i]["username"] . "</td>
            <td><small class='float-right text-muted'>" . $this->DateExplainder($output[$i]["dateuploaded"]) . "</small>" . date("F d, Y g:i a",strtotime($output[$i]["dateuploaded"])) . " </td>
             <td>
        
     <a class='btn btn-danger btn-sm' onclick='opendeleteresource(this)' data-rid='" . $output[$i]["assetidres"] . "' data-toggle='modal' data-target='#modal_delnow' href='#'><i class='far fa-trash-alt'></i> Delete</a>

             </td>
        </tr>";
      }

      return $toecho;
    }
    public function deleresnow(Request $req){
       $tag = $this->sdm_encrypt("deleteanewreource",PKEY);
       $id_of_something = $this->sdm_encrypt($req["id_of_something"],PKEY);
        $client = new \GuzzleHttp\Client();
            $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
            "id_of_something"=>$id_of_something,
        ]]);

        $result = $this->sdm_decrypt($result->getBody()->getContents(),PKEY);
        if($result == "true"){
          Alert::success("Asset Deleted!");
          return redirect()->route("asset_resources");
        }else{
          Alert::error("Unable to delete asset!");
          return redirect()->route("asset_resources");
        }
    }
    public function parse_number($number, $dec_point=null) {
        if (empty($dec_point)) {
            $locale = localeconv();
            $dec_point = $locale['decimal_point'];
        }
        return floatval(str_replace($dec_point, '.', preg_replace('/[^\d'.preg_quote($dec_point).']/', '', $number)));
    }
    public function addnewregistryreocrd(Request $req){

      $tag = $this->sdm_encrypt("add_new_item_registry",PKEY);

      $property_number = $this->sdm_encrypt($req["property_number"],PKEY);
      $asset_item = $this->sdm_encrypt($req["asset_item"],PKEY);
      $office_type = $this->sdm_encrypt($req["office_type"],PKEY);
      $office_name = $this->sdm_encrypt($req["office_name"],PKEY);
      $asset_classification = $this->sdm_encrypt($req["asset_classification"],PKEY);
      $asset_sub_class = $this->sdm_encrypt($req["asset_sub_class"],PKEY);
      $uacs_object_code = $this->sdm_encrypt($req["uacs_object_code"],PKEY);
      $manufacturer = $this->sdm_encrypt($req["manufacturer"],PKEY);
      $model = $this->sdm_encrypt($req["model"],PKEY);
      $serial_number = $this->sdm_encrypt($req["serial_number"],PKEY);
      $specification = $this->sdm_encrypt($req["specification"],PKEY);
      $current_condition = $this->sdm_encrypt($req["current_condition"],PKEY);
      $source_of_fund = $this->sdm_encrypt($req["source_of_fund"],PKEY);
      $cost_of_acquisition = $this->sdm_encrypt($req["cost_of_acquisition"],PKEY);
      $date_of_acquisition = $this->sdm_encrypt($req["date_of_acquisition"],PKEY);
      $estimated_total_life_years = $this->sdm_encrypt($req["estimated_total_life_years"],PKEY);
      $name_of_accountable_officer = $this->sdm_encrypt($req["name_of_accountable_officer"],PKEY);
      $asset_location = $this->sdm_encrypt($req["asset_location"],PKEY);
      $remarks = $this->sdm_encrypt($req["remarks"],PKEY);
      $unit_of_measure = $this->sdm_encrypt($req["unit_of_measure"],PKEY);
      $service_center = $this->sdm_encrypt($req["service_center"],PKEY);
      $room_number = $this->sdm_encrypt($req["room_number"],PKEY);

      $client = new \GuzzleHttp\Client();
            $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
            "property_number"=>$property_number,
            "asset_item"=>$asset_item,
            "office_type"=>$office_type,
            "office_name"=>$office_name,
            "asset_classification"=>$asset_classification,
            "asset_sub_class"=>$asset_sub_class,
            "uacs_object_code"=>$uacs_object_code,
            "manufacturer"=>$manufacturer,
            "model"=>$model,
            "serial_number"=>$serial_number,
            "specification"=>$specification,
            "current_condition"=>$current_condition,
            "source_of_fund"=>$source_of_fund,
            "cost_of_acquisition"=>$cost_of_acquisition,
            "date_of_acquisition"=>$date_of_acquisition,
            "estimated_total_life_years"=>$estimated_total_life_years,
            "name_of_accountable_officer"=>$name_of_accountable_officer,
            "asset_location"=>$asset_location,
            "remarks"=>$remarks,
            "unit_of_measure"=>$unit_of_measure,
            "service_center"=>$service_center,
            "room_number"=>$room_number,

        ]]);

        $result =$result->getBody()->getContents();

        if($result == "1"){
            Alert::success("Asset has been added!");
            return redirect()->route("assetregistry");
        }else if($result == "2"){
          // return $result;
            Alert::error("Asset already exist!");
            return redirect()->route("assetregistry");
        }
    }

       // SDM PROPERTIES
    public function RecordLog($logcode){
       $station_id = $this->sdm_encrypt(session("user_school"),PKEY);
        $account_id = $this->sdm_encrypt(session("user_eid"),PKEY);
      $logcode = $this->sdm_encrypt($logcode,PKEY);
       $tag = $this->sdm_encrypt("addlogs",PKEY);
       $client = new \GuzzleHttp\Client();
            $result = $client->request("POST",WEBSERVICE_URL,["form_params"=>[
            "tag"=>$tag,
            "station_id"=>$station_id,
            "account_id"=>$account_id,
            "action_code"=>$logcode,

        ]]);
    }

public function compute_lifeprice($from,$cost,$items_count,$lifeyears){
  $date_of_aquisition = $from;
  $cost_of_aquisition = $cost;
  $date_today = date("Y-m-d");
  $estimated_lifeyears = $lifeyears;

  $total_years = 1;

  $pri_dedution = 0;
  if($total_years != 0){
    $pri_dedution = ($cost_of_aquisition / $total_years);
  }

  $percentage = 5;
  $new_width = ($percentage / 100) * $pri_dedution;

  $per_year = ($cost_of_aquisition - $new_width) / $estimated_lifeyears;

  //My number is 928.
$myNumber = $per_year;
 
//I want to get 25% of 928.
$percentToGet = 8.34;
 
//Convert our percentage value into a decimal.
$percentInDecimal = $percentToGet / 100;
 
//Get the result.
$percent = $percentInDecimal * $myNumber;
$per_month = $percent;
$dt_cout = explode(",", $this->count_years($date_of_aquisition,$date_today));
$overall = $per_year * $dt_cout[0];

  if($overall > $cost_of_aquisition){
    $overall = $cost_of_aquisition;
  }else{
    $overall += ($per_month * $dt_cout[1]);
  }

  return $cost - ($overall * $items_count);
  // return 3333;
}


public function count_years($d1,$d2){
$date1 = $d1;
$date2 = $d2;

$diff = abs(strtotime($date2) - strtotime($date1));

$years = floor($diff / (365*60*60*24));
$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
return $years . ",".  $months;
}
    public function sdm_encrypt($data,$hash){
    // return "x - " . md5($data);
    $keycode = openssl_digest(utf8_encode($hash),"sha512",true);
    $string = substr($keycode, 10,24);
    // DATA
    $utfData = utf8_encode($data);
    $encryptData = openssl_encrypt($utfData, "DES-EDE3", $string, OPENSSL_RAW_DATA,'');
    $base64Data = base64_encode($encryptData);
    return $base64Data;
    }
    public function sdm_decrypt($data,$hash){
        // return "x - " . md5($data);
        $keycode = openssl_digest(utf8_encode($hash),"sha512",true);
        $string = substr($keycode, 10,24);

        $utfData = base64_decode($data);
        $decryptData = openssl_decrypt($utfData, "DES-EDE3", $string, OPENSSL_RAW_DATA,'');
        // $base64Data = base64_decode($decryptData);
        return $decryptData;
    }

       // FLASH CODE TECHNOLOGIES
    // FLASH CODE TECHNOLOGIES
    // FLASH CODE TECHNOLOGIES

   public function ShowOutput($out,$need_decryption = false){

    if($need_decryption == true){
      $out = $this->sdmdec($out,true);
    }

    return json_encode($out);
   }
    public function quick_result($output,$page,$passed_array = [],$custom_message = ""){
      if($output[0] == "true"){

        if($custom_message != ""){
         Alert::success($custom_message);
        }else{
           Alert::success("Success!");
        }
      
       return redirect()->route($page,$passed_array);
      }else{
        if($custom_message != ""){
         Alert::error($custom_message);
        }else{
          Alert::error("Error!");
        }
        
        return redirect()->route($page,$passed_array);
      }
    }
    public function quick_error($page){
       Alert::error("Please check your given information!");
       return redirect()->route($page);
    }
    public function quick_success($page){
       Alert::success("You got it!");
       return redirect()->route($page);
    }
    public function send($contents){
      $contents["tag"] = $this->sdmenc($contents["tag"]);
      $client = new \GuzzleHttp\Client();
      $res = $client->request("POST",WEBSERVICE_URL,["form_params"=>$contents]);
      return json_decode($this->sdmdec($res->getBody()->getContents()),true);
    }
    public function tblform_dropdown($name,$contents){
      return ' <div class="dropdown">
      <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-cog"></i> ' . $name . '
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
      ' . $contents . ' 
      </div>
      </div>';
    }
    public function form_select($value,$name){
    return "<option value='" . $value . "'>" . $name . "</option>";
    }
    public function form_tbl($cols){
      $structure = "<tr>";
      for ($i=0; $i < count($cols); $i++) { 
      $content = $cols[$i];
      // CHECK IF DATE
      if(date("Y",strtotime($content)) != "1970" && strlen($content) != 1){
      $content = date("F d, Y g:i a",strtotime($content));
      }else{
       //IF RICH TEXT
        if(strpos($content,"<a ") == false && strpos($content,"<button ") == false && strpos($content,"<img ") == false && strpos($content,"<p>") == false){
       $content = "<pre>" . $content . " </pre>";
      }

      }
      $structure .= "<td>" . $content . "</td>";
      }

      $structure .= "</tr>";
      return $structure;
    }
  
    public function DateExplainder($starting_time){
      date_default_timezone_set('asia/manila');
            $now = time(); // or your date as well
            $your_date = strtotime($starting_time);
            $datediff = $now - $your_date;

            $result =  round($datediff / (60 * 60 * 24));

            $months = number_format((round($datediff / (60 * 60 * 24))) / 30);
            if($result == 0){

            $time1 = date("H:i",strtotime($starting_time));
            $time2 = date("H:i");

            $diff = abs(strtotime($time1) - strtotime($time2));

            $tmins = $diff/60;

            $hours = floor($tmins/60);

            $mins = $tmins%60;
            if($mins == "0" && $hours =="0"){
            return "Just now"; 
            }else if($mins == "1" && $hours =="0"){
            return "1 min ago"; 
            } else{
            if($hours == "0"){
            return "$mins mins ago";  
            }else if($hours == "1"){
            return "an hour ago";  
            }else{
            return "$hours hours ago";  
            }

            }

            }else{
            if($result == "1"){
            return "yesterday";
            }else if($result > 30){
             return $months . " months ago.";
            }else{
            return round($datediff / (60 * 60 * 24)) . " days ago.";
            }
            }
        }

    public function sdmenc($data){
      $keycode = openssl_digest(utf8_encode(PKEY),"sha512",true);
      $string = substr($keycode, 10,24);
      $utfData = utf8_encode($data);
      $encryptData = openssl_encrypt($utfData, "DES-EDE3", $string, OPENSSL_RAW_DATA,'');
      $base64Data = base64_encode($encryptData);
      return $base64Data;
    }

    public function sdmdec($data){
      $keycode = openssl_digest(utf8_encode(PKEY),"sha512",true);
      $string = substr($keycode, 10,24);
      $utfData = base64_decode($data);
      $decryptData = openssl_decrypt($utfData, "DES-EDE3", $string, OPENSSL_RAW_DATA,'');
      return $decryptData;
    }

}
