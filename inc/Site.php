<?php

class Site {

	public static $params = [TEMPLATE_LANG, 'index'];
	public static $lang;
	public static $page;
	public static $bodyClass;
	public static $data;
	public static $myURL;
	private static $i18;
	private static $browser;
	private static $javascript = array();
	private static $css = '';
	private static $isHeader = false;

	public static function init() {

		if(isset($_GET['params'])) {
			$tmp = explode('/', trim($_GET['params'], '/'));
			if (count($tmp) > 0) {
				if (!is_file(PATH_LANG . DS . $tmp[0] . '.php')) {
					array_unshift($tmp, TEMPLATE_LANG);
				}
				if ((count($tmp) == 1) || (count($tmp) > 1 && !is_file(PATH_PAGE . DS . $tmp[1] . '.php'))) {
					array_splice($tmp, 1, 0, self::$params[1]);
				}
				self::$params = $tmp;
			}
		}

		self::$lang = array_shift(self::$params);
		self::$page = array_shift(self::$params);
		self::$bodyClass = 'page-'.self::$page;
		self::$myURL = BASE_URL . '/' . ((count(self::$params) > 0) ? implode('/', self::$params) . '/' : '');

		self::browserDetect();
		if(self::isMobile()) self::$bodyClass .= ' page-mobile';
		if(self::isTablet()) self::$bodyClass .= ' page-tablet';
		if(self::isDesktop()) self::$bodyClass .= ' page-desktop';
		
		self::setLang(self::$lang);

		self::getFile(self::$page, PATH_PAGE);
	}
	
	private static function getFile($file, $dir = NULL, $params = NULL, $once = false) {
		if (is_null($dir))
			$dir = array(PATH_SEGMENT, PATH_PAGE, PATH_COMMON);
		else 
			$dir = array(rtrim($dir, DS));

		foreach($dir as $path) {
			if (file_exists($path . DS . $file . '.php')) {
				if ($once === false)	require $path . DS . $file . '.php';
				else 					require_once $path . DS . $file . '.php';
				return true;
			}
		}
		return self::getFile('404', PATH_PAGE, $file);
	}

	public static function getHeader($name = 'header') {
		self::$isHeader = true;
		self::getFile($name, PATH_COMMON, NULL, true);
	}
	
	public static function getFooter($name = 'footer') {
		self::getFile($name, PATH_COMMON, NULL, true);
	}

	public static function getSegment($name, $params = NULL, $output = false) {
		if ($output === true) ob_start();
		self::getFile($name, PATH_SEGMENT, $params);
		if ($output === true) {
			$output = ob_get_contents();
			ob_end_clean();
			return $output;
		}
	}
	
	public static function url($string = '') {
		return BASE_URL . DS . ltrim($string, DS);
	}
	
	public static function __($s) {
		if (isset(self::$i18[$s]))
			return self::$i18[$s];
		else 
			return '';
	}
	public static function setLang($lang) {
		self::getFile(self::$lang, PATH_LANG);
	}

	public static function setJS($js, $block = 'ready') {
		if (!isset(self::$javascript[$block])) self::$javascript[$block] = '';
		self::$javascript[$block] .= $js;
	}
	public static function getJS($block) {
		self::getFile('JSMin', PATH_PHP, NULL, true);

		if (isset(self::$javascript[$block]))
			return JSMin::minify(self::$javascript[$block]);
		else
			return NULL;
	}

	public static function setCSS($css) {
		self::$css .= $css;
	}
	public static function getCSS() {
		$css = self::$css;
		$css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);                 	    // Remove comments
		$css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css);	// Remove whitespace
		$css = str_replace(array(' {', '{ '), '{', $css);       	                            // Remove space before/after bracket
		$css = str_replace(array(' }', '} '), '}', $css);           	                        // Remove space before/after bracket
		$css = str_replace(array(' ;', '; '), ';', $css);               	                    // Remove space before/after dot with comma
		$css = str_replace(array(' :', ': '), ':', $css);                   	                // Remove space before/after colons
		$css = str_replace(array(' ,', ', '), ',', $css);                       	            // Remove space before/after commas
		$css = str_replace(';}', '}', $css);													// Remove last dot with comma
		return $css;
	}

	public static function isPage($page) {
		return $page == self::$page;
	}

	public static function addBodyClass($bodyClass) {
		self::$bodyClass .= ' ' . $bodyClass;
	}

	public static function isMobile() {
		return (self::$browser->isMobile() && !self::$browser->isTablet());
	}

	public static function isTablet() {
		return (self::$browser->isTablet());
	}

	public static function isDesktop() {
		return (!self::$browser->isMobile() && !self::$browser->isTablet());
	}
	
	private static function browserDetect() {
		self::getFile('Mobile_Detect', PATH_PHP, NULL, true);
		self::$browser = new Mobile_Detect;
	}
}


