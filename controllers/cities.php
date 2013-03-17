<?php

// header("Content-Type: text/xml");
header("Content-Type: application/json");

// *****************//
// Controller Config
// *****************//

// para acessos via JSON.
if(!defined("MODEL_PATH"))
	require_once("../includes/config.php");

// Object Name
// ************
$object = "city";
$objects = get_filename(__FILE__);


// Class Name
// ************
$Class = ucfirst($object);


// XML - Basci Struture
// ************
$father_node = $objects;
$child_node = $object;


// inclua todas as classes necessárias
require_once(MODEL_PATH.DS."{$object}.php");

switch($_SERVER['REQUEST_METHOD']){
	
	case "GET":

		
		if(isset($params['id'])){
			$$objects = array($Class::find_by_state_and_name($params['id']));
		} else {
			$$objects = $Class::find_all();
		}

		$array = array();

		foreach($cities as $city) {
			$array[] = array(
									"id"       => $city->id,
									"name"     => $city->name,
									"state_id" => $city->state_id,
									);
		}

		$output['iTotalRecords'] = $Class::get_total_amount();
		$output['iTotalDisplayRecords'] = count($$objects);
		$output['aaData'] = $array;

		$output = json_encode($output);
		echo $output;

	break;
	
	case "POST":

		echo "nothing here for you ;]";
		exit();

		$input = file_get_contents("php://input");
		$xml = simplexml_load_string($input);

		// quebrando o xml e setando dentro 
		foreach($xml->$child_node as $obj){

			$$object = new $Class();
			$db_fields = $$object->get_attributes_type();

			foreach($db_fields as $attribute=>$type)
				if(isset($obj->$attribute))
					$params[$attribute] = $obj->$attribute;				

			$$object->set_attributes($params);

			if(isset($$object->id))
				$$object->update();
			else
				$$object->create();

			unset($$object);
		}

	break;
	
	case "PUT":

		$input = file_get_contents("php://input");
		$xml = simplexml_load_string($input);

		print_r($xml);

		// quebrando o xml e setando dentro 
		foreach($xml->$child_node as $obj){

			$$object = new $Class();
			$db_fields = $$object->get_attributes_type();

			foreach($db_fields as $attribute=>$type)
				if(isset($obj->$attribute))
					$params[$attribute] = $obj->$attribute;				

			$$object->set_attributes($params);
			
			$result = $$object->update();

			unset($$object);
		}

	break;
	
	case "DELETE":

		$$object = new $Class();
		$$object->id = $params['id'];
		$$object->delete();
		
	break;
	
}

exit();
?>