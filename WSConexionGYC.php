<?php
$usuario = $_POST['username'];
$password = $_POST['password'];

$servicio="http://administrativo.ganaycobra.com/BOSSWebServices/IncomingIntegrationService/IncomingIntegrationService.svc?wsdl"; //url del servicio


$parametros=array(); //parametros de la llamada
$parametros['sourceId']="GANAYCOBRAID";
$parametros['sourcePassword']="g4n4yc0br4";
$parametros['playerId']=$usuario;
$parametros['password']=$password;
$parametros['userId']="INETUSR";
 
$parametros['workstationId']=$_SERVER['REMOTE_ADDR'];
$parametros['applicationId']="SBBR";
$parametros['logonSource']="1";
$parametros['websiteId']="6404";
$parametros['partnerId']="House";
$parametros['thridPartyToken']=""; 


$client = new SoapClient($servicio);
$result = $client->PlayerLogin($parametros);    //llamamos al métdo que nos interesa con los parámetros
$result = obj2array($result);

$error = $result[PlayerLoginResult]['ErrorCode'];
$message = $result[PlayerLoginResult]['LocalizedMessage'];
//echo $result[PlayerLoginResult]['Token']."<br>";
//print_r($result);
/*print_r($stoken);
print_r($error);
print_r($message);
*/

function obj2array($obj) {
  $out = array();
  foreach ($obj as $key => $val) {
    switch(true) {
        case is_object($val):
         $out[$key] = obj2array($val);
         break;
      case is_array($val):
         $out[$key] = obj2array($val);
         break;
      default:
        $out[$key] = $val;
    }
  }
  return $out;
}

//print_r($result);
if(!isset($_COOKIE['stoken'])){
	$_COOKIE['stoken']='';
}
$_COOKIE['stoken']='';
$stoken = $result[PlayerLoginResult]['Token']; 
setcookie("stoken", $stoken, time()+(60*20));
$_COOKIE['stoken']=$stoken;

//  Obtenemos el fondo del usuario
if ($stoken!=""){
    $parametros_2=array(); //parametros de la llamada
    $parametros_2['sourceId']="GANAYCOBRAID";
    $parametros_2['sourcePassword']="g4n4yc0br4";
    //$parametros_2['playerId']=$usuario;
    $parametros_2['token']=$stoken;

    $client_2 = new SoapClient($servicio, $parametros_2);
    //$result_2 = $client_2->GetFunds($parametros_2);    //llamamos al métdo que nos interesa con los parámetros
    $result_2 = $client_2->GetPlayerPersonalInformation($parametros_2);    //llamamos al métdo que nos interesa con los parámetros
    $result_2 = obj2array($result_2);

    $_COOKIE['balance']='';
    $_COOKIE['CustomerId']='';
    $_COOKIE['CurrencyLocalizedSymbol']='';
    $_COOKIE['TotalCurrentWeekWonLost']='';
    $_COOKIE['CurrentWeekInOut']='';

    $balance = $result_2[GetPlayerPersonalInformationResult]['PlayerInfo']['CurrentBalance'];
    $CustomerId = $result_2[GetPlayerPersonalInformationResult]['PlayerInfo']['CustomerId'];
    $CurrencyLocalizedSymbol = $result_2[GetPlayerPersonalInformationResult]['PlayerInfo']['CurrencyLocalizedSymbol'];
    $TotalCurrentWeekWonLost = $result_2[GetPlayerPersonalInformationResult]['PlayerInfo']['TotalCurrentWeekWonLost'];
    $CurrentWeekInOut = $result_2[GetPlayerPersonalInformationResult]['PlayerInfo']['CurrentWeekInOut'];

    setcookie("balance", $balance , time()+(60*20));
    setcookie("CustomerId", $CustomerId , time()+(60*20));
    setcookie("CurrencyLocalizedSymbol", $CurrencyLocalizedSymbol , time()+(60*20));
    setcookie("TotalCurrentWeekWonLost", $TotalCurrentWeekWonLost , time()+(60*20));
    setcookie("CurrentWeekInOut", $CurrentWeekInOut , time()+(60*20));

    $_COOKIE['balance']=$balance ;
    $_COOKIE['CustomerId']=$CustomerId;
    $_COOKIE['CurrencyLocalizedSymbol']=$CurrencyLocalizedSymbol;
    $_COOKIE['TotalCurrentWeekWonLost']=$TotalCurrentWeekWonLost;
    $_COOKIE['CurrentWeekInOut']=$CurrentWeekInOut;
    //print_r($result_2);exit();
}
//echo $_COOKIE['stoken']; exit();
/*if ($stoken!="")
    echo '<script language="javascript" type="text/javascript">parent.window.location.href = "http://ganaycobra.com/hipismo/";</script>';
else
    echo '<script language="javascript" type="text/javascript">parent.window.location.href = "javascript:history.back(1)";parent.window.location.href = "javascript:history.back(1)";alert("Usuario o Password invalidos!");</script>';

*/
if ($error>0)
	echo '<script language="javascript" type="text/javascript"> var message = '.json_encode($message).';alert("Error: "+message);</script>';
else
    echo '<script language="javascript" type="text/javascript">parent.window.location.href = "http://ganaycobra.com/hipismo/";</script>';

?>