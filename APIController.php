<?php

class APIController
{
	public function render($data, $format)
	{
		switch($format) {
			case 'json':
				header('Content-Type: text/json');

				echo json_encode($data);
				break;
			case 'xml':
				$root = key($data);
				$xml  = new SimpleXMLElement("<?xml version=\"1.0\"?><".$root."></".$root.">");

				$this->array_to_xml($data[$root], $xml);

				echo $xml->asXML();
				break;
		}
	}

	public function array_to_xml($data, &$xml) {
	    foreach($data as $key => $value) {
	        if(is_array($value)) {
	            if(!is_numeric($key)){
	                $subnode = $xml->addChild("$key");
	                $this->array_to_xml($value, $subnode);
	            }
	            else{
	                $this->array_to_xml($value, $xml);
	            }
	        }
	        else {
	            $xml->addChild("$key","$value");
	        }
	    }
	}
}