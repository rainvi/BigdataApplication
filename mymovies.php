<?php 
include 'session.php';
header('charset=utf-8');
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
            <div id="header">
                <h1 class="title">호r연이💞으l 달콤🧁살벌🔨한 영화 저😋장소</h1>
            </div>
            <div id="serve_menu">
                <ul class="list_nav">
                  <li class="nav_item"><a href="mypage.php">회원 정보 수정</a></li> |
                  <li class="nav_item"><a href="mymovies.php">나의 영화 저장소</a></li>
                </ul>
            </div>      
        </div>
    
        <div id="container">
            <div id="fav_page">
            <div class="fav_movie">
               <h2 class="fav_title">즐겨찾는 영화</h2>
               <table id='favlist'>
                  <tr><th>영화 제목</th><th>삭제</th></tr>
                  <?php //즐겨찾는 영화 불러오기
                     #$mysqli = mysqli_connect("localhost", "team05", "team05", "team05");
                     $mysqli = mysqli_connect("localhost", "root", "", "team05");
                     if(mysqli_connect_error()) {
                            printf("Connection Failed : %d\n", mysqli_connect_error());
                            exit();
                     }
                     $uid = $_SESSION['userid'];
    
                     $sqll=  "SELECT * FROM fav_movies WHERE userid ='".$uid."'";
                     $rest= mysqli_query($mysqli,$sqll);

                     $rest = mysqli_fetch_assoc($rest);

                     $sql= "SELECT movie.title_kor FROM movie WHERE MID= '".$rest."'";
                     $res=mysqli_query($mysqli,$sql);

                     $j=2;

                     if($res){
                        while($row = mysqli_fetch_assoc($res))
                           {
                              echo "<tr> <td>$row[$j]</td> <td>-</td> </tr>";
                              $j++;
                           }
                     }
                  ?>
               </table>
            </div>
            <div class="fav_movie">
                <h2 class="fav_title">내가 만든 플레이리스트</h2>
                <table id="favlist">
                  <tr><th>플레이리스트 제목</th><th>삭제</th></tr>
                  <?php //즐겨찾는 영화 불러오기
                     #$mysqli = mysqli_connect("localhost", "team05", "team05", "team05");
                     $mysqli = mysqli_connect("localhost", "root", "", "team05");
                     if(mysqli_connect_error()) {
                            printf("Connection Failed : %d\n", mysqli_connect_error());
                            exit();
                     }
                     $uid = $_SESSION['userid'];

                     $sqll=  "SELECT * FROM fav_movies WHERE userid = '".$uid."'";
                     $rest= mysqli_query($mysqli,$sqll);

                     $rest = mysqli_fetch_assoc($rest);

                     $sql= "SELECT movie.title_kor FROM movie WHERE MID= '".$rest."'";
                     $res=mysqli_query($mysqli,$sql);

                     $j=2;

                     if($res){
                        while($row = mysqli_fetch_assoc($res))
                           {
                              echo "<tr> <td>$row[$j]</td> <td>-</td> </tr>";
                              $j++;
                           }
                     }
                     ?>
               </table>
            </div>
        </div>
    </div>
    <script src="main.js"> </script>
  </body>
</html>
