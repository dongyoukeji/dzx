<?php



class WxPayRedTip
{



	public function SetMch_id($value)
	{
		$this->values['mch_id'] = $value;
	}
	public function getNonceStr($length = 32) 
	{
		$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str .= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		} 
		return $str;
	}



}


















?>