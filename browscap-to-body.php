<?php

/*
Plugin Name: Browscap to Body
Description: Inject browscap info into the body class
Author: Internet + Jake
Version: 1.0
*/  

require __DIR__ . '/vendor/autoload.php';
use BrowscapPHP\Browscap;

class BrowscapToBody
{
	protected $bc;

	function __construct()
	{
		$this->bc = new Browscap();
		add_filter('body_class', array($this,'injectBodyClasses'));
	}

	/**
	 * Filter to inject browser info into the classes
	 * @param  array $classes Array of body class strings
	 * @return array          The modified
	 */
	public function injectBodyClasses($classes)
	{
		$b = $this->bc->getBrowser();
		foreach($b as &$item) 
		{
			if( is_string($item) ) {
				$item = $this->cleanseForBody($item);
			}
		}

		$injections = ['browser', 'version', 'majorver', 'minorver', 'platform'];

		foreach($injections as $injection) 
		{
			if($b->$injection) {
				$classes[] = "$injection-" . $b->$injection;
			}
		}

		if( $b->ismobiledevice ) {
			$classes[] = "is-mobile";
		}

		if( $b->istablet ) {
			$classes[] = "is-tablet";
		}

		if( $b->ismobiledevice && !$b->istablet ) {
			$classes[] = "is-phone";
		}

		return $classes;
	}

	/**
	 * Clean up a string so it's suitable for body injection. lowercase and replace ' ' with '-'
	 * @param  string $str The string to clean
	 * @return string      The cleansed string
	 */
	protected function cleanseForBody($str)
	{
		return str_replace(' ', '-', strtolower($str));
	}
}

new BrowscapToBody();

/* Sample value for getBrowser()

stdClass Object
(
    [browser_name_regex] => /^mozilla\/5\.0 \(.*mac os x 10.11.*\) applewebkit\/.* \(khtml.* like gecko\) chrome\/51\..*safari\/.*$/
    [browser_name_pattern] => mozilla/5.0 (*mac os x 10?11*) applewebkit/* (khtml* like gecko) chrome/51.*safari/*
    [parent] => Chrome 51.0
    [comment] => Chrome 51.0
    [browser] => Chrome
    [browser_type] => unknown
    [browser_bits] => 0
    [browser_maker] => Google Inc
    [browser_modus] => unknown
    [version] => 51.0
    [majorver] => 51
    [minorver] => 0
    [platform] => MacOSX
    [platform_version] => unknown
    [platform_description] => unknown
    [platform_bits] => 0
    [platform_maker] => unknown
    [alpha] => false
    [beta] => false
    [win16] => false
    [win32] => false
    [win64] => false
    [frames] => false
    [iframes] => false
    [tables] => false
    [cookies] => false
    [backgroundsounds] => false
    [javascript] => false
    [vbscript] => false
    [javaapplets] => false
    [activexcontrols] => false
    [ismobiledevice] => 
    [istablet] => 
    [issyndicationreader] => false
    [crawler] => 
    [isfake] => false
    [isanonymized] => false
    [ismodified] => false
    [cssversion] => 0
    [aolversion] => 0
    [device_name] => unknown
    [device_maker] => unknown
    [device_type] => Desktop
    [device_pointing_method] => mouse
    [device_code_name] => unknown
    [device_brand_name] => unknown
    [renderingengine_name] => unknown
    [renderingengine_version] => unknown
    [renderingengine_description] => unknown
    [renderingengine_maker] => unknown
)

*/