<?php

class State extends DatabaseObject{
	
	public $id;
	public $acronym;
	public $name;

	// não manipuláveis
	// apenas para a visualização
	public $created_at;
	public $updated_at;
	
	protected static $table_name = "states";
	protected static $db_fields = array(	
										"id"      => INTEGER,
										"acronym" => STRING,
										"name"    => STRING,
										);
}

?>