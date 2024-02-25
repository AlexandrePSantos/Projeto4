<?php
// require 'resize_image.php';

// Include PHP Image Magician library
require_once($_SERVER["DOCUMENT_ROOT"] . '/server/php_libs/image-magician/php_image_magician.php');

$images = array("image/jpeg", "image/png");
if (isset($_FILES["foto_artigo"])) {
	$error = $_FILES["foto_artigo"]["error"];
	if (!is_array($_FILES["foto_artigo"]['name']))//single file
	{
		$fileNameTmp = $_FILES["foto_artigo"]["name"];
		$fileName = time()."".generateRandomString(5);
		$ext = pathinfo($fileNameTmp, PATHINFO_EXTENSION);
		$ext = "." . $ext;

		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$info = finfo_file($finfo, $_FILES["foto_artigo"]["tmp_name"]);
		if (!in_array($info, $images)) {
			echo $info;
			$response["errors"] = true;
			$response["type"] = 1;
			die(json_encode($response));
		}

		$withoutExt = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fileName);
		// $withoutExt = urlencode($withoutExt);
		$fileName = clean($withoutExt);
		$timestamp = time();

		if (exif_imagetype($_FILES["foto_artigo"]["tmp_name"]) == IMAGETYPE_JPEG) {
			$exif = exif_read_data($_FILES["foto_artigo"]["tmp_name"]);
			if (!empty($exif['Orientation'])) {
				$rotate = $exif['Orientation'];
			} else {
				$rotate = 0;
			}

		} else {
			$rotate = 0;
		}

		if (move_uploaded_file($_FILES["foto_artigo"]["tmp_name"], "../../uploads/faturacao/artigos/" . $fileName . $ext)) {
			$var_auxilar_caminho = "/uploads/faturacao/" . $fileName . $ext;
			$foto_name = $fileName . $ext;

			$aux = $_SERVER['DOCUMENT_ROOT'] . "/uploads/faturacao/artigos/" . $fileName . $ext;

			// Open Image File
			$imgObj = new imageLib($aux);

			// Resize to Width Selected (Landscape format perpective)
			$width = $imgObj -> getWidth();
			$height = $imgObj -> getHeight();
			if ( $width > 800 || $height > 600 ) {
				#Options for resize -> exact | portrait | landscape | auto | crop
				if($height > 600) $imgObj -> resizeImage(800, 600, 'portrait'); /* resize by Height */
				if($width > 800) $imgObj -> resizeImage(800, 600, 'landscape'); /* resize by Width */
				
				// Save resized image as a PNG
				$imgObj -> saveImage($aux);
			}

			// if (!empty($rotate)) {
			// 	switch($rotate) {
			// 		case 8 :
			// 			$degree = 90;
			// 			break;
			// 		case 3 :
			// 			$degree = 180;
			// 			break;
			// 		case 6 :
			// 			$degree = -90;
			// 			break;
			// 		default :
			// 			$degree = 0;
			// 			break;
			// 	}
			// } else {
			// 	$degree = 0;
			// }

			// $image = new SimpleImage();
			// $image -> load($aux);
			// $width = $image -> getWidth();
			// if ($width > 800 ) {
			// 	$image -> resizeToWidth(800);
			// 	$image -> save($aux, $degree);
			// }
			
			// $image -> save($aux, 0);

			// $newfile = $_SERVER['DOCUMENT_ROOT'] . "/uploads/faturacao/grey_" . $fileName . $ext;
			// if (copy($aux, $newfile)) {
			// 	if(getimagesize($aux)[2] == IMAGETYPE_PNG) {
			// 		$im = imagecreatefrompng($aux);
			// 		imagealphablending($im, false);
			// 		imagesavealpha($im, true);
			// 		if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
			// 		{
			// 			imagefilter($im, IMG_FILTER_CONTRAST, -1000);

			// 			imagepng($im, $newfile);
			// 		}
			// 		imagedestroy($im);
			// 	} else {
			// 		$im = imagecreatefromjpeg($aux);
			// 		// imagealphablending($im, false);
			// 		// imagesavealpha($im, true);
			// 		if($im && imagefilter($im, IMG_FILTER_GRAYSCALE))
			// 		{
			// 			imagefilter($im, IMG_FILTER_CONTRAST, -1000);

			// 			imagejpeg($im, $newfile);
			// 		}
			// 		imagedestroy($im);
			// 	}
			// }

			$response = array('errors' => false, 'path' => $foto_name, 'original' => $fileName . $ext, 'name' => $fileName . $ext);
			die(json_encode($response));
		} else {
			$response["errors"] = true;
			$response["type"] = 2;
			die(json_encode($response));
		}

	}

} else {
	$response["errors"] = true;
	$response["type"] = 3;
	die(json_encode($response));
}
function is_image($path) {
	$a = getimagesize($path);
	$image_type = $a[2];

	if (in_array($image_type, array(IMAGETYPE_JPEG, IMAGETYPE_PNG))) {
		return true;
	}
	return false;
}

function clean($string) {
	$string = str_replace(' ', '-', $string);
	return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}

function generateRandomString($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}

?>