<?php
define('HOST_NAME',"localhost");
define('PORT',"8091");
$null = NULL;



$dbhost = "localhost";
$dbname = "etolivin_chat";
$dbusername = "root";
$dbpassword = "";

$link = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);


require_once("class.chathandler.php");
$chatHandler = new ChatHandler();

$socketResource = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($socketResource, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($socketResource, 0, PORT);
socket_listen($socketResource);

$clientSocketArray = array($socketResource);
while (true) {
	$newSocketArray = $clientSocketArray;
	socket_select($newSocketArray, $null, $null, 0, 10);

	if (in_array($socketResource, $newSocketArray)) {
		$newSocket = socket_accept($socketResource);
		$clientSocketArray[] = $newSocket;

		$header = socket_read($newSocket, 1024);
		$chatHandler->doHandshake($header, $newSocket, HOST_NAME, PORT);

		socket_getpeername($newSocket, $client_ip_address);
		$connectionACK = $chatHandler->newConnectionACK($client_ip_address);

		$chatHandler->send($connectionACK);

		$newSocketIndex = array_search($socketResource, $newSocketArray);
		unset($newSocketArray[$newSocketIndex]);
	}

	foreach ($newSocketArray as $newSocketArrayResource) {
		while(socket_recv($newSocketArrayResource, $socketData, 1024, 0) >= 1){
			$socketMessage = $chatHandler->unseal($socketData);
			$messageObj = json_decode($socketMessage);

            $statement = $link->prepare("INSERT INTO chat(nombre, mensaje, id_microempresario, id_rse, tipo, leido_portal, leido_rse)
                VALUES(:nombre, :mensaje, :id_microempresario, :id_rse, :tipo, :leido_portal, :leido_rse)");
            $statement->execute(array(
                'nombre' => $messageObj->chat_user,
                'mensaje' => $messageObj->chat_message,
                'id_microempresario' => 5,
                'id_rse' => 1,
                'tipo' => 0,
                'leido_portal' => 0,
                'leido_rse' => 0
            ));

			$chat_box_message = $chatHandler->createChatBoxMessage($messageObj->chat_user, $messageObj->chat_message);
			$chatHandler->send($chat_box_message);
			break 2;
		}

		$socketData = @socket_read($newSocketArrayResource, 1024, PHP_NORMAL_READ);
		if ($socketData === false) {
			socket_getpeername($newSocketArrayResource, $client_ip_address);
			$connectionACK = $chatHandler->connectionDisconnectACK($client_ip_address);
			$chatHandler->send($connectionACK);
			$newSocketIndex = array_search($newSocketArrayResource, $clientSocketArray);
			unset($clientSocketArray[$newSocketIndex]);
		}
	}
}
socket_close($socketResource);