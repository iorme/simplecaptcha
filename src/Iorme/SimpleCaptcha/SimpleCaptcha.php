<?php
namespace Iorme\SimpleCaptcha;
use Str, Session, HTML, URL;
/**
 *
 * Simple PHP captcha generator
 * @copyright Copyright (c) 2013 Harry Yunanto
 * @version 0.1
 * @author Harry Yunanto
 * @contact yunanto2209@gmail.com
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 *
 */

class SimpleCaptcha {
	protected $dirs;
	protected $fontsizes;
	protected $fontsize;
	protected $font;
	protected $string;

	public function __construct() {
		$this->dirs = __DIR__ . '/../../../public/assets/fonts/';
		$this->fontsizes = array(13,14,15,16,17);
		$this->fontsize = $this->asset('fontsize');
		$this->font = $this->asset('fonts');
	}

	/*
	Generate captcha image
	*/
	public function create() {
		$this->string = $this->generateString();

		$image = imagecreatetruecolor(100, 50);
		$bg = imagecolorallocate($image, rand(0,255), rand(0,255), 55);
		imagefill($image, 0, 0, $bg);

		$color = imagecolorallocate($image, rand(0,255), rand(0,255), 200);
		$line = imagecolorallocate($image, rand(0,255), rand(0,255), 220);

		imagettftext($image, $this->fontsize, 0, 25, 30, $color, $this->font, $this->string); 

		for($i = 0; $i <= count($this->string); $i++){ 
            $x1 = rand(0,100);
            $x2 = rand(0,100); 
            $y1 = rand(0,100);
            $y2 = rand(0,100); 
            imageline($image,$x1,$y1,$x2,$y2,$line); 
        } 
		
		imagealphablending($image, false);
				
		header('Cache-Control: no-cache, no-store, max-age=0, must-revalidate');
        header('Pragma: no-cache');
		header("Content-type: image/png");  
		imagepng($image); 
		imagedestroy($image);
	}

	/*
	Check the captcha inputed by user
	*/
	public static function check($value)
    {
		$captchasess = Session::get('captchasess');

        return $value != null && $captchasess != null && $captchasess == $value;
    }

	/*
	Generate string
	*/
	public function generateString() {
		$string = Str::random(5);

		Session::put('captchasess', $string);

		return $string;
	}

	public function listFonts() {

    	$fonts = array();
		$ext = 'ttf';

		foreach (glob($this->dirs.'/*.'.$ext) as $filename) {
		    $fonts[] = $filename;
		}

		return $fonts;
    }

    public function asset($type = 'fonts') {
    	if($type == 'fonts') {
    		$fonts = static::listFonts();
    		$asset = $fonts[rand(0, count($fonts) - 1)];
    	} else if($type == 'fontsize') {
    		$asset = $this->fontsizes[rand(0, count($this->fontsizes) - 1)];
    	}
    	
    	return $asset;
    } 

    public function img($attributes = array())
    {
        return HTML::image(URL::to('/simplecaptcha?' . mt_rand(100000, 999999)), 'Captcha', $attributes);
    }
}
?>