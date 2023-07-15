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
            <button id="sch_btn" class="search_type" class="input" type="submit" title="검색" //onclick="window.nclick(this,'sch.action','','',event);"
              / />검색</button>
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
          <?php
          #$mysqli = mysqli_connect("localhost", "team05", "team05", "team05");
          $mysqli = mysqli_connect("localhost", "root", "", "team05");
                        
          if(mysqli_connect_error()) {
                 printf("Connection Failed : %d\n", mysqli_connect_error());
                 exit();
          }
          $age = $_SESSION['age'];
          $sqll = "SELECT result.*, Movie.title_kor FROM Movie, (SELECT rank() over(order by Age_PR.A$age desc) as ranking, Age_PR.Mid, Age_PR.A$age FROM Age_PR, Movie WHERE Age_PR.Mid = Movie.Mid) AS result WHERE result.ranking<=2 ORDER BY RAND() LIMIT 3";
          $result = mysqli_query($mysqli, $sqll);
          $i=0;
          if($result){
            while($newArray = $result->fetch_ASSOC()){
              $i = $i+1;
              $ranking[$i] = $newArray['ranking'];
              $mid[$i] = $newArray['Mid'];
              //$u_age[$i] = $newArray['A10'];
              $title_kor[$i] = $newArray['title_kor'];
            }
          }
          if($age==10) {
            echo "10대 장르 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($age==20) {
            echo "20대 장르 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($age==30) {
            echo "30대 장르 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($age==40) {
            echo "40대 장르 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($age==50) {
            echo "50대 이상 장르 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          ?>
          </div>
        </div>
        <div id="filter" class="search_type">
          <select name="age" id="filter_btn">
            <option value="all_a" selected>나이 선택</option>
            <option value="10">10대</option>
            <option value="20">20대</option>
            <option value="30">30대</option>
            <option value="40">40대</option>
            <option value="50">50대 이상</option>
          </select>
        </div>
        <div class="type">
          <div class="gallery">
            <div id="mov1" class="movie"> - </div>
            <div id="mov2" class="movie"> - </div>
            <div id="mov3" class="movie"> - </div>
            <div id="mov4" class="movie"> - </div>
            <div id="mov5" class="movie"> - </div>
            <div id="mov6" class="movie"> - </div>
            <div id="mov7" class="movie"> - </div>
            <div id="mov8" class="movie"> - </div>
            <div id="mov9" class="movie"> - </div>
          </div>
        </div>
      </div>  
    </div>
    <script src="main.js"> </script>
  </body>
</html>
