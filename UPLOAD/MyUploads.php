<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>View</title>
	<style>
		body {
		    display: flex;
			justify-content: center;
			align-items: center;
			flex-wrap: wrap;
			min-height: 100vh;
		}
		video {
			width: 640px;
			height: 360px;
		}
		a {
			text-decoration: none;
			color: #006CFF;
			font-size: 1.5rem;
		}
	</style>
</head>
<body>
	<a href="UVideo.php">Upload New Video</a>

	<div class="alb">
    <div class="list-container"> 
                <div class="vid-list">
                    <a href=""><thumbnail src="images/thumbnail1.png" class="thumbnail"></a>
                    <div class="flex-div">
                        <thumbnail src="images/Jack.png">
                        <div class="vid-info">
                            <a href=""><?php $query="SELECT Title from videos where video id = id el video "?></a>
                        </div>
                    </div>
                </div>
        </div>
		<?php 
		 include "db_conn.php";
         
		 $sql = "SELECT * FROM videos ORDER BY id DESC";
		 $res = mysqli_query($conn, $sql);

		 if (mysqli_num_rows($res) > 0) {
		 	while ($video = mysqli_fetch_assoc($res)) { 
		 ?>
		 		
	        <video src="uploads/<?=$video['video_url']?>" 
	        	   controls>
	        	
	        </video>

	    <?php 
	     }
		 }else {
		 	echo "<h1>Empty</h1>";
		 }
		 ?>
	</div>
</body>
</html>