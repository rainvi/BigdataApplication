
<?php
   header('Content-Type: text/html; charset=utf-8');
   //OTT별 모아보기 사이트 랭킹 페이지
   // 들어갈 것 : OTT movie 테이블에서 select, group by, rank 기능을 이용하여 정렬된 데이터 가져오기.

   $mysqli = mysqli_connect('localhost','team05','team05','team05');

   // db 연결
   // 연결 체크
   if ($mysqli == false){
      die("ERROR : 연결 실패".mysqli_connect_error());
   }
   $ott_id = $_GET['ott'];
   $ca_id = $_GET['ca'];

   $oid = 0;
   if ($ott_id == "netflix")
      $oid = 1;
   if ($ott_id == "watcha")
      $oid = 2;
   if ($ott_id == "wavve")
      $oid = 3;
   if ($ott_id == "disneyplus")
      $oid = 4;
   if ($ca_id == "cc")
      $caid = "CRate";
   if ($ca_id == "aa")
      $caid = "ARate";

   //SELECT 문
   //rank 함수 사용
   $sql_ott = "SELECT result.*, Movie.title_kor FROM Movie, (SELECT rank() over(partition by ott_movies.ott_id order by review.".$caid." desc) as ranking, ott_movies.ott_id, ott_movies.Mid from ott_movies, review where ott_movies.Mid = review.Mid) AS result WHERE result.ranking <= 9 and Movie.Mid = result.Mid and result.ott_id = ".$oid;

   $result = mysqli_query($mysqli, $sql_ott);
   $i = 0;
   if ($result){
      while($newArray = $result->fetch_ASSOC()){
         $i = $i+1;
         $id[$i] = $newArray['Mid'];
         $title_kor[$i] = $newArray['title_kor'];
         $ranking[$i] = $newArray['ranking'];
      }
   }
   $img1 = "http://localhost:8080/team05/img/".$id[1].".jpg";
   $img2 = "http://localhost:8080/team05/img/".$id[2].".jpg";
   $img3 = "http://localhost:8080/team05/img/".$id[3].".jpg";
   $img4 = "http://localhost:8080/team05/img/".$id[4].".jpg";
   $img5 = "http://localhost:8080/team05/img/".$id[5].".jpg";
   $img6 = "http://localhost:8080/team05/img/".$id[6].".jpg";
   $img7 = "http://localhost:8080/team05/img/".$id[7].".jpg";
   $img8 = "http://localhost:8080/team05/img/".$id[8].".jpg";
   $img9 = "http://localhost:8080/team05/img/".$id[9].".jpg";

   //close connection
   mysqli_close($mysqli);

   ?>

   <div class="type">
          <div class="gallery">
            <div id="mov1" class="movie">
              <a href ="http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[1] ?>"> 
                <img src = <?php echo $img1; ?>
                  alt = "이미지 오류">
              </a>
              <dl class = "movie_title">
                <dt class = "mtitle">
                  <b> <?php echo $ranking[1]; ?>위 : </b>
                  <a href = "http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[1] ?>"> <?php echo $title_kor[1]; ?> </a>
                </dt>
              </dl>
            </div>
            <div id="mov2" class="movie"> 
              <a href ="http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[2] ?>"> 
                <img src = <?php echo $img2; ?>
                  alt = "이미지 오류">
              </a>
              <dl class = "movie_title">
                <dt class = "mtitle">
                  <b> <?php echo $ranking[2]; ?>위 : </b>
                  <a href = "http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[2] ?>"> <?php echo $title_kor[2]; ?> </a>
                </dt>
              </dl>
            </div>
            <div id="mov3" class="movie"> 
              <a href ="http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[3] ?>"> 
                <img src = <?php echo $img3; ?>
                  alt = "이미지 오류">
              </a>
              <dl class = "movie_title">
                <dt class = "mtitle">
                  <b> <?php echo $ranking[3]; ?>위 : </b>
                  <a href = "http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[3] ?>"> <?php echo $title_kor[3]; ?> </a>
                </dt>
              </dl>
            </div>
            <div id="mov4" class="movie"> 
              <a href ="http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[4] ?>"> 
                <img src = <?php echo $img4; ?>
                  alt = "이미지 오류">
              </a>
              <dl class = "movie_title">
                <dt class = "mtitle">
                  <b> <?php echo $ranking[4]; ?>위 : </b>
                  <a href = "http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[4] ?>"> <?php echo $title_kor[4]; ?> </a>
                </dt>
              </dl>
            </div>
            <div id="mov5" class="movie"> 
              <a href ="http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[5] ?>"> 
                <img src = <?php echo $img5; ?>
                  alt = "이미지 오류">
              </a>
              <dl class = "movie_title">
                <dt class = "mtitle">
                  <b> <?php echo $ranking[5]; ?>위 : </b>
                  <a href = "http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[5] ?>"> <?php echo $title_kor[5]; ?> </a>
                </dt>
              </dl>
            </div>
            <div id="mov6" class="movie"> 
              <a href ="http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[6] ?>"> 
                <img src = <?php echo $img6; ?>
                  alt = "이미지 오류">
              </a>
              <dl class = "movie_title">
                <dt class = "mtitle">
                  <b> <?php echo $ranking[6]; ?>위 : </b>
                  <a href = "http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[6] ?>"> <?php echo $title_kor[6] ; ?> </a>
                </dt>
              </dl>
            </div>
            <div id="mov7" class="movie"> 
              <a href ="http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[7] ?>"> 
                <img src = <?php echo $img7; ?>
                  alt = "이미지 오류">
              </a>
              <dl class = "movie_title">
                <dt class = "mtitle">
                  <b> <?php echo $ranking[7]; ?>위 : </b>
                  <a href = "http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[7] ?>"> <?php echo $title_kor[7]; ?> </a>
                </dt>
              </dl>
            </div>
            <div id="mov8" class="movie"> 
              <a href ="http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[8] ?>"> 
                <img src = <?php echo $img8; ?>
                  alt = "이미지 오류">
              </a>
              <dl class = "movie_title">
                <dt class = "mtitle">
                  <b> <?php echo $ranking[8]; ?>위 : </b>
                  <a href = "http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[8] ?>"> <?php echo $title_kor[8]; ?> </a>
                </dt>
              </dl>
            </div>  
            <div id="mov9" class="movie"> 
              <a href ="http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[9] ?>"> 
                <img src = <?php echo $img9; ?>
                  alt = "이미지 오류">
              </a>
              <dl class = "movie_title">
                <dt class = "mtitle">
                  <b> <?php echo $ranking[9]; ?>위 : </b>
                  <a href = "http://localhost:8080/team05/movie_details.php?Mid=<?php echo $id[9] ?>"> <?php echo $title_kor[9]; ?> </a>
                </dt>
              </dl>
            </div>
          </div>
        </div>