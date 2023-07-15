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
                <h1 class="title"><a href="login.php">호r연이💞으l 달콤🧁살벌🔨한 영화 저😋장소</a></h1>
            </div>
        </div>
    
        <div id="container" class="log_page">
            <div>
                <h1 class="welcome">환영합니다!</h1>
            </div>
            <form action="register_check.php" method="POST">
                <div class="personal_data">
                    
                    <div class="search_type">
                        <b>ID</b> <input placeholder="아이디를 입력하세요" class="input" name="userid" type="text">
                    </div>
                    <div class="search_type">
                        <b>PW</b> <input placeholder="비밀번호를 입력하세요" class="input" name="pwd" type="password">
                    </div>
                    <div class="search_type">
                            <b>연령대</b>
                            <select name="age" class="input" id="log_filter">
                                <option value="" selected>나이 선택</option>
                                <option value="10">10대</option>
                                <option value="20">20대</option>
                                <option value="30">30대</option>
                                <option value="40">40대</option>
                                <option value="50">50대 이상</option>
                            </select>
                    </div>
                    <div class="search_type">
                        <b>성별</b>                         
                        <select name="gender" class="input" id="log_filter">
                            <option value="" selected>성별 선택</option>
                            <option value="F">여성</option>
                            <option value="M">남성</option>
                        </select>

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
                    <span></span>
                    <button id="sch_btn" class="search_type" class="input" type="submit" title="가입">회원 가입</button>
                </div>
            </form>
        </div>
    </div>
    <script src="main.js">
    </script>
  </body>
</html>
