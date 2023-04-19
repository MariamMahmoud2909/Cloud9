<?php 
/*  $thumbnail_name = $_FILES['Thumbnail']['name'];
	$tmp_name = $_FILES['Thumbnail']['tmp_name'];
	$error = $_FILES['Thumbnail']['error'];

    if ($error === 0) {
        $thumbnail_ex = pathinfo($thumbnail_name, PATHINFO_EXTENSION);
        $thumbnail_ex_lc = strtolower($thumbnail_ex);
        $allowed_exs = array("jpg", "jpeg", "png"); 

        if (in_array($thumbnail_ex_lc, $allowed_exs)) {
            $new_thumbnail_name = uniqid("thumbnail-", true).'.'.$thumbnail_ex_lc;
            $thumbnail_upload_path = 'uploads/'.$new_thumbnail_name;
            move_uploaded_file($tmp_name, $thumbnail_upload_path);
        }else {
            $em = "You can't upload files of this type";
            header("Location: index.php?error=$em");
        }
    }*/
/*
}else{
	header("Location: UVideo.php");
}*/
/*
	echo "<pre>";
	print_r($_FILES['Thumbnail']);
	echo "</pre>";
	
	

}else {
	header("Location: index.php");
}
*/

if (isset($_POST['submit']) && isset($_FILES['Video'])) 
{
	include "db_conn.php";

    $t= $_REQUEST['title'];
    $c= $_REQUEST['category'];
    $d= $_REQUEST['description'];

    $video_name = $_FILES['Video']['name'];
    $tmp_name = $_FILES['Video']['tmp_name'];
    $error = $_FILES['Video']['error'];

   
    if ($error === 0) {
    	$video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
        $video_ex_lc = strtolower($video_ex);
        $allowed_exs = array("mp4", 'webm', 'avi', 'flv');

    	if (in_array($video_ex_lc, $allowed_exs)) {
    		
    		$new_video_name = uniqid("video-", true). '.'.$video_ex_lc;
    		$video_upload_path = 'uploads/'.$new_video_name;
    		move_uploaded_file($tmp_name, $video_upload_path);

    		//Insert the video path into database
            $sql = "INSERT INTO videos(video_url,Title,Category,Description)
                   VALUES('$new_video_name','$t','$c','$d')";
            mysqli_query($conn, $sql);
            header("Location: MyUploads.php");
    	}
    else 
        {
            $em = "You can't upload files of this type";
    		header("Location: Uploadd.php?error=$em");
        }
    }

}else{
	header("Location: Uploadd.php");
}
/*<?php 
/*  

    if ($error === 0) {
        

        
    }

}else{
	header("Location: UVideo.php");
}*/
/*
	echo "<pre>";
	print_r($_FILES['Thumbnail']);
	echo "</pre>";



if (isset($_POST['submit']) && isset($_FILES['Video'])) 
{
	include "db_conn.php";

    $t= $_REQUEST['title'];
    $c= $_REQUEST['category'];
    $d= $_REQUEST['description'];

    $video_name = $_FILES['Video']['name'];
    $tmp_name = $_FILES['Video']['tmp_name'];
    $error = $_FILES['Video']['error'];

    $thumbnail_name = $_FILES['Thumbnail']['name'];
	$tmp_name = $_FILES['Thumbnail']['tmp_name'];
	$error = $_FILES['Thumbnail']['error'];

   
    if ($error === 0) {
    	$video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
        $video_ex_lc = strtolower($video_ex);
        $allowed_exs = array("mp4", 'webm', 'avi', 'flv');

        $thumbnail_ex = pathinfo($thumbnail_name, PATHINFO_EXTENSION);
        $thumbnail_ex_lc = strtolower($thumbnail_ex);
        $allowed_exs = array("jpg", "jpeg", "png"); 

        if (in_array($video_ex_lc, $allowed_exs)) {
    		
    		$new_video_name = uniqid("video-", true). '.'.$video_ex_lc;
    		$video_upload_path = 'upload/'.$new_video_name;
    		move_uploaded_file($tmp_name, $video_upload_path);

        if (in_array($thumbnail_ex_lc, $allowed_exs)) 
        {
            $new_thumbnail_name = uniqid("thumbnail-", true).'.'.$thumbnail_ex_lc;
            $thumbnail_upload_path = 'upload/'.$new_thumbnail_name;
            move_uploaded_file($tmp_name, $thumbnail_upload_path);

//Insert the video path into database
$sql = "INSERT INTO videos(video_url,Thumbnail,Title,Category,Description)
VALUES('$new_video_name','$new_thumbnail_name','$t','$c','$d')";
mysqli_query($conn, $sql);
header("Location: MyUploads.php");
}
        }


        
        else 
        {
            $em = "You can't upload thumbnails of this type";
            header("Location: Uploadd.php?error=$em");
        }
    }
    		
    else 
        {
            $em = "You can't upload videos of this type";
    		header("Location: Uploadd.php?error=$em");
        }
    }

else{
	header("Location: Uploadd.php");
}*/ 