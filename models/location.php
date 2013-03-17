<?php

class Location extends DatabaseObject{
	
	public $latitude;
	public $longitude;

	/**
	 * Retorna todos os locais de uma cidade
	 * @access public
	 * @param integer $city_id
	 * @return array
	 */

	public static function find_all_by_city($city_id){
		return EnterpriseHeadquarter::find_all_by_city($city_id);
	}

	public static function find_all_by_neighborhood($neighborhood_id){
		return EnterpriseHeadquarter::find_all_by_neighborhood($neighborhood_id);
	}

	public static function find_all_by_enterprises_types($enterprises_types_id, $city_id, $neighborhood_id){
		return EnterpriseHeadquarter::find_all_by_enterprises_types($neighborhood_id);
	}

	public static function find_all_by_enterprises_subtypes($enterprises_types_id, $city_id = "", $neighborhood_id = ""){
		return EnterpriseHeadquarter::find_all_by_enterprises_subtypes($neighborhood_id);
	}
}

?>