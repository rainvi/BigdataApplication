<?php
// Session 체크 모듈, include 'session.php';로 가져옴
// if($login){login 된 코드} else{안된코드}
// session이 set되어있으면 다음과 같은 아이들이 있음
// $_SESSION['userid'], userid. string
// $_SESSION['age'], age. 10 20 30 40 50의 int
// $_SESSION['gender'], gender. M/F의 VARCHAR(1)
// $_SESSION['genre'], 선호장르. string값
// $_SESSION['ott'], 선호 ott. 1~4 숫자값

  session_start();
  if( isset( $_SESSION['userid'])){
    $login = TRUE;
  }
?>