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
$object = "enterprise_subtype";
$objects = get_filename(__FILE__);


// Class Name
// ************
$Class = "EnterpriseSubtype";


// XML - Basci Struture
// ************
$father_node = $objects;
$child_node = $object;


// inclua todas as classes necessárias
require_once(MODEL_PATH.DS."{$object}.php");

switch($_SERVER['REQUEST_METHOD']){
	
	case "GET":

		// para listar apenas valores de um determinado tipo
		if(isset($params['id'])){

			$$objects = array($Class::find_by_id($params['id']));

		} else if(isset($params['enterprises_type_id'])){

			$$objects = $Class::find_by_enterprise_type($params['enterprises_type_id']);

		} else {
			
			$$objects = $Class::find_all();
		}
		

		$array = array();

		foreach($enterprises_subtypes as $enterprise_subtype) {
			$array[] = array(
									"id"   => $enterprise_subtype->id,
									"name" => $enterprise_subtype->name,
									//"enterprise_type_id" => $enterprise_subtype->enterprise_type_id,
									);
		}

		$output['iTotalRecords'] = $Class::get_total_amount();
		$output['iTotalDisplayRecords'] = count($$objects);
		$output['aaData'] = $array;

		$output = json_encode($output);
		echo $output;

	break;
	
	case "POST":
		
		$output['bResult'] = false;
		$output['aError'] = array();

		if (!isset($params['enterprises_type_id']) || $params['enterprises_type_id'] =="") {
			$output['aError'][] = array('iCode' => 1, "sText" => "Ex: City not found");
		} else {
			$params['enterprise_type_id'] = $params['enterprises_type_id'];
		}


		$$object = new $Class();
		$db_fields = $$object->get_attributes_type();

		foreach($db_fields as $attribute=>$type)
			if(isset($obj->$attribute))
				$params[$attribute] = $obj->$attribute;

		$$object->set_attributes($params);
	
		$result = $$object->create();

		if ($result) {
			$output['bResult'] = true;
		} else {
			$output['bResult'] = false;
		}

		$output = json_encode($output);
		echo $output;

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