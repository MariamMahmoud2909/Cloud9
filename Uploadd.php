<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8">
    <title>Upload Form</title>
  <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins',sans-serif;
}
body{
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 10px;
  background: linear-gradient(135deg, #71b6e6, #ebe7ec);
}
.container{
  max-width: 800px;
  width: 100%;
  background-color: #fff;
  padding: 25px 30px;
  border-radius: 5px;
  box-shadow: 0 50px 100px rgba(0,0,0,0.15);
}
.container .title{
  font-size: 25px;
  font-weight: 500;
  position: relative;
}
.container .title::before{
  content: "";
  position: absolute;
  left: 0;
  bottom: 0;
  height: 3px;
  width: 135px;
  border-radius: 5px;
  background: linear-gradient(135deg, #71b6e6, #ebe7ec);
}
.content form .Video-details{
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin: 20px 0 12px 0;
}
form .Video-details .input-box{
  margin-bottom: 15px;
  width: calc(100% / 2 - 20px);
}
form .input-box span.details{
  display: block;
  font-weight: 500;
  margin-bottom: 5px;
}
.Video-details .input-box input{
  height: 45px;
  width: 100%;
  outline: none;
  font-size: 16px;
  border-radius: 5px;
  padding-left: 15px;
  border: 1px solid #ccc;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}
.Video-details .input-box input:focus,
.Video-details .input-box input:valid{
  border-color: #9b59b6;
}
 form .gender-details .gender-title{
  font-size: 20px;
  font-weight: 500;
 }
 form .category{
   display: flex;
   width: 80%;
   margin: 14px 0 ;
   justify-content: space-between;
 }
 form .category label{
   display: flex;
   align-items: center;
   cursor: pointer;
 }
 form .category label .dot{
  height: 18px;
  width: 18px;
  border-radius: 50%;
  margin-right: 10px;
  background: #d9d9d9;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}
 
 
 form input[type="radio"]
 {
   display: none;
 }
 form .button
 {
   height: 45px;
   margin: 35px 0;
   width: 350px;
 }
 form .button input{
   height: 100%;
   width: 350 px;
   border-radius: 5px;
   border: none;
   color: #fff;
   font-size: 18px;
   font-weight: 500;
   letter-spacing: 1px;
   cursor: pointer;
   transition: all 0.3s ease;
   background: linear-gradient(135deg, #c0d5e0, #71b6e6);
 }
 form .button input:hover{
  
  background: linear-gradient(-135deg, #ebe7ec , #71b6e6);
  }
 @media(max-width: 584px){
 .container{
  max-width: 100%;
}
form .Video-details .input-box{
    margin-bottom: 15px;
    width: 100%;
  }
  form .category{
    width: 100%;
  }
  .content form .Video-details{
    max-height: 300px;
    overflow-y: scroll;
  }
  .Video-details::-webkit-scrollbar{
    width: 5px;
  }
  }
  @media(max-width: 459px){
  .container .content .category{
    flex-direction: column;
  }
}
.error {

background: #D2042D;

color: White;

padding: 10px;

width: 100%;

border-radius: 1px;
justify-content: center;
margin: 20px auto;

}
    </style>
  </head>
  <body>
  
      <div class="container">
        <div class="title" style="color: #71b6e6  ;font-size:35px;text-align:left">Upload Video</div>
        <div class="content">
        <form action="upload.php" method="post" enctype="multipart/form-data">
        <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
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
        </div>
        </div>
   </form>
        
      </div>
  </body>
</html>