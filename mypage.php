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
    
        <div id="container" class="log_page">
            <div>
                <h1 class="welcome">회원 정보 수정</h1>
            </div>
            <form action="mypage_check.php" method="POST">
                <div class="personal_data">

                    <div class="search_type">
                        <b>ID</b> <input placeholder=<?php echo $array['userid'];?> class="input" name="userid" type="text" disabled>
                    </div>
                    <div class="search_type">
                        <b>PW</b> <input placeholder="비밀번호를 입력하세요" class="input" name="pwd" type="password">
                    </div>
                    <div class="search_type">
                        <b>연령대</b>
                        <input placeholder=<?php 
                            if($array['age_group']=="10"){echo "10대";}
                            elseif($array['age_group']=="20") {echo "20대";}
                            elseif($array['age_group']=="30") {echo "30대";}
                            elseif($array['age_group']=="40") {echo "40대";}
                            else {echo "50대 이상";}
                            ?> class="input" type="text" disabled>
                    </div>
                    <div class="search_type">
                        <b>성별</b> 
                        <input placeholder=<?php if($array['gender']=="F"){echo "여성";} else {echo "남성";}?> class="input" type="text" disabled>
                    </div>
                    <div class="search_type">
                        <b>선호 장르</b>           
                        <select name="genre" class="input" id="log_filter">
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
                    <div class="search_type">
                        <b>선호 OTT</b>           
                        <select name="ott" class="input" id="log_filter">
                            <option value="" selected>OTT 선택</option>
                            <option value="1">넷플릭스</option>
                            <option value="2">왓챠</option>
                            <option value="3">웨이브</option>
                            <option value="4">디즈니플러스</option>
                        </select>
                
                    </div>
                </div>
                <div id="log_btn">
                    <button id="sch_btn" class="search_type" class="input" type="submit" onclick="delete_check()" title="탈퇴" name="delete">탈퇴하기</button>
                    <button id="sch_btn" class="search_type" class="input" type="submit" title="수정" name="edit">수정하기</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        function delete_check(){
            var check = confirm("정말 탈퇴하시나요?");
            if (check==TRUE) {
                location.replace = "./mypage_check.php";
            }
        }
    </script>
  </body>
</html>
