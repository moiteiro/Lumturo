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
$object = "enterprise_type";
$objects = get_filename(__FILE__);


// Class Name
// ************
$Class = "EnterpriseType";


// XML - Basci Struture
// ************
$father_node = $objects;
$child_node = $object;


// inclua todas as classes necessárias
require_once(MODEL_PATH.DS."{$object}.php");

switch($_SERVER['REQUEST_METHOD']){
	
	case "GET":

	
		if(isset($params['id'])){
			$$objects = array($Class::find_by_id($params['id']));
		} else {
			
			$$objects = $Class::find_all();
		}

		$array = array();

		foreach($enterprises_types as $enterprise_type) {
			$array[] = array(
									"id"   => $enterprise_type->id,
									"name" => $enterprise_type->name,
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

		$$object = new $Class();
		$db_fields = $$object->get_attributes_type();

		foreach($db_fields as $attribute=>$type)
			if(isset($obj->$attribute))
				$params[$attribute] = $obj->$attribute;


		// campos da tabela que não serão avalidados
		$not_evaluate = array("id");
		$validation->avoid_fields($not_evaluate);
		
		// validando os dados submetidos
		$validation->validate_fields($params, $db_fields);
		
		// ver o resultado das validações
		# echo $validation->get_validation_result(); exit();
		
		if($validation->get_errors() != 0) {

			$output = json_encode($output);
			echo $output;
			exit();

		}
		
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