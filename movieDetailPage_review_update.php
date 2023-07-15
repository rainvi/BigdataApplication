<?php 
include 'session.php';
// 발급된 세션 id가 있다면 세션의 id를, 없다면 false 반환
if(!session_id()) {
    session_start();
}
#기존 데이터 보여주기
if($login){
  $userid = $_SESSION['userid'];
   $mysqli = mysqli_connect("localhost", "team05", "team05", "team05");
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

<?php
   header('Content-Type: text/html; charset=utf-8');

   $mysqli = mysqli_connect('localhost','team05','team05','team05');

   // db 연결
   // 연결 체크
   if ($mysqli == false){
      die("ERROR : 연결 실패".mysqli_connect_error());
   }

   $Mid = $_GET['Mid']; //html에서 영화별 페이지 접근할 때 Mid란 이름의 변수를 보낸다고 가정*
   $Uid = $_SESSION['userid']; //로그인 중인 유저의 아이디*
   $review = $_GET['review']; //작성한 리뷰


   //insert 문, update 문에 prepared statement 사용

   //UPDATE 문
   $sql_review_update = "UPDATE review2 set Text = ? WHERE Uid = ? and Mid = ?";   //해당 영화에 해당 유저가 작성한 리뷰 업데이트


   if ($stmt = mysqli_prepare($mysqli, $sql_review_update)){
      mysqli_stmt_bind_param($stmt, "sss", $R, $U, $M);

      $U = $Uid;  //uid 요청*
      $M = $Mid; //Mid 요청*
      $R = $review;   //Review 요청*

      if (mysqli_stmt_execute($stmt)){
         echo "<script>alert('리뷰 업데이트 성공적입니다'); location.href='./movie_details.php?Mid=".$Mid."'</script>";
      } else{
         echo "ERROR : 쿼리를 실행할 수 없어요 : $sql_review_update . ".mysqli_error($mysqli);
      }

   }else{
      echo "ERROR : 쿼리를 실행할 수 없어요 : $sql_review_update . ".mysqli_error($mysqli);
   }

   //close statement
   Mysqli_stmt_close($stmt);


   //close connection
   mysqli_close($mysqli);


?>