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
        </div>
        <div id="container" class="log_page">
            <section class="login-form">
            <h1>환영합니다!</h1>
            <h2>Sign in to 영화 저😋장소</h2>
            <form action="login_check.php" method="GET">
                <div class="int-area">
                    <input type="text" name="userid" id="id"
                    autocomplete="off" required>
                    <label for="id">ID</label>
                </div>
                <div class="int-area">
                    <input type="password" name="pwd" id="pw"
                    autocomplete="off" required>
                    <label for="pw">Password</label>
                </div>

                <div class="btn-area">
                    <button id="btn" type="submit">LOGIN</button>
                </div>
            </form>
            <!-- <div class="caption">
                <a href="">Forgot Password?</a>
            </div> -->
            <div class="caption">
                <a href="register.php">Create an account</a>
            </div>
        </section>
        <script>
            let id = $('#id');
            let pw = $('#pw');
            let btn = $('#btn');

            $(btn).on('click',function(){
                if($(id).val() == "") {
                    $(id).next('label').addClass('warning');
                    setTimeout(function() {
                        $('label').removeClass('warning');
                    },1500);
                }
                else if($(pw).val()== "") {
                    $(pw).next('label').addClass('warning');
                    setTimeout(function() {
                        $('label').removeClass('warning');
                    },1500);
                }
            });
        </script>
  </body>
</html>
