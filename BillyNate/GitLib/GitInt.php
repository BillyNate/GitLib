<?php

namespace BillyNate\GitLib;

class GitInt //PHP doesn't allow us to use Int (understandable but leaves us with a less beautiful classname)
{
	public static function varintToDec($str, &$length=0)
	{
		$dec = 0;
		$val = 0x80;
		for($i=0; $val&0b10000000; $i+=1)
		{
			$val = ord(mb_substr($str, $i, 1));
			$dec |= (($val & 0b01111111) << $i * 7);
		}
		$length = $i;
		return $dec;
	}

	public static function decToVarint($dec)
	{
		$str = '';
		while($dec > 0)
		{
			$val = $dec & 0b01111111;
			$dec = $dec >> 7;
			if($dec > 0)
			{
				$val |= 0b10000000;
			}
			$str .= chr($val);
		}
		return $str;
	}
}