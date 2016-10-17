<?
// Codigo de muestra de Mexabtc.mx
// Hector Atalo Ramos Gomez
// https://www.mexabtc.mx/index.php
//
function changeStatusTrade($idTrade){
  global $mysqli;
  $idTrade = $mysqli->real_escape_string($idTrade);
  $resp = $mysqli->query("SELECT activo FROM trades WHERE id = '$idTrade' LIMIT 1");
  $dt = $resp->fetch_array(MYSQLI_BOTH);

  if($dt[activo] == 0)
    $newStatus = 1;
  else if($dt[activo] == 1)
    $newStatus = 0;

  $mysqli->query("UPDATE trades SET activo = '$newStatus' WHERE id = '$idTrade' LIMIT 1");
}

function blockUser($uid, $uidDestiny){
  global $mysqli;
  $uid = $mysqli->real_escape_string($uid);
  $uidDestiny = $mysqli->real_escape_string($uidDestiny);
  unTrustzone($uid, $uidDestiny);
  if(!banChecked($uid, $uidDestiny)){
     $hoy = time();
    $mysqli->query("INSERT INTO `bloqueos` (
`id` ,
`user_bloquea` ,
`user_destino` ,
`fecha_bloqueo`
)
VALUES (
NULL , $uid , $uidDestiny , $hoy
);
");
    return true;
  } else
  return false;
}

function getGoodFeedbacks($uid){
  global $mysqli;
  $uid = $mysqli->real_escape_string($uid);
  $resp = $mysqli->query("SELECT id FROM feedback WHERE user_destino='$uid' and calificacion > 0");
  $row_cont = $resp->num_rows;
  return $row_cont;
}
function addBlockWithoutFeedback($uid, $uidDestiny){
 global $mysqli;
  $uid = $mysqli->real_escape_string($uid);
  $uidDestiny = $mysqli->real_escape_string($uidDestiny);
  $resp = $mysqli->query("SELECT uid, trades_count FROM users WHERE uid='$uidDestiny' LIMIT 1");
  $datos = $resp->fetch_array(MYSQLI_BOTH);
  $tradeCount = $datos[trades_count];
  $tradeCount++;
 
  $mysqli->query("UPDATE users SET trades_count = '$tradeCount' WHERE uid = '$uidDestiny' LIMIT 1");
}

function addDistrustBlockFeedback($uid, $uidDestiny){
  global $mysqli;
  $uid = $mysqli->real_escape_string($uid);
  $uidDestiny = $mysqli->real_escape_string($uidDestiny);
  $resp = $mysqli->query("SELECT uid, trades_count,feedback_score FROM users WHERE uid='$uidDestiny' LIMIT 1");
  $datos = $resp->fetch_array(MYSQLI_BOTH);
  $tradeCount = $datos[trades_count];
  $tradeCount++;
  if($datos[feedback_score] == 0)
    $feedbackScoreCount = 0;
  else {
    $respFeedscore = $mysqli->query("SELECT id FROM feedback WHERE user_destino ='$uidDestiny' AND calificacion IN ('0','-2')");
    $numFeedscore = $respFeedscore->num_rows;
    
    $tradeCountFeedback = $tradeCount - $numFeedscore;
    $goodTrades = getGoodFeedbacks($uidDestiny);

    $feedbackScoreCount = $goodTrades / $tradeCountFeedback;
    $feedbackScoreCount = $feedbackScoreCount * 100;
  }
  $mysqli->query("UPDATE users SET trades_count = '$tradeCount', feedback_score = '$feedbackScoreCount' WHERE uid = '$uidDestiny' LIMIT 1");

}

function addNeutralFeedback($uid, $uidDestiny){
  global $mysqli;
  $uid = $mysqli->real_escape_string($uid);
  $uidDestiny = $mysqli->real_escape_string($uidDestiny);
  $resp = $mysqli->query("SELECT uid, trades_count FROM users WHERE uid='$uidDestiny' LIMIT 1");
  $datos = $resp->fetch_array(MYSQLI_BOTH);
  $tradeCount = $datos[trades_count];
  $tradeCount++;
  $mysqli->query("UPDATE users SET trades_count = '$tradeCount' WHERE uid = '$uidDestiny' LIMIT 1");
}

function addPositiveFeedback($uid, $uidDestiny){
  global $mysqli;
  $uid = $mysqli->real_escape_string($uid);
  $uidDestiny = $mysqli->real_escape_string($uidDestiny);
  $resp = $mysqli->query("SELECT uid, trades_count, feedback_score FROM users WHERE uid='$uidDestiny' LIMIT 1");
  $datos = $resp->fetch_array(MYSQLI_BOTH);
  $tradeCount = $datos[trades_count];
  $tradeCount++;
  if($datos[feedback_score] == 0)
    $feedbackScoreCount = 100;
  else if($datos[feedback_score] == 100){
    $feedbackScoreCount = 100;
  } else {
    $respFeedscore = $mysqli->query("SELECT id FROM feedback WHERE user_destino ='$uidDestiny' AND calificacion IN ('0','-2')");
    $numFeedscore = $respFeedscore->num_rows;
    
    $tradeCountFeedback = $tradeCount - $numFeedscore;
    $goodTrades = getGoodFeedbacks($uidDestiny);
    $feedbackScoreCount = $goodTrades / $tradeCountFeedback;
    $feedbackScoreCount = $feedbackScoreCount * 100;
  }
  $mysqli->query("UPDATE users SET trades_count = '$tradeCount', feedback_score = '$feedbackScoreCount' WHERE uid = '$uidDestiny' LIMIT 1");
}

function addTrustZone($uid, $uidDestiny){
  global $mysqli;
  $uid = $mysqli->real_escape_string($uid);
  $uidDestiny = $mysqli->real_escape_string($uidDestiny);
  if(!trustChecked($uid, $uidDestiny)){
    $hoy = time();
    $mysqli->query("INSERT INTO  `mexabtc_portal`.`trusts` (
`id` ,
`user_califica` ,
`user_destino` ,
`fecha_trust`
)
VALUES (
NULL , $uid , $uidDestiny , $hoy
);
");

$resp = $mysqli->query("SELECT trust_count FROM users WHERE uid='$uidDestiny' LIMIT 1");
  $datos = $resp->fetch_array(MYSQLI_BOTH);
  $trustCount = $datos[trust_count];
  $trustCount++;

  $mysqli->query("UPDATE users SET trust_count = '$trustCount' WHERE uid = '$uidDestiny' LIMIT 1");

    return true;
  } else {
    return false;
  }
}
