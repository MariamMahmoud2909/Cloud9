<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Upload Form</title>
    <link rel="shortcut icon" href="java/Registration.js">
    <link rel="stylesheet" href="Upload.css">
  </head>
  <body>
  <?php if (isset($_GET['error'])) {  ?>
              <p><?=$_GET['error']?></p>
              <?php } ?>
      <div class="container">
        <div class="title" style="color: #71b6e6  ;font-size:35px;text-align:left">Upload Video</div>
        <div class="content">
        <form action="upload.php" method="post" enctype="multipart/form-data">
          <div class="Video-details">
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
            
            <div class="input-box">
                <span class="details">Video</span>
                <input type="file" name="Video">
            </div>
            <div class="input-box">
                <span class="details">Thumbnail</span>
                <input type="file" name="Thumbnail">
            </div> 
        <div class="button">
          <input type="submit"  name="submit" value="                         Upload                         ">
        </div>
          
   </form>

          
            
            
          </div>
        </div>
      
             
   
  </body>
</html>