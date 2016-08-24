<?php
/**
* Encrypt class - 加密解密
*
* @version 1.0
* @author duqbing
* @copyright cmts.cn
* @createDate 2012.10.10
*/
class EncryptCopy{

	/**
	* 字符串加密
	* @param : $input - 需要加密的字符串
	* @return : 加密后的字符串
	*/
	public static function encrypt($input){
		$result = self::_DoXor($input,XOR_KEY);
		return bin2hex($result);
	}
	/**
	* 字符串加密
	* @param : $input - 需要加密的字符串
	* @param : $key - 加密key
	* @return : 加密后的字符串
	*/
	public static function encryptByKey($input, $key){
		$result = self::_DoXor($input, $key);
		return bin2hex($result);
	}

	/**
	* 字符串解密
	* @param : $input - 需要解密的字符串
	* @return : 解密后的字符串
	*/
	public static function decrypt($input){
		$result = self::hex2bin($input);
		return self::_DoXor($result,XOR_KEY);
	}

	/**
	* 字符串解密
	* @param : $input - 需要解密的字符串
	* @param : $key - 加密key
	* @return : 解密后的字符串
	*/
	public static function decryptByKey($input,$key){
		$result = self::hex2bin($input);
		return self::_DoXor($result,$key);
	}

	private static function _DoXor($input, $key){
		$source = $input;
		$xor_key = $key;
		for($i=0;$i<strlen($source);$i++){
			$index = $i % strlen($xor_key);
			$key .= $xor_key[$index];
			
		}
		return $source ^ $key;
	}

	/**
    * 把十六进制字符串转换成文本字符串 
    * @param $str - 要转换的字符串,不能为null. 
    * @return string 
    * @throw Exception 
    */   
	public static function hex2bin($str){
		return pack('H*', $str);
	}

	
}
?>