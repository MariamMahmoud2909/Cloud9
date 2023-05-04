<?php 

class Video
{
    public $t;
    public $c;
    public $d;
    public $video_name;
    public $tmpname;
    public $verror;
    public $thumbnail;
    public $tempname;
    public $therror;

}

$Upload = new Video;

if (isset($_POST['submit']) && isset($_FILES['Video'])) 
{
	include "db_conn.php";
    
    $Upload->t; $t=$_POST['title'];
    $Upload->c; $c=$_POST['category'];
    $Upload->d; $d=$_POST['description'];

    $Upload->video_name; $video_name = $_FILES['Video']['name'];
    $Upload->tmpname;   $tmp_name = $_FILES['Video']['tmp_name'];
    $Upload->verror;     $verror = $_FILES['Video']['error'];

    $Upload->thumbnail; $thumbnail = $_FILES['Thumbnail']['name'];
    $Upload->tempname;  $tempname = $_FILES['Thumbnail']['tmp_name'];
    $Upload->therror;   $therror = $_FILES['Thumbnail']['error'];
 
    if ($verror === 0 && $therror === 0) {
    	$video_ex = pathinfo($video_name, PATHINFO_EXTENSION);
        $video_ex_lc = strtolower($video_ex);
        $allowed_exs = array("mp4", 'webm', 'avi', 'flv','mkv');

        $th_ex = pathinfo($thumbnail, PATHINFO_EXTENSION);
        $th_ex_lc = strtolower($th_ex);
        $allowed_ex = array("jpg", 'png');

    	if (in_array($video_ex_lc, $allowed_exs)) {
    		
    		$new_video_name = uniqid("video-", true). '.'.$video_ex_lc;
    		$video_upload_path = 'uploads/'.$new_video_name;
    		move_uploaded_file($tmp_name, $video_upload_path);

          if (in_array($th_ex_lc, $allowed_ex)) {
    		
                $new_th_name = uniqid("thumbnail-", true). '.'.$th_ex_lc;
                $th_upload_path = 'thumbnails/'.$new_th_name;
                move_uploaded_file($tempname, $th_upload_path);
                

    		//Insert the video path into database
            $sql = "INSERT INTO videos(video_url,Thumbnail,Title,Category,Description)
                   VALUES('$new_video_name','$new_th_name','$t','$c','$d')";
            mysqli_query($conn, $sql);
            header("Location:MyUp.php");
    	}
    
    else 
        {
    		header("Location: Uploadd.php?error=You cannot upload thumbnails of this type!");
        }
    }
    else 
    {
        header("Location: Uploadd.php?error=You cannot upload videos of this type!");
    }

}
else
{
	header("Location: Uploadd.php");
}
}