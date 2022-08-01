<?php $mensagem="";
if(isset($_GET['mensagem'])) {
  $mensagem = $_GET['mensagem'];}
?>

<?xml version="1.0" encoding="UTF-8" standalone="no"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

  <head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.js" type="text/javascript"></script>
 	<script type = "text/javascript"
         src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type = "text/javascript">


    // Create a client instance
  client = new Paho.MQTT.Client("192.168.0.235", 9001, "sistema");

  // set callback handlers
  client.onConnectionLost = onConnectionLost;
  client.onMessageArrived = onMessageArrived;

  // connect the client
  client.connect({onSuccess:onConnect,cleanSession: false});


  // called when the client connects
  function onConnect() {
    // Once a connection has been made, make a subscription and send a message.


    client.subscribe("ESP32_pub",{qos:2});
    //message = new Paho.MQTT.Message("Hello");
    //message.destinationName = "World";
    //client.send(message);
  }

  // called when the client loses its connection
  function onConnectionLost(responseObject) {
    if (responseObject.errorCode !== 0) {
      console.log("onConnectionLost:"+responseObject.errorMessage);
    }
  }

  // called when a message arrives
  function onMessageArrived(message) {
    //console.log("aux:"+message.payloadString);
      var aux = message.payloadString;
      var aux2 = <?php echo json_encode($mensagem);?>;
      document.cookie = "msg_mqtt="+aux;
      document.cookie = "pagina="+window.location.href
      if(aux!=getCookie('msg_mqtt2')){
        document.cookie = "msg_mqtt2="+aux;
        window.location.assign("inclui_dado.php");
      }

      console.log("aux:"+aux);
      console.log("aux2:"+aux2);
  }
  function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

    </script>

  </head>
  <body>


	    <script >

	    </script>
  </body>
</html>
