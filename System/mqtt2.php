<?php
require("phpMQTT-master/phpMQTT.php");
$host   = "test.mosquitto.org/";
$port     = 9001;
$username = "";
$password = "";
$mqtt = new bluerhinos\phpMQTT($host, $port, "sistema");

if(!$mqtt->connect(false,NULL,$username,$password)){
  echo "Msg Recievedsfgd:";
  exit(1);
}

//currently subscribed topics
$topics['ESP32_pub'] = array("qos"=>2, "function"=>"procmsg");
$mqtt->subscribe($topics,0);

while($mqtt->proc()){
}

$mqtt->close();
function procmsg($topic,$msg){
  echo "Msg Recieved: $msg";
}
?>
