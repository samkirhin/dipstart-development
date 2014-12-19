<?php
/**
 * YiiFilemanImageResizer
 *	a helper class to handle image resize.
 *
 *	example usage:

		$imgres = new YiiFilemanImageResizer();
		list($ow, $oh, $mimetype) = getimagesize($image_local_path);
		$f = fopen($image_local_path,"r");
		$newImage = $imgres->resize(fread($f,filesize($image_local_path)), 
			160, 120, 70, $ow, $oh);
		fclose($f);
		header('Content-type: '.$mimetype);
		imagepng($newImage);
		imagedestroy($newImage);

 * 
 * @author Christian Salazar <christiansalazarh@gmail.com> 
 * @license NEW BSD. 
 */
class YiiFilemanImageResizer {
	/**
	 * resize
	 *	resizes an image making it to fit into a rectangle
	 * 
	 * @param mixed $image 	Binary raw image data.
	 * @param mixed $dw 	destination Width viewport
	 * @param mixed $dh 	destination Height viewport
	 * @param mixed $q		quality for jpg or png: 1 to 100.
	 * @param mixed $ow 	original image width
	 * @param mixed $oh 	original image height
	 * @return new image. you can echo it or use GD functions to handle it. 
	 */
	public function resize($image, $dw, $dh, $q, $ow, $oh){
		$im = imagecreatetruecolor($dw, $dh);
		$im_src = imagecreatefromstring($image);
		$_w = 0;
		$_h = 0;
		$this->_scaleVector($dw, $dh, 0.95, $ow, $oh, $_w, $_h);
		$dx = ($dw - $_w)/2;
		$dy = ($dh - $_h)/2;
		$fillcolor = imagecolorallocate($im,255,255,255);
		//$xcolor = imagecolorallocate($im, 200,200,200);
		imagefilledrectangle($im, 0,0,$dw, $dh, $fillcolor);
		//imagefilledrectangle($im, $dx,$dy, $dx + $_w, $dy + $_h, $xcolor);
		imagecopyresampled(
				$im, $im_src, 
				$dx, $dy, 0, 0, 
				$_w, $_h, 
				$ow, $oh
		);
		return $im;
	}

	/***
	 	creates a new image saved as {$dst}, using coords from src image.
	 	 */
	public function crop($src, $src_x, $src_y, $w, $h, $toFileName){
		$im_src = imagecreatefromstring($src);
		$im_dst = imagecreatetruecolor($w, $h);

		$fillcolor = imagecolorallocate($im_dst,255,255,255);
		imagefilledrectangle($im_dst, 0,0,$w, $h, $fillcolor);

		imagecopyresampled(
			$im_dst, $im_src, 
			0,0, $src_x, $src_y, 
			$w, $h, 
			$w, $h
		);

		imagedestroy($im_src);
		
		@unlink($toFileName);
		imagejpeg($im_dst, $toFileName, 100);

		imagedestroy($im_dst);
	}

	/**
	 * _scaleVector
	 *	
	 * 
	 * @param mixed $dw 		|	destination viewport:
	 * @param mixed $dh 		|		d = {w, h}
	 * @param mixed $delta 		|	delta: is a fixture measurement. max 1.
	 * @param mixed $ow 		|	original viewport to be scaled into "d":
	 * @param mixed $oh 		|		o = {w, h}
	 * @param mixed $out_w 		
	 * @param mixed $out_h 
	 * @access private
	 * @author Christian Salazar H. <christiansalazarh@gmail.com>  
	 * @return void
	 */
	private function _scaleVector($dw, $dh, $delta, $ow, $oh, &$out_w, &$out_h){
		$dR = $dw / $dh;
		if($dR >= 1){
			$out_w = $delta * $dw;
			$out_h = ($out_w * $oh) / $ow;
		}else{
			$out_h = $delta * $dh;
			$out_w = ($out_h * $ow) / $oh;
		}
	}
}
