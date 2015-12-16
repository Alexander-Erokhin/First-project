<?php 

class Validator{
	//Большие и маленькие английские буквы, цифры и _, -
	function basic_filter($str){
		if(!preg_match('/^[A-Za-z0-9_-]+$/u', $str)) return false;
		else return $str;
	}

	//Цифры и - для объема
	function volume_car_filter($str){
		if(!preg_match('/^([0-9]{1,2}.[0-9]{1}|\-{1})$/u', $str)) return false;
		else return $str;
	}
	
	//Русские букв, слеш и пробел
	function rus_string_slash_filter($str){
		if(!preg_match('/^[а-яё\/ ]+$/iu', $str)) return false;
		return $str;
	} 
	
	/**
	 * 
	 * Проверка поля на целое цисло
	 * @param string
	 */
	function integer($str){
		return filter_var($str, FILTER_VALIDATE_INT);
	}

	/**
	 * 
	 * Проверка поля на число c плавающей точкой
	 * @param string
	 */
	function float($str){
		
		
		return filter_var($str, FILTER_VALIDATE_FLOAT);
	}	
	/**
	 * Значение не может быть пустым
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */
	function required($str)
	{
		if ( ! is_array($str))
		{
			return (trim($str) == '') ? FALSE : TRUE;
		}
		else
		{
			return ( ! empty($str));
		}
	}
	
	/**
	 * Валидация URL
	 * @param string
	 */
	function valid_url($str){

		return filter_var($str, FILTER_VALIDATE_URL);
	}
	
	
	/**
	 * 
	 * Валидация email-адреса
	 * @param string
	 */
	function valid_email($str){
	
		return filter_var($str, FILTER_VALIDATE_EMAIL);
	}
	
	
	/**
	 * 
	 * Валидация IP-адреса
	 * @param string
	 */
	function valid_ip($str){
		
		
		return filter_var($str, FILTER_VALIDATE_IP);
	}
	
	
	/**
	 * Match one field to another
	 *
	 * @access	public
	 * @param	string
	 * @param	field
	 * @return	bool
	 */
	function matches($str, $field)
	{
		if ( ! isset($_POST[$field]))
		{
			return FALSE;				
		}
		
		$field = $_POST[$field];

		return ($str !== $field) ? FALSE : TRUE;
	}
	
	
	
	/**
	 * Только буквы латинского алфавита
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */		
	function alpha($str)
	{
		return ( ! preg_match("/^([a-z])+$/i", $str)) ? FALSE : TRUE;
	}

	
	/**
	 * Проверка капчи
	 *
	 * @access	public
	 * @param	string
	 * @param	string
	 * @return	bool
	 */	
	function valid_captcha($str,$name){
		
		return (!empty($_SESSION[$name]) && $_SESSION[$name] == $str)? TRUE: FALSE;
	}
	
	
	/**
	 * Проверка даты
	 *
	 * @access	public
	 * @param	string
	 * @return	bool
	 */	
	function valid_date($str){
		
		$stamp = strtotime( $str );

		if (!is_numeric($stamp)){
			
			return FALSE;
		}
		
		$month = date( 'm', $stamp );
		$day   = date( 'd', $stamp );
		$year  = date( 'Y', $stamp );
		
		return checkdate($month, $day, $year); 
	}
	
	
	function unique($str,$fields){
		
		list($table,$field) = explode('.',$fields);
		
		$result = mysql_query("SELECT COUNT(*) AS count FROM `".$table."` WHERE ".mysql_real_escape_string($field)."='".mysql_real_escape_string($str)."'");
	
		$myrow  =  mysql_fetch_assoc($result);
		
		return $myrow['count'] == 0;
		
	}
}

?>