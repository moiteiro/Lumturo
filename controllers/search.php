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
$object = "search";
$objects = get_filename(__FILE__);


// Class Name
// ************
$Class = ucfirst($object);


// XML - Basci Struture
// ************
$father_node = $objects;
$child_node = $object;


require_once(MODEL_PATH.DS."search.php");
// inclua todas as classes necessárias
require_once(MODEL_PATH.DS."enterprise_headquarter.php");
require_once(MODEL_PATH.DS."enterprise_subtype.php");
require_once(MODEL_PATH.DS."enterprise_type.php");
require_once(MODEL_PATH.DS."neighborhood.php");
require_once(MODEL_PATH.DS."enterprise.php");
require_once(MODEL_PATH.DS."city.php");


switch($_SERVER['REQUEST_METHOD']){
	
	case "GET":

		$search = new Search();

		if (!isset($params['neighborhood_id'])) {
			$params['neighborhood_id'] = NULL;	
		}

		if (!isset($params['city_id'])) {
			$params['city_id'] = NULL;
		}


		/******************
			Pagination
		******************/

		$params['page'] = isset($params['page']) ? $params['page'] : 0;
		$params['qty'] = isset($params['qty']) ? $params['qty'] : 10;

		$start = $params['page'] <= 0 ? 0 : $params['page'] - 1;
		$length	= $params['qty'] > 100 ? 100 : $params['qty'];

		$start *= $length;

		$results = $search->execute($params['search_string'], $start, $length, $params['city_id'], $params['neighborhood_id']);

		$array = array();

		foreach($results['result'] as $result) {

			$temp_array = array();

			$temp_array['id'] = $result['id'];
			$temp_array['name'] = $result['name'];

			$array[] = $temp_array;
		}

		$output['iTotalRecords']        = $results['total'];
		$output['iTotalDisplayRecords'] = count($results['result']);
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