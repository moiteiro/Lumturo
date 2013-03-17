<?php

class Search extends DatabaseObject{
	
	public $id;
	public $created_at;

	public $occurrences;

	/**
	 * Executa as queries para buscar o resultado e o total.
	 * @access public
	 * @param string $string
	 * @param integer $start
	 * @param integer $length
	 * @return array
	 */
	public function execute($string, $start, $length, $city_id = NULL, $neighborhood_id = NULL) {
		global $database;
		
		$query = $this->prepare_query($string, $start, $length, $city_id, $neighborhood_id);
		$amount = $this->prepare_count_query($string);

		$result['result'] = $database->result_to_array($database->query($query));
		$result['total'] = $this->execute_query_count($amount);

		return $result;
	}

	/**
	 * Executa a query de contagem e retorna o total de resultados.
	 * @access protected
	 * @param string $query
	 * @return integer 
	 */
	protected function execute_query_count($query){
		global $database;
		
		$result_set = $database->query($query);
		$result = $database->result_to_array($result_set);

		$total = 0;

		if(isset($result) && is_array($result)){
			foreach ($result as $row) {
				$total+=$row['count'];
			}
		}

		return $total;
	}

	/**
	 * Monta a query de busca e retorna uma string
	 * @access protected
	 * @param string $string
	 * @param integer $start
	 * @param integer $length
	 * @return string
	 */
	protected function prepare_query($string, $start, $length, $city_id, $neighborhood_id) {
		global $database;

		$columns = array ('name', 'description');
		$strings = $this->break_string($string);
		$where = "";

		$like_comperasions = $this->create_like_compare_sentence($columns, $strings);
		$relevance_statements =  $this->create_relevance_statement($columns, $strings);

		if ($city_id) {
			$where .= sprintf(" city_id = %s AND ", $database->escape_value($city_id));
		}

		if ($neighborhood_id) {
			$where .= sprintf(" neighborhood_id = %s AND ", $database->escape_value($neighborhood_id));
		}
		
		$query = "SELECT *, SUM({$relevance_statements}) AS occurrences 
						 FROM enterprises_headquarters
						 WHERE {$where} {$like_comperasions} 
						 GROUP BY id";

		$query.= " ORDER BY occurrences DESC ";
		$query.= sprintf(" LIMIT %s,%s", $database->escape_value($start), $database->escape_value($length));

		return $query;
	}

	/**
	 * Monta a query de busca para pegar o total de ocorrencias.
	 * @access protected
	 * @param string $string
	 * @return string
	 */
	protected function prepare_count_query($string){
		global $database;

		$columns = array ('name', 'description');
		$strings = $this->break_string($string);
		$like_comperasions = $this->create_like_compare_sentence($columns, $strings);

		$query = "SELECT count(id) AS count 
						 FROM enterprises_headquarters 
						 WHERE {$like_comperasions} ";
		
		return $query;

	}
	/**
	 * Quebra a string e no '+' e retorna um array com essas palavras.
	 * @access public
	 * @param $string string
	 * @return array
	 */
	protected function break_string($string){
		return explode('+',$string);
	}

	/**
	 * Retorna toda a sentenca de likes em uma unica string.<br />
	 * @access public
	 * @param array $columns 
	 * @param array $string
	 * @return string
	 */
	protected function create_like_compare_sentence($columns, $strings){
		global $database;

		$strings = $this->create_all_words_sentences($strings);

		$like_sentence = array();
		foreach($strings as $string) {
			if(strlen($string) < 2 ) 
				continue;

			foreach($columns as $column){
				$like_sentence[] = sprintf(" {$column} like '%%%s%%' ",$database->escape_value($string));
			}
		}

		return $like_sentence ? implode(" OR ", $like_sentence) : " 1 ";
	}

	/**
	 * Retorna a relevancia que cada palavra pesquisada tera.<br />
	 * Essa relevancia eh baseada em quantas vezes ela parace na linha do resgistro e em qual coluna da tabela.<br />
	 * @access protected
	 * @param array $columns
	 * @param array $strings
	 * @return string
	 */
	protected function create_relevance_statement($columns, $strings){
		global $database;

		$relevance_statement = array();
		$relevance = 10;

		foreach($strings as $string){
			if(strlen($string) < 2 ) 
				continue;

			foreach($columns as $column){
				if($column == 'name') //para que o titulo tenha mais relevancia
					$relevance = 1;
				$relevance_statement[] = sprintf("((LENGTH({$column}) - LENGTH(REPLACE(LOWER({$column}), LOWER('%s'), ''))) / {$relevance })", 
					$database->escape_value($string));
				$relevance = 10;
			}
		}

		return $relevance_statement ? implode("+", $relevance_statement) : "";
	}

	protected function create_all_words_sentences($string) {
		$strings = array();
		$strings[] = implode(" ", $string);
		return array_merge($strings, $string);
	}
}

?>