<?php   


$sname = "localhost";
$uname = "root";
$password = "";
$db_name = "ytcommentsystem";

$conn = mysqli_connect($sname, $uname, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
	exit();
}

if (isset($_POST['getAllComments'])) { 
    $start = $conn->real_escape_string($_POST['start']);
    $video_id= $_POST['video_id'];

    $response = "";
    $sql = $conn->query("SELECT comment.id,name,comment, DATE_FORMAT(comment.creat_on, '%Y-%m-%d') AS creat_on FROM comment INNER JOIN user ON comment.user_id = user.id AND comment.video_id=$video_id ORDER BY comment.id DESC LIMIT $start, 20;");
    while($data = $sql->fetch_assoc())
        $response .= createCommentRow($data);

    exit($response);
}

if (isset($_POST['getlastComments'])) { 
    $start = $conn->real_escape_string($_POST['start']);
    $video_id= $_POST['video_id'];

    $response = "";
    $sql = $conn->query("SELECT comment.id,name,comment, DATE_FORMAT(comment.creat_on, '%Y-%m-%d') AS creat_on FROM comment INNER JOIN user ON comment.user_id = user.id AND comment.video_id=$video_id ORDER BY comment.id ASC LIMIT $start, 20;");
    while($data = $sql->fetch_assoc())
        $response .= createCommentRow($data);

    exit($response);
}


if (isset($_POST['addComment'])) {
	$comment = $conn->real_escape_string($_POST['comment']);
	$video_id = $_POST['video_id'];
	$user_id= $_POST['user_id'];

	$sql="INSERT INTO comment (user_id,video_id,comment,creat_on) VALUES ($user_id, $video_id, '$comment',NOW())";
	mysqli_query($conn, $sql);

	exit('success');
}

function createCommentRow($data) {
    global $conn;


    $response = '
    <div class="old-comment">
    <img src="images/fady.jpeg">
    <div>
        <h3>'.$data['name'].'<span>'.$data['creat_on'].'</span></h3>
        <div class="userComment">'.$data['comment'].'</div>
        <div class="comment-actions">
 
        <span>REPLY</span>
        <a href="">all replies</a>
            
            </div>
           
    </div>
</div> ';

    // $sql = $conn->query("SELECT replies.id, name, comment, DATE_FORMAT(replies.createdOn, '%Y-%m-%d') AS createdOn FROM replies INNER JOIN users ON replies.userID = users.id WHERE replies.commentID = '".$data['id']."' ORDER BY replies.id DESC LIMIT 1");
    // while($dataR = $sql->fetch_assoc())
    //     $response .= createCommentRow($dataR);

    // $response .= '
    //                     </div>
    //         </div>
    //     ';

    return $response;
}






//  function getAllComments(start, max) {
//             alert('tmm');
//     if (start > max) {
//         return;
//     }

//     $.ajax({
//         url: 'index.php',
//         method: 'post',
//         data: {
//             'getAllComments': 1,
//             'start': start
//         }, success: function (response) {
//             $(".userComments").append(response);
//             getAllComments((start+20), max);
//         }
//     });
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>play video - at cloud9</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
     *{
    margin: 0;
    padding: 0;
    font-family: 'poppins',sans-serif;
    box-sizing: border-box;
}
a{
    text-decoration: none;
    color: #5a5a5a;
}
img{
    cursor: pointer;
}
.flex-div{
    display: flex;
    align-items: center;
}
nav{
    padding: 10px 2%;
    justify-content: space-between;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    background: #fff;
    position: sticky;
    top: 0;
    z-index: 10;
}
.nav-right img{
    width: 25px;
    margin-right: 25px; 
}
.nav-right .user-icon{
    width: 35px;
    border-radius: 50%;
    margin-right: 0;
}
.nav-left .menu-icon{
    width: 22px;
    margin-right: 25px;
}
.nav-left .logo{
     width: 130px;
}
.nav-midde .mic-icon{
    width: 16px;
}
.nav-midde .search-box{
    border: 1px solid #ccc;
    margin-right: 15px;
    padding: 8px 12px;
    border-radius: 25px;
}
.nav-midde .search-box input{
    width: 400px;
    border: 0;
    outline: 0;
    background: transparent;
}
.nav-midde .search-box img{
    width: 15px;
}

/* --------------sidebar------------- */

.sidebar{
    background: #fff;
    width: 15%;
    height: 100vh;
    position: fixed;
    top: 0;
    padding-left: 2%;
    padding-top: 80px;
}
.shortcut-links a img{
    width: 20px;
    margin-right: 20px;
}
.shortcut-links a {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    width: fit-content;
    flex-wrap: wrap;
}
.shortcut-links a:first-child{
color: #ed3833;
}
.sidebar hr{
    border: 0;
    height: 1px;
    background: #ccc;
    width: 85%;
}
.subscribed-list h3{
    font-size: 13px;
    margin: 20px 0;
    color: #5a5a5a;
}
.subscribed-list a{
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    width: fit-content;
    flex-wrap: wrap;
}
.subscribed-list a img{
    width: 25px;
    border-radius: 50%;
    margin-right: 20px;
}
.small-sidebar{
    width: 5%;
}
.small-sidebar a p{
    display: none;
}
.small-sidebar h3{
    display: none;
}
.small-sidebar hr{
    width: 50%;
    margin-bottom: 25px;
}
/* ------------------main----------- */

.container{
    background: #f9f9f9;
    padding-left: 17%;
    padding-right: 2%;
    padding-top: 20px;
    padding-bottom: 20px;
}
.large-container{
    padding-left: 7%;
}
.banner{
    width: 100%;
}
.banner img{
    width: 100%;
    border-radius: 8px;
}
.list-container{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    grid-column-gap: 16px;
    grid-row-gap: 30px;
    margin-top: 15px;
}
.vid-list .thumbnail{
    width: 100%;
    border-radius: 5px;
}
.vid-list .flex-div{
    align-items: flex-start;
    margin-top: 7px;
}
.vid-list .flex-div img{
    width: 35px;
    margin-right: 10px;
    border-radius: 50%;
}
.vid-info{
    color: #5a5a5a;
    font-size: 13px;
}
.vid-info a{
    color: #000;
    font-weight: 600;
    display: block;
    margin-bottom: 5px;
}

@media (max-width: 900px){
    .menu-icon{
        display: none;
    }
    .sidebar{
        display: none;
    }
    .container, .large-container{
        padding-left: 5%;
        padding-right: 5%; 
    }
    .nav-right img{
        display: none;
    }
    .nav-right .user-icon{
        display: block;
        width: 30px;
    }
    .nav-midde .search-box input{
        width: 100px;
    }
    .nav-middle .mic-icon{
        display: none;
    }
    .logo{
        width: 90px;
    }
}

.play-container{
    padding-left: 2%;
}
.row{
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}

.play-video{
    flex-basis: 69%;
}
.right-sidebar{
    flex-basis: 30%;
}

.play-video video{
    width: 100%;
}

.side-video-list{
    display: flex;
    justify-content: space-between;
    margin-bottom: 8px;
}

.side-video-list img{
    width:100%;
}

.side-video-list .small-thumbnail{
    flex-basis: 49%;
}

.side-video-list .vid-info{
    flex-basis: 49%;
}

.play-video .tags a{
    color: 0000ff;
    font-size: 13px;
}

.play-video h3{
    font-size: 22px;
    font-weight: 600;
}

.play-video .play-video-info{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-top: 10px;
    font-size: 14px;
    color: #5a5a5a;
}

.play-video .play-video-info{
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-top: 10px;
    font-size: 14px;
    color: #5a5a5a;
}

.play-video .play-video-info a img{
    width: 20px;
    margin-right: 8px;
}

.play-video .play-video-info a{
    display: inline-flex ;
    align-items: center;
    margin-left: 15px;
}
.play-video hr{
background: #ccc;
height: 1px;
border: 0;
margin: 10px;

}

.publisher{
    display: flex;
    align-items: center;
    margin-top: 20px;
}

.publisher div{
flex:1;
line-height: 18px;
}

.publisher img{
    width: 40px;
    border-radius: 50%;
    margin-right: 15px;
}

.publisher div p{
    color: #000;
    font-weight: 600;
    font-size: 18px;
 }
.publisher div span{
        color: #5a5a5a;
        font-size: 13px;
}
.publisher button{
    background-color: red;
    padding: 8px 30px;
    border: 0;
    outline: 0;
    border-radius: 4px;
    color: white;
}
.video-description{
    padding-left: 55px;
    margin: 15px 0;
}
.video-description p{
    font-size: 14px;
    margin-bottom:5px ;
    color: #5a5a5a;
}
.video-description h4{
    font-size: 14px;
    margin-top:15px ;
    color: #5a5a5a;
}
.add-comment{
    display: flex;
    align-items: center;
    margin: 30px 0;
}

.add-comment img{
width: 35px;
border-radius: 50%;
margin-right: 15px;
}

.add-comment input{
border: 0;
outline: 0;
background-color: transparent;
border-bottom: 1px solid #ccc;
width: 100% ;
padding-top: 10px;
}
.old-comment{
    display: flex;
    align-items: center;
    margin: 20px 0;
}

.old-comment img{
    width: 35px;
    height: 35px;
    border-radius: 50%;
    margin-right:15px ;
}

.old-comment h3{
font-size: 14px;
margin-bottom: 2px;
}

.old-comment h3 span{
    font-size: 12px;
    color: #5a5a5a;
    font-weight: 500;
    margin-left: 8px ;
    }

.old-comment .comment-actions{
    display: flex;
    align-items: center;
    margin: 8px 0;
    font-size: 14px;
}   

.old-comment .comment-actions img{
border-radius: 0;
width: 20px;
height: 20px;
margin-right: 5px;
}   

.old-comment .comment-actions span{
color: #5a5a5a;
margin-right: 20px;
}  

.old-comment .comment-actions a{
    color: blue;
}

.posts-wrapper {
    width: 50%;
    margin: 20px auto;
    border: 1px solid #eee;
  }
  .post {
    width: 90%;
    margin: 20px auto;
    padding: 10px 5px 0px 5px;
    border: 1px solid green;
  }
  .post-info {
    margin: 10px auto 0px;
    padding: 5px;
  }
  .fa {
    font-size: 1.2em;
  }
  .fa-thumbs-down, .fa-thumbs-o-down {
    transform:rotateY(180deg);
  }

  .logged_in_user {
    padding: 10px 30px 0px;
  }
  i {
    color: blue;
  }
    </style>
</head>
<body>
    <nav class="flex-div">
        <div class="nav-left flex-div">
            <img src="images/menu.png" class="menu-icon">
         <a href="home.php"><img src="images/clouuuuud.jpg" class="logo"></a>
        </div>
        <div class="nav-midde flex-div">
            <div class="search-box flex-div">
                <input type="text" placeholder="Search">
            <img src="images/search.png">
            </div>
            <img src="images/voice-search.png" class="mic-icon">
        </div>
        <div class="nav-right flex-div">
            <img src="images/upload.png"> 
            <img src="images/more.png">  
            <img src="images/notification.png">
            <img src="images/Jack.png" class="user-icon">
            
        </div>
    </nav>

    <div class="container play-container">
    <div class="row">
            <div class="play-video">
            <?php 
     if (!empty($_GET))
       {
           $title= htmlspecialchars($_GET['title']);
           $id= htmlspecialchars($_GET['id']);
        //    print_r($_GET);
         //   $id=$_GET;
        //    echo $id;
       }
       else {
           echo "No GET data passed!";
       }
		 $sql = "SELECT video_url FROM video WHERE title=\"$title\" ";
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
                <div class="tags">
                    <a href="">#coding</a><a href="">#html</a><a href="">#css</a><a href="">#javascript</a>
                </div>
                <h3><?php echo $title; ?></h3>
                <div class="play-video-info">
                    <p>1225 views &bull; 2 days ago</p>
                    <?php 
                    $sql = "SELECT id FROM video WHERE title=\"$title\"";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    // echo print_r($row['id']);
                    $query_id=$row['id'];
                    $sqlNumComments = $conn->query("SELECT id FROM comment WHERE video_id=$query_id");
                    $numComments = $sqlNumComments->num_rows;
                     ?>
                    <div>
                    <i <?php if (userLiked($row['id'],$id)): ?>
      		         class="fa fa-thumbs-up like-btn"
                    <?php else: ?>
                        class="fa fa-thumbs-o-up like-btn"
                    <?php endif ?>
                    data-id="<?php echo $row['id'] ?>"
                    data-user_id="<?php echo $id ?>"
                    ></i>
                    <span class="likes"><?php echo getLikes($row['id']); ?></span>
      	
      	&nbsp;&nbsp;&nbsp;&nbsp;

	    <!-- if user dislikes post, style button differently -->
      	<i <?php if (userDisliked($row['id'],$id)): ?>
      		  class="fa fa-thumbs-down dislike-btn"
      	  <?php else: ?>
      		  class="fa fa-thumbs-o-down dislike-btn"
      	  <?php endif ?>
      	  data-id="<?php echo $row['id'] ?>"
          data-user_id="<?php echo $id ?>"
          ></i>
          <span class="dislikes"><?php echo getDislikes($row['id']); ?></span>
        </div>
                    <!-- <script src="script.js"></script> -->
                </div>
                <hr>
                <div class="publisher">
                    <img src="images/Jack.png">
                    <div>
                        <p>easy toturilles</p>
                        <span>500k SUBSCRIBER</span>
                    </div>
                    <button type="button">subscribe</button>
                </div>
                <div class="video-description">
                    <p>channel that makes development easy </p>
                    <p>subscribe to watch more toturilles</p>
                <hr>
                <h2><b id="numComments"><?php echo $numComments ?> Comments</b></h2>
                <div class="add-comment">
                    <img src="images/Jack.png">
                    <!-- <form method="post" enctype="multipart/form-data">
                    <input type="text" name="comment" placeholder="write comments...">
                    </form> -->
            <!-- <div class="col-md-12"> -->
                <textarea class="form-control" id="mainComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
                <button style="float:right" class="btn-primary btn" id="addComment" data-id="<?php echo $row['id'] ?>"
          data-user_id="<?php echo $id ?>">Add Comment</button>
          <!-- <button style="float:right" class="btn-primary btn" onclick="isReply = true;" id="addReply">Add Reply</button>
        <button style="float:right" class="btn-default btn" onclick="$('.replyRow').hide();">Close</button> -->
            <!-- </div> -->
                    <?php  //@$comment=$_POST['comment'];?> 
                </div>
    
           <div>     
            <button style="float:left" class="btn-primary btn" id="showcomments" data-id="<?php echo $row['id'] ?>"
          data-user_id="<?php echo $id ?>">Show all comments</button>
          </div>
               
          <div class="userComments">
            <br>

            </div>
                <!-- <div class="old-comment">
                    <img src="images/fady.jpeg">
                    <div>
                        <h3>Fady hany<span>now</span></h3>
                        <div class="comment-actions">
                            <img src="images/like.png" >
                            <span>200M</span>
                            <img src="images/dislike.png" >
                            <span>0</span>
                            <span>REPLY</span>
                            <a href="">all replies</a>
                        </div>
                    </div>
                </div> -->

            </div>
            </div>
            <!-- <script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

             -->
         <div class="right-sidebar">
            <div class="side-video-list">
                <a href="" class="small-thumbnail"><img src="images/thumbnail1.png"></a>
                <div class="vid-info">
                    <a href="">best channel to make you a web developer</a>
                    <p>easy toturilles</p>
                    <p>15k views</p>
                </div>
            </div>

            <div class="side-video-list">
                <a href="" class="small-thumbnail"><img src="images/thumbnail2.png"></a>
                <div class="vid-info">
                    <a href="">best channel to make you a web developer</a>
                    <p>easy toturilles</p>
                    <p>15k views</p>
                </div>
            </div>

            <div class="side-video-list">
                <a href="" class="small-thumbnail"><img src="images/thumbnail3.png"></a>
                <div class="vid-info">
                    <a href="">best channel to make you a web developer</a>
                    <p>easy toturilles</p>
                    <p>15k views</p>
                </div>
            </div>

            <div class="side-video-list">
                <a href="" class="small-thumbnail"><img src="images/thumbnail4.png"></a>
                <div class="vid-info">
                    <a href="">best channel to make you a web developer</a>
                    <p>easy toturilles</p>
                    <p>15k views</p>
                </div>
            </div>

            <div class="side-video-list">
                <a href="" class="small-thumbnail"><img src="images/thumbnail5.png"></a>
                <div class="vid-info">
                    <a href="">best channel to make you a web developer</a>
                    <p>easy toturilles</p>
                    <p>15k views</p>
                </div>
            </div>

            <div class="side-video-list">
                <a href="" class="small-thumbnail"><img src="images/thumbnail6.png"></a>
                <div class="vid-info">
                    <a href="">best channel to make you a web developer</a>
                    <p>easy toturilles</p>
                    <p>15k views</p>
                </div>
            </div>

            <div class="side-video-list">
                <a href="" class="small-thumbnail"><img src="images/thumbnail7.png"></a>
                <div class="vid-info">
                    <a href="">best channel to make you a web developer</a>
                    <p>easy toturilles</p>
                    <p>15k views</p>
                </div>
            </div>
         </div>
        </div>
    </div>

 <script type="text/javascript">
    $(document).ready(function(){
    
    // if the user clicks on the dislike button ...
    $('.dislike-btn').on('click', function(){
      var video_id = $(this).data('id');
      var user_id = $(this).data('user_id');
    //   alert(user_id);    
      $clicked_btn = $(this);
      if ($clicked_btn.hasClass('fa-thumbs-o-down')) {
          action = 'dislike';
      } else if($clicked_btn.hasClass('fa-thumbs-down')){
          action = 'undislike';
      }
      $.ajax({
          url: 'index.php',
          type: 'post',
          data: {
              'action': action,
              'video_id': video_id,
              'user_id':user_id
          },
          success: function(data){
              res = JSON.parse(data);
            //   alert(print_r($res));
              if (action == "dislike") {
                  $clicked_btn.removeClass('fa-thumbs-o-down');
                  $clicked_btn.addClass('fa-thumbs-down');
              } else if(action == "undislike") {
                  $clicked_btn.removeClass('fa-thumbs-down');
                  $clicked_btn.addClass('fa-thumbs-o-down');
              }
            //   alert(res.dislikes);
              // display the number of likes and dislikes
              $clicked_btn.siblings('span.likes').text(res.likes);
              $clicked_btn.siblings('span.dislikes').text(res.dislikes);
              
              // change button styling of the other button if user is reacting the second time to post
              $clicked_btn.siblings('i.fa-thumbs-up').removeClass('fa-thumbs-up').addClass('fa-thumbs-o-up');
          }
      });	
    
    });

    $('.like-btn').on('click', function(){
        var video_id = $(this).data('id');
        var user_id = $(this).data('user_id');
        $clicked_btn = $(this);
        if ($clicked_btn.hasClass('fa-thumbs-o-up')) {
            action = 'like';
        } else if($clicked_btn.hasClass('fa-thumbs-up')){
            action = 'unlike';
        }
        $.ajax({
            url: 'index.php',
            type: 'post',
            data: {
                'action': action,
                'video_id': video_id,
                'user_id':user_id
            },
            success: function(data){
                res = JSON.parse(data);
                // alert(res.url);
                if (action == "like") {
                    $clicked_btn.removeClass('fa-thumbs-o-up');
                    $clicked_btn.addClass('fa-thumbs-up');
                } else if(action == "unlike") {
                    $clicked_btn.removeClass('fa-thumbs-up');
                    $clicked_btn.addClass('fa-thumbs-o-up');
                }
                // display the number of likes and dislikes
                $clicked_btn.siblings('span.likes').text(res.likes);
                $clicked_btn.siblings('span.dislikes').text(res.dislikes);
      
                // change button styling of the other button if user is reacting the second time to post
                $clicked_btn.siblings('i.fa-thumbs-down').removeClass('fa-thumbs-down').addClass('fa-thumbs-o-down');
            }
        });		
      
      });
      var isReply = false, videoID = <?php echo $row['id'] ?>,start=-1, max= <?php echo ($numComments); ?>;

    //   $("#showlastcomments").on('click', function () {
    //     alert(max);
    //     getAllComments(max-1, max);

    //   });

      $("#showcomments").on('click', function () {
     
        getAllComments(0, max);

      });



        $("#addComment").on('click', function () {
            var video_id = $(this).data('id');
            var user_id = $(this).data('user_id');
            var comment = $("#mainComment").val();
            // alert(max);
            // alert(comment);
            // alert(user_id);
            if (comment.length > 5) {
                 $.ajax({
                     url: 'index.php',
                     method: 'post',
                     data: {
                         'addComment': 1,
                         'video_id': video_id,
                         'user_id':user_id,
                         'comment': comment
                     }, success: function (response) {
                        max++;
                        $("#numComments").text(max + " Comments");
                        console.log(response);
                        getlastComment(max-1, max);
                     }
                 });
            } else
                alert('Please Check Your Inputs');

        });
        
        function getAllComments(start, max) {
            // alert('tmm');
    if (start > max) {
        return;
    }

    $.ajax({
        url: 'index.php',
        method: 'post',
        data: {
            'getAllComments': 1,
            'start': start,
            'video_id': videoID
        }, success: function (response) {
            $(".userComments").append(response);
            getAllComments((start+20), max);
            // console.log(response);
        }
    });
}

function getlastComment(start, max) {
            // alert('tmm');
    // if (start > max) {
    //     return;
    // }

    $.ajax({
        url: 'index.php',
        method: 'post',
        data: {
            'getlastComments': 1,
            'start': start,
            'video_id': videoID
        }, success: function (response) {
            $(".userComments").append(response);
            getAllComments((start+20), max);
            // console.log(response);
        }
    });
}
    
    });

    
    </script>


</body>
</html>
