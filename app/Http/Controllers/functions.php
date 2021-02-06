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
class functions extends Controller {
    public function usermanagement() {
        return view('usermanagement');
    }
    public function assetregistry() {
        return view('assetregistry');
    }
    public function assetuploadresult() {
        return view('assetuploadresult');
    }
    public function asset_disposed() {
        return view('asset_disposed');
    }
    public function asset_view() {
        return view('assetview');
    }
    public function group_asset() {
        return view('assetgrouping');
    }
    public function printapp66() {
        return view('doc_appendix73');
    }
    public function asset_scanned() {
        return view('assetscanned');
    }
    public function view_all_unencludedassets() {
        return view('asset_noentry');
    }
    public function asklogin() {
        return view('login');
    }
    public function proc_logout() {
        session()->flush();
        return redirect('/');
    }
    public function dboard() {
        return view('asset_dash');
    }
    public function stationmy() {
        return view('mystation');
    }
    public function manstat() {
        return view('managestations');
    }
    public function lod_discrep_indetail() {
        return view('asset_discrepancies');
    }
    public function ass_transhis() {
        return view('asset_trans_history');
    }
    public function sta_amanagement() {
        return view('asset_stations');
    }
    public function go_abouts() {
        return view('asset_abouts');
    }
    public function myaccount() {
        return view('myaccount');
    }
    public function asset_resources() {
        return view('asset_resources');
    }
    public function manage_utilities() {
        return view('asset_utilities');
    }
    public function manage_reports() {
        return view('asset_reports');
    }
    public function manage_reminders() {
        return view('asset_reminders');
    }
    public function goto_assetdl() {
        return view('asset_reportdownload');
    }
    public function goto_omitts() {
        return view('asset_omitted');
    }
    public function goto_howto() {
        return view('asset_howto');
    }
    public function goto_regoms() {
        return view('asset_omissionreport');
    }
    public function fly_semi_expendable_validationpage() {
        return view('asset_semivalidation');
    }
    public function fly_semiexpendable_discrepancies() {
        return view('asset_semidiscrepancies');
    }
    public function fly_semiexpedable_omitted() {
        return view('asset_semi_omitted');
    }
    public function fly_issuances() {
        return view('asset_issuances');
    }
    public function fly_supply_validationpage() {
        return view('asset_supply_validation');
    }
    public function fly_missing_scanned_semi() {
        return view('assets_missing_semi_scanned');
    }
    public function fly_semi_expendable_item_view() {
        return view('asset_view_semi_single');
    }
    public function fly_inventory_co() {
        return view('asset_addinventory_capitaloutlay');
    }
    public function fly_generate_appendix66() {
        return view('doc_appendix66');
    }
    public function fly_print_assets_qr(){
        return view('asset_utilities');
    }
    // FUNCTIONS
    public function fire_restore_disposed_semi(Request $req){
        $out = $this->send(["tag"=>"RESTORE_DISPOSED_SE_DATA","itemid"=>$this->sdmenc($req["item_id"])]);
        Alert::success("Item Restored!");
       return redirect()->back();
    }
    public function look_get_disposed_semiexpendable(Request $req){
        $out = $this->send_get(["tag"=>"GET_SEMI_EXPENDABLE_DISPOSED","station_id"=>$this->sdmenc($req["sta_id"])]);

        $toecho = "";
        for ($i = 0;$i < count($out);$i++) {
            $toecho.= "
        <tr>
        <td>" . $out[$i]["article"] . "</td>
        <td>" . $out[$i]["description"] . "</td>
        <td>" . $out[$i]["stock_number"] . "</td>
        <td>" . $out[$i]["unit_of_mesure"] . "</td>
        <td>" . $out[$i]["unit_value"] . "</td>
        <td>" . $out[$i]["balance_per_card"] . "</td>
        <td>" . $out[$i]["on_hand_per_count"] . "</td>
         <td>" . $out[$i]["office"] . "</td>
          <td>" . $out[$i]["room_number"] . "</td>
          <td>

 <div class='dropdown'>
    <a class='btn btn-link' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
      <i class='fas fa-ellipsis-v'></i>
    </a>
  
  
    <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink'>
      <a class='dropdown-item' onclick='OpenAssetToDispose_Semi(this)' data-asset_id='" . $out[$i]["item_id"] . "' href='#' data-toggle='modal' data-target='#restore_semi_item'><i class='fas fa-trash-restore'></i> Restore</a>
    </div>
  </div>
          </td>
        </tr>
        ";
        }

        return $toecho;
    }
    public function look_scanned_co(){
        $out = $this->send_get(["tag"=>"GET_SC_CO_CURR","station_id"=>$this->sdmenc(session("user_school"))]);
        for ($i=0; $i < count($out); $i++) { 
            if(date("Y-m-d",strtotime($out[$i]["scanned_date"])) == date("Y-m-d")){
                $out[$i]["scanned_date"] = date("g:i a",strtotime($out[$i]["scanned_date"]));
            }else{
            $out[$i]["scanned_date"] = date("F d, Y g:i a",strtotime($out[$i]["scanned_date"]));
        }
    }
        return json_encode($out);
    }
    public function look_scanned_se(){
        $out = $this->send_get(["tag"=>"GET_SC_SE_CURR","station_id"=>$this->sdmenc(session("user_school"))]);
        for ($i=0; $i < count($out); $i++) { 
            if(date("Y-m-d",strtotime($out[$i]["scanned_date"])) == date("Y-m-d")){
                $out[$i]["scanned_date"] = date("g:i a",strtotime($out[$i]["scanned_date"]));
            }else{
            $out[$i]["scanned_date"] = date("F d, Y g:i a",strtotime($out[$i]["scanned_date"]));
        }
    }
        return json_encode($out);
    }
    public function look_items_for_scanning(Request $req) {
        $output = $this->send_get(['tag' =>'GET_ASSETS_FOR_QR_GENERATION',
            'property_no' => $this->sdmenc($req["p_number"]),
            'ass_type' => $this->sdmenc($req["ass_type"]),
            'room_name' => $this->sdmenc($req["room_name"]),
            'room_number' => $this->sdmenc($req["room_number"]),
            'station' => $this->sdmenc(session('user_school'))]);
        return json_encode($output);
    }
    public function fly_printassetpage() {
        $sch_id = session('user_schoolname');
        return view('asset_printpage', ['sch_id' => $sch_id]);
    }
    public function look_semi_count_by_station(Request $req) {
        $out = $this->send_get(['tag' => 'GET_SEMI_COUNT_REGISTRY_BY_STATION', 'stationid' => $this->sdmenc($req['sd_id']) ]);
        if ($out[0] == "" || $out[0] == null) {
            return "0";
        } else {
            return $out[0];
        }
    }
    public function fire_dispose_semi_expendable(Request $req){
        $out = $this->send(["tag"=>"DISPOSE_SINGLE_SEMI_EXPENDABLE",
                            "status"=>$this->sdmenc($req["asset_archive_type"]),
                            "data_id"=>$this->sdmenc($req["asset_id"])]);
        Alert::success("Item Disposed!");
       return redirect()->back();
    }
    public function look_total_assets_of_station_specific(Request $req) {
        $client = new \GuzzleHttp\Client();
        $result = $client->request('POST', WEBSERVICE_URL, ['form_params' => ['tag' => $this->sdmenc('get_total_assets'), 'station_id' => $this->sdmenc($req['station_number']), ]]);
        $total_assets = $this->sdmdec($result->getBody()->getContents());
        return $total_assets;
    }
    public function fire_univ_change_source(Request $req) {
        session(['user_changesource_station' => $req['new_source_id']]);
        session(['user_changesource_station_name' => $this->fixWrongUTF8Encoding($req['new_source_name']) ]);
        return 'true';
    }
    public function fixWrongUTF8Encoding($inputString) {
        $fix_list = array(
        'â€š' => '‚', 'â€ž' => '„', 'â€¦' => '…', 'â€¡' => '‡', 'â€°' => '‰', 'â€¹' => '‹', 'â€˜' => '‘', 'â€™' => '’', 'â€œ' => '“', 'â€¢' => '•', 'â€“' => '–', 'â€”' => '—', 'â„¢' => '™', 'â€º' => '›', 'â‚¬' => '€',
        'Ã‚' => 'Â', 'Æ’' => 'ƒ', 'Ãƒ' => 'Ã', 'Ã„' => 'Ä', 'Ã…' => 'Å', 'â€' => '†', 'Ã†' => 'Æ', 'Ã‡' => 'Ç', 'Ë†' => 'ˆ', 'Ãˆ' => 'È', 'Ã‰' => 'É', 'ÃŠ' => 'Ê', 'Ã‹' => 'Ë', 'Å’' => 'Œ', 'ÃŒ' => 'Ì', 'Å½' => 'Ž', 'ÃŽ' => 'Î', 'Ã‘' => 'Ñ', 'Ã’' => 'Ò', 'Ã“' => 'Ó', 'â€' => '”', 'Ã”' => 'Ô', 'Ã•' => 'Õ', 'Ã–' => 'Ö', 'Ã—' => '×', 'Ëœ' => '˜', 'Ã˜' => 'Ø', 'Ã™' => 'Ù', 'Å¡' => 'š', 'Ãš' => 'Ú', 'Ã›' => 'Û', 'Å“' => 'œ', 'Ãœ' => 'Ü', 'Å¾' => 'ž', 'Ãž' => 'Þ', 'Å¸' => 'Ÿ', 'ÃŸ' => 'ß', 'Â¡' => '¡', 'Ã¡' => 'á', 'Â¢' => '¢', 'Ã¢' => 'â', 'Â£' => '£', 'Ã£' => 'ã', 'Â¤' => '¤', 'Ã¤' => 'ä', 'Â¥' => '¥', 'Ã¥' => 'å', 'Â¦' => '¦', 'Ã¦' => 'æ', 'Â§' => '§', 'Ã§' => 'ç', 'Â¨' => '¨', 'Ã¨' => 'è', 'Â©' => '©', 'Ã©' => 'é', 'Âª' => 'ª', 'Ãª' => 'ê', 'Â«' => '«', 'Ã«' => 'ë', 'Â¬' => '¬', 'Ã¬' => 'ì', 'Â®' => '®', 'Ã®' => 'î', 'Â¯' => '¯', 'Ã¯' => 'ï', 'Â°' => '°', 'Ã°' => 'ð', 'Â±' => '±', 'Ã±' => 'ñ', 'Â²' => '²', 'Ã²' => 'ò', 'Â³' => '³', 'Ã³' => 'ó', 'Â´' => '´', 'Ã´' => 'ô', 'Âµ' => 'µ', 'Ãµ' => 'õ', 'Â¶' => '¶', 'Ã¶' => 'ö', 'Â·' => '·', 'Ã·' => '÷', 'Â¸' => '¸', 'Ã¸' => 'ø', 'Â¹' => '¹', 'Ã¹' => 'ù', 'Âº' => 'º', 'Ãº' => 'ú', 'Â»' => '»', 'Ã»' => 'û', 'Â¼' => '¼', 'Ã¼' => 'ü', 'Â½' => '½', 'Ã½' => 'ý', 'Â¾' => '¾', 'Ã¾' => 'þ', 'Â¿' => '¿', 'Ã¿' => 'ÿ', 'Ã€' => 'À',
        'Ã' => 'Á', 'Å' => 'Š', 'Ã' => 'Í', 'Ã' => 'Ï', 'Ã' => 'Ð', 'Ã' => 'Ý', 'Ã' => 'à', 'Ã­' => 'í');
        $error_chars = array_keys($fix_list);
        $real_chars = array_values($fix_list);
        return str_replace($error_chars, $real_chars, $inputString);
    }
    public function fire_clear_recovery_data() {
        session(['user_last_scansession_sc' => '']);
        session(['user_last_scansession' => '']);
        session(['user_last_schoolname' => '']);
        return "deleted";
    }
    public function look_not_inserted_recent_co_data(Request $req) {
        $out = $this->send(['tag' => 'GET_RECENT_NOT_ADDED_ASSET_CO', 'stationid' => $this->sdmenc($req['current_station']) ]);
        $toecho = '';
        for ($i = 0;$i < count($out);$i++) {
            //office_type ---- 0
            //office_name ---- 1
            //asset_classification ---- 2
            //asset_sub_class ---- 3
            //uacs_object_code ---- 4
            //asset_item ---- 5
            //manufacturer ---- 6
            //model ---- 7
            //serial_number ---- 8
            //specification ---- 9
            //property_number ---- 10
            //unit_of_measure ---- 11
            //current_condition ---- 12
            //source_of_fund ---- 13
            //cost_of_acquisition ---- 14
            //date_of_acquisition ----- 15
            //estimated_total_life_years ---- 16
            //name_of_accountable_officer ---- 17
            //asset_location ---- 18
            //service_center ---- 19
            //room_number ---- 20
            //remarks ---- 21
            if ($out[$i] != "") {
                $data_fragment = explode("<|next|>", $out[$i]["json_data"]);
                $toecho.= "<tr>
            <td>" . $data_fragment[10] . "</td>
            <td>" . $data_fragment[5] . "</td>
            <td>" . $data_fragment[9] . "</td>
            <td>" . $data_fragment[12] . "</td>
            <td>" . $data_fragment[19] . "</td>
            <td>" . $data_fragment[20] . "</td>
            <td>" . $out[$i]["sub_note"] . "<br><small class='text-muted'>" . $this->DateExplainder($out[$i]["date_recorded"]) . "</small></td>
         </tr>";
            }
        }
        return $toecho;
    }
    public function fire_trans_sdm(Request $req) {
        return $this->sdmdec(str_replace(" ", "+", $req["todec"]));
    }
    public function fire_save_last_session(Request $req) {
        session(['user_last_scansession_sc' => $req["stationid"]]);
        session(['user_last_scansession' => $req["rawdata"]]);
        session(['user_last_schoolname' => $req["stationname"]]);
        return "saved";
    }
    public function fire_remove_last_session() {
        session(['user_last_scansession_sc' => '']);
        session(['user_last_scansession' => '']);
        session(['user_last_schoolname' => '']);
        return "deleted";
    }
    public function look_last_session() {
        if (session('user_last_scansession') != "") {
            // HAS LAST SESSION
            return session('user_last_scansession_sc') . "<|SLICER|>" . session('user_last_scansession') . "<|SLICER|>" . session('user_last_schoolname');
        } else {
            return "false";
        }
    }
    public function fire_delete_specific_assetdata_all(Request $req) {
        $result = $this->send(['tag' => "DELETE_DATA_ASSET_BYSTATION_TYPE", "station_id" => $this->sdmenc($req["station_id"]), "asset_type" => $this->sdmenc($req["asset_type"]) ]);
        return json_encode($result);
    }
    public function look_generate_se_app66_data(Request $req) {
        $loc_id = $this->sdmenc($req["locationid"]);
        $asset_table_head = '
  <tr>
   <th rowspan="2">ARTICLE</th>
    <th rowspan="2">DESCRIPTION</th>
    <th rowspan="2">STOCK<br>NUMBER</th>
    <th rowspan="2">UNIT OF<br>MEASURE</th>
    <th rowspan="2">UNIT<br>VALUE</th>
    <th rowspan="2">BALANCE PER<br>CARD</th>
    <th rowspan="2">ON HAND PER<br>COUNT</th>
    <th colspan="2">SHORTAGE/OVERAGE</th>
    <th rowspan="2">REMARKS</th>
  </tr>
  <tr>
    <th><small>Quantity</small></th>
    <th><small>Value</small></th>
  </tr>
      ';
        $client = new \GuzzleHttp\Client();
        $output = $this->send(['tag' => "GET_SEMI_ASSETS_BYFILTER", "loc_id" => $loc_id, "stat_id" => $this->sdmenc(session("user_school")), "inv_year" => $this->sdmenc($req["inv_year"]), "inv_month" => $this->sdmenc($req["inv_month"]) ]);
        $lc_count = 0;
        $pagecount = 0;
        $toecho = '

<table id="page_' . $pagecount . '" >
<tr class="borderless">
<th colspan="11">
<div style="text-align: right;">Appendix 66</div>
<div style="text-align: center; margin-top: -35px;">
  <h4 style="margin-bottom: 0px;"><img style="display:none;" src="' . asset('images/deped.png') . '" style="height: 80px; width: 80px;"><br>REPORT ON THE PHYSICAL COUNT OF INVENTORIES</h4>
  <small style="margin-bottom: 50px;"><u>Semi-Expendable</u><p style="margin:0px;">(Type of Inventory Item)</p>
  As at <u>' . session("user_schoolname") . ' - ' . $req["roomname"] . '</u></small><br><br>
</div>
<div style="text-align: left;">
  <small>
    <strong>
      Fund Cluster:____________________________<br>
      For which____________________________, <u>(Official Designation)</u>, <u>(Entity Name)</u> is accountable, having assumed such accountability on <u></u>.
    </strong>
  </small>
</div>

</th>
</tr>

 ' . $asset_table_head . '



      ';
        for ($i = 0;$i < count($output);$i++) {
            $on_hand_per_count = $output[$i]["asset_onhandcount"];
            if ($on_hand_per_count != null && $on_hand_per_count != "") {
                $lc_count++;
                if ($lc_count > 16) {
                    $pagecount++;
                    $lc_count = 0;
                    $toecho.= '
      </table>
      <br>
      <br>
      <table id="page_' . $pagecount . '" >
      ' . $asset_table_head . '
      ';
                }
                $toecho.= '<tr>
         <td>' . $output[$i]["article"] . '</td>
          <td>' . $output[$i]['description'] . "</td>";
                $linecount = 0;
                if (strlen($output[$i]['description']) > strlen($output[$i]["article"])) {
                    $linecount = intval(strlen($output[$i]['description']) / 101);
                } else {
                    $linecount = intval(strlen($output[$i]['article']) / 101);
                }
                $lc_count+= $linecount;
                //computation
                $bal_per_card = $output[$i]['balance_per_card'];
                $short_ov_quantity = ($bal_per_card - $on_hand_per_count);
                $output[$i]['unit_value'] = str_replace(",", "", $output[$i]['unit_value']);
                $output[$i]['unit_value'] = str_replace(" ", "", $output[$i]['unit_value']);
                $short_ov_value = number_format((int)$short_ov_quantity * (int)$output[$i]['unit_value'],2);
                $disp_onhandcount = "";
                if ($on_hand_per_count == null || $on_hand_per_count == '') {
                    $disp_onhandcount = "Missing Inv.";
                } else {
                    $disp_onhandcount = $on_hand_per_count;
                }
                if ($short_ov_value < 0) {
                    $short_ov_value = '(' . $short_ov_value . ')';
                    $short_ov_quantity = '(' . $short_ov_quantity . ')';
                }
                $toecho.= '
            <td>' . $output[$i]['stock_num'] . '</td>
            <td>' . $output[$i]['unit_of_mesure'] . '</td>
            <td style="text-align:right;">' . number_format((int)$output[$i]['unit_value'], 2) . '</td>
            <td style="text-align:center;">' . $bal_per_card . '</td>
            <td style="text-align:center;">' . $disp_onhandcount . '</td>
            <td style="text-align:center;">' . $short_ov_quantity . '</td>
            <td style="text-align:center;">' . $short_ov_value . '</td>
            <td>' . $output[$i]['remarks'] . '</td>             
          </tr>';
            }
        }
        $toecho.= '

  <tr  class="bottom_field">
   
    <td class="fronter" colspan="3">
      Certified Corrected by:
      <center>
        __________________________________<br>
       Signature over Printed Name of<br>Inventory Committee Chair and<br>Members
      </center>
    </td>
    <td colspan="3">
      Approved by:
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
        $this->RecordLog("a02.1");
        return $toecho;
    }
    public function look_semi_pagecount(Request $req) {
        $result = $this->send(['tag' => "GET_SEMI_ASSETS_BYFILTER", "loc_id" => $this->sdmenc($req["lc_id"]), "stat_id" => $this->sdmenc(session("user_school")), "inv_year" => $this->sdmenc($req["inv_year"]), "inv_month" => $this->sdmenc($req["inv_month"]) ]);
        return count($result);
    }
    public function look_checkready_specific(Request $req) {
        //CHECK CAPITAL OUTLAY REDINESS
        $output = $this->send_get(["tag"=>"inventory_checkif_ready","station_id" => $this->sdmenc($req["user_school"])]);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            // CHECK TYPE OF ASSET
            $asset_type_name = "";
            $missing_cases = "";
            if ($output[$i]["pref_name"] == "Inventory Status") {
                $asset_type_name = "co";
            } else if ($output[$i]["pref_name"] == "Inventory Status Semi") {
                $asset_type_name = "se";
            }
            if ($asset_type_name != "") {
                if ($output[$i]["pref_value"] == "Ready") {
                    $toecho.= $asset_type_name;
                }
            }
        }
        return $toecho;
    }
    public function fire_submit_scanned_data(Request $req) {
        $loc_id = $req["loc_id"];
        $ass_cd = $req["ass_cd"];
        $timesp = $req["timesp"];
        $ass_type = $req["ass_type"];
        $out = $this->send(['tag' => "UNI_ADD_INVENTORY_DATA", "loc_id" => $this->sdmenc($loc_id), "ass_cd" => $this->sdmenc($ass_cd), "timesp" => $this->sdmenc($timesp), "ass_type" => $this->sdmenc($ass_type), "sta_id" => $this->sdmenc($req["stationid"]), "asset_name" => $this->sdmenc($req["asset_name"]) ]);
        return json_encode($out);
    }
    public function look_get_max_values_of_CoSe(Request $req) {
        $out = $this->send_get(['tag' => "GET_MAX_VALUES_OF_CAPITAL_X_SEMI", "station_id" => $this->sdmenc($req["sta_id"]), "center_id" => $this->sdmenc($req["service_centerid"]) ]);
        return $out[0];
    }
    public function look_scanned_item_details(Request $req) {
        $out = $this->send_get(['tag' => "GET_SINGLE_SCANNED_ASSET_DETAILS", "station_id" => $this->sdmenc($req["sta_id"]), "code" => $this->sdmenc($req["scanned_cod"]), "loc_id" => $this->sdmenc($req["location_id"]) ]);
        return json_encode($out);
    }
    public function look_single_service_center_data_byid(Request $req) {
        $out = $this->send_get(['tag' => "GET_SERVICE_CENTER_INFO_BYID", "loc_id" => $this->sdmenc($req["service_center_id"]) ]);
        return json_encode($out);
    }
    public function look_getallservicecenters(Request $req) {
        $out = $this->send_get(['tag' => "GET_ALL_SERVICE_CENTERS_MYSTATION", "station_id" => $this->sdmenc($req["station_id"]) ]);
        $toecho = "";
        for ($i = 0;$i < count($out);$i++) {
            $toecho.= "
            <option value='" . $out[$i]["id"] . "'>" . $out[$i]["office"] . " (room #: " . $out[$i]["room_number"] . ")" . "</option>
          ";
        }
        return $toecho;
    }
    public function look_all_years_with_inventory_semiexpendable(Request $req) {
        $out = $this->send(['tag' => "GET_INVENTORY_YEARS_SEMI_EXPENDABLE", "station_id" => $this->sdmenc($req["station_id"]) ]);
        $toecho = "";
        for ($i = 0;$i < count($out);$i++) {
            $toecho.= "<option>" . date("Y", strtotime($out[$i]["scanned_date"])) . "</option>";
        }
        if ($toecho == '') {
            $toecho.= "<option value='" . date("Y") . "'  >No Record</option>";
        }
        return $toecho;
    }
    public function look_inventory_month_semiexpendable(Request $req) {
        $out = $this->send(['tag' => "GET_INVENTORY_MONTH_SEMI_EXPENDABLE_BYYEAR", "station_id" => $this->sdmenc($req["station_id"]), "year_promised" => $this->sdmenc($req["date_year"]) ]);
        $toecho = "";
        for ($i = 0;$i < count($out);$i++) {
            $toecho.= "<option value='" . date("m", strtotime($out[$i]["scanned_date"])) . "'>" . date("F", strtotime($out[$i]["scanned_date"])) . "</option>";
        }
        if ($toecho == '') {
            $toecho.= "<option value='" . date("m") . "'  >No Record</option>";
        }
        return $toecho;
    }
    public function look_inventory_month_capital_outlay(Request $req) {
        $out = $this->send(['tag' => "GET_INVENTORY_MONTH_CAP_OUTLAY_BYYEAR", "station_id" => $this->sdmenc($req["station_id"]), "year_promised" => $this->sdmenc($req["date_year"]) ]);
        $toecho = "";
        for ($i = 0;$i < count($out);$i++) {
            $toecho.= "<option value='" . date("m", strtotime($out[$i]["scanned_date"])) . "'>" . date("F", strtotime($out[$i]["scanned_date"])) . "</option>";
        }
        if ($toecho == '') {
            $toecho.= "<option value='" . date("m") . "'  >No Record</option>";
        }
        return $toecho;
    }
    public function look_all_years_with_inventory_capitaloutlay(Request $req) {
        $out = $this->send(['tag' => "GET_INVENTORY_YEARS_CAPITAL_OUTLAY", "station_id" => $this->sdmenc($req["station_id"]) ]);
        $toecho = "";
        for ($i = 0;$i < count($out);$i++) {
            $toecho.= "<option>" . date("Y", strtotime($out[$i]["scanned_date"])) . "</option>";
        }
        if ($toecho == '') {
            $toecho.= "<option value='" . date("Y") . "'  >No Record</option>";
        }
        return $toecho;
    }
    public function look_single_semi_expenable(Request $req) {
        $out = $this->send_get(['tag' => "GET_SINGLE_SEMI_EXPENDABLE", "data_id" => $this->sdmenc($req["d_id"]) ]);
        if (count($out) != 0) {
            $out[0]["unit_value"] = str_replace(" ", "",  strtolower($out[0]["unit_value"]));
            if($out[0]["unit_value"] != "" && $out[0]["unit_value"] != null && !strpos("n/a", $out[0]["unit_value"])){

                $out[0]["unit_value"] = str_replace(",", "",   $out[0]["unit_value"]);
                $out[0]["unit_value"] = number_format((int)$out[0]["unit_value"], 2);
                if($out[0]["unit_value"] == "0.00"){
                    $out[0]["unit_value"] = "Unidentified";
                }
            }
        }
        return json_encode($out);
    }
    public function look_get_semi_expendable_not_scanned(Request $req) {
        $output = $this->send_get(['tag' => "GET_MISSING_SCANNED_SEMI_DATA", "station_id" => $this->sdmenc($req["station_info"]), "cho_year" => $this->sdmenc($req["selyear"]), "cho_month" => $this->sdmenc($req["selmonth"]) ]);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            if ($output[$i]["stock_number"] != "none" && $output[$i]["stock_number"] != "") {
                $toecho.= "
        <tr>
        <td class='missedt'>
        <form action='" . route('goto_semi_expendable_item_view') . "' method='GET' target='_blank'>
        <input type='hidden' value='" . $output[$i]["item_id"] . "' name='asset_id'>
        <button class='btn btn-link' type='submit' target='_blank'>" . $output[$i]["stock_number"] . "</button>
        </form>
        </td>
        <td>" . $output[$i]["article"] . "</td>
        <td>" . $output[$i]["description"] . "</td>
        <td>" . $output[$i]["office"] . "</td>
        <td>" . $output[$i]["room_number"] . "</td>
        </tr>
        ";
            }
        }
        return $toecho;
    }
    public function look_getsemisum_totalscanned(Request $req) {
        $output = $this->send(['tag' => "GET_TOTAL_SCANNED_SEMIEXPENDABLE", "station_id" => $this->sdmenc($req["sd_id"]), "yy" => $this->sdmenc($req["selyear"]), "mm" => $this->sdmenc($req["selmonth"]) ]);
        if ($output[0] == "" || $output[0] == null) {
            return "0";
        } else {
            return $output[0];
        }
    }
    public function look_getsemisum_fromto(Request $req) {
        $output = $this->send(['tag' => "GET_SEMI_FROM_TO_DATES", "station_id" => $this->sdmenc($req["sd_id"]), "yy" => $this->sdmenc($req["selyear"]), "mm" => $this->sdmenc($req["selmonth"]) ]);
        $toecho = "";
        if (count($output) != 0) {
            $output = explode("|", $output[0]);
            if ($output[0] == $output[0]) {
                //same date
                $toecho = date("F d, Y", strtotime($output[0])) . "<br>" . "<span class='text-muted'>" . $this->DateExplainder($output[0]) . "</span>";
            } else {
                //different data
                $toecho = date("F d", strtotime($output[0])) . " to " . date("F d, Y", strtotime($output[1])) . "<br>" . "<span class='text-muted'>" . $this->DateExplainder($output[1]) . "</span>";
            }
        } else {
            $toecho = "No inventory date available.";
        }
        return $toecho;
    }
    public function look_getsemisum_itemsnotfound(Request $req) {
        $output = $this->send(['tag' => "GET_SEMI_ITEMS_NOT_FOUND", "station_id" => $this->sdmenc($req["sd_id"]), "yy" => $this->sdmenc($req["selyear"]), "mm" => $this->sdmenc($req["selmonth"]) ]);
        return $output[0];
    }
    public function fire_uploadscannedcapitaloutlay(Request $req) {
        $SchoolID = $this->sdmenc($req["sc_id"]);
        $upload_CSVFILE = $req->file('thecsvfile');
        $file = fopen($upload_CSVFILE, "r");
        $toecho = "";
        while (($getData = fgetcsv($file, 10000, ",")) !== false) {
            if (count($getData) == 4) {
                $dt_date = htmlentities($getData[0]);
                $dt_time = htmlentities($getData[1]);
                $dt_datatype = htmlentities($getData[2]);
                $dt_datacode = htmlentities($getData[3]);
                if ($dt_date != "" && $dt_time != "" && $dt_datatype != "" && $dt_datacode != "") {
                    $AllSemiExpendable = $this->send(['tag' => "IS_EXISITING_PROPNUMB", "stocknumb" => $this->sdmenc($dt_datacode) ]);
                    if (count($AllSemiExpendable) == "1") {
                        // return "is_existing";
                        //INSERT DATA BACAUSE STOCK NUMBER IS EXISTING
                        //ADD COMPILED DATE TIME
                        $scanned_date_and_time = date("Y-m-d H:i:s", strtotime($dt_date . " " . $dt_time));
                        $SemiExFullInfo = $this->send(['tag' => "GET_CAPITALOUTLAY_FULLINFO_SINGLE", "stock_number" => $this->sdmenc($dt_datacode) ]);
                        $property_num = $dt_datacode;
                        $location = $SemiExFullInfo[0]["service_center"];
                        $roomnumber = $SemiExFullInfo[0]["room_number"];
                        $school_id = session("user_school");
                        $origin_id = session("user_eid");
                        $send_semi_ex_scanneddata = $this->send(['tag' => "UPLOAD_CAPITAL_OUTLAY_SCANNED_DATA", "property_number" => $this->sdmenc($property_num), "scanned_date" => $this->sdmenc($scanned_date_and_time), "location" => $this->sdmenc($location), "room_number" => $this->sdmenc($roomnumber), "school_id" => $this->sdmenc($school_id), "origin_id" => $this->sdmenc($origin_id) ]);
                    }
                }
            }
        }
        return $this->quick_result([true], "asset_scanned");
    }
    public function look_show_uploaded_semi_expendable_scanneddata(Request $req) {
        $out = $this->send(['tag' => "GET_SEMI_SCANNED_DATA", "stationid" => $this->sdmenc($req["sd_id"]), "yy" => $this->sdmenc($req["selyear"]), "mm" => $this->sdmenc($req["selmonth"]) ]);
        $toecho = "";
        for ($i = 0;$i < count($out);$i++) {
            $toecho.= "<tr>
            <td>
 <form action='" . route('goto_semi_expendable_item_view') . "' method='GET' target='_blank'>
        <input type='hidden' value='" . $out[$i]["item_id_semi"] . "' name='asset_id'>
        <button class='btn btn-link' type='submit' target='_blank'>" . $out[$i]["stock_number"] . "</button>
        </form>
            </td>
            <td>" . $out[$i]["article"] . "</td>
            <td>" . $out[$i]["description"] . "</td>
            <td>" . $out[$i]["office"] . "</td>
            <td>" . $out[$i]["room_number"] . "</td>
            <td>" . date("F d, Y g:i a", strtotime($out[$i]["scanned_date"])) . "<br><span class='text-muted'>" . $this->DateExplainder($out[$i]["scanned_date"]) . "</span>" . "</td>
           </tr>";
        }
        return $toecho;
    }
    public function fire_uploadsemiexpendabledatascanned(Request $req) {
        $SchoolID = $this->sdmenc($req["sc_id"]);
        $upload_CSVFILE = $req->file('thecsvfile');
        $file = fopen($upload_CSVFILE, "r");
        $toecho = "";
        while (($getData = fgetcsv($file, 10000, ",")) !== false) {
            if (count($getData) == 4) {
                $dt_date = htmlentities($getData[0]);
                $dt_time = htmlentities($getData[1]);
                $dt_datatype = htmlentities($getData[2]);
                $dt_datacode = htmlentities($getData[3]);
                if ($dt_date != "" && $dt_time != "" && $dt_datatype != "" && $dt_datacode != "") {
                    $AllSemiExpendable = $this->send(['tag' => "IS_EXISITING_STOCKNUM", "stocknumb" => $this->sdmenc($dt_datacode) ]);
                    if (count($AllSemiExpendable) == "1") {
                        //INSERT DATA BACAUSE STOCK NUMBER IS EXISTING
                        //ADD COMPILED DATE TIME
                        $scanned_date_and_time = date("Y-m-d H:i:s", strtotime($dt_date . " " . $dt_time));
                        $SemiExFullInfo = $this->send(['tag' => "GET_SEMI_EXPEN_FULLINFO_SINGLE", "stock_number" => $this->sdmenc($dt_datacode) ]);
                        $stock_number = $dt_datacode;
                        $location = $SemiExFullInfo[0]["office"];
                        $roomnumber = $SemiExFullInfo[0]["room_number"];
                        $school_id = session("user_school");
                        $origin_id = session("user_eid");
                        $send_semi_ex_scanneddata = $this->send(['tag' => "ADD_ASSET_SEMI_SCANNEDDATA", "stock_number" => $this->sdmenc($stock_number), "scanned_date" => $this->sdmenc($scanned_date_and_time), "location" => $this->sdmenc($location), "room_number" => $this->sdmenc($roomnumber), "school_id" => $this->sdmenc($school_id), "origin_id" => $this->sdmenc($origin_id) ]);
                    }
                }
            }
        }
        return $this->quick_result([true], "asset_scanned");
    }
    public function fire_add_supply(Request $req) {
        $SchoolID = $this->sdmenc($req["sc_id"]);
        $upload_CSVFILE = $req->file('thecsvfile');
        $file = fopen($upload_CSVFILE, "r");
        $toecho = "";
        // SELECT ALL EXISTING SEMI EXPENDABLE
        $AllSemiExpendable = $this->send(['tag' => "GET_ALL_SUPPLY_BY_STATION", "station_id" => $this->sdmenc(session("user_school")) ]);
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
        $current_stocknumber = array();
        while (($getData = fgetcsv($file, 10000, ",")) !== false) {
            if ($rot_count != 0) {
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
                array_push($UploadedData, $sem_article . $sem_description . $sem_stocknumber . $sem_unitofmesure . $sem_unitval . $sem_balpercard . $sem_onhandper . $sem_shortover . $sem_remarks);
                // SEE IF HAS EXACT SAME
                $exact_same = false;
                $data_match = 0;
                for ($ix = 0;$ix < count($AllSemiExpendable);$ix++) {
                    $is_exact = true;
                    //CHECK IF HAS EXISTING STOCK NUMBER
                    if ($sem_stocknumber != "" && $sem_stocknumber != null) {
                        if ($sem_stocknumber == $AllSemiExpendable[$ix]["stock_number"]) {
                            $has_existing_stock_number = true;
                            if (!in_array($sem_stocknumber, $current_stocknumber)) {
                                array_push($current_stocknumber, $sem_stocknumber);
                            } else {
                                $acceptable = false;
                                $discrepancyList.= "<strong>Stock Number already exist/not unique (Not Inserted)</strong>" . "<br>";
                            }
                        }
                    }
                    if ($sem_article !== $AllSemiExpendable[$ix]["article"] || $sem_description !== $AllSemiExpendable[$ix]["description"] || $sem_stocknumber !== $AllSemiExpendable[$ix]["stock_number"] || $sem_unitofmesure !== $AllSemiExpendable[$ix]["unit_of_mesure"] || $sem_unitval !== $AllSemiExpendable[$ix]["unit_value"] || $sem_balpercard !== $AllSemiExpendable[$ix]["balance_per_card"] || $sem_onhandper !== $AllSemiExpendable[$ix]["on_hand_per_count"] || $sem_shortover !== $AllSemiExpendable[$ix]["shortage_overage"] || $sem_remarks !== $AllSemiExpendable[$ix]["remarks"]) {
                        $is_exact = false;
                    }
                    if ($is_exact == true) {
                        // THE DATA HAS MATCH
                        $exact_same = true;
                        $data_match++;
                    }
                }
                if ($data_match == 0) {
                    // DATA IS NEW AND FRESH
                    
                }
                if ($sem_article == '' || $sem_article == null) {
                    $hasmiss = true;
                    $discrepancyList.= "Missing Article" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                if ($sem_description == '' || $sem_description == null) {
                    $hasmiss = true;
                    $discrepancyList.= "Missing Description" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                if ($sem_stocknumber == '' || $sem_stocknumber == null) {
                    $hasmiss = true;
                    $discrepancyList.= "<strong>Missing Stock Number (Not Inserted)</strong>" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                if ($sem_unitofmesure == '' || $sem_unitofmesure == null) {
                    $hasmiss = true;
                    $discrepancyList.= "Missing Unit of Mesure" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                if ($sem_unitval == '' || $sem_unitval == null) {
                    $hasmiss = true;
                    $discrepancyList.= "Missing Unit value" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                if ($sem_balpercard == '' || $sem_balpercard == null) {
                    $hasmiss = true;
                    $discrepancyList.= "Missing Balance per Card" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                // Counstruct Discrepancy
                if ($discrepancyList != "") {
                    $tbl_discrepancies.= "<tr>
            <td>" . ($rot_count + 1) . "</td>
            <td>";
                    if ($sem_article == '') {
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_article;
                    }
                    $tbl_discrepancies.= "</td>
            <td>";
                    if ($sem_description == '') {
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_description;
                    }
                    $tbl_discrepancies.= "</td>
            <td>";
                    if ($sem_stocknumber == '') {
                        $acceptable = false;
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_stocknumber;
                    }
                    $tbl_discrepancies.= "</td>
            <td>";
                    if ($sem_unitofmesure == '') {
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_unitofmesure;
                    }
                    $tbl_discrepancies.= "</td>
            <td>";
                    if ($sem_unitval == '') {
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_unitval;
                    }
                    $tbl_discrepancies.= "</td>
             <td>";
                    if ($sem_balpercard == '') {
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_balpercard;
                    }
                    $tbl_discrepancies.= "</td>
            <td>" . $discrepancyList . "</td>
          </tr>";
                }
                if ($existing == true && $datacount >= 1) {
                    // Prove that there's exisiting data
                    $overall_assets++;
                } else {
                    // NO EXISTING DATA
                    $acceptable = false;
                }
                if ($exact_same == true) {
                    //HAS EXACT SAME
                    $acceptable = false;
                    $exactsamecount++;
                }
                if ($datacount == 6) {
                    $perfect_data++;
                }
                if ($existing == true && $hasmiss == true) {
                    // has exisiting data but mussing column(s)
                    $miss_col++;
                }
                if ($acceptable == true) {
                    // INSERT DATA
                    if ($has_existing_stock_number) {
                        // UPDATE DATA ONLY
                        $insert_assetdata = $this->send(['tag' => "UPDATE_SUPPLY_DATA", "sem_article" => $this->sdmenc($sem_article), "sem_description" => $this->sdmenc($sem_description), "sem_stocknumber" => $this->sdmenc($sem_stocknumber), "sem_unitofmesure" => $this->sdmenc($sem_unitofmesure), "sem_unitval" => $this->sdmenc($sem_unitval), "sem_balpercard" => $this->sdmenc($sem_balpercard), "sem_onhandper" => $this->sdmenc($sem_onhandper), "sem_shortover" => $this->sdmenc($sem_shortover), "sem_remarks" => $this->sdmenc($sem_remarks), "station_id" => $this->sdmenc(session("user_school")), "serv_center_id" => $this->sdmenc($req["service_center_id"]) ], true);
                        $asset_updated++;
                    } else {
                        // ADD NEW DATA TO SEMI EXPENDABLE
                        $insert_assetdata = $this->send(['tag' => "ADD_NEW_SUPPLY_DATA", "sem_article" => $this->sdmenc($sem_article), "sem_description" => $this->sdmenc($sem_description), "sem_stocknumber" => $this->sdmenc($sem_stocknumber), "sem_unitofmesure" => $this->sdmenc($sem_unitofmesure), "sem_unitval" => $this->sdmenc($sem_unitval), "sem_balpercard" => $this->sdmenc($sem_balpercard), "sem_onhandper" => $this->sdmenc($sem_onhandper), "sem_shortover" => $this->sdmenc($sem_shortover), "sem_remarks" => $this->sdmenc($sem_remarks), "station_id" => $this->sdmenc(session("user_school")), "serv_center_id" => $this->sdmenc($req["service_center_id"]) ], true);
                        $asset_inserted++;
                    }
                    $toecho.= json_encode($insert_assetdata);
                } else {
                    $not_inserted++;
                }
            }
            $rot_count++;
        }
        if (count($AllSemiExpendable) != 0) {
            //DELETE ALL OMITTED
            $this->send(['tag' => "RESET_OMITTED_SUPPLY", "station_id" => $this->sdmenc(session("user_school")) ]);
        }
        for ($i = 0;$i < count($AllSemiExpendable);$i++) {
            $hmat = true;
            for ($x = 0;$x < count($UploadedData);$x++) {
                $unifieds = $AllSemiExpendable[$i]["article"] . $AllSemiExpendable[$i]["description"] . $AllSemiExpendable[$i]["stock_number"] . $AllSemiExpendable[$i]["unit_of_mesure"] . $AllSemiExpendable[$i]["unit_value"] . $AllSemiExpendable[$i]["balance_per_card"] . $AllSemiExpendable[$i]["on_hand_per_count"] . $AllSemiExpendable[$i]["shortage_overage"] . $AllSemiExpendable[$i]["remarks"];
                if ($unifieds == $UploadedData[$x]) {
                    $hmat = false;
                }
            }
            if ($hmat == true) {
                $omittedass++;
                $tbl_assetnofound.= "
                <tr>
                  <td>" . $omittedass . "</td>
                  <td>" . $AllSemiExpendable[$i]["article"] . "</td>
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
                // INSERT OMITTED ASSETS TO DATABASE
                $omission_insert = $this->send(['tag' => "INSERT_SUPPLY_ASSET_OMITTED", "sem_article" => $this->sdmenc($AllSemiExpendable[$i]["article"]), "sem_description" => $this->sdmenc($AllSemiExpendable[$i]["description"]), "sem_stocknumber" => $this->sdmenc($AllSemiExpendable[$i]["stock_number"]), "sem_unitofmesure" => $this->sdmenc($AllSemiExpendable[$i]["unit_of_mesure"]), "sem_unitval" => $this->sdmenc($AllSemiExpendable[$i]["unit_value"]), "sem_balpercard" => $this->sdmenc($AllSemiExpendable[$i]["balance_per_card"]), "sem_onhandper" => $this->sdmenc($AllSemiExpendable[$i]["on_hand_per_count"]), "sem_shortover" => $this->sdmenc($AllSemiExpendable[$i]["shortage_overage"]), "sem_remarks" => $this->sdmenc($AllSemiExpendable[$i]["remarks"]), "station_id" => $this->sdmenc(session("user_school")), "serv_center_id" => $this->sdmenc($req["service_center_id"]) ], true);
            }
        }
        $guessExtension = $upload_CSVFILE->getClientOriginalExtension();
        $origname = $upload_CSVFILE->getClientOriginalName();
        $NewFileName = str_replace(" ", "", session("user_school")) . "--" . date("F_d_Y-g_i_a") . "." . $guessExtension;
        $ResourceFileUpload = $this->send(['tag' => "index_upload_asset_csv", "file_name" => $this->sdmenc($NewFileName), "st_id" => $this->sdmenc(session("user_school")), "empid" => $this->sdmenc(session("user_eid")), "realname" => $this->sdmenc($origname), "file_format" => $this->sdmenc($guessExtension) ], true);
        $upload_CSVFILE->move(public_path() . "/uploads/", $NewFileName);
        $this->RecordLog("a01.2");
        return redirect()->route("goto_supply_validationpage", ["overallassets" => $overall_assets, "perfectdata" => $perfect_data, "missingcolumns" => $miss_col, "insertedassets" => $asset_inserted, "exactsame" => $exactsamecount, "notinserted" => $not_inserted, "ass_withdesc" => $tbl_discrepancies, "ass_nofount" => $tbl_assetnofound, "ass_omitted" => $omittedass, "ass_updated" => $asset_updated]);
    }
    public function look_preview_of_uploaded_supplyfile(Request $req) {
        $csv_file = $req->file('thecsvfile');
        $file = fopen($csv_file, "r");
        $toecho = "";
        $previewcount = 0;
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            if ($previewcount != 0 && count($getData) <= 9) {
                $toecho.= "<tr>";
                for ($i = 0;$i < 9;$i++) {
                    $toecho.= "<td>" . $getData[$i] . "</td>";
                }
                $toecho.= "</tr>";
                if ($previewcount >= 3) {
                    break;
                }
            }
            $previewcount++;
        }
        if ($toecho == '') {
            $toecho = "
          <tr>
          <td>Supply CSV file is not valid.</td>
          </tr>
          ";
        } else {
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
    public function look_all_of_my_supply_data(Request $req) {
        $semiex = $this->send(['tag' => "GET_ALL_OFMY_SUPPLYDATA", "station_id" => $this->sdmenc($req["station_id"]) ]);
        $toecho = "";
        for ($i = 0;$i < count($semiex);$i++) {
            $toecho.= "
        <tr>
        <td>" . $semiex[$i]["article"] . "</td>
        <td>" . $semiex[$i]["description"] . "</td>
        <td>" . $semiex[$i]["stock_number"] . "</td>
        <td>" . $semiex[$i]["unit_of_mesure"] . "</td>
        <td>" . $semiex[$i]["unit_value"] . "</td>
        <td>" . $semiex[$i]["balance_per_card"] . "</td>
        <td>" . $semiex[$i]["on_hand_per_count"] . "</td>
        <td>" . $semiex[$i]["remarks"] . "</td>
        <td>" . '
                     <div class="dropdown">
    <a class="btn btn-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v"></i>
    </a>
  
            
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#supplydispose"><i class="fas fa-trash"></i> Dispose</a>

              </div>
            </div>

        ' . "</td>
        </tr>
        ";
        }
        return $toecho;
    }
    public function look_last_date_ofcode(Request $req) {
        $out = $this->send_get(['tag' => "GET_LAST_DATE_CODEOF", "station_id" => $this->sdmenc($req["station_id"]), "logcode" => $this->sdmenc($req["givencode"]) ]);
        if (count($out) != 0) {
            // HAS DATE
            return date("M d, Y g:i a", strtotime($out[0]["timestamp"])) . "<small class='text-muted float-right'>" . $this->DateExplainder($out[0]["timestamp"]) . "</small>";
        } else {
            // NO DATE
            return "N/A";
        }
    }
    public function fire_reset_account_password(Request $req) {
        $reset_account_password = $this->send(['tag' => "RESET_ACCOUNT_PASSWORD_BYADMIN", "accid" => $this->sdmenc($req["employeeid"]), "empnum" => $this->sdmenc($req["employeenumber"]) ]);
        return $this->quick_result($reset_account_password, "usermanagement");
    }
    public function look_semi_expendable_omitted(Request $req) {
        $omitt = $this->send_get(['tag' => "GET_OMITTED_ASSET_IN_SCHOOL", "station_id" => $this->sdmenc($req["station_id"]), true]);
        $toecho = "";
        switch ($req["layout"]) {
            case 'count':
                $omitted_count = count($omitt);
                if ($omitted_count == "0") {
                    // NONE
                    $toecho = $omitted_count;
                } else {
                    // PROVIDE LINE
                    $toecho = "<a href='" . route("goto_semiexpedable_omitted") . "?stationid=" . $req["station_id"] . "'>" . $omitted_count . "</a>";
                }
            break;
            case 'table':
                for ($i = 0;$i < count($omitt);$i++) {
                    $toecho.= "<tr>
               <td>" . ($i + 1) . "</td>
                    <td>" . $omitt[$i]["article"] . "</td>
                    <td>" . $omitt[$i]["description"] . "</td>
                    <td>" . $omitt[$i]["stock_number"] . "</td>
                    <td>" . $omitt[$i]["unit_of_mesure"] . "</td>
                    <td>" . $omitt[$i]["unit_value"] . "</td>
                    <td>" . $omitt[$i]["balance_per_card"] . "</td>
                    <td>" . $omitt[$i]["on_hand_per_count"] . "</td>
                    <td>" . $omitt[$i]["remarks"] . "</td>
                    <td>" . '
                  <div class="dropdown">
    <a class="btn btn-link btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Action
    </a>
  
    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
      <a class="dropdown-item" href="#"><i class="fas fa-flag"></i> Report</a>
    </div>
  </div>

                 ' . "</td>
            </tr>";
                }
            break;
        }
        return $toecho;
    }
    public function look_my_semiexpendable_descrepancies(Request $req) {
        $semiex = $this->send_get(['tag' => "GET_ALL_SEMI_EXPENDIBLE_BY_STATION", "station_id" => $this->sdmenc($req["station_id"]), "location_id" => $this->sdmenc("all") ]);
        $toecho = "";
        $desccount = 0;
        switch ($req["layout"]) {
            case 'count':
                for ($i = 0;$i < count($semiex);$i++) {
                    $has_desc = false;
                    $sem_article = htmlentities($semiex[$i]["article"]);
                    $sem_description = htmlentities($semiex[$i]["description"]);
                    $sem_stocknumber = htmlentities($semiex[$i]["stock_number"]);
                    $sem_unitofmesure = htmlentities($semiex[$i]["unit_of_mesure"]);
                    $sem_unitval = htmlentities($semiex[$i]["unit_value"]);
                    $sem_balpercard = htmlentities($semiex[$i]["balance_per_card"]);
                    $sem_onhandper = htmlentities($semiex[$i]["on_hand_per_count"]);
                    $sem_remarks = htmlentities($semiex[$i]["remarks"]);
                    if ($sem_article == '' || $sem_article == null) {
                        $has_desc = true;
                    } else {
                        $existing = true;
                    }
                    if ($sem_description == '' || $sem_description == null) {
                        $has_desc = true;
                    } else {
                        $existing = true;
                    }
                    if ($sem_stocknumber == '' || $sem_stocknumber == null) {
                        $has_desc = true;
                    } else {
                        $existing = true;
                    }
                    if ($sem_unitofmesure == '' || $sem_unitofmesure == null) {
                        $has_desc = true;
                    } else {
                        $existing = true;
                    }
                    if ($sem_unitval == '' || $sem_unitval == null) {
                        $has_desc = true;
                    } else {
                        $existing = true;
                    }
                    if ($sem_balpercard == '' || $sem_balpercard == null) {
                        $has_desc = true;
                    } else {
                        $existing = true;
                    }
                    if ($has_desc) {
                        $desccount++;
                    }
                }
                if ($desccount == "0") {
                    // NONE
                    $toecho = $desccount;
                } else {
                    // PROVIDE LINE
                    $toecho = "<a href='" . route("goto_semiexpendable_discrepancies") . "?stationid=" . $req["station_id"] . "'>" . $desccount . "</a>";
                }
            break;
            case 'table':
                for ($i = 0;$i < count($semiex);$i++) {
                    $discrepancyList = "";
                    $sem_article = htmlentities($semiex[$i]["article"]);
                    $sem_description = htmlentities($semiex[$i]["description"]);
                    $sem_stocknumber = htmlentities($semiex[$i]["stock_number"]);
                    $sem_unitofmesure = htmlentities($semiex[$i]["unit_of_mesure"]);
                    $sem_unitval = htmlentities($semiex[$i]["unit_value"]);
                    $sem_balpercard = htmlentities($semiex[$i]["balance_per_card"]);
                    $sem_onhandper = htmlentities($semiex[$i]["on_hand_per_count"]);
                    $sem_remarks = htmlentities($semiex[$i]["remarks"]);
                    if ($sem_article == '' || $sem_article == null) {
                        $discrepancyList.= "Missing Article" . "<br>";
                    } else {
                        $existing = true;
                    }
                    if ($sem_description == '' || $sem_description == null) {
                        $discrepancyList.= "Missing Description" . "<br>";
                    } else {
                        $existing = true;
                    }
                    if ($sem_stocknumber == '' || $sem_stocknumber == null) {
                        $discrepancyList.= "<strong>Missing Stock Number (Not Inserted)</strong>" . "<br>";
                    } else {
                        $existing = true;
                    }
                    if ($sem_unitofmesure == '' || $sem_unitofmesure == null) {
                        $discrepancyList.= "Missing Unit of Mesure" . "<br>";
                    } else {
                        $existing = true;
                    }
                    if ($sem_unitval == '' || $sem_unitval == null) {
                        $discrepancyList.= "Missing Unit value" . "<br>";
                    } else {
                        $existing = true;
                    }
                    if ($sem_balpercard == '' || $sem_balpercard == null) {
                        $discrepancyList.= "Missing Balance per Card" . "<br>";
                    } else {
                        $existing = true;
                    }
                    if ($discrepancyList != "") {
                        $toecho.= "<tr>
            <td>";
                        if ($sem_article == '') {
                            $toecho.= "<i class='invalidcolor'>Missing</i>";
                        } else {
                            $toecho.= $sem_article;
                        }
                        $toecho.= "</td>
            <td>";
                        if ($sem_description == '') {
                            $toecho.= "<i class='invalidcolor'>Missing</i>";
                        } else {
                            $toecho.= $sem_description;
                        }
                        $toecho.= "</td>
            <td>";
                        if ($sem_stocknumber == '') {
                            $acceptable = false;
                            $toecho.= "<i class='invalidcolor'>Missing</i>";
                        } else {
                            $toecho.= $sem_stocknumber;
                        }
                        $toecho.= "</td>
            <td>";
                        if ($sem_unitofmesure == '') {
                            $toecho.= "<i class='invalidcolor'>Missing</i>";
                        } else {
                            $toecho.= $sem_unitofmesure;
                        }
                        $toecho.= "</td>
            <td>";
                        if ($sem_unitval == '') {
                            $toecho.= "<i class='invalidcolor'>Missing</i>";
                        } else {
                            $toecho.= $sem_unitval;
                        }
                        $toecho.= "</td>
             <td>";
                        if ($sem_balpercard == '') {
                            $toecho.= "<i class='invalidcolor'>Missing</i>";
                        } else {
                            $toecho.= $sem_balpercard;
                        }
                        $toecho.= "</td>
            <td>" . $discrepancyList . "</td>
          </tr>";
                    }
                }
            break;
        }
        return $toecho;
    }
    public function look_semi_expendable_bystation(Request $req) {
        $semiex = $this->send_get(['tag' => "GET_ALL_SEMI_EXPENDIBLE_BY_STATION", "station_id" => $this->sdmenc($req["station_id"]), "location_id" => $this->sdmenc("all") ]);
        $toecho = "";
        for ($i = 0;$i < count($semiex);$i++) {
            $toecho.= "
        <tr>
        <td>" . $semiex[$i]["article"] . "</td>
        <td>" . $semiex[$i]["description"] . "</td>
        <td>" . $semiex[$i]["stock_number"] . "</td>
        <td>" . $semiex[$i]["unit_of_mesure"] . "</td>
        <td>" . $semiex[$i]["unit_value"] . "</td>
        <td>" . $semiex[$i]["balance_per_card"] . "</td>
        <td>" . $semiex[$i]["on_hand_per_count"] . "</td>
        <td><p class='m-0'>" . $semiex[$i]["office"] . "</p><span class='text-muted'>Room #: " . $semiex[$i]["room_number"] . "</span></td>

        <td>" . $semiex[$i]["remarks"] . "</td>
        <td>" . '
                   <div class="dropdown">
    <a class="btn btn-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-ellipsis-v"></i>
    </a>
  
            
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">

              ';
            $toecho.= "
              <form action='" . route('goto_semi_expendable_item_view') . "' method='GET' target='_blank'>
              <input type='hidden' value='" . $semiex[$i]["item_id"] . "' name='asset_id'>
              <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
              </form>";
            $toecho.= '
                <a class="dropdown-item" href="#" data-toggle="modal" data-itemid="' . $semiex[$i]["item_id"] . '" onclick="preparesemidisposal(this)" data-target="#semidispose"><i class="fas fa-trash"></i> Dispose</a>
              </div>
            </div>

        ' . "</td>
        </tr>
        ";
        }
        return $toecho;
    }
    public function look_all_ofmy_service_center(Request $req) {

        $toecho = "";

        if(session('user_type') == "4"){
            // LOAD SPECIFICALLY FOR CENTER MANAGER
            $out = $this->send_get(['tag'=>"GET_SERVICE_CENTER_BY_EID","user_eid"=>$this->sdmenc(session("user_eid")), "station_id" => $this->sdmenc($req["station_id"]) ]);
            if( count($out) == "0"){
$toecho.= "<option value='' disabled selected>No Service Center Assigned</option>";
            }else{
                $toecho.= "<option value='' disabled selected>Choose here...</option>";
            }
            
        for ($i = 0;$i < count($out);$i++) {
            $extra_info = "";
            $name = "";
            if($out[$i]["items_count"] != "0"){
                 $extra_info = " → " . number_format($out[$i]["items_count"]) . " stored";
                $name = "(" . $out[$i]["office"] . " - " . $out[$i]["room_number"] .")";
            }else{
                $name = $out[$i]["office"] . " - " . $out[$i]["room_number"];
            }

            $toecho.= "<option value='" . $out[$i]["id"] . "'>" . $name .  $extra_info . "</option>";
        }
        }else{
            // EVERYONE ELSE
        $out = $this->send_get(['tag' => "GET_ALL_SERVICE_CENTERS_MYSTATION", "station_id" => $this->sdmenc($req["station_id"]) ]);
        $toecho.= "<option value='' disabled selected>Choose here...</option>";
        for ($i = 0;$i < count($out);$i++) {
            $extra_info = "";
            $name = "";
            if($out[$i]["items_count"] != "0"){
                 $extra_info = " → " . number_format($out[$i]["items_count"]) . " stored";
                $name = "(" . $out[$i]["office"] . " - " . $out[$i]["room_number"] .")";
            }else{
                $name = $out[$i]["office"] . " - " . $out[$i]["room_number"];
            }

            $toecho.= "<option value='" . $out[$i]["id"] . "'>" . $name .  $extra_info . "</option>";
        }


        }

       
        return $toecho;
    }
    public function fire_add_semi_expendible(Request $req) {
        $SchoolID = $this->sdmenc($req["sc_id"]);
        $upload_CSVFILE = $req->file('thecsvfile');
        $file = fopen($upload_CSVFILE, "r");
        $toecho = "";
        // SELECT ALL EXISTING SEMI EXPENDABLE
        $AllSemiExpendable = $this->send_get(['tag' => "GET_ALL_SEMI_EXPENDIBLE_BY_STATION", "station_id" => $this->sdmenc(session("user_school")), "location_id" => $this->sdmenc($req["service_center_id"]) ]);
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
        $current_stocknumber = array();
        while (($getData = fgetcsv($file, 10000, ",")) !== false) {
            if ($rot_count != 0) {
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
                array_push($UploadedData, $sem_article . $sem_description . $sem_stocknumber . $sem_unitofmesure . $sem_unitval . $sem_balpercard . $sem_onhandper . $sem_shortover . $sem_remarks);
                // SEE IF HAS EXACT SAME
                $exact_same = false;
                $data_match = 0;
                for ($ix = 0;$ix < count($AllSemiExpendable);$ix++) {
                    $is_exact = true;
                    //CHECK IF HAS EXISTING STOCK NUMBER AND LOCATION ID
                    if ($sem_stocknumber != "" && $sem_stocknumber != null) {
                        if ($sem_stocknumber == $AllSemiExpendable[$ix]["stock_number"]) {
                            $has_existing_stock_number = true;
                            if (!in_array($sem_stocknumber, $current_stocknumber)) {
                                array_push($current_stocknumber, $sem_stocknumber);
                            } else {
                                $acceptable = false;
                                $discrepancyList.= "<strong>Stock Number already exist/not unique (Not Inserted)</strong>" . "<br>";
                            }
                        }
                    }
                    if ($sem_article !== $AllSemiExpendable[$ix]["article"] || $sem_description !== $AllSemiExpendable[$ix]["description"] || $sem_stocknumber !== $AllSemiExpendable[$ix]["stock_number"] || $sem_unitofmesure !== $AllSemiExpendable[$ix]["unit_of_mesure"] || $sem_unitval !== $AllSemiExpendable[$ix]["unit_value"] || $sem_balpercard !== $AllSemiExpendable[$ix]["balance_per_card"] || $sem_onhandper !== $AllSemiExpendable[$ix]["on_hand_per_count"] || $sem_shortover !== $AllSemiExpendable[$ix]["shortage_overage"] || $sem_remarks !== $AllSemiExpendable[$ix]["remarks"]) {
                        $is_exact = false;
                    }
                    if ($is_exact == true) {
                        // THE DATA HAS MATCH
                        $exact_same = true;
                        $data_match++;
                    }
                }
                if ($data_match == 0) {
                    // DATA IS NEW AND FRESH
                    
                }
                if ($sem_article == '' || $sem_article == null) {
                    $hasmiss = true;
                    $discrepancyList.= "Missing Article" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                if ($sem_description == '' || $sem_description == null) {
                    $hasmiss = true;
                    $discrepancyList.= "Missing Description" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                if ($sem_stocknumber == '' || $sem_stocknumber == null) {
                    $hasmiss = true;
                    $discrepancyList.= "<strong>Missing Stock Number (Not Inserted)</strong>" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                if ($sem_unitofmesure == '' || $sem_unitofmesure == null) {
                    $hasmiss = true;
                    $discrepancyList.= "Missing Unit of Mesure" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                if ($sem_unitval == '' || $sem_unitval == null) {
                    $hasmiss = true;
                    $discrepancyList.= "Missing Unit value" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                if ($sem_balpercard == '' || $sem_balpercard == null) {
                    $hasmiss = true;
                    $discrepancyList.= "Missing Balance per Card" . "<br>";
                } else {
                    $existing = true;
                    $datacount++;
                }
                // Counstruct Discrepancy
                if ($discrepancyList != "") {
                    $tbl_discrepancies.= "<tr>
            <td>" . ($rot_count + 1) . "</td>
            <td>";
                    if ($sem_article == '') {
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_article;
                    }
                    $tbl_discrepancies.= "</td>
            <td>";
                    if ($sem_description == '') {
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_description;
                    }
                    $tbl_discrepancies.= "</td>
            <td>";
                    if ($sem_stocknumber == '') {
                        $acceptable = false;
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_stocknumber;
                    }
                    $tbl_discrepancies.= "</td>
            <td>";
                    if ($sem_unitofmesure == '') {
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_unitofmesure;
                    }
                    $tbl_discrepancies.= "</td>
            <td>";
                    if ($sem_unitval == '') {
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_unitval;
                    }
                    $tbl_discrepancies.= "</td>
             <td>";
                    if ($sem_balpercard == '') {
                        $tbl_discrepancies.= "<i class='invalidcolor'>Missing</i>";
                    } else {
                        $tbl_discrepancies.= $sem_balpercard;
                    }
                    $tbl_discrepancies.= "</td>
            <td>" . $discrepancyList . "</td>
          </tr>";
                }
                if ($existing == true && $datacount >= 1) {
                    // Prove that there's exisiting data
                    $overall_assets++;
                } else {
                    // NO EXISTING DATA
                    $acceptable = false;
                }
                if ($exact_same == true) {
                    //HAS EXACT SAME
                    $acceptable = false;
                    $exactsamecount++;
                }
                if ($datacount == 6) {
                    $perfect_data++;
                }
                if ($existing == true && $hasmiss == true) {
                    // has exisiting data but mussing column(s)
                    $miss_col++;
                }
                if ($acceptable == true) {
                    // INSERT DATA
                    if ($has_existing_stock_number) {
                        // UPDATE DATA ONLY
                        $insert_assetdata = $this->send(['tag' => "UPDATE_SEMI_EXPENDABLE_DATA", "sem_article" => $this->sdmenc($sem_article), "sem_description" => $this->sdmenc($sem_description), "sem_stocknumber" => $this->sdmenc($sem_stocknumber), "sem_unitofmesure" => $this->sdmenc($sem_unitofmesure), "sem_unitval" => $this->sdmenc($sem_unitval), "sem_balpercard" => $this->sdmenc($sem_balpercard), "sem_onhandper" => $this->sdmenc($sem_onhandper), "sem_shortover" => $this->sdmenc($sem_shortover), "sem_remarks" => $this->sdmenc($sem_remarks), "station_id" => $this->sdmenc(session("user_school")), "serv_center_id" => $this->sdmenc($req["service_center_id"]) ], true);
                        $asset_updated++;
                    } else {
                        // ADD NEW DATA TO SEMI EXPENDABLE
                        $insert_assetdata = $this->send(['tag' => "ADD_NEW_SEMI_EXPENDABLE", "sem_article" => $this->sdmenc($sem_article), "sem_description" => $this->sdmenc($sem_description), "sem_stocknumber" => $this->sdmenc($sem_stocknumber), "sem_unitofmesure" => $this->sdmenc($sem_unitofmesure), "sem_unitval" => $this->sdmenc($sem_unitval), "sem_balpercard" => $this->sdmenc($sem_balpercard), "sem_onhandper" => $this->sdmenc($sem_onhandper), "sem_shortover" => $this->sdmenc($sem_shortover), "sem_remarks" => $this->sdmenc($sem_remarks), "station_id" => $this->sdmenc(session("user_school")), "serv_center_id" => $this->sdmenc($req["service_center_id"]) ], true);
                        $asset_inserted++;
                    }
                    $toecho.= json_encode($insert_assetdata);
                } else {
                    $not_inserted++;
                }
            }
            $rot_count++;
        }
        if (count($AllSemiExpendable) != 0) {
            //DELETE ALL OMITTED
            $this->send(['tag' => "RESET_OMITTED_ASSETS_OF_STATION", "station_id" => $this->sdmenc(session("user_school")) ]);
        }
        for ($i = 0;$i < count($AllSemiExpendable);$i++) {
            $hmat = true;
            for ($x = 0;$x < count($UploadedData);$x++) {
                $unifieds = $AllSemiExpendable[$i]["article"] . $AllSemiExpendable[$i]["description"] . $AllSemiExpendable[$i]["stock_number"] . $AllSemiExpendable[$i]["unit_of_mesure"] . $AllSemiExpendable[$i]["unit_value"] . $AllSemiExpendable[$i]["balance_per_card"] . $AllSemiExpendable[$i]["on_hand_per_count"] . $AllSemiExpendable[$i]["shortage_overage"] . $AllSemiExpendable[$i]["remarks"];
                if ($unifieds == $UploadedData[$x]) {
                    $hmat = false;
                }
            }
            if ($hmat == true) {
                $omittedass++;
                $tbl_assetnofound.= "
                <tr>
                  <td>" . $omittedass . "</td>
                  <td>" . htmlentities(substr($AllSemiExpendable[$i]["article"], 0, 25)) . "..." . "</td>
                  <td>" . htmlentities(substr($AllSemiExpendable[$i]["description"], 0, 25)) . "..." . "</td>
                  <td>" . htmlentities($AllSemiExpendable[$i]["stock_number"]) . "</td>
                </tr>
             ";
                // INSERT OMITTED ASSETS TO DATABASE
                $omission_insert = $this->send(['tag' => "INSERT_SEMI_OMITTED_ASSET", "sem_article" => $this->sdmenc($AllSemiExpendable[$i]["article"]), "sem_description" => $this->sdmenc($AllSemiExpendable[$i]["description"]), "sem_stocknumber" => $this->sdmenc($AllSemiExpendable[$i]["stock_number"]), "sem_unitofmesure" => $this->sdmenc($AllSemiExpendable[$i]["unit_of_mesure"]), "sem_unitval" => $this->sdmenc($AllSemiExpendable[$i]["unit_value"]), "sem_balpercard" => $this->sdmenc($AllSemiExpendable[$i]["balance_per_card"]), "sem_onhandper" => $this->sdmenc($AllSemiExpendable[$i]["on_hand_per_count"]), "sem_shortover" => $this->sdmenc($AllSemiExpendable[$i]["shortage_overage"]), "sem_remarks" => $this->sdmenc($AllSemiExpendable[$i]["remarks"]), "station_id" => $this->sdmenc(session("user_school")), "serv_center_id" => $this->sdmenc($req["service_center_id"]) ], true);
            }
        }
        $guessExtension = $upload_CSVFILE->getClientOriginalExtension();
        $origname = $upload_CSVFILE->getClientOriginalName();
        $NewFileName = str_replace(" ", "", session("user_school")) . "--" . date("F_d_Y-g_i_a") . "." . $guessExtension;
        $ResourceFileUpload = $this->send(['tag' => "index_upload_asset_csv", "file_name" => $this->sdmenc($NewFileName), "st_id" => $this->sdmenc(session("user_school")), "empid" => $this->sdmenc(session("user_eid")), "realname" => $this->sdmenc($origname), "file_format" => $this->sdmenc($guessExtension) ], true);
        $upload_CSVFILE->move(public_path() . "/uploads/", $NewFileName);
        // VALIDATE REDINESS
        if ($miss_col == "0") {
            // READY
            $this->send(['tag' => "UPDATE_SEMI_EXPENDABLE_STATUS", "station_id" => $this->sdmenc(session("user_school")), "status" => $this->sdmenc("Ready"), "pref_name" => $this->sdmenc("Inventory Status Semi") ]);
        } else {
            // NOT READY
            $this->send(['tag' => "UPDATE_SEMI_EXPENDABLE_STATUS", "station_id" => $this->sdmenc(session("user_school")), "status" => $this->sdmenc("Not Ready"), "pref_name" => $this->sdmenc("Inventory Status Semi") ]);
        }
        $this->RecordLog("a01.1");
        $tbl_discrepancies = gzcompress($tbl_discrepancies);
        $tbl_assetnofound = gzcompress($tbl_assetnofound);
        return redirect()->route("goto_semi_expendable_validationpage", ["overallassets" => $overall_assets, "perfectdata" => $perfect_data, "missingcolumns" => $miss_col, "insertedassets" => $asset_inserted, "exactsame" => $exactsamecount, "notinserted" => $not_inserted, "ass_withdesc" => $tbl_discrepancies, "ass_nofount" => $tbl_assetnofound, "ass_omitted" => $omittedass, "ass_updated" => $asset_updated]);
    }
    public function fire_preview_csv_semiexpendable(Request $req) {
        $csv_file = $req->file('thecsvfile');
        $file = fopen($csv_file, "r");
        $toecho = "";
        $previewcount = 0;
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            if ($previewcount != 0 && count($getData) <= 9) {
                $toecho.= "<tr>";
                for ($i = 0;$i < 9;$i++) {
                    $toecho.= "<td>" . $getData[$i] . "</td>";
                }
                $toecho.= "</tr>";
                if ($previewcount >= 3) {
                    break;
                }
            }
            $previewcount++;
        }
        if ($toecho == '') {
            $toecho = "
          <tr>
          <td>Semi Expendable CSV file is not valid.</td>
          </tr>
          ";
        } else {
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
    public function fire_add_new_semi_expendable_registry() {
        $toret = $this->send(['tag' => "ADD_NEW_SEMI_EXPENDABLE"]);
    }
    public function rep_all_om_ass(Request $req) {
        $tag = $this->sdmenc("report_all_omitted_assets");
        $reason = $this->sdmenc("2");
        $propertynumber = $this->sdmenc("");
        if (isset($req["propertynumber"])) {
            $propertynumber = $this->sdmenc($req["propertynumber"]);
        }
        $remarks = $this->sdmenc($req["remarks"]);
        $station_id = $this->sdmenc(session("user_school"));
        $user_eid = $this->sdmenc(session("user_eid"));
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "reason" => $reason, "propertynumber" => $propertynumber, "remarks" => $remarks, "user_eid" => $user_eid, "station_id" => $station_id, ]]);
        $output = $this->sdmdec($xresult->getBody()->getContents());
        Alert::success("All Asset Reported!");
        return redirect()->back();
    }
    public function display_omitted_of_station(Request $req) {
        $tag = $this->sdmenc("disp_om_ass_rebysta");
        $mystation = $this->sdmenc($req["selected_realid"]);
        $usertype = $this->sdmenc(session("user_type"));
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "mystation" => $mystation, "usertype" => $usertype, ]]);
        $output = json_decode($this->sdmdec($result->getBody()->getContents()), true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
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
            $reason.= "<hr>";
            if ($output[$i]["om_remarks"] != "") {
                $reason.= "<pre><i class='far fa-comment-alt'></i> " . $output[$i]["om_remarks"] . "</pre>";
            }
            if ($output[$i]["om_usereid"] != "") {
                $reason.= "<pre><i class='fas fa-portrait'></i> EMPLOYEE ID #" . $output[$i]["om_usereid"] . "</pre>";
            }
            if ($output[$i]["om_timestamp"] != "") {
                $reason.= "<hr><span class='text-muted'>" . date("F d, Y g:i a", strtotime($output[$i]["om_timestamp"])) . "</span>";
            }
            $toecho.= "
        <tr>
        <td>" . $output[$i]["property_number"] . "</td>
        <td>" . $output[$i]["asset_item"] . "</td>
        <td>" . $output[$i]["current_condition"] . "</td>
        <td>" . $output[$i]["service_center"] . "</td>
        <td>" . $output[$i]["room_number"] . "</td>
         <td>" . '<button class="btn btn-link"   data-html="true"  title="Reason" data-toggle="popover" data-trigger="hover" data-content="' . $reason . '">View Reason</button>' . "</td>
        ";
        }
        return $toecho;
    }
    public function rep_om_sing(Request $req) {
        $tag = $this->sdmenc("report_omitted_now_singleton");
        $idofassetinregistry = $this->sdmenc($req["idofassetinregistry"]);
        $reason = $this->sdmenc($req["reason"]);
        $propertynumber = $this->sdmenc("");
        if (isset($req["propertynumber"])) {
            $propertynumber = $this->sdmenc($req["propertynumber"]);
        }
        $remarks = $this->sdmenc("");
        if (isset($req["remarks"])) {
            $remarks = $this->sdmenc($req["remarks"]);
        }
        $station_id = $this->sdmenc(session("user_school"));
        $user_eid = $this->sdmenc(session("user_eid"));
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "idofassetinregistry" => $idofassetinregistry, "reason" => $reason, "propertynumber" => $propertynumber, "remarks" => $remarks, "user_eid" => $user_eid, "station_id" => $station_id, ]]);
        $output = $this->sdmdec($xresult->getBody()->getContents());
        Alert::success("Asset Reported!");
        return redirect()->back();
    }
    public function get_station_in_statuses() {
        $output = $this->send_get(["tag"=>"GET_STATION_STATUSES"]);
        // return $output;
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $isready_capital = $output[$i]["pref_value"];
            if ($isready_capital == "Ready") {
                $isready_capital = '<span style="color: #44bd32;"><i class="fas fa-check"></i></span>';
            } else {
                $isready_capital = '<span style="color: #c23616;"><i class="fas fa-times"></i></span>';
            }
            $outx = $this->send(['tag' => "GET_STATUS_SEMI", "station_id" => $this->sdmenc($output[$i]["pref_station_id"]) ]);
            $isready_semiexpendable = "";
            if (count($outx) == 0 || $outx[0]["pref_value"] != "Ready") {
                $isready_semiexpendable = '<span style="color: #c23616;"><i class="fas fa-times"></i></span>';
            } else {
                $isready_semiexpendable = '<span style="color: #44bd32;"><i class="fas fa-check"></i></span>';
            }
            $toecho.= "<tr>
        <td>" . $output[$i]["name"] . "</td>
        <td><center>" . $isready_capital . "</center></td>
         <td><center>" . $isready_semiexpendable . "</center></td>
       </tr>";
        }
        return $toecho;
    }
    public function get_ser_fqrs(Request $req) {
        $output = $this->send_get(["tag"=>"get_ser_fqrs","station_id"=>$this->sdmenc(session("user_school"))]);

        $toecho = "<option selected value='" . $this->sdmenc("all") . "~all'>Show All</option>";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<option value='" . $this->sdmenc($output[$i]["office"]) . "~" . $output[$i]["room_number"] . "'>" . $output[$i]["office"] . " (" . $output[$i]["room_number"] . ")" . "</option>";
        }
        return $toecho;
    }
    public function get_qr_as_sbyer(Request $req) {
        $output = $this->send_get(["tag"=>"getassqrbyroomfilter","station_id" => $this->sdmenc(session("user_school")), "service_center" => $this->sdmenc($this->sdmdec($req["service_center"])), "room_number" =>$this->sdmenc($req["room_number"]), "assettype" => $this->sdmenc($req["asset_type"])]);

        $toecho = "";
        if ($req["asset_type"] == "co") {
            for ($i = 0;$i < count($output);$i++) {
                $toecho.= '
        <tr>
          <td>
            <div class="form-check">
              <input data-propno="' . $output["$i"]["property_number"] . '" class="form-check-input checkbox_y" type="checkbox" value="" id="defaultCheck1">
            </div>
          </td>
          <td>' . $output[$i]["property_number"] . '</td>
          <td>' . $output[$i]["asset_item"] . '</td>
          <td>' . $output[$i]["asset_classification"] . '</td>
          <td>' . $output[$i]["current_condition"] . '</td>
          <td>' . $output[$i]["service_center"] . '</td>
          <td>' . $output[$i]["room_number"] . '</td>
        </tr>

       ';
            }
        } else {
            //SEMI EXPENDABLE
            for ($i = 0;$i < count($output);$i++) {
                $toecho.= '
        <tr>
          <td>
            <div class="form-check">
              <input data-propno="' . $output[$i]["stock_number"] . '" class="form-check-input checkbox_y" type="checkbox" value="" id="defaultCheck1">
            </div>
          </td>
          <td>' . $output[$i]["stock_number"] . '</td>
          <td>' . $output[$i]["description"] . '</td>
          <td>' . $output[$i]["article"] . '</td>
          <td>' . $output[$i]["unit_of_mesure"] . '</td>
          <td>' . $output[$i]["office"] . '</td>
          <td>' . $output[$i]["room_number"] . '</td>
        </tr>

       ';
            }
        }
        return $toecho;
    }
    public function get_report(Request $req) {
        $tag = $this->sdmenc("grep_bygroup");
        $columnname = $this->sdmenc($req["columnname"]);
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "colname" => $columnname, "station_id" => $this->sdmenc(session("user_school")), ]]);
        $output = json_decode($this->sdmdec($xresult->getBody()->getContents()), true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<tr>";
            $colval = "";
            if ($req["columnname"] != "date_of_acquisition") {
                // NORMAL
                $colval = $output[$i][$req["columnname"]];
            } else {
                // CONVERTED
                $colval = date("Y", strtotime($output[$i][$req["columnname"]]));
            }
            $toecho.= "<td>" . $colval . "</td>";
            $toecho.= "<td>


         <div class='dropdown'>
           <a class='btn btn-light dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
           " . $output[$i]["valcount"] . "
           </a>
         
           <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
             <a class='dropdown-item' href='#' data-toggle='modal' data-target='#modal_assetview' data-colname='" . $req["columnname"] . "' data-colval='" . $colval . "' onclick='fetchallassets(this)'><i class='fas fa-binoculars'></i> View</a>
            <form action='" . route("tprint") . "' method='get' style='display:none;' target='_blank'>" . csrf_field() . "
            <input type='hidden' value='" . $req["columnname"] . "' name='colname'>
            <input type='hidden' value='" . $colval . "' name='colval'>
           <button class='dropdown-item' type='submit'>Download CSV</button>
            </form>
           </div>
         </div>


       </td>
        </tr>";
        }
        return $toecho;
    }
    public function extgroupedconts(Request $req) {
        $tag = $this->sdmenc("getextractedgrouprep");
        $column_name = $this->sdmenc($req["column_name"]);
        $column_value = $this->sdmenc($req["column_value"]);
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "school_id" => $this->sdmenc(session("user_school")), "column_name" => $column_name, "column_value" => $column_value, ]]);
        $output = json_decode($this->sdmdec($xresult->getBody()->getContents()), true);
        $toecho = "";
        $isown = false;
        if ($req["station_number"] == session("user_school")) {
            $isown = true;
        }
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "
        <tr>
        <td>" . $output[$i]["property_number"] . "</td>
        <td>" . $output[$i]["asset_item"] . "</td>
        <td>" . $output[$i]["asset_classification"] . "</td>
        <td>" . $output[$i]["current_condition"] . "</td>
        <td>" . $output[$i]["service_center"] . "</td>
        <td>" . $output[$i]["room_number"] . "</td>
        <td>
        ";
            if ($isown) {
                $toecho.= "
        <div class='dropdown'>
    <a class='btn btn-link' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
      <i class='fas fa-ellipsis-v'></i>
    </a>
  

        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>


        <form action='" . route("asset_view") . "' method='GET' target='_blank'>
        <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
        <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
        </form>

        ";
                if (session("user_type") < "4") {
                    $toecho.= "<a class='dropdown-item' href='#' data-toggle='modal' onclick='OpenAssetToDispose(this)' data-asset_id='" . $output[$i]["id"] . "' data-target='#m_remove'>Dispose</a>
      </div>
      </div>
      </td>
      </tr>
      ";
                }
            } else {
                $toecho.= "
        <div class='dropdown'>
    <a class='btn btn-link' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
      <i class='fas fa-ellipsis-v'></i>
    </a>
  
        <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>


        <form action='" . route("asset_view") . "' method='GET' target='_blank'>
        <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
        <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
        </form>

        ";
            }
        }
        return $toecho;
    }
    public function get_tobegen_repcount(Request $req) {
        $tag = $this->sdmenc("get_tobegenCount");
        $rn = $this->sdmenc($req["rn"]);
        $cc = $this->sdmenc($req["cc"]);
        $station_id = $this->sdmenc($req["station_id"]);
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "school_id" => $station_id, "rn" => $rn, "cc" => $cc, "inv_year" => $this->sdmenc($req["inv_year"]), "inv_month" => $this->sdmenc($req["inv_month"]) ]]);
        $output = $this->sdmdec($xresult->getBody()->getContents());
        return $output;
    }
    public function findnewservcen() {
        $tag = $this->sdmenc("findservicecenternew");
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $this->sdmenc(session("user_school")), ]]);
        $output = json_decode($this->sdmdec($xresult->getBody()->getContents()), true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            if ($output[$i]["service_center"] != "none") {
                $toecho.= "<tr>
            <td>" . $output[$i]["service_center"] . "</td>
            <td>" . $output[$i]["room_number"] . "</td>
            <td>" . $output[$i]["holding_items"] . "</td>
          </tr>";
            }
        }
        return $toecho;
    }
    public function impallfoundsercen() {
        $tag = $this->sdmenc("importallservice_centers");
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $this->sdmenc(session("user_school")), ]]);
        $output = $this->sdmdec($xresult->getBody()->getContents());
        // return $output;
        if ($output == "true") {
            Alert::success("All Service Centers has been imported!");
            return redirect()->route("stationmy");
        } else {
            Alert::error("Failed to import service centers!");
            return redirect()->route("stationmy");
        }
    }
    public function passchange(Request $req) {
        $tag = $this->sdmenc("passchangenow");
        $olpas = $this->sdmenc($req["olpas"]);
        $newpas = $this->sdmenc($req["newpas"]);
        $renewpas = $this->sdmenc($req["renewpas"]);
        if ($newpas == $renewpas) {
            $client = new \GuzzleHttp\Client();
            $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "empid" => $this->sdmenc(session("user_eid")), "olpas" => $olpas, "newpas" => $newpas, ]]);
            $mynameschool = $this->sdmdec($xresult->getBody()->getContents());
            if ($mynameschool == "true") {
                Alert::success("Password Updated!");
                return redirect()->route("myaccount");
            } else {
                Alert::error("Old password do not match.");
                return redirect()->route("myaccount");
            }
        } else {
            Alert::error("New password do not match.");
            return redirect()->route("myaccount");
        }
    }
    public function count_all_created_asset_loc() {
        $output = $this->send_get(["tag"=>"count_allcreated_assloc","school_id" => $this->sdmenc(session("user_school"))],true);
        return $output;
    }
    public function edit_sc_info(Request $req) {
        $tag = $this->sdmenc("editscinf");
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "st_id" => $this->sdmenc($req["st_id"]), "school_id" => $this->sdmenc($req["school_id"]), "st_name" => $this->sdmenc($req["st_name"]), ]]);
        $mynameschool = $this->sdmdec($xresult->getBody()->getContents());
        Alert::success("Station Updated!");
        return redirect()->route("sta_amanagement");
    }
    public function delstationnow(Request $req) {
        $tag = $this->sdmenc("del_st_now");
        $st_id = $this->sdmenc($req["st_id"]);
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "st_id" => $st_id, ]]);
        $mynameschool = $this->sdmdec($xresult->getBody()->getContents());
        Alert::success("Station Deleted!");
        return redirect()->route("sta_amanagement");
    }
    public function view_all_st_names(Request $req) {
        $tag = $this->sdmenc("view_all_station_names");
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, ]]);
        $mynameschool = $this->sdmdec($xresult->getBody()->getContents());
        return $mynameschool;
    }
    public function addnewsta_xnow(Request $req) {
        $tag = $this->sdmenc("station_new_add");
        $st_name = $this->sdmenc($req["st_name"]);
        $st_id = $this->sdmenc($req["st_id"]);
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "st_name" => $st_name, "st_id" => $st_id, ]]);
        $mynameschool = $this->sdmdec($xresult->getBody()->getContents());
        if ($mynameschool == "true") {
            Alert::success("Station added!");
        } else if ($mynameschool == "exist") {
            Alert::error("Station already exist!");
        } else {
            Alert::error("Unable to add station!");
        }
        return redirect()->route("sta_amanagement");
    }
    public function get_school_fullname(Request $req) {
        $output = $this->send_get(["tag"=>"get_sc_name","sc_id"=>$this->sdmenc($req["stationid"])],true);
        return $output;
    }
    public function search_asstov(Request $req) {
        $tag = $this->sdmenc("search_histo");
        $search_keyword = $this->sdmenc($req["searchkey"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "search_keyword" => $search_keyword, ]]);
        $result = $this->sdmdec($result->getBody()->getContents());
        return $result;
    }
    public function get_export_history() {
        $tag = $this->sdmenc("get_exporthist");
        $station_id = $this->sdmenc(session("user_school"));
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $station_id, "employee_id" => $this->sdmenc(session("user_eid")), ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $output = json_decode($output, true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<tr>
        
         <td>" . $output[$i]["total_csv"] . "</td>
         <td>" . $output[$i]["inserted"] . "</td>
         <td>" . $output[$i]["updated"] . "</td>
          <td>" . $output[$i]["incomplete"] . "</td>
          <td>" . $output[$i]["notinserted"] . "</td>
           <td>" . date("F d, Y g:i a", strtotime($output[$i]["timestamp"])) . "</td>
        </tr>";
        }
        return $toecho;
    }
    public function get_trhisto() {
        $output = $this->send_get(["tag"=>"gettrahistory","station_id" => $this->sdmenc(session("user_school")), "employee_id" => $this->sdmenc(session("user_eid"))]);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<tr>
        
         <td><span style='display:none;'>" . date("Y-m-d H:i:s", strtotime($output[$i]["timestamp"])) . "</span>" . "<span class='float-right text-muted'>" . $this->DateExplainder($output[$i]["timestamp"]) . "</span>" . date("F d, Y g:i a", strtotime($output[$i]["timestamp"])) . "</td>
         <td>" . $output[$i]["action_taken"] . "</td>
         <td>" . ucwords(strtolower($output[$i]["username"])) . "</td>
        </tr>";
        }
        return $toecho;
    }
    public function lod_dis_indetail(Request $req) {
        $output = $this->send_get(["tag"=>"get_discrepancies_indetail","station_id"=>$this->sdmenc($req["stationid"])],true);
        return $output;
    }
    public function inventory_checkif_ready() {
        //CHECK CAPITAL OUTLAY REDINESS
        $output = $this->send_get(["tag"=>"inventory_checkif_ready","station_id" => $this->sdmenc(session("user_school"))]);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            // CHECK TYPE OF ASSET
            $asset_type_name = "";
            $missing_cases = "";
            if ($output[$i]["pref_name"] == "Inventory Status") {
                $asset_type_name = "Capital Outlay";
                $missing_cases = "missing property number, location, etc.";
            } else if ($output[$i]["pref_name"] == "Inventory Status Semi") {
                $asset_type_name = "Semi-Expendable";
                $missing_cases = "missing stock number, balance per card, etc.";
            }
            if ($asset_type_name != "") {
                if ($output[$i]["pref_value"] == "Ready") {
                    $toecho.= "
            <div class='card mb-3'>
            <div class='card-body'>
            <span class='float-right text-muted'>READY</span>
            <h5 class='text-success mb-3'><i class='fas fa-check'></i> " . $asset_type_name . "</h5>
            <p class='mt-0'>Congratulations! Your " . $asset_type_name . " is now ready for inventory, click the button below to proceed to the inventory page.</p>
            <a class='btn btn-success btn-sm mt-3' href=" . route('asset_scanned') . ">Start Inventory</a>
            </div>
            </div>";
                } else {
                    $toecho.= "
            <div class='card mb-3'>
            <div class='card-body'>
            <span class='float-right text-muted'>NOT READY</span>
            <h5 class='text-danger mb-3'><i class='fas fa-times'></i> " . $asset_type_name . "</h5>
            <p class='mt-0'>Your " . $asset_type_name . " asset still has some discrepancies left like " . $missing_cases . "</p>
            <a class='btn btn-secondary btn-sm mt-3' href=" . route('assetregistry') . ">Fix Issues</a>
            </div>
            </div>";
                }
            }
        }
        return $toecho;
    }
    public function loadassetvalsum(Request $re) {
        $station_id = $this->sdmenc($re["selected_realid"]);
        $total_assets = "0";
        $discrepancies = "0";
        $last_login = "0";
        $last_trans = "0";
        $omittedcount = "0";
        // GET TOTAL ASSETS COUNT IN CLOUD
        $tag = $this->sdmenc("get_total_assets");
        // $station_id = $this->sdmenc(session("user_school"));
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $station_id, ]]);
        $total_assets = $this->sdmdec($result->getBody()->getContents());
        $total_assets = number_format($total_assets);
        // GET ASSET DISCREPANCY COUNT
        $tag = $this->sdmenc("read_asset_discrepancy");
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $station_id, ]]);
        $discrepancies = $this->sdmdec($result->getBody()->getContents());
        // GET LAST LOGIN TO THE SYSTEM
        if ($re["selected_realid"] == session("user_school")) {
            $out = $this->send_get(['tag' => "GET_LAST_DATE_CODEOF", "station_id" => $this->sdmenc(session("user_school")), "logcode" => $this->sdmenc("a01") ]);
            if (count($out) != 0) {
                $last_login = date("M d, Y g:i a", strtotime($out[0]["timestamp"])) . "<small class='text-muted float-right'>" . $this->DateExplainder($out[0]["timestamp"]) . "</small>";
            } else {
                $last_login = "N/A";
            }
        } else {
            $last_login = "Private";
        }
        if ($re["selected_realid"] == session("user_school")) {
            //GET LAST TRANSACTION DATE
            $tag = $this->sdmenc("get_last_act_log");
            $station_id = $this->sdmenc(session("user_school"));
            $client = new \GuzzleHttp\Client();
            $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $station_id, "employee_id" => $this->sdmenc(session("user_eid")), ]]);
            $output = $this->sdmdec($result->getBody()->getContents());
            $last_trans = $output;
        } else {
            $last_trans = "Private";
        }
        // GET OMITTED COUNT
        $tag = $this->sdmenc("get_omitted_count");
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "st_id" => $this->sdmenc($re["selected_realid"]), ]]);
        $omittedcount = $this->sdmdec($result->getBody()->getContents());
        $is_own = false;
        if ($re["selected_realid"] == session("user_school")) {
            $is_own = true;
        } else {
            $is_own = false;
        }
        if ($last_login == '') {
            $last_login = "No Record";
        }
        if ($last_trans == '') {
            $last_trans = "No Record";
        }
        $not_inserted_co_count = $this->send(['tag' => "GET_RECENT_NOT_ADDED_ASSET_CO_COUNT", "stationid" => $this->sdmenc($re["selected_realid"]) ]);
        $toecho = "<tr>
            <td>" . $total_assets . "</td>


            <td>
              <form action='" . route("lod_discrep_indetail") . "' method='get'>
              <input type='hidden' value='" . $is_own . "' name='isown'>
               <input type='hidden' value='" . $re["selected_realid"] . "' name='stationid'>
              <button type='submit' class='btn btn-link' style='margin:0px; padding:0px;' title='Click to view discrepancies in detail.'>" . $discrepancies . "</button>
              </form>
            </td>


            <td><a href='#' data-toggle='modal' data-target='#notinserted_co' onclick='load_not_inserted_co()'>" . $not_inserted_co_count[0] . "</a></td>


            <td><a href='" . route('gotoomitted') . "?station_id=" . $re["selected_realid"] . "'>" . $omittedcount . "</a></td>
            

            <td>" . $last_login . "</td>
             
            
          </tr>";
        return $toecho;
    }
    public function get_om_itms_astbls(Request $req) {
        $tag = $this->sdmenc("load_om_itms");
        $station_id = $this->sdmenc($req["sid"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $station_id, ]]);
        $output = json_decode($this->sdmdec($result->getBody()->getContents()), true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<tr>
                <td>" . $output[$i]["property_number"] . "</td>
                <td>" . $output[$i]["asset_item"] . "</td>
                <td>" . $output[$i]["asset_classification"] . "</td>
                <td>" . $output[$i]["current_condition"] . "</td>
                <td>" . $output[$i]["asset_location"] . "</td>
                <td>" . $output[$i]["room_number"] . "</td>
              ";
            $toecho.= "
        <td> <div class='dropdown'>
    <a class='btn btn-link' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
      <i class='fas fa-ellipsis-v'></i>
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
    public function ignore_single_omitted(Request $req) {
        $tag = $this->sdmenc("ignore_single_omitt");
        $station_id = $this->sdmenc(session("user_school"));
        $asset_id = $this->sdmenc($req["asset_id"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $station_id, "asset_id" => $asset_id, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        if ($output == "true") {
            Alert::success("Successfully ignored!");
            return redirect()->route("gotoomitted");
        } else {
            Alert::error("Error in ignoring the asset!");
            return redirect()->route("gotoomitted");
        }
    }
    public function clearallomitted(Request $req) {
        $tag = $this->sdmenc("clear_omitted_assets_now");
        $station_id = $this->sdmenc(session("user_school"));
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $station_id, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        if ($output == "true") {
            Alert::success("All omitted asset(s) ignored successfully!");
            return redirect()->route("gotoomitted");
        } else {
            Alert::error("Error in ignoring omitted asset(s)!");
            return redirect()->route("gotoomitted");
        }
    }
    public function lodstaprefx(Request $req) {
        $tag = $this->sdmenc("lod_sta_prefx");
        $station_id = $this->sdmenc(session("user_school"));
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $station_id, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $output = json_decode($output, true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<tr>
                <td>" . $output[$i]["pref_name"] . "<br><small class='text-muted'>" . $output[$i]["pref_description"] . "</small></td>
                <td>" . $output[$i]["pref_value"] . "</td>
              </tr>";
        }
        return $toecho;
    }
    public function removelocation(Request $req) {
        $tag = $this->sdmenc("remolocnow");
        $loc_id = $this->sdmenc($req["loc_id"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "loc_id" => $loc_id, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        if ($output == "true") {
            Alert::success("Removed!");
            return redirect()->route("stationmy");
        } else {
            Alert::warning("Unable to Remove!");
            return redirect()->route("stationmy");
        }
    }
    public function addnewassloc(Request $req) {
        $tag = $this->sdmenc("addnewassetlocation");
        $xstation = $this->sdmenc($req["xstation"]);
        $xoffice = $this->sdmenc($req["xoffice"]);
        $xroomnum = $this->sdmenc($req["xroomnum"]);
        $xincharge = $this->sdmenc($req["incharge"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "xstation" => $xstation, "xoffice" => $xoffice, "xroomnum" => $xroomnum, "xincharge" => $xincharge, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        if ($output == "true") {
            Alert::success("Location added!");
            return redirect()->route("stationmy");
        } else if ($output == "exist") {
            Alert::warning("Location already exist!");
            return redirect()->route("stationmy");
        } else {
            Alert::error("Unable to add location");
            return redirect()->route("stationmy");
        }
    }
    public function get_futh_val_ass_reg(Request $req) {
        $tag = $this->sdmenc("get_last_import_log");
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "st_name" => $st_name, "st_id" => $st_id, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        return $output;
    }
    public function get_all_last_upload_log() {
        $tag = $this->sdmenc("get_last_import_log");
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $this->sdmenc(session("user_school")), ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        if ($output != "false") {
            $output = json_decode($output, true);
            $output[0]["timestamp"] = date("F d, Y g:i a", strtotime($output[0]["timestamp"]));
            $output = json_encode($output);
        }
        return $output;
    }
    public function new_station(Request $req) {
        $tag = $this->sdmenc("add_new_station");
        $st_name = $this->sdmenc($req["st_name"]);
        $st_id = $this->sdmenc($req["st_id"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "st_name" => $st_name, "st_id" => $st_id, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        Alert::success("Station Added Successfully!");
        return redirect()->route("manstat");
    }
    public function stat_del_now(Request $req) {
        $tag = $this->sdmenc("stat_deletion_technology");
        $sc_id_todelete = $this->sdmenc($req["sc_id_todel"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "sc_id_todel" => $sc_id_todelete, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        Alert::success("School Removed successfully!");
        return redirect()->route("manstat");
    }
    public function load_stat_enc() {
        $output = $this->send_get(["tag"=>"lod_all_enc_station"]);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<tr>
                <td>" . $output[$i]["name"] . "</td>
                <td>" . $output[$i]["school_id"] . "</td>
                <td>
                  <button class='btn btn-sm btn-danger' data-toggle='modal' data-sc_id='" . $output[$i]["id"] . "' onclick='openremoveschool(this)' data-target='#modal_delsc'>Remove</button>
                </td>
              </tr>";
        }
        return $toecho;
    }
    public function lodasslocenc() {
        $tag = $this->sdmenc("loadallassetlocation");
        $station_id = $this->sdmenc(session("user_school"));
        $user_type = $this->sdmenc(session("user_type"));
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "user_school" => $station_id, "user_type" => $user_type, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $output = json_decode($output, true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $scname = $output[$i]["name"];
            if ($scname == '') {
                $scname = "Unknown";
            }
            $toecho.= "<tr>
                <td>" . $output[$i]["office"] . "</td>
                <td>" . $output[$i]["room_number"] . "</td>
                <td>";
            // GET STATION ACCOUNT NAMES
            $tag = $this->sdmenc("get_employeename_byeid");
            $client = new \GuzzleHttp\Client();
            $res_2 = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "empid" => $this->sdmenc($output[$i]["incharge_eid"]), "station_id" => $station_id, ]]);
            $out_2 = $this->sdmdec($res_2->getBody()->getContents());
            if ($out_2 == '') {
                $toecho.= "<span class='text-muted'>(none)<span>";
            } else {
                $toecho.= ucwords(strtolower($out_2));
            }
            $toecho.= "</td>
                <td>

                 <div class='dropdown'>
    <a class='btn btn-link' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
      <i class='fas fa-ellipsis-v'></i>
    </a>
  
                  <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>

                    <a class='dropdown-item' data-toggle='modal' data-target='#editservicecentermodal' href='#' onclick='showupdateincharge(this)' data-cont_id='" . $output[$i]["locid"] . "'
                                                          data-servicecen='" . $output[$i]["office"] . "'
                                                          data-roomnum='" . $output[$i]["room_number"] . "'
                                                          data-incha='" . $output[$i]["incharge_eid"] . "'>Edit</a>

                     <a data-toggle='modal' data-target='#myremovelocmodal' class='dropdown-item' onclick='showremovelocmodal(this)' data-cont_id='" . $output[$i]["locid"] . "' href='#'>Remove</a>
                  </div>
                </div>

               
                </td>
              </tr>";
        }
        return $toecho;
    }
    public function chainsecnow(Request $req) {
        $tag = $this->sdmenc("changeinchargenowplease");
        $id_of_something = $this->sdmenc($req["id_of_something"]);
        $incharge = $this->sdmenc($req["incharge"]);
        $edit_servicenter = $this->sdmenc(htmlentities($req["edit_servicenter"]));
        $edit_roomnumber = $this->sdmenc(htmlentities($req["edit_roomnumber"]));
        $client = new \GuzzleHttp\Client();
        $res_2 = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "id_of_something" => $id_of_something, "incharge" => $incharge, "edit_servicenter" => $edit_servicenter, "edit_roomnumber" => $edit_roomnumber, ]]);
        $output = $this->sdmdec($res_2->getBody()->getContents());
        if ($output == "true") {
            Alert::success("Person In-Charge Updated!");
            return redirect()->route("stationmy");
        } else {
            Alert::error("Failed to update!");
            return redirect()->route("stationmy");
        }
    }
    public function addrem(Request $req) {
        $tag = $this->sdmenc("addnewreminder");
        $title = htmlentities($this->sdmenc($req["remindertitle"]));
        $desc = htmlentities($this->sdmenc($req["reminderdeadline"]));
        $deadline = $this->sdmenc("none");
        if (isset($req["reminderdescription"])) {
            $deadline = $this->sdmenc($req["reminderdescription"]);
        }
        $audiencetype = $this->sdmenc($req["remindwhocansee"]);
        $reminderorigineid = $this->sdmenc(session("user_eid"));
        $client = new \GuzzleHttp\Client();
        $res_2 = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "remindertitle" => $title, "reminderdeadline" => $desc, "reminderdescription" => $deadline, "remindwhocansee" => $audiencetype, "reminderorigineid" => $reminderorigineid, ]]);
        $output = $this->sdmdec($res_2->getBody()->getContents());
        if ($output == "true") {
            Alert::success("New Reminder Added!");
            return redirect()->route("manage_reminders");
        } else {
            Alert::error("Failed to add reminder!");
            return redirect()->route("manage_reminders");
        }
    }
    public function getremorgi() {
        $output = $this->send_get(["tag"=>"getallreminderbyoriginnoe","reminderorigineid"=>$this->sdmenc(session("user_eid"))]);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "
             <tr>
              <td><div class='dropdown'>
                    <a class='btn btn-link mt-0 mb-0 p-0 dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                     " . $output[$i]["title"] . "
                    </a>
                  
                    <div class='dropdown-menu' aria-labelledby='dropdownMenuLink'>
                      <a class='dropdown-item' data-toggle='modal' data-target='#modal_delete' onclick='opendeletereminder(this)' data-oid='" . $output[$i]["id"] . "' href='#'><i class='far fa-trash-alt'></i> Delete</a>
                    </div>
                  </div></td>
              <td><pre>" . $output[$i]["description"] . "</pre></td>
              <td>";
            $remtype = $output[$i]["viewtype"];
            switch ($remtype) {
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
            $toecho.= strtoupper($remtype);
            $toecho.= "</td>
              <td>";
            if ($output[$i]["deadline"] != "") {
                $toecho.= date("F d, Y g:i a", strtotime($output[$i]["deadline"]));
            } else {
                $toecho.= "<span class='text-muted'>N/A</span>";
            }
            $toecho.= "</td>
              <td><span style='display:none;'>" . $output[$i]["dateposted"] . "</span>" . date("F d, Y g:i a", strtotime($output[$i]["dateposted"])) . "<p class='mt-0 mb-0 text-muted'>" . $this->DateExplainder($output[$i]["dateposted"]) . "</p>" . "</td>
             </tr>";
        }
        return $toecho;
    }
    public function findservcount(Request $req) {
        $tag = $this->sdmenc("getservicecentercount");
        $client = new \GuzzleHttp\Client();
        $res_2 = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $this->sdmenc(session("user_school")), ]]);
        $output = $this->sdmdec($res_2->getBody()->getContents());
        return $output;
    }
    public function lodnewannounce(Request $req) {
        $output = $this->send_get(["tag"=>"getrecentreminders", "reminderorigineid" => $this->sdmenc(session("user_type")), "userid" => $this->sdmenc(session("user_eid"))]);
        $toecho = "";
        $system_suggestion = array("
              <div class='alert alert-secondary pt-5 pb-5 announcement_card mb-4 card-shadow'>
              <h5 class='text-dark'>Suggestion</h5>
              <p class='text-dark'>Let's learn these simple steps to kickstart how Innoventory works.</p>
              <a href='/innoventory/how_to' class='btn btn-sm btn-primary'>Go to Tutorial</a>
              </div>
              ", "
              <div class='text-dark alert alert-secondary pt-5 pb-5 announcement_card mb-4 card-shadow'>
              "  . 
              "<div class='iconize' style='background-color: #1B8EF5; margin-bottom: 10px;'>
                <center> <span style='font-size: 20px;'><i class='fas fa-box'></i></span> </center>
              </div>
<div class='iconize' style='background-color: #4EDD57; margin-bottom: 10px;'>
                <center> <span style='font-size: 20px;'><i class='fas fa-boxes'></i></span> </center>
              </div>"
               . "
              <h5 class='text-primary'>Capital Outlay and Semi-Expendable Templates</h5>
              <p class='text-muted'>Get them by going to Resources page > Templates to download a blank csv template.</p>
              
              </div>
              ", "
              <div class='text-dark alert alert-secondary pt-5 pb-5 announcement_card mb-4 card-shadow'>
              <h5 class='text-primary'>Discover how you can post your own Announcement</h5>
              <p class='text-muted'>If you are a Property Custodian or Property Admin, you can post your own reminder in Innoventory by going to the reminders page.</p>
              <ul>
                <li>See reminders, announcements posted by your Admin or Property Custodian</li>
                <li>Let your station see your reminder, announcements</li>
              <ul>
              </div>
              ", "
              <div class='text-dark alert alert-light pt-5 pb-5 announcement_card mb-4 card-shadow'>
              <h5 class='text-info mb-0'>Your omitted assets wont affect your rediness for inventory.</h5>
              <hr>
               <span class='text-muted'><i class='fas fa-info-circle'></i> Innoventory Infocard</span>
              </div>
              ", "
              <div class='text-dark alert alert-light pt-5 pb-5 announcement_card mb-4 card-shadow'>
              <h5 class='text-info mb-0'>You can download your previously uploaded CSV file from the resource page.</h5>
              <hr>
               <span class='text-muted'><i class='fas fa-info-circle'></i> Innoventory Infocard</span>
              </div>
              ", "
              <div class='text-dark alert alert-light pt-5 pb-5 announcement_card mb-4 card-shadow'>
              <h5 class='text-info mb-0'>Service Center name are case sensitive. make sure the service center name from your CSV matches the exact capitalizations in your Manage Service Centers page.</h5>
              <hr>
               <span class='text-muted'><i class='fas fa-info-circle'></i> Innoventory Infocard</span>
              </div>
              ", "
              <div class='text-dark alert alert-light pt-5 pb-5 announcement_card mb-4 card-shadow'>
              <h5 class='text-info mb-0'>Assets from LGU, Disposed is not included in QR Code generation.</h5>
              <hr>
               <span class='text-muted'><i class='fas fa-info-circle'></i> Innoventory Infocard</span>
              </div>
              ", "
              <div class='alert alert-light text-dark pt-5 pb-5 announcement_card mb-4 card-shadow'>
              <h5 class='text-primary mb-0'>SDO-Marikina Youtube Channel</h5>
              <p class='text-muted'>Stay updated in the latest events in Schools Division Office - Marikina City.</p>
               <a target='_blank' href='https://www.youtube.com/channel/UCWA9DPz2cxtahvaqjBwt82g' class='btn btn-danger btn-sm'><i class='fab fa-youtube'></i> Subscribe</a>
              </div>
              ");
        $tips_chance = 40;
        for ($i = 0;$i < count($output);$i++) {
            if ($tips_chance < 90) {
                $tips_chance+= ($i * rand(0, 3));
            }
            if (count($system_suggestion) != 0) {
                $selected_systempost = rand(0, (count($system_suggestion) - 1));
                $has_system_post = rand(0, 100);
                if ($has_system_post < $tips_chance) {
                    $toecho.= $system_suggestion[$selected_systempost];
                    array_splice($system_suggestion, $selected_systempost);
                }
            }
            $remtype = $output[$i]["viewtype"];
            switch ($remtype) {
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
            $toecho.= "
                  <div class='card card-shadow mb-4 announcement_card'>
                    <div class='card-body mt-3 mb-3'>
                    <p class='float-right'><small style='color:#007DFF;'><i class='fas fa-globe-asia'></i> " . strtoupper($remtype) . "</small></p>
                      <p><strong><i class='fas fa-user-circle'></i> " . ucwords(strtolower($output[$i]["username"])) . "</strong>
                        <br><span class='text-muted' title='" . date("m/d/y g:i a", strtotime($output[$i]["dateposted"])) . "'>" . $this->DateExplainder($output[$i]["dateposted"]) . "</span>
                      </p>
                      <h5>" . $output[$i]["title"] . "</h5>
                     <pre class='card-subtitle'>" . $output[$i]["description"] . " </pre>
                    </div>
                  </div>
                ";
        }
        $toecho.= "
                 <div class='alert alert-light text-dark pt-5 pb-5 announcement_card mb-4 card-shadow'>
              <h5 class='text-primary mb-0'>More Announcements?</h5>
              <p class='text-muted'>View, Manage announcements of your station.</p>
              <a href=" . route('manage_reminders') . " class='btn btn-primary btn-sm'><i class='fas fa-hand-point-right'></i> See All Announcements</a>
              </div>
             ";
        return $toecho;
    }
    public function delremthis(Request $req) {
        $tag = $this->sdmenc("deltereminderbyid");
        $reminderid = $this->sdmenc($req["reminderidx"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "reminderid" => $reminderid, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        if ($output == "true") {
            Alert::success("Deleted!");
            return redirect()->route("manage_reminders");
        } else {
            Alert::error("Failed to delete reminder!");
            return redirect()->route("manage_reminders");
        }
    }
    public function centerman_selection() {
        $toecho = "";
        $station_id = $this->sdmenc(session("user_school"));
        $tag = $this->sdmenc("get_station_acc_names");
        $client = new \GuzzleHttp\Client();
        $res_2 = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $station_id, ]]);
        $out_2 = $this->sdmdec($res_2->getBody()->getContents());
        $out_2 = json_decode($out_2, true);
        $toecho.= "<option selected disabled value=''>Select who's in-charge</option>";
        for ($xc = 0;$xc < count($out_2);$xc++) {
            // GET STATION ACCOUNT NAMES
            for ($xc = 0;$xc < count($out_2);$xc++) {
                $toecho.= "<option value='" . $out_2[$xc]["employee_id"] . "'>" . ucwords(strtolower($out_2[$xc]["username"])) . "</option>";
            }
        }
        return $toecho;
    }
    public function proc_sign_protocol(Request $req) {
        $tag = $this->sdmenc("proc_login");
        $depedemail = strtolower($req["user_employee_id"]);
        if (strripos($depedemail, "deped.gov.ph") !== false) {
            $user_employee_id = $this->sdmenc($depedemail);
            $user_employee_password = $this->sdmenc($req["user_employee_password"]);
            $client = new \GuzzleHttp\Client();
            $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "empid" => $user_employee_id, "emppass" => $user_employee_password, ]]);
            $output = $this->sdmdec($result->getBody()->getContents());
            // $output = json_encode($output);
            // return $output;
            if ($output == "false") {
                //WRONG CREDENTIALS
                Alert::error("Username and/or password is incorrect.");
                return redirect('/');
            } else {
                // $output = json_decode($output,true);
                $output = json_decode($output, true);
                // return   $output;
                // GET MY SCHOOL NAME FULL
                $mynameschool = $this->send_get(["tag"=>"get_sc_name","sc_id" => $this->sdmenc($output[0]["station_id"])],true);

                session(['user_uname' => $output[0]["username"]]);
                session(['user_eid' => $output[0]["employee_id"]]);
                session(['user_type' => $output[0]["acc_type"]]);
                session(['user_depedemail' => $output[0]["depedemail"]]);
                session(['user_school' => $output[0]["station_id"]]);
                session(['user_schoolname' => $this->fixWrongUTF8Encoding($mynameschool) ]);
                session(['user_last_scansession_sc' => '']);
                session(['user_last_scansession' => '']);
                session(['user_last_schoolname' => '']);
                session(['user_changesource_station' => $output[0]["station_id"]]);
                session(['user_changesource_station_name' => $this->fixWrongUTF8Encoding($mynameschool) ]);
                //RIGHT CREDENTIALS
                return redirect()->route("dboard");
            }
        } else {
            Alert::error("Email must be a DepEd Email.");
            return $output;
            return redirect('/');
        }
    }
    public function get_asc_not_included(Request $req) {
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $this->sdmenc("get_asc_not_inc"), "sn" => $this->sdmenc($req["station_info"]), "yy" => $this->sdmenc($req["selyear"]), "mm" => $this->sdmenc($req["selmonth"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $output = json_decode($output, true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            if ($output[$i]["property_number"] != "none") {
                $toecho.= "
        <tr>
        <td class='misscadata'>" . $output[$i]["property_number"] . "</td>
        <td>" . $output[$i]["asset_item"] . "</td>
        <td>" . $output[$i]["asset_classification"] . "</td>
        <td>" . $output[$i]["current_condition"] . "</td>
        <td>" . $output[$i]["service_center"] . "</td>
        <td>" . $output[$i]["room_number"] . "</td>
        <td>
        ";
                $toecho.= "
         <div class='dropdown'>
    <a class='btn btn-link' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
      <i class='fas fa-ellipsis-v'></i>
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
    public function get_not_entry_scannedassets(Request $req) {
        $tag = $this->sdmenc("get_no_ent_sca");
        $station_number = $this->sdmenc($req["station_number"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "sn" => $station_number, "choosenYear" => $this->sdmenc($req["selyear"]), "choosenMonth" => $this->sdmenc($req["selmonth"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        return $output;
    }
    public function g_sca_ttitms(Request $req) {
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $this->sdmenc("g_sca_ttitmsxx"), "sn" => $this->sdmenc($req["station_number"]), "choosenYear" => $this->sdmenc($req["selyear"]), "choosenMonth" => $this->sdmenc($req["selmonth"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        return $output;
    }
    public function get_sc_occudates(Request $req) {
        $tag = $this->sdmenc("get_sc_occudatesxx");
        $station_number = $this->sdmenc($req["station_number"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "sn" => $station_number, "choosenYear" => $this->sdmenc($req["selyear"]), "choosenMonth" => $this->sdmenc($req["selmonth"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $output = explode("|", $output);
        if ($output[0] != "") {
            // not empty
            if ($output[0] == $output[1]) {
                $output = date("F d, Y", strtotime($output[0])) . "<br><span class='text-muted'>" . $this->DateExplainder($output[0]) . "</span>";
            } else {
                $output = date("F d", strtotime($output[0])) . " to " . date("F d, Y", strtotime($output[1])) . "<br><span class='text-muted'>" . $this->DateExplainder($output[1]) . "</span>";
            }
        } else {
            //empty
            $output = "No inventory date available.";
        }
        return $output;
    }
    public function get_ass_scanned(Request $req) {
        $tag = $this->sdmenc("getallscanneditems");
        $station_number = $this->sdmenc($req["station_number"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "sn" => $station_number, "choosenYear" => $this->sdmenc($req["selyear"]), "choosenMonth" => $this->sdmenc($req["selmonth"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $output = json_decode($output, true);
        $toecho = "";
        $isown = false;
        if ($req["station_number"] == session("user_school")) {
            $isown = true;
        }
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "
           <tr>
              <td><form action='" . route("asset_view") . "' method='GET' target='_blank'>
              <input type='hidden' value='" . $output[$i]["item_real_id"] . "' name='asset_id'>
              <button class='btn btn-link' type='submit' target='_blank'>";
            if ($output[$i]["status"] != "0") {
                $toecho.= $output[$i]["property_number"] . " <span class='badge badge-danger'>Disposed</span>";
            } else {
                $toecho.= $output[$i]["property_number"];
            }
            $toecho.= "</button>
              </form></td>
              <td>";
            $toecho.= $output[$i]["asset_item"];
            $toecho.= "</td>
              <td>" . $output[$i]["current_condition"] . "</td>
              <td>" . $output[$i]["service_center"] . "</td>
              <td>" . $output[$i]["room_number"] . "</td>
              <td>" . "<span class='float-right text-muted'>" . $this->DateExplainder($output[$i]["scanned_date"]) . "</span>" . date("F d, Y", strtotime($output[$i]["scanned_date"])) . "</td>
           </tr>
            ";
        }
        return $toecho;
    }
    public function bionic_page_count(Request $req) {
        $rn = $this->sdmenc($req["rn"]);
        $cat = $this->sdmenc($req["cat"]);
        $tag = $this->sdmenc("log_ass_filt");
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "fil_roomnum" => $rn, "fil_category" => $cat, "stat_id" => $this->sdmenc(session("user_school")), "inv_year" => $this->sdmenc($req["inv_year"]), "inv_month" => $this->sdmenc($req["inv_month"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $output = json_decode($output, true);
        $lc_count = 0;
        $pagecount = 0;
        for ($i = 0;$i < count($output);$i++) {
            $lc_count++;
            if ($lc_count > 16) {
                $pagecount++;
                $lc_count = 0;
            }
        }
        $tag = $this->sdmenc("view_ass_grouped");
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "fil_roomnum" => $rn, "fil_category" => $cat, "station_id" => $this->sdmenc(session("user_school")), "inv_year" => $this->sdmenc($req["inv_year"]), "inv_month" => $this->sdmenc($req["inv_month"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $output = json_decode($output, true);
        // for ($x=0; $x < 50; $x++) {
        for ($i = 0;$i < count($output);$i++) {
            $lc_count++;
            if ($lc_count > 16) {
                $pagecount++;
                $lc_count = 0;
            }
        }
        return $pagecount;
    }
    public function generate_asset_report_printout(Request $req) {
        $rn = $this->sdmenc($req["rn"]);
        $cat = $this->sdmenc($req["cat"]);
        $asset_table_head = '
  <tr>
   <th rowspan="2">ARTICLE</th>
    <th rowspan="2">DESCRIPTION</th>
    <th rowspan="2">PROPERTY<br>NUMBER</th>
    <th rowspan="2">UNIT OF<br>MEASURE</th>
    <th rowspan="2">UNIT<br>VALUE</th>
    <th rowspan="2">QUANTITY<br>per<br>PROPERTY CARD</th>
    <th rowspan="2">QUANTITY<br>per<br>PHYSICAL COUNT</th>
    <th colspan="2">SHORTAGE/OVERAGE</th>
    <th rowspan="2">REMARKS</th>
  </tr>
  <tr>
    <th><small>Quantity</small></th>
    <th><small>Value</small></th>
  </tr>
      ';
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $this->sdmenc("log_ass_filt"), "fil_roomnum" => $rn, "fil_category" => $cat, "stat_id" => $this->sdmenc(session("user_school")), "inv_year" => $this->sdmenc($req["inv_year"]), "inv_month" => $this->sdmenc($req["inv_month"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        // return json_encode($output);
        $output = json_decode($output, true);
        $lc_count = 0;
        $pagecount = 0;
        $toecho = '

<table id="page_' . $pagecount . '" >
<tr class="borderless">
<th colspan="11">
<div style="text-align: right;">Appendix 73</div>
<div style="text-align: center; margin-top: -35px;">
  <h4 style="margin-bottom: 0px;"><img style="display:none;" src="' . asset('images/deped.png') . '" style="height: 80px; width: 80px;"><br>REPORT ON THE PHYSICAL COUNT OF PROPERTY, PLANT AND EQUIPMENT</h4>
  <small style="margin-bottom: 50px;"><u>' . $req["cat"] . '</u><p style="margin:0px;">(Type of Property, Plant and Equipment)</p>
  As at <u>' . session("user_schoolname") . ' - ' . $req["roomname"] . '</u></small><br><br>
</div>
<div style="text-align: left;">
  <small>
    <strong>
      Fund Cluster:____________________________<br>
      For which____________________________, <u>(Official Designation)</u>, <u>(Entity Name)</u> is accountable, having assumed such accountability on <u></u>.
    </strong>
  </small>
</div>

</th>
</tr>' . $asset_table_head . '';
        for ($i = 0;$i < count($output);$i++) {
            if ($output[$i]["status"] == "0") {
                $lc_count++;
                if ($lc_count > 16) {
                    $pagecount++;
                    $lc_count = 0;
                    $toecho.= '
</table>
<br>
<br>
<table id="page_' . $pagecount . '" >
' . $asset_table_head . '
        ';
                }
                $toecho.= '<tr>
         <td>' . $output[$i]["uacs_object_code"] . '</td>
          <td>' . $output[$i]['asset_item'];
                $linecount = intval(strlen($output[$i]['asset_item']) / 101);
                $lc_count+= $linecount;
                //computation
                $bal_per_card = $output[$i]['balance_per_card'];
                $on_hand_per_count = $output[$i]["physical_count"];
                $short_ov_quantity = ($bal_per_card - $on_hand_per_count);
                $short_ov_value = number_format(($short_ov_quantity * $output[$i]['cost_of_acquisition']),2);
                $disp_onhandcount = "";
                if ($on_hand_per_count == null || $on_hand_per_count == '') {
                    $disp_onhandcount = "Missing Inv.";
                } else {
                    $disp_onhandcount = $on_hand_per_count;
                }
                if ($short_ov_quantity < 0) {
                    $short_ov_quantity = '(' . $short_ov_quantity . ')';
                    $short_ov_value = '(' . $short_ov_value . ')';
                }
                $toecho.= '</td>
          <td>' . $output[$i]['property_number'] . '</td>
        
          <td>' . $output[$i]['unit_of_measure'] . '</td>
            <td style="text-align:right;">' . number_format($output[$i]['cost_of_acquisition'], 2) . '</td>
                 <td style="text-align:center;">' . $bal_per_card . '</td>
                 <td style="text-align:center;">' . $disp_onhandcount . '</td>
                   <td style="text-align:center;">' . $short_ov_quantity . '</td>
                     <td style="text-align:center;">' . $short_ov_value . '</td>
                        <td>';
                if ($this->item_condition_validator_display($output[$i]["current_condition"])) {
                    $toecho.= $output[$i]["current_condition"];
                }
                $toecho.= '</td>
                  </tr>';
            }
        }
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $this->sdmenc("view_ass_grouped"), "fil_roomnum" => $rn, "fil_category" => $cat, "station_id" => $this->sdmenc(session("user_school")), "inv_year" => $this->sdmenc($req["inv_year"]), "inv_month" => $this->sdmenc($req["inv_month"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        // return json_encode($output);
        $output = json_decode($output, true);
        for ($i = 0;$i < count($output);$i++) {
            $lc_count++;
            if ($lc_count > 16) {
                $pagecount++;
                $lc_count = 0;
                $toecho.= '
</table>
<br>
<br>
<table id="page_' . $pagecount . '" >
' . $asset_table_head . '
        ';
            }
            if (strlen($output[$i]['assets_included']) > strlen($output[$i]['group_name'])) {
                $linecount = intval(strlen($output[$i]['assets_included']) / 64);
                $lc_count+= $linecount;
            } else {
                $linecount = intval(strlen($output[$i]['group_name']) / 64);
                $lc_count+= $linecount;
            }
            // $life_price = $this->compute_lifeprice($output[$i]["date_of_acquisition"],
            // $output[$i]["cost_of_acquisition"],
            // $mysortage,
            // $output[$i]["estimated_total_life_years"]);
            $quantity = (int)$output[$i]["quantity"];
            $blpercard = (int)$output[$i]["balance_per_card"];
            $short_ov_quantity = ($blpercard - $quantity);
            $short_ov_value = number_format(($short_ov_quantity * $output[$i]['cost_of_acquisition']),2);
            $toecho.= "<tr>
           <td>" . $output[$i]["uacs_object_code"] . "</td>
           <td>" . $output[$i]["group_name"] . "</td>
          <td>" . $this->ProNumSeparator($output[$i]["assets_included"]) . "</td>
           
         <td>" . $output[$i]["unit_of_measure"] . "</td>
        <td style='text-align:right;'>" . number_format($output[$i]["cost_of_acquisition"], 2) . "</td>          
            <td style='text-align:center;'>" . $blpercard . "</td>
            <td style='text-align:center;'>" . $quantity . "</td>
            <td  style='text-align:center;'>" . $short_ov_quantity . "</td>
            <td style='text-align:center;'>" . $short_ov_value . "</td>
            <td>" . $this->group_words_count($output[$i]["assets_conditions"]) . "</td>
      </tr>";
        }
        $toecho.= '

  <tr  class="bottom_field">
   
    <td class="fronter" colspan="3">
      Certified Corrected by:
      <center>
        __________________________________<br>
       Signature over printed name of<br>School Inventory Committee/or<br>In-Charge of Service Center/or<br>Property Custodian
      </center>
    </td>
    <td colspan="3">
      Approved by:
      <center>
        __________________________________<br>
        Signature over Printed Name of School Head of<br>Agency/Entity of Authorized Representative
      </center>
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td class="laster">
      Verified by:
      <center>
        __________________________________<br>
        Signature over Printed Name of<br>Inventory Team Representative
      </center>
    </td>
  </tr>
  </table>
      ';
        $this->RecordLog("a02");
        return $toecho;
    }
    public function ungroup_items(Request $req) {
        $tag = $this->sdmenc("ungroup_item_now");
        $groupname = $this->sdmenc($req["groupname"]);
        $groupnumber = $this->sdmenc($req["groupnumber"]);
        $category = $this->sdmenc($req["category"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "groupname" => $groupname, "groupnumber" => $groupnumber, "category" => $category, "unikid" => $this->sdmenc($req["idunik"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        return $output;
    }
    public function viewassetgrouped(Request $req) {
        $tag = $this->sdmenc("view_ass_grouped");
        $rnum = $this->sdmenc($req["rnum"]);
        $catname = $this->sdmenc($req["catname"]);
        $station_id = $this->sdmenc($req["station_id"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "fil_roomnum" => $rnum, "fil_category" => $catname, "station_id" => $station_id, "inv_year" => $this->sdmenc($req["inv_year"]), "inv_month" => $this->sdmenc($req["inv_month"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $output = json_decode($output, true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<tr>
           <td><a style='font-size:20px;' href='#' onclick='OpenUngroupItems(this)'
            data-gname='" . $output[$i]["group_name"] . "'
            data-rnum='" . $output[$i]["room_number"] . "'
            data-assclass='" . $output[$i]["asset_classification"] . "'
             data-unik='" . $output[$i]["unik_id"] . "'
             data-toggle='modal' data-target='#ungroup_modal' title='Ungroup'><i class='fas fa-clone'></i></a></td>
           <td>" . $output[$i]["group_name"] . "</td>
          <td>" . $this->ProNumSeparator($output[$i]["assets_included"]) . "</td>
           
          <td>" . $output[$i]["unit_of_measure"] . "</td>
          <td>" . date("F d, Y", strtotime($output[$i]["date_of_acquisition"])) . "<br><span class='text-muted'>" . $this->DateExplainder($output[$i]["date_of_acquisition"]) . "</span>" . "</td>
          <td>" . number_format($output[$i]["cost_of_acquisition"], 2) . "</td>       
          <td>" . $this->group_words_count($output[$i]["assets_conditions"]) . "</td>          
            <td>" . $output[$i]["quantity"] . "</td>
      </tr>";
        }
        return $toecho;
    }
    public function ProNumSeparator($property_number) {
        $to_ret = "";
        $property_number = explode("<|next|>", $property_number);
        for ($i = 0;$i < count($property_number);$i++) {
            $to_ret.= " (" . $property_number[$i] . ") ,";
        }
        $to_ret = rtrim($to_ret, ",");
        return $to_ret;
    }
    public function group_words_count($txt_words) {
        $existing_words = array();
        $existing_counter = array();
        $frag = explode(", ", $txt_words);
        for ($i = 0;$i < count($frag);$i++) {
            if (!in_array($frag[$i], $existing_words)) {
                array_push($existing_words, $frag[$i]);
                array_push($existing_counter, $frag[$i] . "<|count|>1");
            } else {
                for ($x = 0;$x < count($existing_counter);$x++) {
                    if (strpos($existing_counter[$x], $frag[$i] . "<|count|>") !== false) {
                        $current_existing = explode("<|count|>", $existing_counter[$x]);
                        $existing_counter[$x] = $current_existing[0] . "<|count|>" . ($current_existing[1] + 1);
                    }
                }
            }
        }
        //reword
        $toecho = "";
        for ($i = 0;$i < count($existing_counter);$i++) {
            $ff = explode("<|count|>", $existing_counter[$i]);
            if ($this->item_condition_validator_display($ff[0])) {
                $toecho.= $ff[0] . " - " . $ff[1] . " <br>";
            }
        }
        $toecho = preg_replace('~\\s+\\S+$~', ' <br>', $toecho);
        return $toecho;
    }
    public function item_condition_validator_display($condition) {
        $condition = strtolower($condition);
        if (strpos($condition, "good") !== false && strpos($condition, "condition") !== false) {
            return false;
        } else {
            return true;
        }
    }
    public function add_new_asset_group(Request $req) {
        $tag = $this->sdmenc("add_new_group");
        $ass_gname = $this->sdmenc(strtoupper(htmlentities($req["ass_gname"])));
        $ass_propnum = $this->sdmenc($req["ass_propnum"]);
        $ass_roomnum = $this->sdmenc($req["ass_roomnum"]);
        $ass_assclass = $this->sdmenc($req["ass_assclass"]);
        $ass_ass_balpercard = $this->sdmenc($req["ass_balpercard"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "ass_gname" => $ass_gname, "ass_propnum" => $ass_propnum, "ass_roomnum" => $ass_roomnum, "ass_assclass" => $ass_assclass, "ass_balpercard" => $ass_ass_balpercard, "inv_year" => $this->sdmenc($req["inv_year"]), "inv_month" => $this->sdmenc($req["inv_month"]), "station_id" => $this->sdmenc(session("user_school")), "unikid" => $this->sdmenc($req["unikid"]) ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        return $output;
    }
    public function lod_asset_filtered(Request $req) {
        $tag = $this->sdmenc("log_ass_filt");
        $rnum = $this->sdmenc($req["rnum"]);
        $catname = $this->sdmenc($req["catname"]);
        $station_id = $this->sdmenc(session("user_school"));
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "fil_roomnum" => $rnum, "fil_category" => $catname, "stat_id" => $station_id, "inv_year" => $this->sdmenc($req["inv_year"]), "inv_month" => $this->sdmenc($req["inv_month"]), ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        // return $output;
        $output = json_decode($output, true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<tr>
         <td>";
            if ($output[$i]["status"] == "0") {
                //NORMAL
                $toecho.= "<input style=' transform:scale(2, 2);' type='checkbox' class='asset_item_check' data-oid='" . $output[$i]["id"] . "' 

         data-dateofaq='" . $output[$i]["date_of_acquisition"] . "'
         data-totlifey='" . $output[$i]["estimated_total_life_years"] . "'
         data-unitofmea='" . $output[$i]["unit_of_measure"] . "'
         data-aq_cost='" . $output[$i]["cost_of_acquisition"] . "'
          data-itemname='" . $output[$i]["asset_item"] . "' data-propnum='" . $output[$i]["property_number"] . "' data-assetitem='" . $output[$i]["asset_item"] . "'>";
            } else {
                //DISPOSED
                $toecho.= "<span class='text-danger'>Disposed</span>";
            }
            $toecho.= "</td>
          <td>" . $output[$i]["asset_item"] . "</td>
          <td>" . $output[$i]["property_number"] . "</td>
        
          <td>" . $output[$i]["unit_of_measure"] . "</td>
          <td>" . date("F d, Y", strtotime($output[$i]["date_of_acquisition"])) . "<br><span class='text-muted'>" . $this->DateExplainder($output[$i]["date_of_acquisition"]) . "</span>" . "</td>
          <td>" . number_format($output[$i]["cost_of_acquisition"], 2) . "</td>


            <td>" . $output[$i]["current_condition"] . "</td>
                 <td>1</td>
      </tr>";
        }
        return $toecho;
    }
    public function add_a_new_user(Request $req) {
        $depedemail = strtolower($req["x_depedemail"]);
        if (strpos($depedemail, "@deped.gov.ph") !== false) {
            $tag = $this->sdmenc("a_new_account_now");
            $x_username = $this->sdmenc(htmlentities($req["x_username"]));
            $x_selectedschool = $this->sdmenc($req["x_selectedschool"]);
            $x_empid = $this->sdmenc($req["x_empid"]);
            $x_usertype = $this->sdmenc($req["x_usertype"]);
            $x_pass = $this->sdmenc($req["x_empid"]);
            $x_repass = $this->sdmenc($req["x_empid"]);
            $x_depedemail = $this->sdmenc($depedemail);
            if ($x_pass == $x_repass) {
                $client = new \GuzzleHttp\Client();
                $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "x_username" => $x_username, "x_selectedschool" => $x_selectedschool, "x_empid" => $x_empid, "x_usertype" => $x_usertype, "x_pass" => $x_pass, "x_depedemail" => $x_depedemail, ]]);
                $output = $this->sdmdec($result->getBody()->getContents());
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
            } else {
                Alert::error("Password do not match.");
                return redirect()->route("usermanagement");
            }
        } else {
            Alert::error("Email must be a DepEd Email.");
            return redirect()->route("usermanagement");
        }
    }
    public function archive_an_asset(request $req) {
        $tag = $this->sdmenc("archive_an_asset");
        $asset_id = $this->sdmenc($req["asset_id"]);
        $asset_archive_type = $this->sdmenc($req["asset_archive_type"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "asset_id" => $asset_id, "asset_archive_type" => $asset_archive_type, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $this->RecordLog("a03");
        if ($output == "true") {
            Alert::success("Asset has been archived!");
            return redirect()->route("assetregistry");
        } else {
            Alert::error("Cannot archive asset.");
            return redirect()->route("assetregistry");
        }
    }
    public function get_cat_gr(request $req) {
        $tag = $this->sdmenc("get_categories_grouped");
        $school_id = $this->sdmenc($req["school_id"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $school_id, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $output = json_decode($output, true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<option>" . $output[$i]["cat_name"] . "</option>";
        }
        return $toecho;
    }
    public function get_roo_gr(request $req) {
        $tag = $this->sdmenc("get_room_grouped");
        $school_id = $this->sdmenc($req["school_id"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $school_id, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $output = json_decode($output, true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<option value='" . $output[$i]["room_number"] . "'>" . $output[$i]["office"] . " - " . $output[$i]["room_number"] . "</option>";
        }
        return $toecho;
    }
    public function restore_an_asset(request $req) {
        $tag = $this->sdmenc("restore_an_asset");
        $asset_id = $this->sdmenc($req["asset_id"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "asset_id" => $asset_id, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $this->RecordLog("a07");
        if ($output == "true") {
            Alert::success("Asset restored!");
            return redirect()->route("asset_disposed");
        } else {
            Alert::error("Cannot restore asset.");
            return redirect()->route("asset_disposed");
        }
    }
    public function get_acc_info_edit(request $req) {
        return json_encode($this->send_get(["tag"=>"get_emp_info_for_edit","emp_id"=> $this->sdmenc($req["emp_id"])]));
    }
    public function edit_the_user_info(Request $req) {
        $depedemail = strtolower($req["x_depedemail"]);
        if (strpos($depedemail, "@deped.gov.ph") !== false) {
            $tag = $this->sdmenc("user_edit_info");
            $x_username = $this->sdmenc(htmlentities($req["x_username"]));
            $x_selectedschool = $this->sdmenc($req["x_selectedschool"]);
            $x_empid = $this->sdmenc($req["x_empid"]);
            $x_usertype = $this->sdmenc($req["x_usertype"]);
            $x_userid = $this->sdmenc($req["empid"]);
            $x_depedemail = $this->sdmenc($depedemail);
            $client = new \GuzzleHttp\Client();
            $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "x_username" => $x_username, "x_selectedschool" => $x_selectedschool, "x_empid" => $x_empid, "x_usertype" => $x_usertype, "x_userid" => $x_userid, "x_depedemail" => $x_depedemail, ]]);
            $output = $this->sdmdec($result->getBody()->getContents());
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
        } else {
            Alert::error("Email must be a DepEd Email.");
            return redirect()->route("usermanagement");
        }
    }
    public function delete_the_user(Request $req) {
        $empid = $this->sdmenc($req["empid"]);
        $tag = $this->sdmenc("user_delete");
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "x_userid" => $empid, ]]);
        $output = $this->sdmdec($result->getBody()->getContents());
        $this->RecordLog("a05");
        Alert::success("User Account has been deleted!");
        return redirect()->route("usermanagement");
    }
    public function load_all_school_names() {
        $output = $this->send_get(["tag"=>"load_all_sc_names"]);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            if (session("user_type") == "0" || session("user_type") == "1") {
                $toecho.= "<option value='" . $output[$i]["id"] . "'>" . $output[$i]["name"] . "</option>";
            } else {
                if ($output[$i]["id"] == session("user_school")) {
                    $toecho.= "<option value='" . $output[$i]["id"] . "'>" . $output[$i]["name"] . "</option>";
                    break;
                }
            }
        }
        echo $toecho;
    }
    public function display_all_employees(Request $req) {
        $tag = $this->sdmenc("get_registered_user");
        $user_type = $this->sdmenc(session("user_type"));
        $school_id = $this->sdmenc($req["user_school"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "user_type" => $user_type, "school_id" => $school_id, ]]);
        $output = json_decode($this->sdmdec($result->getBody()->getContents()), true);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            if (session("user_depedemail") == $output[$i]["depedemail"] || session("user_type") >= $output[$i]["type"]) {
            } else {
                $usertype = "";
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
                $toecho.= "<tr>

    <td><small class='text-muted float-right'>" . $output[$i]["employee_id"] . "</small>" . ucwords(strtolower($output[$i]["username"])) . "</td>
    <td>" . $usertype . "</td>
";
                if (session("user_depedemail") == $output[$i]["depedemail"] || session("user_type") >= $output[$i]["type"]) {
                    $toecho.= "

<td>" . '
  <center>
<div class="dropdown ">
  <a class="btn disabled btn-link btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-ellipsis-v"></i>
  </a>

</div>
 </center>
 ' . "</td>

  </tr>";
                } else {
                    $toecho.= "

<td>" . '
 <center>
<div class="dropdown">
  <a class="btn btn-link btn-sm " href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fas fa-ellipsis-v"></i>
  </a>

  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
    <a class="dropdown-item" data-empid="' . $output[$i]["acc_id"] . '" onclick="lod_editacc(this)" data-toggle="modal" data-target="#m_edit" href="#"><i class="fas fa-edit"></i> Edit Account</a>

     <a class="dropdown-item" data-empnumber="' . $output[$i]["employee_id"] . '" data-empid="' . $output[$i]["acc_id"] . '" onclick="lod_resetpass(this)" data-toggle="modal" data-target="#m_resetpass" href="#"><i class="fas fa-sync"></i> Reset Password</a>

    <a class="dropdown-item" data-empid="' . $output[$i]["acc_id"] . '" onclick="lod_deleteacc(this)" data-toggle="modal" data-target="#m_delete" href="#"><i class="fas fa-trash"></i> Delete</a>
  </div>
</div>
 </center>
 ' . "</td>

  </tr>";
                }
            }
        }
        return $toecho;
    }
    public function asset_disp_disposed(Request $req) {
        $output = $this->send_get(["tag"=>"display_disposed_assets_reg","id_of_something"=>$this->sdmenc($req["id_of_something"])]);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "
            <tr>
                <td>";
            switch ($output[$i]["status"]) {
        case '1':
            $toecho.= "<strong  class='text-danger'>" . $output[$i]["property_number"] . " <small class='text-muted'>COND/DES</small></strong>";
        break;
        case '2':
            $toecho.= "<strong class='text-info'>" . $output[$i]["property_number"] . " <small class='text-muted'>TOPR</small></strong>";
        break;
        case '3':
            $toecho.= "<strong class='text-warning'>" . $output[$i]["property_number"] . " <small class='text-muted'>SUPR</small></strong>";
        break;
        case '4':
            $toecho.= "<strong class='text-primary'>" . $output[$i]["property_number"] . " <small class='text-muted'>DOPR</small></strong>";
        break;
        case '5':
            $toecho.= "<strong class='text-secondary'>" . $output[$i]["property_number"] . " <small class='text-muted'>INCPR</small></strong>";
        break;
            }
            $toecho.= "</td>
                <td>" . $output[$i]["asset_item"] . "</td>
                <td>" . $output[$i]["asset_classification"] . "</td>
                <td>" . $output[$i]["current_condition"] . "</td>
                 <td>" . $output[$i]["service_center"] . "</td>
                    <td>" . $output[$i]["room_number"] . "</td>
                <td>

               <div class='dropdown'>
    <a class='btn btn-link' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
      <i class='fas fa-ellipsis-v'></i>
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
    public function preview_csv(Request $req) {
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
        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
            if (count($getData) < 22) {
                $toecho = "";
                break;
            } else if ($previewcount != 0) {
                $toecho.= "<tr>";
                for ($i = 0;$i < 22;$i++) {
                    $toecho.= "<td>" . $getData[$i] . "</td>";
                }
                $toecho.= "</tr>";
                if ($previewcount >= 3) {
                    break;
                }
            }
            $previewcount++;
        }
        return $toecho;
    }
    public function my_asset_full(Request $req) {
        $tag = $this->sdmenc("get_asset_all_info");
        $asset_id = $this->sdmenc($req["asset_id"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "asset_id" => $asset_id, ]]);
        $output = json_decode($this->sdmdec($result->getBody()->getContents()), true);
        $output[0]["cost_of_acquisition"] = number_format($output[0]["cost_of_acquisition"], 2);
        return $output;
    }
    public function display_all_encoded_assets(Request $req) {
        $tag = $this->sdmenc("display_all_assets");
        $mystation = $this->sdmenc($req["selected_realid"]);
        $usertype = $this->sdmenc(session("user_type"));
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "mystation" => $mystation, "usertype" => $usertype, ]]);
        $output = json_decode($this->sdmdec($result->getBody()->getContents()), true);
        $toecho = "";
        $isown = false;
        if ($req["selected_realid"] == session("user_school")) {
            $isown = true;
        }
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "
        <tr>
        <td>";
            if ($output[$i]["omitted"] == "1") {
                $toecho.= $output[$i]["property_number"] . " <strong class='text-danger'>Omitted</strong>";
            } else {
                $toecho.= $output[$i]["property_number"];
            }
            $toecho.= "</td>
        <td>" . $output[$i]["asset_item"] . "</td>
        <td>" . $output[$i]["specification"] . "</td>
        <td>" . $output[$i]["current_condition"] . "</td>
        <td>" . $output[$i]["service_center"] . "</td>
        <td>" . $output[$i]["room_number"] . "</td>
        <td>
        ";
            if ($isown) {
                $toecho.= "
       <div class='dropdown'>
    <a class='btn btn-link' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
      <i class='fas fa-ellipsis-v'></i>
    </a>
  
        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink'>


        <form action='" . route("asset_view") . "' method='GET' >
        <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
        <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
        </form>

        ";
                if (session("user_type") < "4") {
                    $toecho.= "<a class='dropdown-item' href='#' data-toggle='modal' onclick='OpenAssetToDispose(this)' data-asset_id='" . $output[$i]["id"] . "' data-target='#m_remove'><i class='fas fa-trash'></i> Dispose</a>
      </div>
      </div>
      </td>
      </tr>
      ";
                }
            } else {
                $toecho.= "
         <div class='dropdown'>
    <a class='btn btn-link' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
      <i class='fas fa-ellipsis-v'></i>
    </a>
  
        <div class='dropdown-menu dropdown-menu-right' aria-labelledby='dropdownMenuLink'>


        <form action='" . route("asset_view") . "' method='GET'>
        <input type='hidden' value='" . $output[$i]["id"] . "' name='asset_id'>
        <button class='dropdown-item' type='submit' target='_blank'><i class='fas fa-binoculars'></i> View</button>
        </form>

        ";
            }
        }
        return $toecho;
    }
    public function tryprint(Request $req) {
        $tag = $this->sdmenc("getextractedgrouprep");
        // ADDING PROCESS
        $cname = $req["colname"];
        $columnname = $this->sdmenc($cname);
        $colval = $this->sdmenc($req["colval"]);
        $client = new \GuzzleHttp\Client();
        $xresult = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "column_name" => $columnname, "column_value" => $colval, "school_id" => $this->sdmenc(session("user_school")), ]]);
        $output = $this->sdmdec($xresult->getBody()->getContents());
        // END - ADDING PROCESS
        return view("asset_reportdownload", ["thedata" => $output, "cname" => $cname]);
    }
    public function upresnow(Request $req) {
        $tag = $this->sdmenc("index_upload_asset_csv");
        $photo = $req->file('thefile');
        $guessExtension = $photo->getClientOriginalExtension();
        $origname = $photo->getClientOriginalName();
        $newfilename = str_replace(" ", "", session("user_school")) . "--" . date("F_d_Y-g_i_a") . "." . $guessExtension;
        $destinationpath = public_path("/uploads/");
        $req->file("thefile")->move($destinationpath, $newfilename);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "file_name" => $this->sdmenc($newfilename), "st_id" => $this->sdmenc(session("user_school")), "empid" => $this->sdmenc(session("user_eid")), "realname" => $this->sdmenc($origname), "file_format" => $this->sdmenc($guessExtension), ]]);
        Alert::success("Asset Uploaded.");
        return redirect()->route("asset_resources");
    }
    public function uploadassetregistrycsv(Request $req) {
        $output = "";
        $sc_id = $this->sdmenc($req["sc_id"]);
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
        $this->send_get(['tag' => "RESET_MY_NOT_INSERTED_DEFINITION_IN_CO", "stationid" => $this->sdmenc(session("user_school")) ]);
        $tag = $this->sdmenc("get_all_pn_in_ir");
        // GET EXISITING ASSETS
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $this->sdmenc(session("user_school")), ]]);
        $output = json_decode($this->sdmdec($result->getBody()->getContents()), true);
        for ($i = 0;$i < count($output);$i++) {
            if ($output[$i]["property_number"] != "") {
                array_push($asset_signature_existing, $output[$i]["property_number"]);
                array_push($asset_signature_existing_id, $output[$i]["id"]);
            }
        }
        // return $asset_signature_existing;
        $tag = $this->sdmenc("add_new_item_registry");
        $prop_alreasyexist = array();
        $mylogs = "";
        $fieldsx = array("Office Type", "Office Name", "Asset Classification", "Asset Sub Class", "UACS Code", "Asset Item Name", "Manufacturer", "Model Name", "Serial Number", "Specification", "Property Number", "Unit of Measure", "Current Condition", "Source Of Fund", "Cost of Acquisition", "Date of Aquisition", "Estimated Total Life Years", "Name of Accountable Officer", "Asset Location", "Service Center", "Room Number", "Remarks");
        while (($getData = fgetcsv($file, 10000, ",")) !== false) {
            $already_there = false;
            if ($getData[10] != "") {
                if (in_array($getData[10], $prop_alreasyexist) !== false) {
                    $already_there = true;
                } else {
                    array_push($prop_alreasyexist, $getData[10]);
                }
            }
            if ($previewcount != 0 && $valid_header == 1 && $getData[10] != "" && $getData[10] != null && $already_there == false) {
                $tots++;
                $missinglog = "";
                $has_disc = false;
                $has_propertynum = false;
                $fieldwithvals = 0;
                $has_cost_problem = false;
                for ($i = 0;$i < count($fieldsx);$i++) {
                    if ($getData[$i] == '' || $getData[$i] == null) {
                        if ($fieldsx[$i] != "Remarks" && $fieldsx[$i] != "Cost of Acquisition") {
                            $missinglog.= "Missing " . $fieldsx[$i] . "<br>";
                            $has_disc = true;
                        }
                    } else {
                        $fieldwithvals++;
                        // FIELD VALIDATION
                        if ($fieldsx[$i] == "Cost of Acquisition" && str_replace(",", "", $getData[$i]) < 15000) {
                            $has_cost_problem = true;
                        }
                    }
                    if ($i == 10) {
                        if ($getData[10] == '' || $getData[10] == null) {
                            $has_propertynum = false;
                        } else {
                            $has_propertynum = true;
                        }
                    }
                }
                if ($fieldwithvals > 5 && $has_propertynum == false) {
                    $tots++;
                }
                if ($has_disc) {
                    $blankcols++;
                }
                $office_type = $this->sdmenc(htmlentities($getData[0]));
                $office_name = $this->sdmenc(htmlentities($getData[1]));
                $asset_classification = $this->sdmenc(htmlentities($getData[2]));
                $asset_sub_class = $this->sdmenc(htmlentities($getData[3]));
                $uacs_object_code = $this->sdmenc(htmlentities($getData[4]));
                $asset_item = $this->sdmenc(htmlentities($getData[5]));
                $manufacturer = $this->sdmenc(htmlentities($getData[6]));
                $model = $this->sdmenc(htmlentities($getData[7]));
                $serial_number = $this->sdmenc(htmlentities($getData[8]));
                $specification = $this->sdmenc(htmlentities($getData[9]));
                $property_number = $this->sdmenc(htmlentities($getData[10]));
                $unit_of_measure = $this->sdmenc(htmlentities($getData[11]));
                $current_condition = $this->sdmenc(htmlentities($getData[12]));
                $source_of_fund = $this->sdmenc(htmlentities($getData[13]));
                $cost_of_acquisition = $this->sdmenc(htmlentities($this->parse_number($getData[14])));
                $date_of_acquisition = $this->sdmenc(date("Y-m-d", strtotime($getData[15])));
                $estimated_total_life_years = $this->sdmenc(htmlentities($getData[16]));
                $name_of_accountable_officer = $this->sdmenc(htmlentities($getData[17]));
                $asset_location = $this->sdmenc(htmlentities($getData[18]));
                $service_center = $this->sdmenc(htmlentities($getData[19]));
                $room_number = $this->sdmenc(htmlentities($getData[20]));
                $remarks = $this->sdmenc(htmlentities($getData[21]));
                $output = "3";
                if ($has_cost_problem == false) {
                    $client = new \GuzzleHttp\Client();
                    $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "property_number" => $property_number, "asset_item" => $asset_item, "office_type" => $office_type, "office_name" => $office_name, "asset_classification" => $asset_classification, "asset_sub_class" => $asset_sub_class, "uacs_object_code" => $uacs_object_code, "manufacturer" => $manufacturer, "model" => $model, "serial_number" => $serial_number, "specification" => $specification, "current_condition" => $current_condition, "source_of_fund" => $source_of_fund, "cost_of_acquisition" => $cost_of_acquisition, "date_of_acquisition" => $date_of_acquisition, "estimated_total_life_years" => $estimated_total_life_years, "name_of_accountable_officer" => $name_of_accountable_officer, "asset_location" => $asset_location, "remarks" => $remarks, "unit_of_measure" => $unit_of_measure, "service_center" => $service_center, "room_number" => $room_number, "sc_id" => $sc_id, ]]);
                    $mysignature = $this->sdmdec($property_number);
                    if ($mysignature != "") {
                        array_push($asset_signature, $mysignature);
                    }
                    $is_inserted = "";
                    $output = $this->sdmdec($result->getBody()->getContents());
                    $hasinsertednew = false;
                    if ($output == "1") {
                        $is_inserted = "Added";
                        $hasinsertednew = true;
                        $inserted_new++;
                    } else if ($output == "2") {
                        $is_inserted = "Updated";
                    } else if ($output == "3") {
                        $is_inserted = "Not Inserted";
                    }
                }
                if ($missinglog != "") {
                    $mylogs.= "<tr><td>" . $getData[10] . "</td><td>" . $getData[5] . "</td><td>" . $missinglog . "</td></tr>";
                } else if ($has_cost_problem == true) {
                    $logreason = "Not inserted. Cost of Aquisition (" . htmlentities($getData[14]) . ") is below 15,000";
                    $mylogs.= "<tr><td>" . htmlentities($getData[10]) . "</td><td>" . htmlentities($getData[5]) . "</td><td> " . $logreason . "</td></tr>";
                    $data_structure = $this->sdmdec($office_type) . "<|next|>" . $this->sdmdec($office_name) . "<|next|>" . $this->sdmdec($asset_classification) . "<|next|>" . $this->sdmdec($asset_sub_class) . "<|next|>" . $this->sdmdec($uacs_object_code) . "<|next|>" . $this->sdmdec($asset_item) . "<|next|>" . $this->sdmdec($manufacturer) . "<|next|>" . $this->sdmdec($model) . "<|next|>" . $this->sdmdec($serial_number) . "<|next|>" . $this->sdmdec($specification) . "<|next|>" . $this->sdmdec($property_number) . "<|next|>" . $this->sdmdec($unit_of_measure) . "<|next|>" . $this->sdmdec($current_condition) . "<|next|>" . $this->sdmdec($source_of_fund) . "<|next|>" . $this->sdmdec($cost_of_acquisition) . "<|next|>" . $this->sdmdec($date_of_acquisition) . "<|next|>" . $this->sdmdec($estimated_total_life_years) . "<|next|>" . $this->sdmdec($name_of_accountable_officer) . "<|next|>" . $this->sdmdec($asset_location) . "<|next|>" . $this->sdmdec($service_center) . "<|next|>" . $this->sdmdec($room_number) . "<|next|>" . $this->sdmdec($remarks);
                    $this->send(['tag' => "INSERT_NEW_NOT_INSERTED_DATUM_CO", "jsondata" => $this->sdmenc($data_structure), "stationid" => $this->sdmenc(session("user_school")), "subnote" => $this->sdmenc(htmlentities($logreason)) ]);
                    $inserted_not++;
                } else if ($output == "1" && $hasinsertednew == false) {
                    $inserted_new++;
                } else if ($output == "2") {
                    $inserted_alreadyexisting++;
                } else if ($output == "3") {
                    $mylogs.= "<tr><td>" . $getData[10] . "</td><td>" . $getData[5] . "</td><td> Not inserted.</td></tr>";
                }
            } else if ($previewcount == 0 && $valid_header == 0) {
                return $previewcount . " and " . $valid_header;
            } else if ($already_there == true) {
                $mylogs.= "<tr><td>" . $getData[10] . "</td><td>" . $getData[5] . "</td><td> Property number is not unique (NOT INSERTED).</td></tr>";
                $inserted_not++;
                $tots++;
            } else {
                $has_propertynum = false;
                $fieldwithvals = 0;
                for ($i = 0;$i < count($fieldsx);$i++) {
                    if ($getData[$i] != "" && $getData[$i] != null) {
                        $fieldwithvals++;
                    }
                    if ($i == 10) {
                        if ($getData[10] == '' || $getData[10] == null) {
                            $has_propertynum = false;
                        } else {
                            $has_propertynum = true;
                        }
                    }
                }
                if ($fieldwithvals > 5 && $has_propertynum == false) {
                    $tots++;
                    $inserted_not++;
                    $mylogs.= "<tr><td>" . $getData[10] . "</td><td>" . $getData[5] . "</td><td> Please add the property number of this item (NOT INSERTED).</td></tr>";
                }
            }
            $previewcount++;
        }
        $tag = $this->sdmenc("add_to_historylogs");
        //ADD TO LOG HISTORY
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "lg_total_csv" => $this->sdmenc($tots), "lg_inserted" => $this->sdmenc($inserted_new), "lg_update" => $this->sdmenc($inserted_alreadyexisting), "lg_incomplete" => $this->sdmenc($blankcols), "lg_notinserted" => $this->sdmenc($inserted_not), "lg_station_id" => $this->sdmenc(session("user_school")), "lg_origin" => $this->sdmenc(session("user_eid")), ]]);
        // return $result->getBody()->getContents();
        $this->RecordLog("a01");
        // ANALYZE WHATS NOT HERE COMPARED TO LAST TIME
        $nothere = "";
        $omitted_count = 0;
        $omitted_tbl = "";
        for ($i = 0;$i < count($asset_signature_existing);$i++) {
            $signature = $asset_signature_existing[$i];
            $item_id = $asset_signature_existing_id[$i];
            if (!in_array($signature, $asset_signature)) {
                $nothere.= $signature . " ";
                $omitted_count++;
                $tag = $this->sdmenc("get_asset_info_singleton");
                // GET EXISITING ASSETS
                $client = new \GuzzleHttp\Client();
                $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "data_id" => $this->sdmenc($item_id), "station_id" => $this->sdmenc(session("user_school")), ]]);
                $out_res = json_decode($this->sdmdec($result->getBody()->getContents()), true);
                $omitted_tbl.= "
        <tr>
        <td>" . htmlentities($out_res[0]["property_number"]) . "</td>
        <td>" . htmlentities(substr($out_res[0]["asset_item"], 0, 25)) . "...</td>
        </tr>";
            }
        }
        $guessExtension = $photo->getClientOriginalExtension();
        $origname = $photo->getClientOriginalName();
        $newfilename = str_replace(" ", "", session("user_school")) . "--" . date("F_d_Y-g_i_a") . "." . $guessExtension;
        $tag = $this->sdmenc("index_upload_asset_csv");
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "file_name" => $this->sdmenc($newfilename), "st_id" => $this->sdmenc(session("user_school")), "empid" => $this->sdmenc(session("user_eid")), "realname" => $this->sdmenc($origname), "file_format" => $this->sdmenc($guessExtension), ]]);
        $photo->move(public_path() . "/uploads/", $newfilename);
        // RUN PROPERTY NUMBER SEPARATION TECHNOLOGY
        $tag = $this->sdmenc("run_separation_tech");
        $client = new \GuzzleHttp\Client();
        $resultxm = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "st_id" => $this->sdmenc(session("user_school")) ]]);
        $outx = $this->sdmdec($resultxm->getBody()->getContents());
        // $mylogs ="";
        $omitted_tbl = gzcompress($omitted_tbl);
        $mylogs = gzcompress($mylogs);
        // $omitted_tbl
        // $mylogs
        // return $outx;
        Alert::success("Asset Uploaded.");
        return redirect()->route("assetuploadresult", ["i_newly" => $inserted_new, "i_existing" => $inserted_alreadyexisting, "i_not" => $inserted_not, "i_logs" => $mylogs, "i_incomplete" => $blankcols, "total_assets" => $tots, "nothere" => $nothere, "omcount" => $omitted_count, "om_logs" => $omitted_tbl]);
    }
    public function load_res_all_bylatest() {
        $output = $this->send_get(["tag"=>"get_uploaded_assets_allstation_bylatest"]);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<tr>
<td>" . $output[$i]["name"] . "</td>

          <td>";
            switch ($output[$i]["fileformat"]) {
                case "csv":
                    $toecho.= '<h4><i class="fas fa-file-csv"></i></h4>';
                break;
                case "pdf":
                    $toecho.= '<h4><i class="far fa-file-pdf"></i></h4>';
                break;
                case "docx":
                    $toecho.= '<h4><i class="fas fa-file-word"></i></h4>';
                break;
                case "xlsx":
                    $toecho.= '<h4><i class="fas fa-table"></i></h4>';
                break;
                case 'xls':
                    $toecho.= '<h4><i class="far fa-file-excel"></i></h4>';
                break;
                case "txt":
                    $toecho.= '<h4><i class="far fa-sticky-note"></i></h4>';
                break;
            }
            $toecho.= "</td><td><a download='" . $output[$i]["realname"] . "' href='" . asset('/uploads/' . $output[$i]["filename"]) . "'>" . $output[$i]["realname"];
            $toecho.= "</a></td>
           <td>";
            if ($output[$i]["username"] == '') {
                $toecho.= "Not Available";
            } else {
                $toecho.= ucwords(strtolower($output[$i]["username"]));
            }
            $toecho.= "</td>
            <td><small class='float-right text-muted'>" . $this->DateExplainder($output[$i]["dateuploaded"]) . "</small>" . date("F d, Y g:i a", strtotime($output[$i]["dateuploaded"])) . "</td>
     
        </tr>";
        }
        return $toecho;
    }
    public function lodresups() {
        $output = $this->send_get(["tag"=>"get_uploaded_assets", "st_id" => $this->sdmenc(session("user_school"))]);
        $toecho = "";
        for ($i = 0;$i < count($output);$i++) {
            $toecho.= "<tr>


          <td>";
            switch ($output[$i]["fileformat"]) {
                case "csv":
                    $toecho.= '<h4><i class="fas fa-file-csv"></i></h4>';
                break;
                case "pdf":
                    $toecho.= '<h4><i class="far fa-file-pdf"></i></h4>';
                break;
                case "docx":
                    $toecho.= '<h4><i class="fas fa-file-word"></i></h4>';
                break;
                case "xlsx":
                    $toecho.= '<h4><i class="fas fa-table"></i></h4>';
                break;
                case 'xls':
                    $toecho.= '<h4><i class="far fa-file-excel"></i></h4>';
                break;
                case "txt":
                    $toecho.= '<h4><i class="far fa-sticky-note"></i></h4>';
                break;
            }
            $toecho.= "</td><td>  <a download='" . $output[$i]["realname"] . "' href='" . asset('/uploads/' . $output[$i]["filename"]) . "'>" . $output[$i]["realname"];
            $toecho.= "</a></td>
           <td>" . ucwords(strtolower($output[$i]["username"])) . "</td>
            <td><small class='float-right text-muted'>" . $this->DateExplainder($output[$i]["dateuploaded"]) . "</small>" . date("F d, Y g:i a", strtotime($output[$i]["dateuploaded"])) . " </td>
             <td>
        
     <a class='btn btn-danger btn-sm' onclick='opendeleteresource(this)' data-rid='" . $output[$i]["assetidres"] . "' data-toggle='modal' data-target='#modal_delnow' href='#'><i class='far fa-trash-alt'></i> Delete</a>

             </td>
        </tr>";
        }
        return $toecho;
    }
    public function deleresnow(Request $req) {
        $tag = $this->sdmenc("deleteanewreource");
        $id_of_something = $this->sdmenc($req["id_of_something"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "id_of_something" => $id_of_something, ]]);
        $result = $this->sdmdec($result->getBody()->getContents());
        if ($result == "true") {
            Alert::success("Asset Deleted!");
            return redirect()->route("asset_resources");
        } else {
            Alert::error("Unable to delete asset!");
            return redirect()->route("asset_resources");
        }
    }
    public function parse_number($number, $dec_point = null) {
        if (empty($dec_point)) {
            $locale = localeconv();
            $dec_point = $locale['decimal_point'];
        }
        return floatval(str_replace($dec_point, '.', preg_replace('/[^\d' . preg_quote($dec_point) . ']/', '', $number)));
    }
    public function addnewregistryreocrd(Request $req) {
        $tag = $this->sdmenc("add_new_item_registry");
        $property_number = $this->sdmenc($req["property_number"]);
        $asset_item = $this->sdmenc($req["asset_item"]);
        $office_type = $this->sdmenc($req["office_type"]);
        $office_name = $this->sdmenc($req["office_name"]);
        $asset_classification = $this->sdmenc($req["asset_classification"]);
        $asset_sub_class = $this->sdmenc($req["asset_sub_class"]);
        $uacs_object_code = $this->sdmenc($req["uacs_object_code"]);
        $manufacturer = $this->sdmenc($req["manufacturer"]);
        $model = $this->sdmenc($req["model"]);
        $serial_number = $this->sdmenc($req["serial_number"]);
        $specification = $this->sdmenc($req["specification"]);
        $current_condition = $this->sdmenc($req["current_condition"]);
        $source_of_fund = $this->sdmenc($req["source_of_fund"]);
        $cost_of_acquisition = $this->sdmenc($req["cost_of_acquisition"]);
        $date_of_acquisition = $this->sdmenc($req["date_of_acquisition"]);
        $estimated_total_life_years = $this->sdmenc($req["estimated_total_life_years"]);
        $name_of_accountable_officer = $this->sdmenc($req["name_of_accountable_officer"]);
        $asset_location = $this->sdmenc($req["asset_location"]);
        $remarks = $this->sdmenc($req["remarks"]);
        $unit_of_measure = $this->sdmenc($req["unit_of_measure"]);
        $service_center = $this->sdmenc($req["service_center"]);
        $room_number = $this->sdmenc($req["room_number"]);
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, 'property_number' => $property_number, 'asset_item' => $asset_item, 'office_type' => $office_type, 'office_name' => $office_name, 'asset_classification' => $asset_classification, 'asset_sub_class' => $asset_sub_class, 'uacs_object_code' => $uacs_object_code, 'manufacturer' => $manufacturer, 'model' => $model, 'serial_number' => $serial_number, 'specification' => $specification, 'current_condition' => $current_condition, 'source_of_fund' => $source_of_fund, 'cost_of_acquisition' => $cost_of_acquisition, 'date_of_acquisition' => $date_of_acquisition, 'estimated_total_life_years' => $estimated_total_life_years, 'name_of_accountable_officer' => $name_of_accountable_officer, 'asset_location' => $asset_location, 'remarks' => $remarks, 'unit_of_measure' => $unit_of_measure, 'service_center' => $service_center, 'room_number' => $room_number, ]]);
        $result = $result->getBody()->getContents();
        if ($result == "1") {
            Alert::success("Asset has been added!");
            return redirect()->route("assetregistry");
        } else if ($result == "2") {
            // return $result;
            Alert::error("Asset already exist!");
            return redirect()->route("assetregistry");
        }
    }
    // SDM PROPERTIES
    public function RecordLog($logcode) {
        $station_id = $this->sdmenc(session("user_school"));
        $account_id = $this->sdmenc(session("user_eid"));
        $logcode = $this->sdmenc($logcode);
        $tag = $this->sdmenc("addlogs");
        $client = new \GuzzleHttp\Client();
        $result = $client->request("POST", WEBSERVICE_URL, ["form_params" => ['tag' => $tag, "station_id" => $station_id, "account_id" => $account_id, "action_code" => $logcode, ]]);
    }
    public function compute_lifeprice($from, $cost, $items_count, $lifeyears) {
        $date_of_aquisition = $from;
        $cost_of_aquisition = $cost;
        $date_today = date("Y-m-d");
        $estimated_lifeyears = $lifeyears;
        $total_years = 1;
        $pri_dedution = 0;
        if ($total_years != 0) {
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
        $dt_cout = explode(",", $this->count_years($date_of_aquisition, $date_today));
        $overall = $per_year * $dt_cout[0];
        if ($overall > $cost_of_aquisition) {
            $overall = $cost_of_aquisition;
        } else {
            $overall+= ($per_month * $dt_cout[1]);
        }
        return $cost - ($overall * $items_count);
        // return 3333;
        
    }
    public function count_years($d1, $d2) {
        $date1 = $d1;
        $date2 = $d2;
        $diff = abs(strtotime($date2) - strtotime($date1));
        $years = floor($diff / (365 * 60 * 60 * 24));
        $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
        $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
        return $years . "," . $months;
    }
    public function sdm_encrypt($data, $hash) {
        // return "x - " . md5($data);
        $keycode = openssl_digest(utf8_encode($hash), "sha512", true);
        $string = substr($keycode, 10, 24);
        // DATA
        $utfData = utf8_encode($data);
        $encryptData = openssl_encrypt($utfData, "DES-EDE3", $string, OPENSSL_RAW_DATA, '');
        $base64Data = base64_encode($encryptData);
        return $base64Data;
    }
    public function sdm_decrypt($data, $hash) {
        // return "x - " . md5($data);
        $keycode = openssl_digest(utf8_encode($hash), "sha512", true);
        $string = substr($keycode, 10, 24);
        $utfData = base64_decode($data);
        $decryptData = openssl_decrypt($utfData, "DES-EDE3", $string, OPENSSL_RAW_DATA, '');
        // $base64Data = base64_decode($decryptData);
        return $decryptData;
    }
    // FLASH CODE TECHNOLOGIES
    // FLASH CODE TECHNOLOGIES
    // FLASH CODE TECHNOLOGIES
    public function ShowOutput($out, $need_decryption = false) {
        if ($need_decryption == true) {
            $out = $this->sdmdec($out, true);
        }
        return json_encode($out);
    }
    public function quick_result($output, $page, $passed_array = [], $custom_message = "") {
        if ($output[0] == "true") {
            if ($custom_message != "") {
                Alert::success($custom_message);
            } else {
                Alert::success("Success!");
            }
            return redirect()->route($page, $passed_array);
        } else {
            if ($custom_message != "") {
                Alert::error($custom_message);
            } else {
                Alert::error("Error!");
            }
            return redirect()->route($page, $passed_array);
        }
    }
    public function quick_error($page) {
        Alert::error("Please check your given information!");
        return redirect()->route($page);
    }
    public function quick_success($page) {
        Alert::success("You got it!");
        return redirect()->route($page);
    }
    public function send($contents, $free_result = false) {
        $contents['tag'] = $this->sdmenc($contents['tag']);
        $client = new \GuzzleHttp\Client();
        $res = $client->request("POST", WEBSERVICE_URL, ["form_params" => $contents]);
        if ($free_result == false) {
            return json_decode($this->sdmdec($res->getBody()->getContents()), true);
        } else {
            return $this->sdmdec($res->getBody()->getContents());
        }
    }
     public function send_get($contents, $free_result = false) {
        $contents['tag'] = $this->sdmenc($contents['tag']);
        $client = new \GuzzleHttp\Client();
        $res = $client->request("GET", WEBSERVICE_URL, ["query" => $contents]);
        $output = $res->getBody()->getContents();
        if ($free_result == false) {
            return json_decode($this->sdmdec($output),true);
        } else {
            return $this->sdmdec($output);
        }
    }
    public function tblform_dropdown($name, $contents) {
        return ' <div class="dropdown">
      <a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-cog"></i> ' . $name . '
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
      ' . $contents . ' 
      </div>
      </div>';
    }
    public function form_select($value, $name) {
        return "<option value='" . $value . "'>" . $name . "</option>";
    }
    public function form_tbl($cols) {
        $structure = "<tr>";
        for ($i = 0;$i < count($cols);$i++) {
            $content = $cols[$i];
            // CHECK IF DATE
            if (date("Y", strtotime($content)) != "1970" && strlen($content) != 1) {
                $content = date("F d, Y g:i a", strtotime($content));
            } else {
                //IF RICH TEXT
                if (strpos($content, "<a ") == false && strpos($content, "<button ") == false && strpos($content, "<img ") == false && strpos($content, "<p>") == false) {
                    $content = "<pre>" . $content . " </pre>";
                }
            }
            $structure.= "<td>" . $content . "</td>";
        }
        $structure.= "</tr>";
        return $structure;
    }
    public function DateExplainder($starting_time) {
        date_default_timezone_set('asia/manila');
        $now = time(); // or your date as well
        $your_date = strtotime($starting_time);
        $datediff = $now - $your_date;
        $result = round($datediff / (60 * 60 * 24));
        $months = number_format((round($datediff / (60 * 60 * 24))) / 30);
        if ($result == 0) {
            $time1 = date('H:i', strtotime($starting_time));
            $time2 = date('H:i');
            $diff = abs(strtotime($time1) - strtotime($time2));
            $tmins = $diff / 60;
            $hours = floor($tmins / 60);
            $mins = $tmins % 60;
            if ($mins == '0' && $hours == '0') {
                return 'Just now';
            } else if ($mins == '1' && $hours == '0') {
                return '1 min ago';
            } else {
                if ($hours == '0') {
                    return "$mins mins ago";
                } else if ($hours == '1') {
                    return 'an hour ago';
                } else {
                    return "$hours hours ago";
                }
            }
        } else {
            if ($result == '1') {
                return 'yesterday';
            } else if ($months > 12) {
                $yearcount = number_format(($months / 12), "0");
                if ($yearcount == "1") {
                    return "a year ago";
                } else if ($yearcount < 10) {
                    return $yearcount . " years ago";
                } else if ($yearcount > 10) {
                    $decades = number_format(($yearcount / 10), 0);
                    if ($decades == 1) {
                        return "a decade ago";
                    } else {
                        return $decades . " decades ago";
                    }
                }
            } else if ($result > 30) {
                if ($months == 1) {
                    return 'last month';
                } else {
                    return $months . ' months ago';
                }
            } else {
                $daysago = round($datediff / (60 * 60 * 24));
                if ($daysago > 7) {
                    $weeks = number_format(($daysago / 7), 0);
                    if ($weeks == 1) {
                        return "a week ago";
                    } else {
                        return $weeks . " weeks ago";
                    }
                } else {
                    return $daysago . " days ago";
                }
            }
        }
    }
    public function sdmenc($data) {
        $keycode = openssl_digest(utf8_encode(PKEY), 'sha512', true);
        $string = substr($keycode, 10, 24);
        $utfData = utf8_encode($data);
        $encryptData = openssl_encrypt($utfData, 'DES-EDE3', $string, OPENSSL_RAW_DATA, '');
        $base64Data = base64_encode($encryptData);
        return $base64Data;
    }
    public function sdmdec($data) {
        $keycode = openssl_digest(utf8_encode(PKEY), 'sha512', true);
        $string = substr($keycode, 10, 24);
        $utfData = base64_decode($data);
        $decryptData = openssl_decrypt($utfData, 'DES-EDE3', $string, OPENSSL_RAW_DATA, '');
        return $decryptData;
    }
}