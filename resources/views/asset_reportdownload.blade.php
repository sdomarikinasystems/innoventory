<?php
  // PRINT CSV REPORT
      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="Asset Registry.csv"');

      $data = array("Office Type","Office Name","Asset Classification","Asset Sub Class","UACS Code","Asset Item Name","Manufacturer","Model Name","Serial Number","Specification","Property Number","Unit of Measure","Current Condition","Source Of Fund","Cost of Acquisition","Date of Aquisition","Estimated Total Life Years","Name of Accountable Officer","Asset Location","Service Center","Room Number","Remarks");

// $thedata = jso

        for ($i=0; $i < cout($thedata); $i++) { 
          $toadd = ""
           . $thedata[$i]["office_type"] . ","
           . $thedata[$i]["office_name"] . ","
            . $thedata[$i]["asset_classification"] . ","
             . $thedata[$i]["asset_sub_class"] . ","
              . $thedata[$i]["uacs_object_code"] . ","
               . $thedata[$i]["asset_item"] . ","
                . $thedata[$i]["manufacturer"] . ","
                 . $thedata[$i]["model"] . ","
                  . $thedata[$i]["serial_number"] . ","
                  . $thedata[$i]["specification"] . ","
                  . $thedata[$i]["property_number"] . ","
                  . $thedata[$i]["unit_of_measure"] . ","
                  . $thedata[$i]["current_condition"] . ","
                  . $thedata[$i]["source_of_fund"] . ","
                  . $thedata[$i]["cost_of_acquisition"] . ","
                  . $thedata[$i]["date_of_acquisition"] . ","
                  . $thedata[$i]["estimated_total_life_years"] . ","
                  . $thedata[$i]["name_of_accountable_officer"] . ","
                  . $thedata[$i]["asset_location"] . ","
                  . $thedata[$i]["service_center"] . ","
                  . $thedata[$i]["room_number"] . ","
                  . $thedata[$i]["remarks"];
            array_push($data, $toadd);
      }

      $fp = fopen('php://output', 'w');
      foreach ( $data as $line ) {
      $val = explode(",", $line);
      fputcsv($fp, $val);
      }
      fclose($fp);


?>