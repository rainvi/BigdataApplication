<?php
#세션 사용
session_start();
#로그인에 사용되는 요구사항 : Session과 Select
#GET - 전송속도가 빠르고 SELECT에 적합 / 회원가입과 수정(DB)관련은 POST
#username/password 받아서 DB와 비교 후 일치 시 다음으로 넘기기
$userid = $_GET['userid'];
$pwd = $_GET['pwd'];

#ID가 같은 경우의 pwd를 가져옴
$sql = "SELECT * FROM Users WHERE userid = '$userid'";

#userid가 null값이 아니면 연결 
if(!is_null($userid)) {
    #$mysqli = mysqli_connect("localhost", "team05", "team05", "team05");
    $mysqli = mysqli_connect("localhost", "root", "", "team05");
    if(mysqli_connect_errno()) {
        printf("Connection Failed : %d\n", mysqli_connect_error());
        exit();
    } else {
        $res = mysqli_query($mysqli, $sql);
        if(mysqli_num_rows($res)==1) {
            #일치하는 진짜 패스워드
            $row = mysqli_fetch_assoc($res);
            $real_pwd=$row['pwd'];

            if($real_pwd==$pwd){
                #로그인 성공
                #Login, 회원 정보를 세션에 전부 저장 (id, age, gender, genre, ott)
                $age = $row['age_group'];
                $genre = $row['Genres_prefer'];
                $gender = $row['gender'];                
                $ott = $row['ott_prefer'];

                $_SESSION['userid'] = $userid;
                $_SESSION['age'] = $age;
                $_SESSION['gender'] = $gender;
                $_SESSION['genrem'] = $genre;
                $_SESSION['ott'] = $ott;

                if (isset($_SESSION['userid'])) {
                    echo "<script>alert('로그인되었습니다.'); location.replace('main.php')</script>";
                }
            } else {
                #비밀번호가 틀렸음
                echo "<script>alert('아이디 혹은 비밀번호가 틀립니다.'); location.replace('login.php')</script>";
            }
        } else {
            #아이디도 없음
            echo "<script>alert('아이디 혹은 비밀번호가 틀립니다.'); location.replace('login.php')</script>";
        }
    } 
}
?>