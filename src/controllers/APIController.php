<?php

class APIController
{
	public static function render($data, $format)
	{
		switch($format) {
			case 'json':
				APIController::sendResponse(200, 'text/json', json_encode($data));
				break;
			case 'xml':
				$root = key($data);
				$xml  = new SimpleXMLElement("<?xml version=\"1.0\"?><".$root."></".$root.">");

				APIController::array_to_xml($data[$root], $xml);

				APIController::sendResponse(200, 'text/xml', $xml->asXML());
				break;
			default:
				APIController::sendResponse(405);
				break;
		}
	}

	public static function sendResponse($status, $content_type = 'text/html', $data = '')
	{
		$status_header = 'HTTP/1.1 '.$status.' '.APIController::statusCodes($status);
		
		header($status_header);
		header('Content-Type: '.$content_type);

		if($data){
			echo $data;
		} else {
			echo APIController::statusCodes($status);
		}

		exit;
	}

	public static function statusCodes($status)
	{
		$status_codes = Array(
			100 => 'Continue',
			101 => 'Switching Protocols',
			200 => 'OK',
			201 => 'Created',
			202 => 'Accepted',
			203 => 'Non-Authoritative Information',
			204 => 'No Content',
			205 => 'Reset Content',
			206 => 'Partial Content',
			300 => 'Multiple Choices',
			301 => 'Moved Permanently',
			302 => 'Found',
			303 => 'See Other',
			304 => 'Not Modified',
			305 => 'Use Proxy',
			306 => '(Unused)',
			307 => 'Temporary Redirect',
			400 => 'Bad Request',
			401 => 'Unauthorized',
			402 => 'Payment Required',
			403 => 'Forbidden',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			406 => 'Not Acceptable',
			407 => 'Proxy Authentication Required',
			408 => 'Request Timeout',
			409 => 'Conflict',
			410 => 'Gone',
			411 => 'Length Required',
			412 => 'Precondition Failed',
			413 => 'Request Entity Too Large',
			414 => 'Request-URI Too Long',
			415 => 'Unsupported Media Type',
			416 => 'Requested Range Not Satisfiable',
			417 => 'Expectation Failed',
			500 => 'Internal Server Error',
			501 => 'Not Implemented',
			502 => 'Bad Gateway',
			503 => 'Service Unavailable',
			504 => 'Gateway Timeout',
			505 => 'HTTP Version Not Supported'
		);

		return (isset($status_codes[$status])) ? $status_codes[$status] : '';
	}

	public static function array_to_xml($data, &$xml) {
		foreach($data as $key => $value) {
			if(is_array($value)) {
				if(!is_numeric($key)){
					$subnode = $xml->addChild("$key");
					APIController::array_to_xml($value, $subnode);
				}
				else{
					APIController::array_to_xml($value, $xml);
				}
			}
			else {
				$xml->addChild("$key","$value");
			}
		}
	}
}