<?php

 

function checkMriBTWDates($cId, $fromDate, $toDate, $mId, $myDateArr, $g) {
    $sql = "Select DISTINCT date as date from mri_data_imported where meterid='$mId' and date between '$fromDate' AND '$toDate' order by date asc";
    $result = $g->selectQueryInArray($sql);
    $dbDates = [];
    if (count($result) == 0) {
        return ["type" => "NODATA", "color" => "danger", "data" => "-1"];
    }
    foreach ($result as $value) {
        $dbDates[] = $value['date'];
    }
    $diffArr = (array_diff($myDateArr, $dbDates));
    $error = implode("", $diffArr);

    if ($error == "") {
        return ["type" => "DATA", "color" => "success", "data" => "-"];
    } else {
        return ["type" => "LESSDATA", "color" => "warning", "data" => 'data missing for dated ' . implode($diffArr)];
    }
}

function checkMriForDateMonth($cId, $month, $year, $mId, $myDateArr, $g) {
    $sql = "Select DISTINCT date as date from mri_data_imported where meterid='$mId' and month(`date`)='$month' and year(`date`)='$year' order by date asc";
    $result = $g->selectQueryInArray($sql);
    $dbDates = [];
    if (count($result) == 0) {
        return ["type" => "NODATA", "color" => "danger", "data" => "-1"];
    }
    foreach ($result as $value) {
        $dbDates[] = $value['date'];
    }
    $diffArr = (array_diff($myDateArr, $dbDates));
    $error = implode("", $diffArr);

    if ($error == "") {
        return ["type" => "DATA", "color" => "success", "data" => "-"];
    } else {
        return ["type" => "LESSDATA", "color" => "warning", "data" => 'data missing for dated ' . implode($diffArr)];
    }
}

function getMeterData($cid, $g1) {
    $result = $g1->selectQueryInArray("SELECT `id`,`cid`,`meter_no` FROM `consumer_meter_relation` WHERE `meter_type`='Main Meter' AND `cid`='" . $cid . "'");
    if ($result > 0) {
        return $result;
    } else {
        return "NA";
    }
}

function rrmdir($dir) {
    foreach (glob($dir . '/*') as $file) {
        if (is_dir($file))
            rrmdir($file);
        else
            unlink($file);
    }
}

function getColumenNameFromIndexAfterIncrease($startColumn, $increase) {

    for ($m = 0; $m < $increase; $m++) {
        $startColumn++;
    }
    return $startColumn;
}

function validateJSON() {
    $args = func_get_args(); // gets the parameters passed to this func as an array;
    $json = $args[0];
    $count = func_num_args() - 1; // 0 is the json, so total count of arguments - 1;
    $error = array(); // contains the list of keys not found in $json;
    for ($i = 1; $i <= $count; $i++) {
        if (!isset($json->$args[$i]))
            $error[] = $args[$i];
    }
    return $error;
}

function clean($string) {
    $string = str_replace('', '_', $string); // Replaces all spaces with hyphens.
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
}

function makeArrayClean($getArr) {
    $myArr = array();
    foreach ($getArr as $value) {
        if (trim($value) != "") {
            $myArr[] = $value;
        }
    }
    return $myArr;
}

function makeArrayCleanNew($getArr) {
    $myArr = array();
    foreach ($getArr as $key => $value) {
        if (trim($value) != "") {
            $myArr[] = $key;
        }
    }
    return $myArr;
}

function makeJSON() {
    $args = func_get_args();
    $num = func_num_args();
    $jsonArray = array();
    for ($i = 0; $i < $num; $i = $i + 2) {
        $jsonArray[$args[$i]] = $args[$i + 1];
    }
    $json = json_encode($jsonArray);
    return $json;
}

function get_slot_detail($main_array, $from, $to) {
    $from_tm = time_formate($main_array[0]);
    $to_tm = time_formate($main_array[1]);
    if (strtotime($from_tm) <= strtotime($from) && strtotime($to_tm) >= strtotime($to)) {
        return $main_array[2];
    } else {
        return "0";
    }
}

function timeslice() {
    $a = '00:00,00:15,00:30,00:45,01:00,01:15,01:30,01:45,02:00,02:15,02:30,02:45,03:00,03:15,03:30,03:45,04:00,04:15,04:30,04:45,05:00,05:15,05:30,05:45,06:00,06:15,06:30,06:45,07:00,07:15,07:30,07:45,08:00,08:15,08:30,08:45,09:00,09:15,09:30,09:45,10:00,10:15,10:30,10:45,11:00,11:15,11:30,11:45,12:00,12:15,12:30,12:45,13:00,13:15,13:30,13:45,14:00,14:15,14:30,14:45,15:00,15:15,15:30,15:45,16:00,16:15,16:30,16:45,17:00,17:15,17:30,17:45,18:00,18:15,18:30,18:45,19:00,19:15,19:30,19:45,20:00,20:15,20:30,20:45,21:00,21:15,21:30,21:45,22:00,22:15,22:30,22:45,23:00,23:15,23:30,23:45,24:00';
    return explode(",", $a);
}

function timesliceEnergy() {
    $a = "ENERGY0000,ENERGY0015,ENERGY0030,ENERGY0045,ENERGY0100,ENERGY0115,ENERGY0130,ENERGY0145,ENERGY0200,ENERGY0215,ENERGY0230,ENERGY0245,ENERGY0300,ENERGY0315,ENERGY0330,ENERGY0345,ENERGY0400,ENERGY0415,ENERGY0430,ENERGY0445,ENERGY0500,ENERGY0515,ENERGY0530,ENERGY0545,ENERGY0600,ENERGY0615,ENERGY0630,ENERGY0645,ENERGY0700,ENERGY0715,ENERGY0730,ENERGY0745,ENERGY0800,ENERGY0815,ENERGY0830,ENERGY0845,ENERGY0900,ENERGY0915,ENERGY0930,ENERGY0945,ENERGY1000,ENERGY1015,ENERGY1030,ENERGY1045,ENERGY1100,ENERGY1115,ENERGY1130,ENERGY1145,ENERGY1200,ENERGY1215,ENERGY1230,ENERGY1245,ENERGY1300,ENERGY1315,ENERGY1330,ENERGY1345,ENERGY1400,ENERGY1415,ENERGY1430,ENERGY1445,ENERGY1500,ENERGY1515,ENERGY1530,ENERGY1545,ENERGY1600,ENERGY1615,ENERGY1630,ENERGY1645,ENERGY1700,ENERGY1715,ENERGY1730,ENERGY1745,ENERGY1800,ENERGY1815,ENERGY1830,ENERGY1845,ENERGY1900,ENERGY1915,ENERGY1930,ENERGY1945,ENERGY2000,ENERGY2015,ENERGY2030,ENERGY2045,ENERGY2100,ENERGY2115,ENERGY2130,ENERGY2145,ENERGY2200,ENERGY2215,ENERGY2230,ENERGY2245,ENERGY2300,ENERGY2315,ENERGY2330,ENERGY2345,ENERGY2400";
    return explode(",", $a);
}

function timesliceWithoutColan() {
    $a = '0000,0015,0030,0045,0100,0115,0130,0145,0200,0215,0230,0245,0300,0315,0330,0345,0400,0415,0430,0445,0500,0515,0530,0545,0600,0615,0630,0645,0700,0715,0730,0745,0800,0815,0830,0845,0900,0915,0930,0945,1000,1015,1030,1045,1100,1115,1130,1145,1200,1215,1230,1245,1300,1315,1330,1345,1400,1415,1430,1445,1500,1515,1530,1545,1600,1615,1630,1645,1700,1715,1730,1745,1800,1815,1830,1845,1900,1915,1930,1945,2000,2015,2030,2045,2100,2115,2130,2145,2200,2215,2230,2245,2300,2315,2330,2345';
    return explode(",", $a);
}

function time_formate($t) {
    $temp = substr($t, 0, -2);
    $temp1 = substr($t, 2);
    return $temp . ":" . $temp1;
}

function twoDigitDecimalWithoutRound($cN, $precision) {
    $cN = "" . $cN;
    $number = explode(".", $cN);
    if (isset($number[1])) {
        return $number[0] . "." . substr($number[1], 0, $precision);
    } else {
        return $number[0];
    }
}

function getMonthShortNameFromMonthNo($m) {
    if ($m == 13) {
        $m = 1;
    }
    switch ($m) {
        case 1:
            $m = "Jan";
            break;
        case 2:
            $m = "Feb";
            break;
        case 3:
            $m = "Mar";
            break;
        case 4:
            $m = "Apr";
            break;
        case 5:
            $m = 05;
            break;
        case 6:
            $m = "Jun";
            break;
        case 7:
            $m = "Jul";
            break;
        case 8:
            $m = "Aug";
            break;
        case 9:
            $m = "Sep";
            break;
        case 10:
            $m = "Oct";
            break;
        case 11:
            $m = "Nov";
            break;
        case 12:
            $m = "Dec";
            break;
        default:
            break;
    }

    return $m;
}

function date_formate($d) {
    $d = str_replace("/", "-", $d);
    $k = explode("-", $d);
    switch ($k[1]) {
        case "Jan":
            $m = "01";
            break;
        case "Feb":
            $m = "02";
            break;
        case "Mar":
            $m = "03";
            break;
        case "Apr":
            $m = "04";
            break;
        case "May":
            $m = "05";
            break;
        case "Jun":
            $m = "06";
            break;
        case "Jul":
            $m = "07";
            break;
        case "Aug":
            $m = "08";
            break;
        case "Sep":
            $m = "09";
            break;
        case "Oct":
            $m = "10";
            break;
        case "Nov":
            $m = "11";
            break;
        case "Dec":
            $m = "12";
            break;
        default:
            break;
    }
    $k[0] = strlen($k[0]) == 1 ? "0" . $k[0] : $k[0];
    $x = $k[2] . "-" . $m . "-" . $k[0];
    return $x;
}

function changedateformatewithYEar($date) {
    if ($date == "" || $date == "0000-00-00") {
        return $date;
    } else {
        //M-Y-d
        $date = str_replace("/", "-", $date);
        $date_arr = explode("-", $date);
        if (strlen(trim($date_arr[2])) == 2) {
            $date_time = "20" . trim($date_arr[2]) . "-" . trim($date_arr[0]) . "-" . trim($date_arr[1]);
        } else {
            $date_time = trim($date_arr[2]) . "-" . trim($date_arr[0]) . "-" . trim($date_arr[1]);
        }

        // $date_time = date("Y-m-d", mktime(0, 0, 0, $date_arr[1], $date_arr[0], $date_arr[2]));
        //$date_time=mktime(0, 0, 0, $date_arr[0], $date_arr[1], $date_arr[2]);
        return $date_time;
    }
}

function getPxilScheduleImportedOrNot($consumerId, $date, $g) {
    $query = "SELECT * FROM `client_sch_pxilrelation` WHERE `consumer_id`='$consumerId' and `date`='$date'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return "TRUE";
    } else {
        return "FALSE";
    }
}

function getPxilScheduleImportedOrNotOfMonth($dt, $g) {
    $query = "SELECT * FROM `client_sch_pxilrelation` WHERE  `date`='$dt'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return "TRUE";
    } else {
        return "FALSE";
    }
}

function getConsumerIdFromPxilSchName($pxilSchName, $g) {
    $pxilSchName = trim(strtolower($pxilSchName));
    $query = "SELECT  `id` FROM  `client_detail` WHERE LCASE(trim(`pxilname`)) LIKE '%$pxilSchName%'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return $g->singleDataSet->id;
    } else {
        return "NA";
    }
}

function getConsumerIdFromIexSchName($iexSchName, $g) {
    $iexSchName = trim(strtolower($iexSchName));
    $query = "SELECT  `id` FROM  `client_detail` WHERE LCASE(trim(`iexname`)) LIKE '%$iexSchName%'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return $g->singleDataSet->id;
    } else {
        return "NA";
    }
}

function getScheduleImportedOrNot($consumerId, $date, $g) {
    $query = "SELECT * FROM `client_sch_relation` WHERE `consumer_id`='$consumerId' and `date`='$date'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return "TRUE";
    } else {
        return "FALSE";
    }
}

function getScheduleImportedOrNotOfMonth($dt, $g) {
    $query = "SELECT * FROM `client_sch_relation` WHERE  `date`='$dt'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return "TRUE";
    } else {
        return "FALSE";
    }
}

function checkMriImportedOrNot($cId, $month, $year, $mid, $g) {
    $query = "SELECT `filepath` FROM `mri_file_detail` WHERE `consumer_id`='$cId' and `year`='$year' and `month`='$month' and `meterno`='$mid'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return $g->singleDataSet->filepath;
    } else {
        return "NA";
    }
}

function calculateRate($freq, $OD) {

    return ROUND(($freq >= 50.05 ? 0 : ($freq >= 50.01 ? (1.424 - ($freq - 50.01) / 0.01 * 0.356) : ($freq >= 49.69 ? (8.032 - ($freq - 49.7) / 0.01 * 0.2084) : 8.2404))), 5);
}

function calculateAmountDSA($freq, $UD, $consumerKwh, $rate) {
    return ROUND((($UD > 0 ? $UD * $rate / 400 : (abs($UD) > 0.12 * abs($consumerKwh) ? 0.12 * abs($consumerKwh) * $rate * -1 / 400 : $UD * $rate / 400))) * 100000, 0);
}

function calculateAmountAdditionalDSA($freq, $UD, $consumerKwh, $rate) {
    return ROUND(($UD > 0 ? ($freq <= 49.7 ? $UD * $UD / 400 : ($UD < 0.12 * abs($consumerKwh) ? 0 : ($UD < 0.15 * abs($consumerKwh) ? (($UD - (0.12 * abs($consumerKwh))) * 0.2 * $UD / 400) : ($UD < 0.2 * abs($consumerKwh) ? ((($UD - (0.15 * abs($consumerKwh))) * 0.4 * $UD / 400) + (0.03 * abs($consumerKwh) * 0.2 * $UD / 400)) : ((($UD - (0.2 * abs($consumerKwh))) * 1 * $UD / 400) + (0.05 * abs($consumerKwh) * 0.4 * $UD / 400) + (0.03 * abs($consumerKwh) * 0.2 * $UD / 400)))))) : ($freq > 50.1 ? -1.78 * $UD / 400 : 0)) * 100000, 0);
}

function checkfilepath($cId, $month, $year, $g, $from_date, $to_date) {
    $query = "SELECT `file_path` FROM `bill_generated_detail` WHERE `client_id`='$cId' and `year`='$year' and `month`='$month' and `from_date`='$from_date' and `to_date`='$to_date'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return $g->singleDataSet->file_path;
    } else {
        return "NA";
    }
}

function checkuifilepath($cId, $month, $year, $g, $from_date, $to_date) {
    $query = "SELECT `file_path` FROM `ui_generated_detail` WHERE `client_id`='$cId' and `year`='$year' and `month`='$month' and `from_date`='$from_date' and `to_date`='$to_date'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return $g->singleDataSet->file_path;
    } else {
        return "NA";
    }
}

function getMeterType($clientId, $g) {
    $query = "SELECT `makeofmeter` FROM `client_detail` WHERE `id`='$clientId'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return $g->singleDataSet->makeofmeter;
    } else {
        return "NA";
    }
}

function getLosesData($month, $year) {
    $dynamicUrl = "http://powertradingsolutions.com/trading/services/api/poclossesforoabillinghppc.php?year=" . $year . "&month=" . $month;
    $lossesJson = file_get_contents($dynamicUrl);
    return json_decode($lossesJson, true);
}

function getHistoryOftheMonth($clientId, $y, $m, $g) {
    $query = "SELECT `kvarh_high`,`kvarh_low` FROM `history` WHERE `consumer_id`='$clientId' and `month`='$m' and `year`='$y'";

    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return '{"kvarh_high":"' . $g->singleDataSet->kvarh_high . '","kvarh_low":"' . $g->singleDataSet->kvarh_low . '"}';
    } else {
        return "NA";
    }
}

function getHistoryOftheMonthForGenus($clientId, $y, $m, $g) {
    $query = "SELECT `kvarh_lg_high_dur_kwh_imp`,`kvarh_ld_high_dur_kwh_imp`,`kvarh_lg_high_dur_kwh_exp`,`kvarh_ld_high_dur_kwh_exp`,`kvarh_lg_low_dur_kwh_imp`,`kvarh_ld_low_dur_kwh_imp`,`kvarh_lg_low_dur_kwh_exp`,`kvarh_ld_low_dur_kwh_exp` FROM `genus_history` WHERE `consumer_id`='$clientId' and `month`='$m' and `year`='$y'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return '{"kvarh_lg_high_dur_kwh_imp":"' . $g->singleDataSet->kvarh_lg_high_dur_kwh_imp . '","kvarh_ld_high_dur_kwh_imp":"' . $g->singleDataSet->kvarh_ld_high_dur_kwh_imp . '","kvarh_lg_high_dur_kwh_exp":"' . $g->singleDataSet->kvarh_lg_high_dur_kwh_exp . '","kvarh_ld_high_dur_kwh_exp":"' . $g->singleDataSet->kvarh_ld_high_dur_kwh_exp . '","kvarh_lg_low_dur_kwh_imp":"' . $g->singleDataSet->kvarh_lg_low_dur_kwh_imp . '","kvarh_ld_low_dur_kwh_imp":"' . $g->singleDataSet->kvarh_ld_low_dur_kwh_imp . '","kvarh_lg_low_dur_kwh_exp":"' . $g->singleDataSet->kvarh_lg_low_dur_kwh_exp . '","kvarh_ld_low_dur_kwh_exp":"' . $g->singleDataSet->kvarh_ld_low_dur_kwh_exp . '"}';
    } else {
        return "NA";
    }
}

function getmriidfromyearandmonth($cId, $month, $year, $g) {
    $query = "SELECT `id` FROM `mri_file_detail` WHERE `consumer_id`='$cId' and `year`='$year' and `month`='$month'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return $g->singleDataSet->id;
    } else {
        return "NA";
    }
}

function getYearList($g) {
    $query = "SELECT `year` FROM `year_data` order by `year` desc";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        $yearArr = array();
        for ($i = 0; $i < $g->rowcount; $i++) {
            $yearArr[] = $g->singleDataSet->year;
            $g->getNextRow();
        }
        return $yearArr;
    } else {
        return "NA";
    }
}

function getMonthList($g) {
    $query = "SELECT `monthno`,`shortname`,`fullname` FROM `month_data` order by  `monthno`";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        $monthArr = array();
        for ($i = 0; $i < $g->rowcount; $i++) {
            $monthArr[$i][0] = $g->singleDataSet->monthno;
            $monthArr[$i][1] = $g->singleDataSet->shortname;
            $monthArr[$i][2] = $g->singleDataSet->fullname;
            $g->getNextRow();
        }
        return $monthArr;
    } else {
        return "NA";
    }
}

function geDrawalSchFromJson($schJsonObj, $date, $from, $to) {
    for ($i = 0; isset($schJsonObj->SchduleDetail[$i]); $i++) {
        if ($schJsonObj->SchduleDetail[$i]->date == $date) {
            for ($j = 0; isset($schJsonObj->SchduleDetail[$i]->value[$j]); $j++) {
                if (strtotime($schJsonObj->SchduleDetail[$i]->value[$j]->fromtime) == strtotime($from) && strtotime($schJsonObj->SchduleDetail[$i]->value[$j]->totime) == strtotime($to)) {
                    return $schJsonObj->SchduleDetail[$i]->value[$j]->finalLossesInKw;
                }
            }
            break;
        }
    }
    return 0;
}

function getSclDrawalSchClientWise($schJsonObj, $date, $from, $to, $clientName) {
    for ($i = 0; isset($schJsonObj->SchduleDetail[$i]); $i++) {
        if ($schJsonObj->SchduleDetail[$i]->date == $date) {
            for ($j = 0; isset($schJsonObj->SchduleDetail[$i]->value[$j]); $j++) {
                if (strtotime($schJsonObj->SchduleDetail[$i]->value[$j]->fromtime) == strtotime($from) && strtotime($schJsonObj->SchduleDetail[$i]->value[$j]->totime) == strtotime($to) && trim(strtoupper($schJsonObj->SchduleDetail[$i]->value[$j]->cname)) == trim(strtoupper($clientName))) {
                    return $schJsonObj->SchduleDetail[$i]->value[$j]->mw * 1000;
                }
            }
            break;
        }
    }
    return 0;
}

function getvalueFromMeterData($schJsonObj, $date, $from, $to) {
    for ($i = 0; isset($schJsonObj->mriData[$i]); $i++) {
        if ($schJsonObj->mriData[$i]->date == $date) {
            for ($j = 0; isset($schJsonObj->mriData[$i]->value[$j]); $j++) {
                if (strtotime($schJsonObj->mriData[$i]->value[$j]->fromtime) == strtotime($from) && strtotime($schJsonObj->mriData[$i]->value[$j]->totime) == strtotime($to)) {
                    return json_encode($schJsonObj->mriData[$i]->value[$j]);
                }
            }
            break;
        }
    }
    return 0;
}

function getFrequncyFromJson($Frequency, $date, $blockNo) {

    for ($i = 0; isset($Frequency->FrequencyDetail[$i]); $i++) {
        if ($Frequency->FrequencyDetail[$i]->date == $date) {
            for ($j = 0; isset($Frequency->FrequencyDetail[$i]->value[$j]); $j++) {
                if ($Frequency->FrequencyDetail[$i]->value[$j]->blockno == $blockNo) {
                    return $Frequency->FrequencyDetail[$i]->value[$j]->frequency;
                }
            }
            break;
        }
    }
    return "NA";
}

function getLossesDetailOfPerticularDateFromJsonObj($allLossesJsonObj, $date) {
    for ($i = 0; isset($allLossesJsonObj->allLossesData[$i]); $i++) {
        if ($allLossesJsonObj->allLossesData[$i]->date == $date) {

            return $allLossesJsonObj->allLossesData[$i]->nrldc;
            break;
        }
    }
    return "NA";
}

function getHistryTwoFromHistryJson($h2JsonObj, $date) {
    for ($i = 0; isset($h2JsonObj->h2[$i]); $i++) {
        if ($h2JsonObj->h2[$i]->date == "$date") {
            $my = '{"kvarh_lg_high_dur_kwh_imp":"' . $h2JsonObj->h2[$i]->kvarh_lg_high_dur_kwh_imp . '",';
            $my .= '"kvarh_ld_high_dur_kwh_imp":"' . $h2JsonObj->h2[$i]->kvarh_ld_high_dur_kwh_imp . '",';
            $my .= '"kvarh_lg_high_dur_kwh_exp":"' . $h2JsonObj->h2[$i]->kvarh_lg_high_dur_kwh_exp . '",';
            $my .= '"kvarh_ld_high_dur_kwh_exp":"' . $h2JsonObj->h2[$i]->kvarh_ld_high_dur_kwh_exp . '",';

            $my .= '"kvarh_lg_low_dur_kwh_imp":"' . $h2JsonObj->h2[$i]->kvarh_lg_low_dur_kwh_imp . '",';
            $my .= '"kvarh_ld_low_dur_kwh_imp":"' . $h2JsonObj->h2[$i]->kvarh_ld_low_dur_kwh_imp . '",';
            $my .= '"kvarh_lg_low_dur_kwh_exp":"' . $h2JsonObj->h2[$i]->kvarh_lg_low_dur_kwh_exp . '",';
            $my .= '"kvarh_ld_low_dur_kwh_exp":"' . $h2JsonObj->h2[$i]->kvarh_ld_low_dur_kwh_exp . '"}';

            return $my;
        }
    }
    return "NA";
}

function gettotalstaffdetails($zxe, $mytpe) {
    $result = "select `id`,`first_name`,`last_name` from staff_details where mytype='$mytpe'";
    $zxe->selectquerysinglerow($result);
    if ($zxe->rowcount == 0) {
        return "NA";
    } else {
        $json = "{" . '"stafflist":' . "[";
        for ($i = 0; $i < $zxe->rowcount; $i++) {
            $json = $json . "{";
            $json = $json . '"id":"' . $zxe->singleDataSet->id . '","first_name":"' . $zxe->singleDataSet->first_name . '","last_name" : "' . $zxe->singleDataSet->last_name . '"';
            $json = $json . "},";
            $zxe->getNextRow();
        }
    }
    $json = substr($json, 0, -1);
    $json = $json . "]}";
    return $json;
}

function gettotalStatesList($zxe) {
    $str = "select `id` ,`state_name`,`state_code` from states";
    $zxe->selectquerysinglerow($str);
    if ($zxe->rowcount == 0) {
        return "NA";
    } else {
        $json = "{" . '"stateslist":' . "[";
        for ($i = 0; $i < $zxe->rowcount; $i++) {
            $json = $json . "{";
            $json = $json . '"Name":"' . $zxe->singleDataSet->state_name . '","state_id" : "' . $zxe->singleDataSet->id . '","state_code" : "' . $zxe->singleDataSet->state_code . '"';
            $json = $json . "},";
            $zxe->getNextRow();
        }
        $json = substr($json, 0, -1);
        $json = $json . "]}";
        return $json;
    }
}

function getUiRates($zxe) {
    $str = "SELECT  `frequency` ,  `rates` FROM  `ui_rates` ";
    $zxe->selectquerysinglerow($str);
    if ($zxe->rowcount == 0) {
        return "NA";
    } else {
        $json = "{" . '"uirates":' . "[";
        for ($i = 0; $i < $zxe->rowcount; $i++) {
            $json = $json . "{";
            $json = $json . '"frequency":"' . $zxe->singleDataSet->frequency . '","rates" : "' . $zxe->singleDataSet->rates . '","state_code" : "' . $zxe->singleDataSet->state_code . '"';
            $json = $json . "},";
            $zxe->getNextRow();
        }
        $json = substr($json, 0, -1);
        $json = $json . "]}";
        return $json;
    }
}

function getUiRatesFromFrequency($uiRatesJson, $frequency) {
    for ($i = 0; isset($uiRatesJson->uirates[$i]); $i++) {
        if ($frequency == $uiRatesJson->uirates[$i]->frequency) {
            return ($uiRatesJson->uirates[$i]->rates / 100);
        }
    }
    return "NA";
}

function getsubmenulist($zxe, $id) {

    $zxe->selectTable(" menu_child_list");
    $str = "SELECT `id`,`caption`FROM `menu_child_list` WHERE `main_menu_id` = '$id'";
    $zxe->selectquerysinglerow($str);
    if ($zxe->rowcount == 0) {
        return "NA";
    } else {
        $json = "{" . '"getsubmenulist":' . "[";
        for ($i = 0; $i < $zxe->rowcount; $i++) {
            $json = $json . "{";
            $json = $json . '"caption":"' . $zxe->singleDataSet->caption . '","id" : "' . $zxe->singleDataSet->id . '"';
            $json = $json . "},";
            $zxe->getNextRow();
        }
        $json = substr($json, 0, -1);
        $json = $json . "]}";
        return $json;
    }
}

function getGenusOldHistoryOftheMonth($clientId, $y, $m, $g) {
    $query = "SELECT `consumer_id`,`kvarh_lg_high_dur_kwh_imp`,`kvarh_ld_high_dur_kwh_imp`,`kvarh_lg_high_dur_kwh_exp`,`kvarh_ld_high_dur_kwh_exp`,`kvarh_lg_low_dur_kwh_imp`,`kvarh_ld_low_dur_kwh_imp`,`kvarh_lg_low_dur_kwh_exp`,`kvarh_ld_low_dur_kwh_exp`FROM `genus_history` WHERE `consumer_id`='$clientId' and `month`='$m' and `year`='$y'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return '{"kvarh_lg_high_dur_kwh_imp":"' . $g->singleDataSet->kvarh_lg_high_dur_kwh_imp . '","kvarh_ld_high_dur_kwh_imp":"' . $g->singleDataSet->kvarh_ld_high_dur_kwh_imp . '","kvarh_lg_high_dur_kwh_exp":"' . $g->singleDataSet->kvarh_lg_high_dur_kwh_exp . '","kvarh_ld_high_dur_kwh_exp":"' . $g->singleDataSet->kvarh_ld_high_dur_kwh_exp . '","kvarh_lg_low_dur_kwh_imp":"' . $g->singleDataSet->kvarh_lg_low_dur_kwh_imp . '","kvarh_ld_low_dur_kwh_imp":"' . $g->singleDataSet->kvarh_ld_low_dur_kwh_imp . '","kvarh_lg_low_dur_kwh_exp":"' . $g->singleDataSet->kvarh_lg_low_dur_kwh_exp . '","kvarh_ld_low_dur_kwh_exp":"' . $g->singleDataSet->kvarh_ld_low_dur_kwh_exp . '"}';
    } else {
        return "NA";
    }
}

function get_l_t_HistoryOftheMonth($clientId, $y, $m, $g) {
    $query = "SELECT `consumer_id`,`for_high_lag`,`for_high_lead`,`for_low_lag`,`for_low_lead`,`rev_high_lag`,`rev_high_lead`,`rev_low_lag`,`rev_low_lead` FROM `l_t` WHERE `consumer_id`='$clientId' and `month`='$m' and `year`='$y'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return '{"for_high_lag":"' . $g->singleDataSet->for_high_lag . '","for_high_lead":"' . $g->singleDataSet->for_high_lead . '","for_low_lag":"' . $g->singleDataSet->for_low_lag . '","for_low_lead":"' . $g->singleDataSet->for_low_lead . '","rev_high_lag":"' . $g->singleDataSet->rev_high_lag . '","rev_high_lead":"' . $g->singleDataSet->rev_high_lead . '","rev_low_lag":"' . $g->singleDataSet->rev_low_lag . '","rev_low_lead":"' . $g->singleDataSet->rev_low_lead . '"}';
    } else {
        return "NA";
    }
}

function getConsumerName($clientId, $g) {
    $query = "SELECT `consumer_name` FROM `client_detail` WHERE `id`='$clientId'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return $g->singleDataSet->consumer_name;
    } else {
        return "NA";
    }
}

function getVslpScheduleImportedOrNot($consumervslpname, $date, $g) {
    $consumervslpname = trim(strtolower($consumervslpname));
    $query = "SELECT * FROM `client_vslp_sch_relation` WHERE LCASE(trim(`consumer_name`))='$consumervslpname' and `date`='$date'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return "TRUE";
    } else {
        return "FALSE";
    }
}

function vslpMriData($date, $g) {
    $str = "SELECT  `rev_vah` 
FROM  `mri_vslp` 
WHERE  `date` =  '$date'
ORDER BY  `mri_vslp`.`id` ASC 
LIMIT 0 , 96";
    $result = $g->selectQuerySingleRow($str);
    $mriDataList = array();
    if ($g->rowcount > 0) {
        for ($i = 0; $i < $g->rowcount; $i++) {
            $mriDataList[] = $g->singleDataSet->rev_vah;
            $g->getNextRow();
        }
    }
    return $mriDataList;
}

function getVslpCosumerSchFromJson($schJsonObj, $date, $from, $to) {
    for ($i = 0; isset($schJsonObj->SchduleDetail[$i]); $i++) {
        if ($schJsonObj->SchduleDetail[$i]->date == $date) {
            for ($j = 0; isset($schJsonObj->SchduleDetail[$i]->value[$j]); $j++) {
                if (strtotime($schJsonObj->SchduleDetail[$i]->value[$j]->fromtime) == strtotime($from) && strtotime($schJsonObj->SchduleDetail[$i]->value[$j]->totime) == strtotime($to)) {
                    return $schJsonObj->SchduleDetail[$i]->value[$j]->finalLossesInKw;
                }
            }
            break;
        }
    }
    return 0;
}

function getVslpSchMod($schJsonObj, $date, $from, $to) {
    $sum = 0;
    for ($i = 0; isset($schJsonObj->SchduleDetail[$i]); $i++) {
        if ($schJsonObj->SchduleDetail[$i]->date == $date) {
            for ($j = 0; isset($schJsonObj->SchduleDetail[$i]->value[$j]); $j++) {
                // echo $schJsonObj->SchduleDetail[$i]->value[$j]->fromtime. "==". $from ."&&". $schJsonObj->SchduleDetail[$i]->value[$j]->totime ."==".$to;exit();
                if (strtotime($schJsonObj->SchduleDetail[$i]->value[$j]->fromtime) == strtotime($from) && strtotime($schJsonObj->SchduleDetail[$i]->value[$j]->totime) == strtotime($to)) {
                    return $schJsonObj->SchduleDetail[$i]->value[$j]->mw;
                    break;
                }
            }
        }
    }

    return 0;
}

function getMriKvaFromJson($schJsonObj, $date, $from, $to) {
    for ($i = 0; isset($schJsonObj->mriData[$i]); $i++) {
        if ($schJsonObj->mriData[$i]->date == $date) {
            for ($j = 0; isset($schJsonObj->mriData[$i]->value[$j]); $j++) {
                if (strtotime($schJsonObj->mriData[$i]->value[$j]->fromtime) == strtotime($from) && strtotime($schJsonObj->mriData[$i]->value[$j]->totime) == strtotime($to)) {

                    return $schJsonObj->mriData[$i]->value[$j]->kvaimp;
                }
            }
            break;
        }
    }
    return 0;
}

function getMriFromJson($schJsonObj, $date, $from, $to) {
    for ($i = 0; isset($schJsonObj->mriData[$i]); $i++) {
        if ($schJsonObj->mriData[$i]->date == $date) {
            for ($j = 0; isset($schJsonObj->mriData[$i]->value[$j]); $j++) {
                if (strtotime($schJsonObj->mriData[$i]->value[$j]->fromtime) == strtotime($from) && strtotime($schJsonObj->mriData[$i]->value[$j]->totime) == strtotime($to)) {

                    return $schJsonObj->mriData[$i]->value[$j]->kwimp;
                }
            }
            break;
        }
    }
    return 0;
}

function loss($orgValue, $loss) {
    if ($orgValue != 0 && $loss != 0) {
        $tempOrgValue = $orgValue;
        $getloss = (($orgValue * $loss) / 100);
        $afterLoss = $tempOrgValue - $getloss;
        return $afterLoss;
    }
    return $orgValue;
}

function getIexSchFromJson($schJsonObj, $date, $from, $to) {

    for ($i = 0; isset($schJsonObj->SchduleDetail[$i]); $i++) {
        if ($schJsonObj->SchduleDetail[$i]->date == $date) {
            for ($j = 0; isset($schJsonObj->SchduleDetail[$i]->value[$j]); $j++) {
                if (strtotime($schJsonObj->SchduleDetail[$i]->value[$j]->fromtime) == strtotime($from) && strtotime($schJsonObj->SchduleDetail[$i]->value[$j]->totime) == strtotime($to)) {
                    return $schJsonObj->SchduleDetail[$i]->value[$j]->finalLossesInKw;
                }
            }
            break;
        }
    }
    return 0;
}

function getConsumerSupplyVoltage($consumerName, $g) {
    $consumerName = trim(strtolower($consumerName));
    $query = "SELECT `supply_voltage` FROM `client_detail` WHERE LCASE(trim(`vslpname`))='$consumerName'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return $g->singleDataSet->supply_voltage;
    } else {
        return "0";
    }
}

function makeMonthJsonBlank($m, $y) {
    $timeSlice = timeslice();
    if (strlen($m) == 1) {
        $m = "0" . $m;
    }
    $firstDate = $y . "-" . $m . "-01";

    $lastDate = date('Y-m-t', strtotime($firstDate));

    $jsonData = '{"mriData": [';

    for ($i = $firstDate; $i <= $lastDate; $i = date('Y-m-d', strtotime($i . ' + 1 days'))) {

        $jsonData .= '{"date":"' . $i . '",';
        $jsonData .= '"value":[';
        for ($l = 0; $l < 96; $l++) {
            $jsonData .= '{';
            $jsonData .= '"fromtime":"' . $timeSlice[$l] . '",';
            $jsonData .= '"totime":"' . $timeSlice[$l + 1] . '"';

            $jsonData .= '},';
        }
        $jsonData = substr($jsonData, 0, -1);
        $jsonData .= ']},';
    }
    $jsonData = substr($jsonData, 0, -1);
    $jsonData .= ']}';
    return $jsonData;
}

function checkBilateralMriImportedOrNot($cId, $month, $year, $g) {
    $query = "SELECT `filepath` FROM `bilateral_mri_file_detail` WHERE `consumer_id`='$cId' and `year`='$year' and `month`='$month'";
    $result = $g->selectQuerySingleRow($query);
    if ($g->rowcount > 0) {
        return $g->singleDataSet->filepath;
    } else {
        return "NA";
    }
}

function getDiscomLosses($cId, $g) {
    $query = "SELECT `discom_losses` FROM `client_detail` WHERE `id`='$cId'";
    $result = $g->selectQueryInArray($query);

    if (!empty($result)) {
        return $result[0];
    } else {
        return 0;
    }
}

function pre($array) {
    echo "<pre>";
    print_r($array);
}

?>