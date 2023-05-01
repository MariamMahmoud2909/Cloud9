<?php 


class Video
{
    public $t;
    public $c;
    public $d;
    public $video_name;
    public $tmp_name;
    public $verror;
    public $thumbnail;
    public $tempname;
    public $therror;

    public function checkvideoex($tmp_name,$video_name,$verror)
    {
        
}

public function checkthex($tmp_name,$thumbnail,$therror)
    {
        if ($therror === 0) 
        {
            $thumbnail_ex = pathinfo($thumbnail, PATHINFO_EXTENSION);
            $thumbnail_ex_lc = strtolower($thumbnail_ex);
            $allowed_exs = array("jpg", "jpeg", "png"); 

            if (in_array($thumbnail_ex_lc, $allowed_exs)) {
                $new_thumbnail_name = uniqid("thumbnail-", true).'.'.$thumbnail_ex_lc;
                $thumbnail_upload_path = 'images/'.$new_thumbnail_name;
                move_uploaded_file($tmp_name, $thumbnail_upload_path);
            }
            else 
            {
                $em = "You can't upload thumbnail of this type";
    		header("Location: Uploadd.php?error=$em");
            }
        }
           else
        {
	header("Location: Uploadd.php");
        }
    }
    
public function InsertDB($new_video_name,$new_thumbnail_name,$t,$c,$d,$conn)
    {
        $sql = "INSERT INTO videos(video_url,Thumbnail,Title,Category,Description)
               VALUES('$new_video_name','$new_thumbnail_name','$t','$c','$d')";
        mysqli_query($conn, $sql);
        header("Location:MyUploads.php");
    }

}

$Upload = new Video;

if (isset($_POST['submit']) && isset($_FILES['Video'])) 
{
	include "db_conn.php";
    
    $Upload->t; $t=$_POST['title'];
    $Upload->c; $c=$_POST['category'];
    $Upload->d; $d=$_POST['description'];

    $Upload->video_name; $video_name = $_FILES['Video']['name'];
    $Upload->tmp_name;   $tmp_name = $_FILES['Video']['tmp_name'];
    $Upload->verror;     $verror = $_FILES['Video']['error'];

    $Upload->thumbnail; $thumbnail = $_FILES["Thumbnail"]["name"];
    $Upload->tempname;  $tempname = $_FILES["Thumbnail"]["tmp_name"];
    $Upload->therror;   $therror = $_FILES['Thumbnail']['error'];
 
    if ($verror === 0) {
    	$video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
        $video_ex_lc = strtolower($video_ex);
        $allowed_exs = array("mp4", 'webm', 'avi', 'flv','mkv');

    	if (in_array($video_ex_lc, $allowed_exs)) {
    		
    		$new_video_name = uniqid("video-", true). '.'.$video_ex_lc;
    		$video_upload_path = 'uploads/'.$new_video_name;
    		move_uploaded_file($tmp_name, $video_upload_path);
            

    		//Insert the video path into database
            $sql = "INSERT INTO videos(video_url,Thumbnail,Title,Category,Description)
                   VALUES('$new_video_name','$thumbnail','$t','$c','$d')";
            mysqli_query($conn, $sql);
            header("Location:MyUploads.php");
    	}
    else 
        {
    		header("Location: Uploadd.php?error=You cannot upload files of this type!");
        }
    }

}else{
	header("Location: Uploadd.php");
}
/*


    if ($verror === 0) {
    	$video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
        $video_ex_lc = strtolower($video_ex);
        $allowed_exs = array("mp4", 'webm', 'avi', 'flv','mkv');

    	if (in_array($video_ex_lc, $allowed_exs)) {
    		
    		$new_video_name = uniqid("video-", true). '.'.$video_ex_lc;
    		$video_upload_path = 'uploads/'.$new_video_name;
    		move_uploaded_file($tmp_name, $video_upload_path);

            $new_th_name = uniqid("video-", true). '.'.$video_ex_lc;
    		$th_upload_path = 'uploads/'.$new_th_name;
    		move_uploaded_file($tmpname, $th_upload_path);

    		//Insert the video path into database
            $sql = "INSERT INTO videos(video_url,Thumbnail,Title,Category,Description)
                   VALUES('$new_video_name','$thumbnail','$t','$c','$d')";
            mysqli_query($conn, $sql);
            header("Location:MyUploads.php");
    	}
 FINAL WORKING ELHAMDULELLLAAHHHH*/


/*
class Video
{
    public $t;
    public $c;
    public $d;
    public $video_name;
    public $tmp_name;
    public $error;
    public $thumbnail;
    public $tempname;

    public function checkvideoex($tmp_name,$video_name,$error)
    {
        if ($error === 0) 
        {
    	$video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
        $video_ex_lc = strtolower($video_ex);
        $allowed_exs = array("mp4", 'webm', 'avi', 'flv','mkv');

    	if (in_array($video_ex_lc, $allowed_exs)) 
        {
    		
    		$new_video_name = uniqid("video-", true). '.'.$video_ex_lc;
    		$video_upload_path = 'uploads/'.$new_video_name;
    		move_uploaded_file($tmp_name, $video_upload_path);	
        }
        else 
        {
            $em = "You can't upload video of this type";
    		header("Location: Uploadd.php?error=$em");
        }
        }

        
       else
{
	header("Location: Uploadd.php");
}
}

public function checktheoex($tmp_name,$thumbnail,$error)
    {
        if ($error === 0) 
        {
            $thumbnail_ex = pathinfo($thumbnail, PATHINFO_EXTENSION);
            $thumbnail_ex_lc = strtolower($thumbnail_ex);
            $allowed_exs = array("jpg", "jpeg", "png"); 

            if (in_array($thumbnail_ex_lc, $allowed_exs)) {
                $new_thumbnail_name = uniqid("thumbnail-", true).'.'.$thumbnail_ex_lc;
                $thumbnail_upload_path = 'uploads/'.$new_thumbnail_name;
                move_uploaded_file($tmp_name, $thumbnail_upload_path);
            }
            else 
            {
                $em = "You can't upload thumbnail of this type";
    		header("Location: Uploadd.php?error=$em");
            }
        }

        
       else
{
	header("Location: Uploadd.php");
}
    }
    
public function InsertDB($new_video_name,$new_thumbnail_name,$t,$c,$d,$conn)
    {
        $sql = "INSERT INTO videos(video_url,Thumbnail,Title,Category,Description)
               VALUES('$new_video_name','$new_thumbnail_name','$t','$c','$d')";
        mysqli_query($conn, $sql);
        header("Location:MyUp.php");
    }

}

$Upload = new Video;
if (isset($_POST['submit']) && isset($_FILES['Video']) && isset($_FILES["Thumbnail"])) 
{
	include "db_conn.php";

    $Upload->t; $t=$_REQUEST['title'];
    $Upload->c; $c=$_REQUEST['category'];
    $Upload->d; $d=$_REQUEST['description'];
    
    $Upload->video_name; $video_name = $_FILES['Video']['name'];
    $Upload->tmp_name;   $tmp_name = $_FILES['Video']['tmp_name'];
    $Upload->error;      $error = $_FILES['Video']['error'];

    $Upload->thumbnail; $thumbnail = $_FILES["Thumbnail"]["name"];
    $Upload->tempname;  $tempname = $_FILES["Thumbnail"]["tmp_name"];
    $Upload->error;     $error = $_FILES['Thumbnail']['error'];

  /*  
   $check1= $Upload->checktheoex($Upload->tempname,$Upload->$thumbnail,$Upload->$error);
   $check2= $Upload->checkvideoex($Upload->$video_name,$Upload->$tmp_name,$Upload->$error);
    if($check1 && $check2)
        {
        $Upload->InsertDB($new_video_name,$new_thumbnail_name,$t,$c,$d,$conn);  
        }
        else echo 'Error ocuured,video can\'t be uploaded.. ';
   */
     /*   if ($error === 0) {
            $video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
            $video_ex_lc = strtolower($video_ex);
            $allowed_exs = array("mp4", 'webm', 'avi', 'flv','mkv');

            if (in_array($video_ex_lc, $allowed_exs)) {
                
                $new_video_name = uniqid("video-", true). '.'.$video_ex_lc;
                $video_upload_path = 'uploads/'.$new_video_name;
                move_uploaded_file($tmp_name, $video_upload_path);
                
                $sql = "INSERT INTO videos(video_url,Thumbnail,Title,Category,Description)
                       VALUES('$new_video_name','$thumbnail','$t','$c','$d')";
                mysqli_query($conn, $sql);
                header("Location:MyUploads.php");
            }
        }
    
        else 
            {
                $em = "You can't upload videos of this type";
                header("Location: Uploadd.php?error=$em");
            }
        }
    else
    {
        header("Location: Uploadd.php");
    }*/
?>