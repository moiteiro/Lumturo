<?php

class EnterpriseType extends DatabaseObject{
	
	public $id;
	public $name;

	// não manipuláveis
	// apenas para a visualização
	public $created_at;
	public $updated_at;
	
	protected static $table_name = "enterprises_types";
	protected static $db_fields = array(	
										"id"          => INTEGER,
										"name" => STRING,
										);
}

?>