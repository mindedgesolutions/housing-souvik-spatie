<?php

use App\Models\HousingDdo;

function getHrmsData()
{
  return [
    "hrmsId" => "1994007754",
    "applicantName" => "BIRESWAR HALDER",
    "guardianName" => "LT. BHOLANATH HALDER",
    "dateOfBirth" => "15/11/1964",
    "dateOfJoining" => "17/11/1994",
    "dateOfRetirement" => "30/11/2024",
    "mobileNo" => "9831321170",
    "gender" => "Male",
    "applicantDesignation" => "Typist Grade I",
    "officeName" => "HOUSING BUILDING LOAN OFFICE ATTACHED TO HOUSING DEPARTMENT",
    "ddoId" => "CABHOA001",
    "permanentStreet" => "Paglachandi",
    "permanentCityTownVillage" => "Paglachandi",
    "permanentPostOffice" => "Radhakantapur",
    "permanentDistrictCode" => "10",
    "presentStreet" => "MISSON PARA",
    "presentCityTownVillage" => "Misson Road.",
    "presentPostOffice" => "Krishnagar",
    "presentPincode" => "741101",
    "presentDistrictCode" => "10",
    "applicantHeadquarter" => "L2-DIRECTORATE/ COMMISSIONERATE",
    "gradePay" => "3600",
    "payBandId" => "3",
    "applicantPostingPlace" => "1, K.S.ROY ROAD, N.S.BUILDING KOLKATA KOLKATA KOLKATA Calcutta West Bengal",
    "payInThePayBand" => "14570",
    "officeStreetCharacter" => "1, K.S.ROY ROAD, N.S.BUILDING KOLKATA KOLKATA KOLKATA Calcutta West Bengal",
    "officeCityTownVillage" => "KOLKATA",
    "officePostOffice" => "KOLKATA",
    "officePinCode" => "700001",
    "officeDistrict" => "17"
  ];
}

function customJsonValidator($data)
{
  if (!empty($data)) {
    @json_decode($data);
    return (json_last_error() === JSON_ERROR_NONE);
  }
  return false;
}

function fetchHRMSUserAPIData($hrmsID)
{
  $url = "https://uat.wbifms.gov.in/hrms-External/housing/fetchEmployeeDetails";
  $data = array("req" => array("hrmsId" => $hrmsID));
  $postdata = json_encode($data);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
    return false;
  } else {
    $curl_output = curl_exec($ch);
  }
  curl_close($ch);

  return $curl_output;
}

function getHRMSUserData($hrmsID = NULL)
{
  $userDataArr = [];
  if ($hrmsID) {
    $userDataJson = fetchHRMSUserAPIData($hrmsID);
    if (!empty($userDataJson) && customJsonValidator($userDataJson)) {
      $userDataArrTemp = json_decode($userDataJson, true);
      if (isset($userDataArrTemp['resp']['status']) && !empty($userDataArrTemp['resp']['status']) && strtolower($userDataArrTemp['resp']['status']) == 's') {
        $userDataArr = $userDataArrTemp['resp']['data'][0];
      }
    }
  }
  return $userDataArr;
}

function formatHrmsDate($dateString)
{
  $dateArray = explode('/', $dateString);
  $formatted = $dateArray[2] . '-' . $dateArray[1] . '-' . $dateArray[0];
  $result = DateTime::createFromFormat('Y-m-d', $formatted);
  $result = $result->format('Y-m-d');

  return $result;
}


// array:43 [▼ // app\Http\Controllers\Applications\HrmsController.php:160
//   "_token" => "S2FoTNTVjlI1UXon4h2MjQ5yng5uvLSC9MiqCJhI"
//   "applicant_name" => "BIRESWAR HALDER"
//   "father_husband_name" => "Test Father"
//   "mobile_no" => "9831321170"
//   "email" => "test@test.com"
//   "dob" => "1964-11-15"
//   "gender" => "Male"
//   "p_address" => "57/13,NANDAN PALLY,SANTOSH ROY ROAD"
//   "p_city_town_village" => "Kolkata"
//   "p_post_office" => "Barisha"
//   "p_district" => "3"
//   "p_district_value" => null
//   "p_pin_code" => "700008"
//   "present_address" => "57/13,NANDAN PALLY,SANTOSH ROY ROAD."
//   "present_city_town_village" => "Kolkata"
//   "present_post_office" => "BARISHA"
//   "present_district_value" => "3"
//   "present_pin_code" => "700008"
//   "hrms_id" => "1994007754"
//   "designation" => "Typist Grade I"
//   "basic_pay_range_value" => "1"
//   "basic_pay" => "14570"
//   "place_of_posting" => "Kolkata"
//   "headquarter" => "L2-DIRECTORATE/ COMMISSIONERATE"
//   "doj" => "1994-11-17"
//   "dor" => "2024-11-30"
//   "name_of_office" => "HOUSING BUILDING LOAN OFFICE ATTACHED TO HOUSING DEPARTMENT"
//   "office_address" => "1, K.S.ROY ROAD, N.S.BUILDING KOLKATA KOLKATA KOLKATA Calcutta West Bengal"
//   "office_city_town_village" => "KOLKATA"
//   "office_post_office" => "KOLKATA"
//   "office_district_value" => "2"
//   "office_pin_code" => "700001"
//   "office_phn_no" => "700034"
//   "ddo_designation" => "REGISTRAR & DDO, HOUSING DEPTT.(A.E.) BR."
//   "ddo_address" => "NA"
//   "flat_type" => "D"
//   "allotment_reason" => "Physically Handicaped or Serious Illness"
//   "first_preference" => "24"
//   "second_preference" => "12"
//   "third_preference" => "10"
//   "doc_payslip" => 
// Illuminate\Http
// \
// UploadedFile {#1396 ▶}
//   "doc_signature" => 
// Illuminate\Http
// \
// UploadedFile {#1419 ▶}
//   "doc_supporting" => 
// Illuminate\Http
// \
// UploadedFile {#1420 ▶}
// ]