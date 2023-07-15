<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>영화 저장소</title>

    <?php 

    $Mid = $_GET['Mid']; 
    header('Content-Type: text/html; charset=utf-8');
   //영화 상세 페이지의 php 파일
   // 들어갈 것: 영화에 대한 모든 것, 유저의 평점 입력/수정/삭제, 유저의 리뷰 입력/수정/삭제, 유저의 즐겨찾기 기능, 사이트 자체 평점 (average) 
   // 리뷰 담당 : 영화에 대한 모든 것 (select), 유저의 리뷰 입력(insert), 수정(update), 삭제(delete), 유저의 즐겨찾기 기능(?) user table에 저장하는 곳이 없음...
   // 평점 담당 : 유저의 평점 입력/수정/삭제, 사이트 자체 평점 (average)

   $mysqli = mysqli_connect('localhost','team05','team05','team05');

   // db 연결
   // 연결 체크
   if ($mysqli == false){
      die("ERROR : 연결 실패".mysqli_connect_error());
   }
   //transaction 사용 (commit, rollback)
   //mysqli_autocommit($mysqli, false);
   //mysqli_commit($mysqli);
   //mysqli_rollback($mysqli);

   //insert 문, update 문에 prepared statement 사용

   //SELECT 문
   $sql_movie_title_kor = "SELECT title_kor from movie where MID = ".$Mid;   //영화의 한국어 이름
   $sql_movie_title_eng = "SELECT title_eng from movie where MID = ".$Mid;   //영화의 영어 이름
   $sql_movie_country = "SELECT country from movie_info where MID = ".$Mid; //영화 제작국가
   $sql_movie_date = "SELECT date from movie_info where MID = ".$Mid; //영화 제작년도
   $sql_movie_director = "SELECT director from movie_info where MID =".$Mid;   //영화 감독
   $sql_movie_genre = "SELECT genre.genre from genrem, genre where genre.Gid = genre.Gid and genrem.MID =".$Mid;  //영화의 장르
   $sql_movie_actor = "SELECT ACName from actor where MID =".$Mid; //영화의 주연배우 이름 (여러 명일 수 있음)
   $sql_movie_CRate = "SELECT CRate from review where MID =".$Mid; //영화의 평론가 평점 (없을 경우 -1.00)
   $sql_movie_ARate = "SELECT ARate from review where MID =".$Mid; //영화의 평론가 평점 (")
   $sql_movie_ott = "SELECT otts.ott_name from otts, ott_movies where MID =".$Mid." and ott_movies.ott_id = otts.ott_id";   //영화가 스트리밍되는 사이트 목록 (여러 개일 수 있음)
   $sql_review2 = "SELECT * from review2 where Mid = ".$Mid;    //이 영화의 리뷰
   $sql_average = "SELECT AVG(site_rate) as avg FROM REVIEW2 WHERE Mid = ".$Mid; //이 영화의 사용자 평점 평균


   // SELECT 문 실행
   $res_kt = mysqli_query($mysqli, $sql_movie_title_kor);
   $res_et = mysqli_query($mysqli, $sql_movie_title_eng);
   $res_c = mysqli_query($mysqli, $sql_movie_country);
   $res_d = mysqli_query($mysqli, $sql_movie_date);
   $res_dr = mysqli_query($mysqli, $sql_movie_director);
   $res_g = mysqli_query($mysqli, $sql_movie_genre);
   $res_a = mysqli_query($mysqli, $sql_movie_actor);
   $res_cr = mysqli_query($mysqli, $sql_movie_CRate);
   $res_ar = mysqli_query($mysqli, $sql_movie_ARate);
   $res_ott = mysqli_query($mysqli, $sql_movie_ott);
   $res_re2 = mysqli_query($mysqli, $sql_review2);
   $res_avg = mysqli_query($mysqli, $sql_average);

   $review_num = mysqli_num_rows($res_re2);

   $newArray1 = $res_kt->fetch_ASSOC();
   $newArray2 = $res_et->fetch_ASSOC();
   $newArray3 = $res_c->fetch_ASSOC();
   $newArray4 = $res_d->fetch_ASSOC();
   $newArray5 = $res_dr->fetch_ASSOC();
   $newArray6 = $res_g->fetch_ASSOC();
   $newArray7 = $res_a->fetch_ASSOC();
   $newArray8 = $res_cr->fetch_ASSOC();
   $newArray9 = $res_ar->fetch_ASSOC();
   $newArray11 = $res_re2->fetch_ASSOC();
   $newArray12 = $res_avg->fetch_ASSOC();

   if ($newArray1 == null){
        $newArray1 = "-";
   }else{
    $kt_value = $newArray1['title_kor'];
   }
    if ($newArray2 == null){
      $newArray2 = "-";
   }else{
    $et_value = $newArray2['title_eng'];
   }
    if ($newArray3 == null){
      $newArray3 = "-";
   }else{
    $c_value = $newArray3['country'];
   }
    if ($newArray4 == null){
      $newArray4 = "-";
   }else{
    $d_value = $newArray4['date'];
   }
    if ($newArray5 == null){
      $newArray5 = "-";
   }else{
    $dr_value = $newArray5['director'];
   }
    if ($newArray6 ==null){
      $newArray6 = "-";
   }else{
    $g_value = $newArray6['genre'];
   }
    if ($newArray7 == null){
      $newArray7 = "-";
   }else{
    $ac_value = $newArray7['ACName'];
   }
    if ($newArray8 < 0){
        $newArray8 = 0.00;
   }else{
    $cr_value = $newArray8['CRate'];
   }
    if ($newArray9 < 0){
      $newArray9 = 0.00;
   }else{
    $ar_value = $newArray9['ARate'];
   }

   if ($newArray12 == null){
      $newArray12 = 0.00;
   }else{
    $avg_value = $newArray12['avg'];
   }
   $i = 0;
   if ($res_ott){
      while($newArray10 = $res_ott->fetch_ASSOC()){
         $i = $i+1;
         $ott_name[$i] = $newArray10['ott_name'];
      }
   }
   $re2_value[0] = "";
   $re2_value[1] = "";
   $re2_value[2] = "";
   if ($newArray11 == null){
    $newArray11 = " ";
   }else{
    
        $re2_value[0] = $newArray11['Uid'];
        $re2_value[1] = $newArray11['site_rate'];
        $re2_value[2] = $newArray11['Text'];
    }


   //close connection
   mysqli_close($mysqli);


    ?>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300&family=Song+Myung&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div id="wrap">
        <div id="top">
            <div id="header">
                <h1 class="title">호r연이💞으l 달콤🧁살벌🔨한 영화 저😋장소</h1>
            </div>
            <div>
                <a href="main.html" class="link">
                    <div id="back">
                        < 메인페이지로 돌아가기</div>
                </a>
            </div>
         </div>
        <div id="container">
                <div id="movie_info">
                    <div class="movie_img">-</div>
                    <div class="total_info">
                        <div id="title_star">
                            <form name="convertform" id="convertform" method="post" action="./save">
                                <fieldset>
                                    <input type="checkbox" name="즐찾" id="like"><label for="like">⭐</label>
                                </fieldset>
                            </form>
                            <a>
                            <img src = <?php echo "http://localhost:8080/team05/img/".$Mid.".jpg"; ?>
                                alt = "이미지 오류"
                                style="width:335px; height:475px;">
                            </a>
                            <h3> <?php echo "<br>".$kt_value."</br>";
                                echo "<br>".$et_value."</br>"; ?> </h3>

                        </div>
                        <div>
                            <table id='movielist'>
                                <tr>
                                    <th class="table_info">개봉년도</th>
                                    <td><?php echo "<br>".$d_value."</br>"; ?></td>
                                </tr>
                                <tr>
                                    <th class="table_info">국가</th>
                                    <td><?php echo "<br>".$c_value."</br>"; ?></td>
                                </tr>
                                <tr>
                                    <th class="table_info">장르</th>
                                    <td><?php echo "<br>".$g_value."</br>"; ?></td>
                                </tr>
                                <tr>
                                    <th class="table_info">감독</th>
                                    <td><?php echo "<br>".$dr_value."</br>"; ?></td>
                                </tr>
                                <tr>
                                    <th class="table_info">평균평점</th>
                                    <td><?php echo "<br>".$avg_value."</br>"; ?></td>
                                </tr>
                
                            </table>
                        </div>
                    </div>
                </div>
                <div id="star">
                    <form name="myform" id="myform" method="GET" action="movieDetailPage_rate_update.php">
                        <fieldset>
                            <legend>평가하기</legend>
                            <input type="radio" name="rating" value="5.0" id="rate1"><label for="rate1">⭐</label>
                            <input type="radio" name="rating" value="4.0" id="rate2"><label for="rate2">⭐</label>
                            <input type="radio" name="rating" value="3.0" id="rate3"><label for="rate3">⭐</label>
                            <input type="radio" name="rating" value="2.0" id="rate4"><label for="rate4">⭐</label>
                            <input type="radio" name="rating" value="1.0" id="rate5"><label for="rate5">⭐</label>
                        </fieldset>
                    </form>
                </div>
                <div class="search_type">

                    <form method = "GET" name = "frm">
                        <input type = "hidden" name = "Mid" value = "20223742" >
                        <br>코멘트 : </b></br>
                        <input name = "review" class="input" type="text" value = "">
                        <div id="log_btn">
                            <input id="sch_btn" class="search_type" class="input" type="submit" value="삭제" onclick = "btn_click('delete')">
                            <span></span>
                            <input id="sch_btn" class="search_type" class="input" type="submit" value="수정" onclick = "btn_click('update')">
                            <span></span>
                            <input id="sch_btn" class="search_type" class="input" type="submit" value="입력" onclick = "btn_click('insert')">
                        </div>
                    </form>

                    <script>
                    function btn_click(str){                             
                        if(str=="update"){                                 
                        frm.action="movieDetailPage_review_update.php";      
                        } else if(str=="delete"){      
                            frm.action="movieDetailPage_review_delete.php";      
                        }  else if (str == "insert"){
                            frm.action="movieDetailPage_review_insert.php";
                        }
                    }
                    </script>

                    <div id = "comment">
                        <?php
                        if ($re2_value[0] == ""){
                            echo "<br><center> 아직 리뷰가 없어요. </center></br>";
                        }else{
                            
                                echo "<hr><br>".$re2_value[0]."</br>";
                                echo "<br>".$re2_value[1]."</br>";
                                echo "<br>".$re2_value[2]."</br></hr>";
                        }
                        ?>
                    </div>

                </div>
            </div>
    </div>
    <script src="main.js"> </script>
</body>

</html>