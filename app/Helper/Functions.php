<?php
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
