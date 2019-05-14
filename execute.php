<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$responses = array();
$responses['pacciani'] = array();
$responses['pacciani'][] = 'posso parlà da i banco?';
$responses['pacciani'][] = 'con pacciani si andava a fa delle merende';
$responses['pacciani'][] = 'ci penserà il signore a punire il canessa con un malaccio incurabile';

$text = trim($text);
$text = strtolower($text);
header("Content-Type: application/json");

$response = '';

if(strpos($text, "/start") === 0 || $text=="Benvenuto Mario")
{
	$response = "Posso parlà da i banco?";
}	
elseif($text=="ciao mario")
{
	$response = "voglio la libertà per andare alla posta";
}	
elseif($text=="benvenuto")
{
	$response = "ci penserà il signore a punire i canessa con un malaccio incurabile";
}
elseif($text=="ciao vanni")
{
	$response = "ciao $username";
}


else
{
	foreach($responses as $key => $value){
		if(strpos(strtolower($text), $key)){
			$response = $responses[$key][rand(0, sizeof($responses[$key]) - 1)];
		}
	}
}


$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);

