<?php
include 'session.php';
// 발급된 세션 id가 있다면 세션의 id를, 없다면 false 반환
if(!session_id()) {
    session_start();
}

if(isset($_POST['delete'])){
    if($login){
        $uid = $_SESSION['userid'];

        $sql = "DELETE FROM Users WHERE userid ='".$uid."' "; 
    
        //$mysqli = mysqli_connect("localhost", "team05", "team05", "team05");
        $mysqli = mysqli_connect("localhost", "root", "", "team05");
        if(mysqli_connect_errno()) {
            printf("Connection Failed : %d\n", mysqli_connect_error());
            exit();
        } else {
            $res = mysqli_query($mysqli, $sql);
            if($res==TRUE) {}
                unset($_SESSION['userid']);
                unset($_SESSION['age']);
                unset($_SESSION['gender']);
                unset($_SESSION['genre']);
                unset($_SESSION['ott']);
            }
        }   
    
    else {
        echo "<script>alert('세션이 만료되었습니다. 재로그인 해주세요.'); location.replace('login.php')</script>";
    }
    mysqli_close($mysqli);
    echo "<script>alert('탈퇴가 완료되었습니다.'); location.replace('login.php')</script>";
}

elseif(isset($_POST['edit'])) {
    if($login){
        $userid=$_SESSION['userid'];
        $c_pwd=$_POST['pwd'];
        $c_genre = $_POST['genre'];
        $c_ott = $_POST['ott'];
        
        #$mysqli = mysqli_connect("localhost", "team05", "team05", "team05");
        $mysqli = mysqli_connect("localhost", "root", "", "team05");
        if(mysqli_connect_errno()) {
            printf("Connection Failed : %d\n", mysqli_connect_error());
            exit();
        } else{
            //session값 가지고 있으니 그거랑 비교해서 바뀐거 변경해주기
            //값 변경 대상은 pwd, genre, ott
            // $stmt = mysqli_prepare("UPDATE Users SET pwd = ?, genre = ?, ott = ? WHERE userid = '".$userid."'");
            // mysqli_stmt_bind_param($stmt, 'ssd', $pwd, $genre, $ott);
            if($c_pwd==NULL){
                $pwd = $_SESSION['pwd'];
            } else {
                $pwd = $c_pwd;
            }
    
            if($c_genre==""){
                $genre = $_SESSION['genre'];
            } else {
                $genre = $c_genre;
            }
    
            if($c_ott==""){
                $ott = $_SESSION['ott'];
            } else {
                $ott = $c_ott;
            }
            
            $sql = "UPDATE Users SET pwd = '".$pwd."', Genres_prefer = '".$genre."', ott_prefer = $ott WHERE userid = '".$userid."'";
            
            #세션값 수정
            $edit = mysqli_query($mysqli, $sql);
            $_SESSION['pwd']=$pwd;
            $_SESSION['genre']=$genre;
            $_SESSION['ott']=$ott;
        }
    
        if ($edit) {
            echo "<script>alert('회원정보 수정이 완료되었습니다.'); location.href='./main.php'</script>";
        }
    mysqli_close($mysqli);
    
    }
    else {
        echo "<script>alert('세션이 만료되었습니다. 재로그인 해주세요.'); location.replace('login.php')</script>";
    }
}


?>