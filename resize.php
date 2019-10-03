<!-- https://www.youtube.com/watch?v=u6adna5zSwA
https://www.youtube.com/watch?v=E5W6e3nle6E
-->
<?php
function resize_imagepng($file, $max_resolution){
	if(file_exists($file)){
		$original_image=imagecreatefrompng($file);
		$original_width=imagesx($original_image);
		$original_height=imagesy($original_image);
		$ratio=$max_resolution/$original_width;
		$new_width=$max_resolution;
		$new_height=$original_height*$ratio;
		if ($new_height>$max_resolution) {
			$ratio=$max_resolution/$original_height;
			$new_height=$max_resolution;
			$new_width=$original_width*$ratio;
		}
		if ($original_image) {
			$new_image=imagecreatetruecolor($new_width, $new_height);
			imagecopyresampled($new_image, $original_image,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
			imagefilter($new_image, IMG_FILTER_SMOOTH, 6);
			imagepng($new_image,$file,7);
		}

	}
}
	function resize_imagegif($file, $max_resolution){
		//https://stackoverflow.com/questions/718491/resize-animated-gif-file-without-destroying-animation
	if(file_exists($file)){
		$original_image=imagecreatefromgif($file);
		$original_width=imagesx($original_image);
		$original_height=imagesy($original_image);
		$ratio=$max_resolution/$original_width;
		$new_width=$max_resolution;
		$new_height=$original_height*$ratio;
		if ($new_height>$max_resolution) {
			$ratio=$max_resolution/$original_height;
			$new_height=$max_resolution;
			$new_width=$original_width*$ratio;
		}
		if ($original_image) {
			$new_image=imagecreatetruecolor($new_width, $new_height);
			imagecopyresampled($new_image, $original_image,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
			imagefilter($new_image, IMG_FILTER_SMOOTH, 6);
			imagegif($new_image,$file,70);
		}

	}
}
function resize_image($file, $max_resolution){
	if(file_exists($file)){
		$original_image=imagecreatefromjpeg($file);
		$original_width=imagesx($original_image);
		$original_height=imagesy($original_image);
		$ratio=$max_resolution/$original_width;
		$new_width=$max_resolution;
		$new_height=$original_height*$ratio;
		if ($new_height>$max_resolution) {
			$ratio=$max_resolution/$original_height;
			$new_height=$max_resolution;
			$new_width=$original_width*$ratio;
		}
		if ($original_image) {
			$new_image=imagecreatetruecolor($new_width, $new_height);
			imagecopyresampled($new_image, $original_image,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
			imagefilter($new_image, IMG_FILTER_SMOOTH, 6);
			imagejpeg($new_image,$file,90);
		}

	}
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_FILES['image'])&&$_FILES['image']['type']=='image/jpeg'){
		move_uploaded_file($_FILES['image']['tmp_name'],$_FILES['image']['name']);
		$file=$_FILES['image']['name'];
		resize_image($file,"300");
		echo "<img src='$file'/>";
	}
	elseif(isset($_FILES['image'])&&$_FILES['image']['type']=='image/png'){
		move_uploaded_file($_FILES['image']['tmp_name'],$_FILES['image']['name']);
		$file=$_FILES['image']['name'];
		$a=$_POST['with'];
		resize_imagepng($file,$a);
		echo "<img src='$file'/>";
	}
	elseif(isset($_FILES['image'])&&$_FILES['image']['type']=='image/gif'){
		move_uploaded_file($_FILES['image']['tmp_name'],$_FILES['image']['name']);
		$file=$_FILES['image']['name'];
		resize_imagegif($file,"90");
		echo "<img src='$file'/>";
	}
}
?>
<form method='post' enctype='multipart/form-data'>
	<input type="file" name="image">
	<p>Enter Width</p><input type="text" name="with"><br>
	<p>Enter height</p><input type="text" name="het"><br>
	<input type="submit" value='post'>
	
</form>