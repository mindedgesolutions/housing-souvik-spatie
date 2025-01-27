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
