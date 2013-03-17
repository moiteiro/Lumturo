<?php

class Enterprise extends DatabaseObject{
	
	public $id;
	public $name;

	// não manipuláveis
	// apenas para a visualização
	public $created_at;
	public $updated_at;
	
	protected static $table_name = "enterprises";
	protected static $db_fields = array(	
										"id"      => INTEGER,
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

		$query = sprintf("SELECT enterprises.id, enterprises.name 
						  FROM enterprises_headquarters 
						  LEFT JOIN enterprises 
						  ON enterprises_headquarters.enterprise_id = enterprises.id
 						  WHERE city_id = %s 
						  GROUP BY enterprises_headquarters.enterprise_id
						  ORDER BY enterprises.name ASC",
						$database->escape_value($city_id)
					);
		return self::find_by_sql($query);
	}

}

?>