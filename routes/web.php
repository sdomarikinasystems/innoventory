<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// STARTING SCREEN
Route::get('/', function () {
    return view('login');
});
// LOGIN

//RENZ FUNCTION CORE
Route::get("/innoventory/asset/qr",["uses"=>"qrController@get_asset_items","as"=>"fetch_asset"]);
Route::get("/asset_print",["uses"=>"qrController@print_asset","as"=>"pr_asset"]);
Route::post("/get_items",["uses"=>"qrController@get_items","as"=>"g_items"]);

// CORE
Route::get("/innoventory/manage/users",['uses'=>'functions@usermanagement','as'=>'usermanagement']);
Route::get("/innoventory/dashboard",["uses"=>"functions@dboard","as"=>"dboard"]);
Route::get("/innoventory/asset/registry",['uses'=>'functions@assetregistry','as'=>'assetregistry']);
Route::get("/lod_disc_indetail",["uses"=>"functions@lod_discrep_indetail","as"=>"lod_discrep_indetail"]); //update to >>> /innoventory/asset/registry/discrepancies
Route::get("/innoventory/asset/inventory",["uses"=>"functions@asset_scanned","as"=>"asset_scanned"]);
Route::get("/viewallnoentryitems",["uses"=>"functions@view_all_unencludedassets","as"=>"view_all_unencludedassets"]); //update to >>> /innoventory/asset/inventory/notfound
Route::get("/innoventory/asset/disposal",["uses"=>"functions@asset_disposed","as"=>"asset_disposed"]);
Route::get("/innoventory/asset/inventory/reports",["uses"=>"functions@manage_reports","as"=>"manage_reports"]);
Route::get("/innoventory/asset/resources",["uses"=>"functions@asset_resources","as"=>"asset_resources"]);
Route::get("/innoventory/manage/schools",["uses"=>"functions@manstat","as"=>"manstat"]);
Route::get("/innoventory/manage/service_centers",["uses"=>"functions@stationmy","as"=>"stationmy"]);
Route::get("/innoventory/asset/registry/upload_summary",["uses"=>"functions@assetuploadresult","as"=>"assetuploadresult"]);
Route::get("/innoventory/manage/reminders",["uses"=>"functions@manage_reminders","as"=>"manage_reminders"]);
Route::get("/innoventory/asset/print_qr",["uses"=>"functions@manage_utilities","as"=>"manage_utilities"]);
Route::get("/innoventory/system/abouts",["uses"=>"functions@go_abouts","as"=>"abouts_sys"]);
Route::get("/innoventory/asset/transactionhistory",["uses"=>"functions@ass_transhis","as"=>"ass_transhistory"]);
Route::get("/innoventory/reports/asset_download",["uses"=>"functions@goto_assetdl","as"=>"assetdl"]);
Route::get("/innoventory/reports/registry_omissions",["uses"=>"functions@goto_regoms","as"=>"reg_omissions"]);
// HOW TO 
Route::get("/innoventory/how_to",["uses"=>"functions@goto_howto","as"=>"gohow"]);
// ADD-ON
Route::post("/innoventory/manage/service_centers/add",["uses"=>"functions@addnewassloc","as"=>"addnewassloc"]);
Route::post("/addnewregistryreocrd",['uses'=>'functions@addnewregistryreocrd','as'=>'addnewregistryreocrd']);
Route::post("/uploadassetregistrycsv",["uses"=>"functions@uploadassetregistrycsv","as"=>"uploadassetregistrycsv"]);
Route::post("/preview_csv",["uses"=>"functions@preview_csv","as"=>"preview_csv"]);
Route::post("/displayencodedass",["uses"=>"functions@display_all_encoded_assets","as"=>"display_all_encoded_assets"]);
Route::post("/displaydisposedassets",["uses"=>"functions@asset_disp_disposed","as"=>"asset_disp_disposed"]);
Route::post("/getallemployees",["uses"=>"functions@display_all_employees","as"=>"display_all_employees"]);
Route::post("/getallscnames",["uses"=>"functions@load_all_school_names","as"=>"load_all_school_names"]);
Route::post("/add_user",["uses"=>"functions@add_a_new_user","as"=>"add_a_new_user"]);
Route::post("/del_user",["uses"=>"functions@delete_the_user","as"=>"delete_the_user"]);
Route::post("/edit_acc",["uses"=>"functions@edit_the_user_info","as"=>"edit_the_user_info"]);
Route::post("/get_inf_user",["uses"=>"functions@get_acc_info_edit","as"=>"get_acc_info_edit"]);
Route::post("/archive_asset",["uses"=>"functions@archive_an_asset","as"=>"archive_an_asset"]);
Route::post("/restore_asset",["uses"=>"functions@restore_an_asset","as"=>"restore_an_asset"]);
Route::get("/asset_deeplook",["uses"=>"functions@asset_view","as"=>"asset_view"]);
Route::post("/get_asset_full",["uses"=>"functions@my_asset_full","as"=>"my_asset_full"]);
Route::post("/get_grouped_categories",["uses"=>"functions@get_cat_gr","as"=>"get_cat_gr"]);
Route::post("/get_grouped_rooms",["uses"=>"functions@get_roo_gr","as"=>"get_roo_gr"]);
Route::get("/asset_grouptool",["uses"=>"functions@group_asset","as"=>"group_asset"]);
Route::post("/load_filtered_assets",["uses"=>"functions@lod_asset_filtered","as"=>"lod_asset_filtered"]);
Route::post("/add_new_assgr",["uses"=>"functions@add_new_asset_group","as"=>"add_new_asset_group"]);
Route::post("/view_ass_grouped",["uses"=>"functions@viewassetgrouped","as"=>"viewassetgrouped"]);
Route::post("/ung_ims",["uses"=>"functions@ungroup_items","as"=>"ungroup_items"]);
Route::get("/printdoc_a66",["uses"=>"functions@printapp66","as"=>"printapp66"]);
Route::post("/gen_ass_rep_printout",["uses"=>"functions@generate_asset_report_printout","as"=>"generate_asset_report_printout"]);
Route::post("/get_ass_pdf_pagecount",["uses"=>"functions@bionic_page_count","as"=>"bionic_page_count"]);
Route::post("/get_scanned_assets",["uses"=>"functions@get_ass_scanned","as"=>"get_ass_scanned"]);
Route::post("/get_sca_occupied_dates",["uses"=>"functions@get_sc_occudates","as"=>"get_sc_occudates"]);
Route::post("/get_sca_totalitems",["uses"=>"functions@g_sca_ttitms","as"=>"g_sca_ttitms"]);
Route::post("/get_no_ent_sca",["uses"=>"functions@get_not_entry_scannedassets","as"=>"get_noscitems"]);

Route::post("/geallscannedass_notincluded",["uses"=>"functions@get_asc_not_included","as"=>"get_asc_not_included"]);
Route::get("/gotologin",["uses"=>"functions@asklogin","as"=>"asklogin"]);
Route::post("/proc_signin",["uses"=>"functions@proc_sign_protocol","as"=>"proc_sign_protocol"]);
Route::get("/proc_logout_now",["uses"=>"functions@proc_logout","as"=>"proc_logout"]);
Route::post("/loadallassetlocationsencoded",["uses"=>"functions@lodasslocenc","as"=>"lodasslocenc"]);
Route::post("/loadallstation",["uses"=>"functions@load_stat_enc","as"=>"load_stat_enc"]);
Route::post("/del_a_station",["uses"=>"functions@stat_del_now","as"=>"stat_del_now"]);
Route::post("/add_new_station",["uses"=>"functions@new_station","as"=>"new_station"]);
Route::post("/get_reg_last_sum",["uses"=>"functions@get_all_last_upload_log","as"=>"get_all_last_upload_log"]);
Route::post("/lod_furth_val",["uses"=>"functions@get_futh_val_ass_reg","as"=>"get_futh_val_ass_reg"]);
Route::post("/remloc",["uses"=>"functions@removelocation","as"=>"removelocation"]);
Route::post("/loadstationpreferences",["uses"=>"functions@lodstaprefx","as"=>"lodstaprefx"]);
Route::post("/lod_ass_val_sum",["uses"=>"functions@loadassetvalsum","as"=>"loadassetvalsum"]);

Route::post("/get_discrep_indetail",["uses"=>"functions@lod_dis_indetail","as"=>"lod_dis_indetail"]);
Route::post("/get_all_transhistory",["uses"=>"functions@get_trhisto","as"=>"get_trhisto"]);
Route::post("/get_export_his",["uses"=>"functions@get_export_history","as"=>"get_export_history"]);
Route::post("/search_station_toview",["uses"=>"functions@search_asstov","as"=>"search_asstov"]);
Route::post("/get_sc_fn",["uses"=>"functions@get_school_fullname","as"=>"get_school_fullname"]);
Route::get("/stations_man",["uses"=>"functions@sta_amanagement","as"=>"sta_amanagement"]);
Route::post("/addstation_new",["uses"=>"functions@addnewsta_xnow","as"=>"addnewsta_xnow"]);
Route::post("/view_all_ass",["uses"=>"functions@view_all_st_names","as"=>"view_all_st_names"]);
Route::post("/delstation",["uses"=>"functions@delstationnow","as"=>"delstationnow"]);
Route::post("/edit_sc_details",["uses"=>"functions@edit_sc_info","as"=>"edit_sc_info"]);
Route::get("/manage_myaccount",["uses"=>"functions@myaccount","as"=>"myaccount"]);
Route::post("/cha_pass",["uses"=>"functions@passchange","as"=>"passchange"]);
Route::post("/get_dash_info",["uses"=>"functions@count_all_created_asset_loc","as"=>"count_all_created_asset_loc"]);
Route::post("/get_tobegenerated_report_count",["uses"=>"functions@get_tobegen_repcount","as"=>"get_tobegen_repcount"]);
Route::post("/get_center_manager",["uses"=>"functions@center_managers_view","as"=>"centermanviews"]);
Route::post("/get_center_selection",["uses"=>"functions@centerman_selection","as"=>"getcentermanselection"]);
Route::post("/add_a_newremi",["uses"=>"functions@addrem","as"=>"addnewreminder"]);
Route::post("/display_reminders_byorigin",["uses"=>"functions@getremorgi","as"=>"getremindersbyorigin"]);
Route::post("/delete_this_rmeinder_inhouse",["uses"=>"functions@delremthis","as"=>"deletethisreminder"]);
Route::post("/load_new_announcements",["uses"=>"functions@lodnewannounce","as"=>"getmynewannouncements"]);
Route::post("/load_allofmy_assuploads",["uses"=>"functions@lodresups","as"=>"getmyresourcesofassets"]);
Route::post("/load_all_resource_bylatest",["uses"=>"functions@load_res_all_bylatest","as"=>"getallreourcesbylatest"]);
Route::post("/upload_res_now",["uses"=>"functions@upresnow","as"=>"uploadresourcenow"]);
Route::post("/delete_resource_singleton",["uses"=>"functions@deleresnow","as"=>"del_a_re_now"]);
Route::post("/find_new_service_centers",["uses"=>"functions@findnewservcen","as"=>"findnewsercen"]);
Route::post("/import_all_founded_service_center",["uses"=>"functions@impallfoundsercen","as"=>"importallfoundservicecenters"]);
Route::post("/change_incharge_insection",["uses"=>"functions@chainsecnow","as"=>"changeinchargeintheservicecenter"]);
Route::post("/find_new_service_center_count",["uses"=>"functions@findservcount","as"=>"findnewservicecentercount"]);
Route::post("/getreport_now_singleton",["uses"=>"functions@get_report","as"=>"getrepo"]);
Route::post("/extract_grouped_content",["uses"=>"functions@extgroupedconts","as"=>"get_grouped_asset_contents"]);
Route::get("/just_a_try_print",["uses"=>"functions@tryprint","as"=>"tprint"]);
Route::get("/innoventory/assets/omitted",["uses"=>"functions@goto_omitts","as"=>"gotoomitted"]);
Route::post("/get_items_omitted_for_display",["uses"=>"functions@get_om_itms_astbls","as"=>"get_omitteditems_astable"]);
Route::post("/clear_omitted_assets",["uses"=>"functions@clearallomitted","as"=>"clear_omass"]);
Route::post("/ignore_single_omitted_asset",["uses"=>"functions@ignore_single_omitted","as"=>"ig_sin_om"]);
Route::post("/check_if_inventory_ready",["uses"=>"functions@inventory_checkif_ready","as"=>"checinvread"]);
Route::post("/get_service_centers_for_qr_filter",["uses"=>"functions@get_ser_fqrs","as"=>"get_ser_of_sta_fo_fil"]);
Route::post("/get_qr_assets_by_service_center",["uses"=>"functions@get_qr_as_sbyer","as"=>"Loadqrbyservicecen"]);
Route::post("/see_inventory_station_status",["uses"=>"functions@get_station_in_statuses","as"=>"seestationsinvstatus"]);
Route::post("/report_omitted_asset_singleton",["uses"=>"functions@rep_om_sing","as"=>"report_omitted_singleton"]);
Route::post("/display_omitted_data",["uses"=>"functions@display_omitted_of_station","as"=>"disp_omm_reps"]);
Route::post("/report_all_omitted_assets",["uses"=>"functions@rep_all_om_ass","as"=>"reportallomassets"]);






// INNOVENTORY VERSION 2 

// ASSET REGISTRY 
Route::post("/add_new_semi_expendable",["uses"=>"functions@fire_add_semi_expendible","as"=>"shoot_add_semi_expendible"]);
Route::post("/validate_uploaded_cvs_file",["uses"=>"functions@fire_preview_csv_semiexpendable","as"=>"shoot_preview_csv_semiexpendable"]);
Route::post("/get_all_my_service_center",["uses"=>"functions@look_all_ofmy_service_center","as"=>"shoot_all_ofmy_service_center"]);
Route::post("/get_semi_expendablebystation",["uses"=>"functions@look_semi_expendable_bystation","as"=>"stole_semi_expendable_bystation"]);
Route::post("/get_mysemi_discrepancies",["uses"=>"functions@look_my_semiexpendable_descrepancies","as"=>"stole_my_semiexpendable_descrepancies"]);
Route::post("/get_mysemi_omitted",["uses"=>"functions@look_semi_expendable_omitted","as"=>"stole_semi_expendable_omitted"]);
Route::post("/get_suppy_data",["uses"=>"functions@look_all_of_my_supply_data","as"=>"stole_all_of_my_supply_data"]);
Route::post("/validate_uploaded_supply_file",["uses"=>"functions@look_preview_of_uploaded_supplyfile","as"=>"stole_preview_of_uploaded_supplyfile"]);
Route::post("/add_new_supply",["uses"=>"functions@fire_add_supply","as"=>"shoot_add_supply"]);
Route::post("/clear_specific_asset_data_by_type_station",["uses"=>"functions@fire_delete_specific_assetdata_all","as"=>"shoot_delete_specific_assetdata_all"]);
Route::post("/get_not_inserted_co",["uses"=>"functions@look_not_inserted_recent_co_data","as"=>"stole_not_inserted_recent_co_data"]);


// ASSET INVENTORY PAGE
Route::post("/upload_semi_expendable_inventory",["uses"=>"functions@fire_uploadsemiexpendabledatascanned","as"=>"shoot_uploadsemiexpendabledata"]);
Route::post("/get_all_semi_expendable_asset_scanned",["uses"=>"functions@look_show_uploaded_semi_expendable_scanneddata","as"=>"shoot_show_uploaded_semi_expendable_scanneddata"]);
Route::post("/upload_scanned_capital_outlay",["uses"=>"functions@fire_uploadscannedcapitaloutlay","as"=>"shoot_uploadscannedcapitaloutlay"]);

Route::post("/get_total_scanned_semiassets",["uses"=>"functions@look_getsemisum_totalscanned","as"=>"stole_getsemisum_totalscanned"]);
Route::post("/get_from_to_dates_of_semiassets",["uses"=>"functions@look_getsemisum_fromto","as"=>"stole_getsemisum_fromto"]);
Route::post("/get_items_not_fount_of_semiassets",["uses"=>"functions@look_getsemisum_itemsnotfound","as"=>"stole_getsemisum_itemsnotfound"]);
Route::post("/get_all_year_with_inventory",["uses"=>"functions@look_all_years_with_inventory_capitaloutlay","as"=>"stole_all_years_with_inventory_capitaloutlay"]);
Route::post("/get_month_of_inventory_byyear_incapital_outlay",["uses"=>"functions@look_inventory_month_capital_outlay","as"=>"stole_inventory_month_capital_outlay"]);
Route::post("/get_inventory_years_semi",["uses"=>"functions@look_all_years_with_inventory_semiexpendable","as"=>"stole_all_years_with_inventory_semiexpendable"]);
Route::post("/get_inventory_months_semi_byyear",["uses"=>"functions@look_inventory_month_semiexpendable","as"=>"stole_inventory_month_semiexpendable"]);

// GENERATION OF APPENDIX 66
Route::get("/appendix_66_generation",["uses"=>"functions@fly_generate_appendix66","as"=>"goto_generate_appendix66"]);
Route::post("/get_se_ass66_pagecount",["uses"=>"functions@look_semi_pagecount","as"=>"stole_semi_pagecount"]);
Route::post("/get_se_ass66_printout",["uses"=>"functions@look_generate_se_app66_data","as"=>"stole_generate_se_app66_data"]);


// ASSET MISSING SEMI EXPENDABLE SCANNED PAGE
Route::get("/innoventory/inventory/semi_expendable/missing_items",["uses"=>"functions@fly_missing_scanned_semi","as"=>"goto_missing_scanned_semi"]);
Route::post("/get_missing_semi_data",["uses"=>"functions@look_get_semi_expendable_not_scanned","as"=>"stole_get_semi_expendable_not_scanned"]);

// ASSET SEMI VIEWING SINGLE
Route::get("/innoventory/semi_expendable/item_view",["uses"=>"functions@fly_semi_expendable_item_view","as"=>"goto_semi_expendable_item_view"]);
Route::post("/get_full_info_of_single_semi_expendable",["uses"=>"functions@look_single_semi_expenable","as"=>"stole_single_semi_expenable"]);

// INVENTORY GET DATA PAGE
Route::get("/innoventory/inventory/capital_outlay_inventory",["uses"=>"functions@fly_inventory_co","as"=>"goto_inventory_co"]);
Route::post("/get_all_service_centers",["uses"=>"functions@look_getallservicecenters","as"=>"stole_getallservicecenters"]);
Route::post("/get_service_center_allinfo_byid",["uses"=>"functions@look_single_service_center_data_byid","as"=>"stole_single_service_center_data_byid"]);
Route::post("/get_single_scanned_data_by_code",["uses"=>"functions@look_scanned_item_details","as"=>"stole_scanned_item_details"]);
Route::post("/get_maxval_of_capitalo_and_semie",["uses"=>"functions@look_get_max_values_of_CoSe","as"=>"stole_get_max_values_of_CoSe"]);
Route::post("/submit_scanned_asset_datum",["uses"=>"functions@fire_submit_scanned_data","as"=>"shoot_submit_scanned_data"]);
Route::post("/check_rediness_specific",["uses"=>"functions@look_checkready_specific","as"=>"stole_checkready_specific"]);
Route::post("/check_if_last_session",["uses"=>"functions@look_last_session","as"=>"stole_last_session"]);
Route::post("/remove_last_session",["uses"=>"functions@fire_remove_last_session","as"=>"shoot_remove_last_session"]);
Route::post("/save_session_today",["uses"=>"functions@fire_save_last_session","as"=>"shoot_save_last_session"]);
Route::post("/clear_cache_data_rec",["uses"=>"functions@fire_clear_recovery_data","as"=>"shoot_clear_recovery_data"]);


// ASSET SEMI EXPENDABLE DISCREPANCIES
Route::get("/innoventory/asset_registry/semi_expendable/discrepancies",["uses"=>"functions@fly_semiexpendable_discrepancies","as"=>"goto_semiexpendable_discrepancies"]);

// ASSET SEMI EXPENDIBLE OMITTED PADE
Route::get("/innoventory/asset_registry/semi_expendable/omitted",["uses"=>"functions@fly_semiexpedable_omitted","as"=>"goto_semiexpedable_omitted"]);

// USER MANAGEMENT
Route::post("/reset_password_byadmin",["uses"=>"functions@fire_reset_account_password","as"=>"shoot_reset_account_password"]);

// SEMI EXPENDIBLE VALIDATION PAGE
Route::get("/innoventory/asset_registry/semi_expendable",["uses"=>"functions@fly_semi_expendable_validationpage","as"=>"goto_semi_expendable_validationpage"]);

// SEMI EXPENDIBLE VALIDATION PAGE
Route::get("/innoventory/asset_registry/supply",["uses"=>"functions@fly_supply_validationpage","as"=>"goto_supply_validationpage"]);

// ISSUANCE
Route::get("/innoventory/issuances",["uses"=>"functions@fly_issuances","as"=>"goto_issuances"]);

// UNIVERSAL
Route::post("/get_last_logdate",["uses"=>"functions@look_last_date_ofcode","as"=>"stole_last_date_ofcode"]);
Route::post("/uni_change_source",["uses"=>"functions@fire_univ_change_source","as"=>"shoot_univ_change_source"]);


// user_changesource_station
// QR PRINING PAGE
Route::post("/translate_sdm_securitywise",["uses"=>"functions@fire_trans_sdm","as"=>"shoot_trans_sdm"]);

