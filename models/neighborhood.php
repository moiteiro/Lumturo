<?php

class Neighborhood extends DatabaseObject{
	
	public $id;
	public $city_id;
	public $name;

	// não manipuláveis
	// apenas para a visualização
	public $created_at;
	public $updated_at;
	
	protected static $table_name = "neighborhoods";
	protected static $db_fields = array(	
										"id"      => INTEGER,
										"city_id" => INTEGER,
										"name"    => STRING,
										);

	/**
	 * Retorna todos os bairros de um cidade.
	 * @access public
	 * @param integer $city_id
	 * @return array|object
	 */
	public static function find_all_by_city($city_id){
		global $database;

		$query = sprintf("SELECT * FROM ". self::$table_name. " WHERE city_id = %s ORDER BY name ASC",
						$database->escape_value($city_id)
					);

		return self::find_by_sql($query);
	}	

}

?>