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
      <!--요구사항 - RANKING/SELECT/GROUP BY(태그별)-->
      <!--recommend : 추천, 선호 OTT중 랜덤 추천?-->
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
          $ott = $_SESSION['ott'];
          $sqll = "SELECT Movie.Mid, Movie.title_kor, OTT_Movies.ott_id FROM OTT_Movies, Movie WHERE OTT_Movies.Mid=Movie.Mid AND OTT_Movies.ott_id = $ott ORDER BY RAND() LIMIT 3";
          $result = mysqli_query($mysqli, $sqll);
          $i=0;
          if($result){
            while($newArray = $result->fetch_ASSOC()){
              $i = $i+1;
              $mid[$i] = $newArray['Mid'];
              $title_kor[$i] = $newArray['title_kor'];
              $ott_id[$i] = $newArray['ott_id'];
            }
          }          
          if($ott==1) {
            echo "Netflix 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($ott==2) {echo "Watcha 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];}
          if($ott==3) {echo "Wavve 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];}
          if($ott==4) {echo "Disneyplus 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
            }?> </div>
        </div>
        <div id="filter" class="search_type">
          <form action = "OTTrankingPage.php" method = "GET">
          <select name="ott" id="filter_btn">
            <option value="netflix" selected>넷플릭스</option>
            <option value="watcha">왓챠</option>
            <option value="wavve">웨이브</option>
            <option value="disneyplus">디즈니플러스</option>
          </select>
          <select name="ca" id="filter_btn">
            <option value="cc" selected>평론가 인기</option>
            <option value="aa">관람객 인기</option>
          </select>
          <p><input type = "submit" name = "submit" value = "검색"></p>
          </form>
        </div>
        
      </div>  
    </div>
    <script src="main.js"> </script>
  </body>
</html>