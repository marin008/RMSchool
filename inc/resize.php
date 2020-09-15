<?php
class resize {
	var $old_name;
	var $old_img;
	var $old_type;
	var $old_mime;
	var $old_w;
	var $old_h;
	var $new_name;
	var $new_img;
	var $new_w;
	var $new_h;
	var $new_x;
	var $new_y;
	var $new_quality;
	var $new_interlace;
	var $new_set;
	var $new_bg;
	var $cut_w;
	var $cut_h;
	var $cut_area;
	var $cut_x;
	var $cut_y;
	var $logo_name;
	var $logo_img;
	var $logo_type;
	var $logo_mime;
	var $logo_ima;
	var $logo_w;
	var $logo_h;
	var $logo_pos;
	var $logo_size;

	function __construct($imgfile) {
		$imgInfo = getimagesize($imgfile);
		$this->old_name = $imgfile;
		$this->old_img = NULL;
		$this->old_w = $imgInfo[0];
		$this->old_h = $imgInfo[1];
		$this->old_type = $imgInfo[2];
		$this->old_mime = $imgInfo['mime'];
		$this->new_name = NULL;
		$this->new_img = NULL;
		$this->new_w = $imgInfo[0];
		$this->new_h = $imgInfo[1];
		$this->new_x = 0;
		$this->new_y = 0;
//		$this->new_quality = 75;
		$this->setQuality(75);
		$this->new_interlace = 1;
		$this->new_set = "w";
		$this->new_bg = NULL;
		$this->cut_w = $imgInfo[0];
		$this->cut_h = $imgInfo[1];
		$this->cut_area = "cc";
		$this->cut_x = 0;
		$this->cut_y = 0;

		if ($this->old_w == 0 and $this->old_h == 0)
			trigger_error('Unsupported file!', E_USER_WARNING);
	}
	function __destruct() {
        if(is_resource($this->old_img)) @ImageDestroy($this->old_img);
        if(is_resource($this->new_img)) @ImageDestroy($this->new_img);
        if(is_resource($this->logo_img)) @ImageDestroy($this->logo_img);
	}

	function setW($size) {
		if ($this->old_w > $size) {
			$this->new_w = $size;
		}
		$this->new_h = round(($this->new_w / $this->old_w) * $this->old_h);
		$this->new_set = "w";
	}
	function setH($size) {
		if ($this->old_h > $size) {
			$this->new_h = $size;
		}
		$this->new_w = round(($this->new_h / $this->old_h) * $this->old_w);
		$this->new_set = "h";
	}
	function setAuto($size) {
		if ($this->old_w > $this->old_h) $this->setW($size);
		else $this->setH($size);
	}
	function setQuality($q = 75) {
		if ($this->old_type == 3) $q = round(abs(($q - 100) / 11.111111));
		$this->new_quality = $q;
	}
	function setInterlace($i = 1) {
		$this->new_interlace = $i;
	}

	function setCut($w, $h, $bg = NULL) {

		$old_omjer = $this->old_w / $this->old_h;
		$cut_omjer = $w / $h;

		$this->new_w = $w;
		$this->new_h = $h;
		if ($bg != NULL) $this->new_bg = $bg;

		if ($old_omjer > $cut_omjer) {
			$this->cut_w = round($this->old_h * $cut_omjer);
			$this->cut_h = $this->old_h;
		} else {
			$this->cut_w = $this->old_w;
			$this->cut_h = round($this->old_w / $cut_omjer);
		}

		$this->cut_x = round(($this->old_w - $this->cut_w) / 2);
		$this->cut_y = round(($this->old_h - $this->cut_h) / 2);
	}

	function setCutTop($w, $h) {
		$this->setCut($w, $h);
		$old_omjer = $this->old_w / $this->old_h;
		$this->cut_y = ($old_omjer <= 1 ? round($this->old_h * 0.1) : 0);
	}


	function setCrop($w, $h, $area = "cc") {
		$this->new_w = $w;
		$this->new_h = $h;

		$this->cut_w = $w;
		$this->cut_h = $h;

		$this->cut_area = $area;

		if ($area == "cc") {
			$this->cut_x = round(($this->old_w - $this->cut_w) / 2);
			$this->cut_y = round(($this->old_h - $this->cut_h) / 2);
		} elseif ($area == "tl") {
			$this->cut_x = 0;
			$this->cut_y = 0;
		} elseif ($area == "tt") {
			$this->cut_x = round(($this->old_w - $this->cut_w) / 2);
			$this->cut_y = 0;
		} elseif ($area == "tr") {
			$this->cut_x = $this->old_w - $this->cut_w;
			$this->cut_y = 0;
		} elseif ($area == "rr") {
			$this->cut_x = $this->old_w - $this->cut_w;
			$this->cut_y = round(($this->old_h - $this->cut_h) / 2);
		} elseif ($area == "br") {
			$this->cut_x = $this->old_w - $this->cut_w;
			$this->cut_y = $this->old_h - $this->cut_h;
		} elseif ($area == "bb") {
			$this->cut_x = round(($this->old_w - $this->cut_w) / 2);
			$this->cut_y = $this->old_h - $this->cut_h;
		} elseif ($area == "bl") {
			$this->cut_x = 0;
			$this->cut_y = $this->old_h - $this->cut_h;
		} elseif ($area == "ll") {
			$this->cut_x = 0;
			$this->cut_y = round(($this->old_h - $this->cut_h) / 2);
		}
	}

	function setLogo($name, $position = 'br', $size = 5) {
		if (is_file($name)) {
			$imgInfo = getimagesize($name);
			$this->logo_name = $name;
			$this->logo_img = NULL;
			$this->logo_w = $imgInfo[0];
			$this->logo_h = $imgInfo[1];
			$this->logo_type = $imgInfo[2];
			$this->logo_mime = $imgInfo['mime'];
			$this->logo_pos = $position;
			$this->logo_size = ($size > 0 ? (1/$size): $size);
			$this->logo_ima = true;
		}
	}

	function _transparent($w, $h, $transparent = true) {
		if (function_exists("ImageCreateTrueColor")) $f = "ImageCreateTrueColor";
		else $f = "ImageCreate";

		$res = $f($w, $h);
		if ($transparent == true) {
			imagealphablending($res, false);
			imagesavealpha($res, true);
			$transparent = imagecolorallocatealpha($res, 255, 255, 255, 127);
			imagefilledrectangle($res, 0, 0, $w, $h, $transparent);
		}
		return $res;
	}

	function save($name = NULL) {
		$this->new_name = $name;
		$this->show();
	}
	function show() {
		if ($this->new_name == NULL)
			Header("Content-Type: ".$this->old_mime);

		$this->new_img = $this->_transparent($this->new_w, $this->new_h, ($this->old_type == 1 or $this->old_type == 3));
		switch ($this->old_type) {
			case 1: $this->old_img = ImageCreateFromGIF($this->old_name); break;
			case 2: $this->old_img = ImageCreateFromJPEG($this->old_name); break;
			case 3: $this->old_img = ImageCreateFromPNG($this->old_name); break;
			default:  trigger_error('Unsupported filetype!', E_USER_WARNING); break;
		}
		imagecopyresampled($this->new_img, $this->old_img, $this->new_x, $this->new_y, $this->cut_x, $this->cut_y, $this->new_w, $this->new_h, $this->cut_w, $this->cut_h);

		if ($this->logo_ima === true) {
			$logo_margin = 20;
			$logo_omjer = $this->logo_h / $this->logo_w;
			$logo_w = $this->new_w * $this->logo_size;
			$logo_h = $logo_w * $logo_omjer;
			$logo_x = $this->new_w - $logo_w - $logo_margin;
			$logo_y = $this->new_h - $logo_h - $logo_margin;

			switch ($this->logo_type) {
				case 1: $this->logo_img = ImageCreateFromGIF($this->logo_name); break;
				case 2: $this->logo_img = ImageCreateFromJPEG($this->logo_name); break;
				case 3: $this->logo_img = ImageCreateFromPNG($this->logo_name); break;
				default: trigger_error('Unsupported filetype!', E_USER_WARNING); break;
			}

			imagecopyresampled($this->new_img, $this->logo_img, $logo_x, $logo_y, 0, 0, $logo_w, $logo_h, $this->logo_w, $this->logo_h);
		}

		switch ($this->old_type) {
			case 1: imageGIF($this->new_img, $this->new_name); break;
			case 2: imageinterlace($this->new_img, $this->new_interlace); imageJPEG($this->new_img, $this->new_name, $this->new_quality);  break;
			case 3: imagePNG($this->new_img, $this->new_name, $this->new_quality); break;
			default: trigger_error('Failed resize image!', E_USER_WARNING);  break;
		}
	}
}
?>
