<?php 
include 'session.php';
// 발급된 세션 id가 있다면 세션의 id를, 없다면 false 반환
if(!session_id()) {
    session_start();
}
#기존 데이터 보여주기
if($login){
  $userid = $_SESSION['userid'];
   #$mysqli = mysqli_connect("localhost", "team05", "team05", "team05");
   $mysqli = mysqli_connect("localhost", "root", "", "team05");
   if(mysqli_connect_errno()) {
       printf("Connection Failed : %d\n", mysqli_connect_error());
       exit();
   } else{
      $sql = "SELECT * FROM Users WHERE userid = '".$userid."'";
      $res = mysqli_query($mysqli, $sql);
      $array = mysqli_fetch_array($res);
   }
  
}
else {
  echo "<script>alert('세션이 만료되었습니다. 재로그인 해주세요.'); location.replace('login.php')</script>";
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>영화 저장소</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300&family=Song+Myung&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
  </head>
  <body>
    <div id="wrap">
      <div id="top">
        <div id="mypage">
          <a href="mypage.php" class="link">
            <span class="blind">마이페이지</span>
          </a>
          <a class="link">
            <span class="blind"><?php echo $userid;?></span>
          </a>
        </div>
        <div id="header">
          <h1 class="title">호r연이💞으l 달콤🧁살벌🔨한 영화 저😋장소</h1>
          <div class="sch">
            <div class="search_type">
              <input placeholder="영화명, 배우를 입력해주세요" class="input" type="text">
            </div>
            <button id="sch_btn" class="search_type" class="input" type="submit" title="검색">검색</button>
          </div>
        </div>
        <div id="serve_menu">
          <ul class="list_nav">
            <li class="nav_item"><a href="main.php">인기순</a></li> |
            <li class="nav_item"><a href="main_genre.php">장르별</a></li> |
            <li class="nav_item"><a href="main_age.php">연령별</a></li> |
            <li class="nav_item"><a href="main_ott.php">OTT별</a></li> |
            <li class="nav_item"><a href="main_playlist.php">플레이리스트</a></li>
          </ul>
        </div>
      </div>
    
      <div id="container">
        <div class="recommend">
          <div id="mov_top">
          <div class="fav_movie">
          <table id="favlist">
                  <tr><th>플레이리스트 제목</th><th>제작자</th></tr>
                  <?php //즐겨찾는 영화 불러오기
                     $mysqli = mysqli_connect("localhost", "team05", "team05", "team05");
                     #$mysqli = mysqli_connect("localhost", "root", "", "team05");
                     if(mysqli_connect_error()) {
                            printf("Connection Failed : %d\n", mysqli_connect_error());
                            exit();
                     }

                     $sql= "SELECT pl_title, pl_creator FROM playlist";
                     $res=mysqli_query($mysqli,$sql);

                     if($res){
                        while($row = mysqli_fetch_assoc($res))
                           {
                              echo "<tr> <td>$row[pl_title]</td> <td>$row[pl_creator]</td> </tr>";
                           }
                     }
                     ?>
               </table>    
                    </div>      
          </div>
        </div>
      </div>  
    </div>
    <script src="main.js"> </script>
  </body>
</html>