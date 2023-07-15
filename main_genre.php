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
            <!--선호 장르 랜덤 3개-->
            <?php
          #$mysqli = mysqli_connect("localhost", "team05", "team05", "team05");
          $mysqli = mysqli_connect("localhost", "root", "", "team05");
                        
          if(mysqli_connect_error()) {
                 printf("Connection Failed : %d\n", mysqli_connect_error());
                 exit();
          }
          $genre = $_SESSION['genrem']; //genrem의 gid 숫자값 (0~20)
          $sqll = "SELECT Movie.Mid, Movie.title_kor, Genrem.Gid FROM Genrem, Movie WHERE Genrem.Mid=Movie.Mid AND Genrem.Gid = $genre ORDER BY RAND() LIMIT 3";
          $result = mysqli_query($mysqli, $sqll);
          $i=0;
          if($result){
            while($newArray = $result->fetch_ASSOC()){
              $i = $i+1;
              $mid[$i] = $newArray['Mid'];
              $title_kor[$i] = $newArray['title_kor'];
              $genre_p[$i] = $newArray['Gid'];
            }
          }
          //
          if($genre==0) {
            echo "드라마 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==1) {
            echo "코미디 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];}
          if($genre==2) {
            echo "액션 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];}
          if($genre==3) {
            echo "멜로/로맨스 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==4) {
            echo "스릴러 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==5) {
            echo "미스터리 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==6) {
            echo "공포(호러) 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==7) {
            echo "어드벤처 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==8) {
            echo "멜로/로맨스 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==9) {
            echo "범죄 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          } 
          if($genre==10) {
            echo "가족 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==11) {
            echo "판타지 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==12) {
            echo "서부극(웨스턴) 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==13) {
            echo "사극 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==14) {
            echo "애니메이션 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==15) {
            echo "다큐멘터리 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==16) {
            echo "전쟁 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==17) {
            echo "뮤지컬 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==18) {
            echo "성인물(에로) 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==19) {
            echo "공연 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }
          if($genre==20) {
            echo "공연 추천 3개<br>";
            echo $title_kor[1]."<br>";
            echo $title_kor[2]."<br>";
            echo $title_kor[3];
          }?>

          </div>
        </div>
        <div id="filter" class="search_type">
          <select name="genre" id="filter_btn">
            <option value="" selected>장르 선택</option>
            <option value="0">드라마</option>
            <option value="1">코미디</option>
            <option value="2">액션</option>
            <option value="3">멜로/로맨스</option>
            <option value="4">스릴러</option>
            <option value="5">미스터리</option>
            <option value="6">공포(호러)</option>
            <option value="7">어드벤처</option>
            <option value="8">범죄</option>
            <option value="9">가족</option>
            <option value="10">판타지</option>
            <option value="11">SF</option>
            <option value="12">서부극(웨스턴)</option>
            <option value="13">사극</option>
            <option value="14">애니메이션</option>
            <option value="15">다큐멘터리</option>
            <option value="16">전쟁</option>
            <option value="17">뮤지컬</option>
            <option value="18">성인물(에로)</option>
            <option value="19">공연</option>
            <option value="20">기타</option>
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
