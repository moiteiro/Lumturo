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
$object = "location";
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
require_once(MODEL_PATH.DS."enterprise_headquarter.php");

switch($_SERVER['REQUEST_METHOD']){
	
	case "GET":

		if(isset($params['neighborhood_id'])){

			$$objects      = $Class::find_all_by_neighborhood($params['neighborhood_id']);
			$columns       = EnterpriseHeadquarter::get_attributes_type();
			$total_records = EnterpriseHeadquarter::get_total_amount();

		} else if(isset($params['city_id'])){
			
			$$objects      = $Class::find_all_by_city($params['city_id']);
			$columns       = EnterpriseHeadquarter::get_attributes_type();
			$total_records = EnterpriseHeadquarter::get_total_amount();

		} else {
			
		}

		$array = array();

		foreach($locations as $location) {

			$temp_array = array();

			foreach($columns as $attribute=>$type){

				$temp_array["{$attribute}"] = $location->$attribute;
			}

			$temp_array['subtype_id'] = $location->subtype_id;
			$temp_array['type_id'] = $location->type_id;

			$array[] = $temp_array;
		}

		$output['iTotalRecords']        = $total_records;
		$output['iTotalDisplayRecords'] = count($$objects);
		$output['aaData']               = $array;

		$output = json_encode($output);
		echo $output;

	break;
	
	case "POST":

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