<?php
$userid=$_POST['userid'];
$pwd=$_POST['pwd'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$genre = $_POST['genre'];
$ott = $_POST['ott'];

if($userid==NULL || $pwd==NULL || $age=="" || $genre=="" || $gender=="" || $ott=="") {
    echo "<script>alert('모든 값을 전부 입력해주세요.'); location.href='./register.php'</script>";
} else {
    if(!is_null($userid)){
        #$mysqli = mysqli_connect("localhost", "team05", "team05", "team05");
        $mysqli = mysqli_connect("localhost", "root", "", "team05");
        if(mysqli_connect_errno()) {
            printf("Connection Failed : %d\n", mysqli_connect_error());
            exit();
        } else{
            $sql="SELECT userid FROM Users WHERE userid = '".$userid."'";
            $res=mysqli_query($mysqli, $sql);
            
            #insert문에 트랜잭션 추가해주기
            mysqli_begin_transaction($mysqli);
            
            try {
                if($res->num_rows==1){
                    echo "<script>alert('중복된 ID입니다.'); location.href='./register.php'</script>";
                    exit();
                } else {
                    #아이디 중복 아니니까 넣어주기
                    $stmt = "INSERT INTO Users(userid, pwd, age_group, genres_prefer, gender, ott_prefer) VALUES ('$userid', '$pwd', $age, '$genre', '$gender', $ott)";
                    #$stmt = mysqli_prepare("INSERT INTO Users(userid, pwd, age_group, genres_prefer, gender, ott_prefer) VALUES (?, ?, ?, ?, ?, ?)");
                    #mysqli_stmt_bind_param($stmt, 'ssdssd', $pwd, $age, $genre, $gender, $ott);
                    $join = mysqli_query($mysqli, $stmt);
                    mysqli_commit($mysqli);
                }
                if($join) {
                    echo "<script>alert('회원가입이 완료되었습니다. 로그인 해주세요.'); location.href='./login.php'</script>";
                }
            } catch(mysqli_sql_exception $exception){
                mysqli_rollback($mysqli);
            }
        }
    }
}

?>

