<?php

class EnterpriseSubtype extends DatabaseObject{
	
	public $id;
	public $enterprise_type_id;
	public $name;

	// não manipuláveis
	// apenas para a visualização
	public $created_at;
	public $updated_at;

	// joins
	public $enterprise_type_name;
	
	protected static $table_name = "enterprises_subtypes";
	protected static $db_fields = array(	
										"id"                 => INTEGER,
										"enterprise_type_id" => INTEGER,
										"name"               => STRING,
										);

	/**
	 * Retorna todos os subtipos de um tipo de empresa.
	 * @access public
	 * @param integer $enterprise_type_id
	 * @return array|object
	 */
	public static function find_by_enterprise_type($enterprise_type_id){
		global $database;

		$query = sprintf("SELECT * FROM ".self::$table_name." WHERE enterprise_type_id = %s",
				$database->escape_value($enterprise_type_id));
		
		return self::find_by_sql($query);
	}
}

?>