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

   $Mid = $_GET['Mid']; //html에서 영화별 페이지 접근할 때 Mid란 이름의 변수를 보낸다고 가정*
   $Uid = $_SESSION['userid']; //로그인 중인 유저의 아이디*
   $review = $_GET['review']; //작성한 리뷰


   //DELETE 문
   $sql_review_delete = "DELETE from review2 Where Uid ='".$Uid."' and Mid =".$Mid;  //해당 영화에 해당 유저가 작성한 리뷰 삭제

   $res = mysqli_query($mysqli, $sql_review_delete);
   echo "<script>alert('삭제 완료~'); location.href='./movie_details.php?Mid=".$Mid."'</script>";
   //close connection
   mysqli_close($mysqli);


?>
