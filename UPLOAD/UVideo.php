<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>video upload</title>
	<style>
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
			min-height: 100vh;
		}
		input {
			font-size: 2rem;
		}
		a {
			text-decoration: none;
			color: #006CFF;
			font-size: 1.5rem;
		}
	</style>
</head>
<body>
	<!--<a href="view.php">Videos</a>-->
	<?php if (isset($_GET['error'])) {  ?>
		<p><?=$_GET['error']?></p>
	<?php } ?>
	 <form action="upload.php"
	       method="post"
	       enctype="multipart/form-data">
<div class="input-box">
                <span class="details">Title</span>
                <input type="text" name="title" placeholder="Enter video title" required>
              </div>
              <div class="input-box">
                <span class="details">Category</span>
                <input type="text" name="category" placeholder="Enter video category" spellcheck="false" required>
             </div>
             <div class="input-box">
                <span class="details">Description</span>
                <input type="text" name="description" placeholder="Enter video description" spellcheck="false" required>
            </div>
	 	<input type="file"
	 	       name="Video">

	 	<input type="submit"
	 	       name="submit" 
	 	       value="Upload">
	 </form>
</body>
</html>