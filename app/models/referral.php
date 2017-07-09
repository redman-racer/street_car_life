<?php
//function for getting real IP address
function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function logReferral($ref, $conn, $page, $user_id){
  //Set IP address
    $ip = getRealIpAddr();
  //convert ref code into readable date for db
  switch ($ref){
    //Converts 1111 into FB Button
    case "1111":
      $referral = "FB Button";
    break;
    //if Referral code is not recognized, just log the referral code they used.
    default:
      $referral = $_GET['ref'];
    break;
  }
  //Insert referral information into database table page_referrals
  $query = "INSERT INTO page_referrals (page_visited, referral, ip, user_id) VALUES (:page_visited, :referral, :ip, :user_id)";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':page_visited', $page, PDO::PARAM_STR);
  $stmt->bindParam(':referral', $referral, PDO::PARAM_STR);
  $stmt->bindParam(':ip', $ip, PDO::PARAM_STR);
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
  $stmt->execute();
}
