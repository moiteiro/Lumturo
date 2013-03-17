<?php

class EnterpriseHeadquarter extends DatabaseObject{
	
	public $id;
	public $name;
	public $description;
	public $enterprise_id;
	public $city_id;
	public $neighborhood_id;
	public $address;
	public $latitude;
	public $longitude;


	// Joins 
	public $subtype_id;
	public $type_id;

	// não manipuláveis
	// apenas para a visualização
	public $created_at;
	public $updated_at;
	
	protected static $table_name = "enterprises_headquarters";
	protected static $db_fields = array(	
										"id"              => INTEGER,
										"name"            => STRING,
										"description"	  => STRING,
										"enterprise_id"   => INTEGER,
										"city_id"         => INTEGER,
										"neighborhood_id" => INTEGER,
										"address"         => STRING,
										"latitude"        => STRING,
										"longitude"       => STRING
										);

	/**
	 * Retorna todos os locais de uma cidade
	 * @access public
	 * @param integer $city_id
	 * @return array
	 */
	public static function find_all_by_city($city_id){
		global $database;

		$query = sprintf("SELECT * FROM ".self::$table_name." 
						  LEFT JOIN enterprises_subtypes_types
						  ON ".self::$table_name.".enterprise_id = enterprises_subtypes_types.enterprise_id
						  WHERE city_id = %s ", $database->escape_value($city_id));

		return self::find_by_sql($query);
	}


	/**
	 * Retorna todos os locais de um bairro
	 * @access public
	 * @param integer $neighborhood_id
	 * @return array
	 */
	public static function find_all_by_neighborhood($neighborhood_id){
		global $database;

		$query = sprintf("SELECT * FROM ".self::$table_name."
						  LEFT JOIN enterprises_subtypes_types
						  ON ".self::$table_name.".enterprise_id = enterprises_subtypes_types.enterprise_id
						  WHERE neighborhood_id = %s ", $database->escape_value($neighborhood_id));
		return self::find_by_sql($query);
	}

	/**
	 * Retorna todos os locais de um cidade/bairro de um determinado tipo
	 * @access public
	 * @param integer $enterprises_type_id
	 * @param integer $city_id
	 * @param integer $neighborhood_id
	 * @return array
	 */
	public static function find_all_by_enterprises_types($enterprises_type_id, $city_id ="", $neighborhood_id =""){
		global $database;

		$query = sprintf("SELECT * FROM ".self::$table_name." WHERE neighborhood_id = %s ", $database->escape_value($neighborhood_id));
		return self::find_by_sql($query);
	}


		/**
	 * Retorna todos os locais de um cidade/bairro de um determinado subtipo
	 * @access public
	 * @param integer $enterprises_subtype_id
	 * @param integer $city_id
	 * @param integer $neighborhood_id
	 * @return array
	 */
	public static function find_all_by_enterprises_subtypes($enterprises_subtype_id, $city_id ="", $neighborhood_id =""){
		global $database;

		$query = sprintf("SELECT * FROM ".self::$table_name." WHERE neighborhood_id = %s ", $database->escape_value($neighborhood_id));
		return self::find_by_sql($query);
	}


	/**
	 * Retorna todos os locais de um bairro
	 * @access public
	 * @param integer $enterprise_id
	 * @return array
	 */
	public static function find_all_by_enterprise($enterprise_id){
		global $database;

		$query = sprintf("SELECT * FROM ".self::$table_name." WHERE enterprise_id = %s ", $database->escape_value($enterprise_id));
		return self::find_by_sql($query);
	}
}

?>