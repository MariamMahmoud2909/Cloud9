<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Playlist</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');

*{
   font-family: 'Poppins', sans-serif;
   margin:0; padding:0;
   box-sizing: border-box;
   outline: none; border:none;
   text-decoration: none;
   text-transform: capitalize;
}

body{
    background: linear-gradient(135deg, #71b6e6, #ebe7ec);
  /* padding:20px;*/
}

.container{
   float: right;
   padding-left: 180px;
   padding-right: 130px;
   margin-left: 260px ;
   max-width: 1200px;
   margin:100px auto;
   display: flex;
   flex-wrap: wrap;
   align-items: flex-start;
   gap:20px;
}

.container .main-video-container{
   flex:1 1 700px;
   border-radius: 5px;
   box-shadow: 0 5px 15px rgba(0,0,0,.1);
   background-color: #fff;
   padding:15px;
}

.container .main-video-container .main-video{
   margin-bottom: 7px;
   border-radius: 5px;
   width: 100%;
}

.container .main-video-container .main-vid-title{
   font-size: 20px;
   color:#444;
}

.container .video-list-container{
   flex:1 1 350px;
   height: 485px;
   overflow-y: scroll;
   border-radius: 5px;
   box-shadow: 0 5px 15px rgba(0,0,0,.1);
   background-color: #fff;
   padding:15px;
}

.container .video-list-container::-webkit-scrollbar{
   width: 10px;
}

.container .video-list-container::-webkit-scrollbar-track{
   background-color: #fff;
   border-radius: 5px;
}

.container .video-list-container::-webkit-scrollbar-thumb{
   background-color: #444;
   border-radius: 5px;
}

.container .video-list-container .list{
   display: flex;
   align-items: center;
   gap:15px;
   padding:10px;
   background-color: #eee;
   cursor: pointer;
   border-radius: 5px;
   margin-bottom: 10px;
}

.container .video-list-container .list:last-child{
   margin-bottom: 0;
}

.container .video-list-container .list.active{
   background-color: #444;
}

.container .video-list-container .list.active .list-title{
   color:#fff;
}

.container .video-list-container .list .list-video{
   width: 100px;
   border-radius: 5px;
}

.container .video-list-container .list .list-title{
   font-size: 17px;
   color:#444;
}


@media (max-width:1200px){

   .container{
      margin:0;
   }

}

@media (max-width:450px){

   .container .main-video-container .main-vid-title{
      font-size: 15px;
      text-align: center;
   }

   .container .video-list-container .list{
      flex-flow: column;
      gap:10px;
   }

   .container .video-list-container .list .list-video{
      width: 100%;
   }

   .container .video-list-container .list .list-title{
      font-size: 15px;
      text-align: center;
   }

}

button {
 border: none;
 color: #fff;
 background-image: linear-gradient(30deg, #0400ff, #4ce3f7);
 border-radius: 20px;
 background-size: 100% auto;
 font-family: inherit;
 font-size: 17px;
 padding: 0.6em 1.5em;
 margin-left: 500px;
}

button:hover {
 background-position: right center;
 background-size: 200% auto;
 -webkit-animation: pulse 2s infinite;
 animation: pulse512 1.5s infinite;
}

@keyframes pulse512 {
 0% {
  box-shadow: 0 0 0 0 #05bada66;
 }

 70% {
  box-shadow: 0 0 0 10px rgb(218 103 68 / 0%);
 }

 100% {
  box-shadow: 0 0 0 0 rgb(218 103 68 / 0%);
 }
}
</style>
</head>
<body>
<?php include "HeaderSide.php"?>
<div class="container">
    <div style="margin-left: 150px;">
<a href="Uploadd.php"><button  >Upload New Video</button></a>
    </div>
    <div style="margin-left: 120px;">
<button > Delete All Uploaded Videos</button>   
    </div>
<div class="heading" style="color: #71b6e6 ;font-weight:600 ;font-size:35px;text-align:center">My Uploaded Videos</div>
  
<div class="main-video-container">
      <video src="images/vid-1.mp4" loop controls class="main-video"></video>
      <h3 class="main-vid-title">house flood animation</h3>   
   </div>

   <div class="video-list-container">

      <div class="list active">
         <video src="images/vid-1.mp4" class="list-video"></video>
         <h3 class="list-title">house flood animation</h3>
      <button style="float:right;" >Delete</button>
      </div>

      <div class="list">
         <video src="images/vid-2.mp4" class="list-video"></video>
         <h3 class="list-title">zoombie walking animation</h3>
         <button style="float:right;" >Delete</button>     
        </div>

      <?php 
		 include "db_conn.php";
         
		 $sql = "SELECT * FROM videos ORDER BY id DESC";
		 $res = mysqli_query($conn, $sql);

		 if (mysqli_num_rows($res) > 0) {
         while ($video =$th=$title= mysqli_fetch_assoc($res) ) { 
            ?>
       
     <div class="list">
     
       <video src="uploads/<?=$video['video_url']?>" poster="thumbnails/<?=$th['Thumbnail']?>" controls class="list-video"></video>
       <h3 class="list-title"><?=$title['Title']?></h3>
       <button style="float:right;" >Delete</button>
           </div>
     
            <?php 
             }
            }
              ?>
   </div>

</div>


<script>
    let videoList = document.querySelectorAll('.video-list-container .list');

videoList.forEach(vid =>{
   vid.onclick = () =>{
      videoList.forEach(remove =>{remove.classList.remove('active')});
      vid.classList.add('active');
      let src = vid.querySelector('.list-video').src;
      let title = vid.querySelector('.list-title').innerHTML;
      document.querySelector('.main-video-container .main-video').src = src;
      document.querySelector('.main-video-container .main-video').play();
      document.querySelector('.main-video-container .main-vid-title').innerHTML = title;
   };
});
</script>

</body>
</html>
