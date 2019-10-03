<?php
function resize_imagepng($file, $max_resolution){
	if(file_exists($file)){
		$original_image=imagecreatefrompng($file);
		$original_width=imagesx($original_image);
		$original_height=imagesy($original_image);
		$ratio=$max_resolution;
		$new_width=$original_width;
		$new_height=$original_height;
		if ($original_image) {
			$new_image=imagecreatetruecolor($new_width, $new_height);
			imagecopyresampled($new_image, $original_image,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
				imagepng($new_image,$file,$ratio);
		}

	}
}
	function resize_imagegif($file, $max_resolution){
		//https://stackoverflow.com/questions/718491/resize-animated-gif-file-without-destroying-animation
	if(file_exists($file)){
		$original_image=imagecreatefromgif($file);
		$ratio=$max_resolution;
		imagegif($original_image,$file,$ratio);
		
	}
}
function resize_image($file, $max_resolution){
	if(file_exists($file)){
		$original_image=imagecreatefromjpeg($file);
		$original_width=imagesx($original_image);
		$original_height=imagesy($original_image);
		$ratio=$max_resolution;
		$new_width=$original_width;
		$new_height=$original_height;
		if ($original_image) {
			$new_image=imagecreatetruecolor($new_width, $new_height);
			imagecopyresampled($new_image, $original_image,0,0,0,0,$new_width,$new_height,$original_width,$original_height);
			imagejpeg($new_image,$file,$ratio);
		}

	}
}
if($_SERVER['REQUEST_METHOD']=="POST"){
	if(isset($_FILES['image'])&&$_FILES['image']['type']=='image/jpeg'){
		move_uploaded_file($_FILES['image']['tmp_name'],$_FILES['image']['name']);
		$file=$_FILES['image']['name'];
		$a=$_POST['with'];
		resize_image($file,$a);
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
		$a=$_POST['with'];
		resize_imagegif($file,$a);
		echo "<img src='$file'/>";
	}
}
?>
<form method='post' enctype='multipart/form-data'>
	<input type="file" name="image">
	<p>Enter ratio to compress</p><input type="text" name="with"><br>
	<input type="submit" value='post'>
	
</form>