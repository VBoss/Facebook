<?php

/**
 * This file is part of the Kdyby (http://www.kdyby.org)
 *
 * Copyright (c) 2008 Filip Procházka (filip@prochazka.su)
 *
 * For the full copyright and license information, please view the file license.md that was distributed with this source code.
 */

namespace Kdyby\Facebook;

use Nette;



/**
 * @author Filip Procházka <filip@prochazka.su>
 */
class Helpers extends Nette\Object
{

	/**
	 * Return true if this is video post.
	 *
	 * @param string $path The path
	 * @param string $method The http method (default 'GET')
	 *
	 * @return boolean true if this is video post
	 */
	public static function isVideoPost($path, $method = NULL)
	{
		if ($method == 'POST' && preg_match('~^(\\/)(.+)(\\/)(videos)$~', $path)) {
			return TRUE;
		}
		return FALSE;
	}



	/**
	 * Base64 encoding that doesn't need to be urlencode()ed.
	 * Exactly the same as base64_encode except it uses
	 *   - instead of +
	 *   _ instead of /
	 *   No padded =
	 *
	 * @param string $input base64UrlEncoded string
	 * @return string
	 */
	public static function base64UrlDecode($input)
	{
		return base64_decode(strtr($input, '-_', '+/'));
	}



	/**
	 * Base64 encoding that doesn't need to be urlencode()ed.
	 * Exactly the same as base64_encode except it uses
	 *   - instead of +
	 *   _ instead of /
	 *
	 * @param string $input string
	 * @return string base64Url encoded string
	 */
	public static function base64UrlEncode($input)
	{
		$str = strtr(base64_encode($input), '+/', '-_');
		$str = str_replace('=', '', $str);
		return $str;
	}



	/**
	 * @param string $big
	 * @param string $small
	 * @return bool
	 */
	public static function isAllowedDomain($big, $small)
	{
		if ($big === $small) {
			return TRUE;
		}

		if (($len = strlen($small = '.' . $small)) === 0) {
			return TRUE;
		}

		return substr($big, -$len) === $small;
	}

}
