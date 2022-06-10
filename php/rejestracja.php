<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona główna</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/logincss.css">

    <!--   -->
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

<form class="box" action="rejestruj.php" onsubmit="return validate()" method="post" name="formGame">
    <h1>Login</h1>

    <input type="text" placeholder="User Login" name="login" id="login" required="required" >
    <input type="text"  placeholder="User Nick" name="nick" id="nick"required="required">
    <input type="text"  placeholder="User Email" name="email" id="email" required="required">
    <input type="password"  placeholder="Password" name="pass1" id="pass1" required="required" minlength="8">
    <input type="password"  placeholder=" Confirm Password" name="pass2" id="pass2" required="required" minlength="8" >
    <input type="submit"  value="Zaczynaj przygode" class="btn btn-blue btn-block">

</form>
    <script>
        function validate() {
            var login = document.forms["formGame"]["login"].value;
            var  nick= document.forms["formGame"]["nick"].value;
            var email = document.forms["formGame"]["email"].value;
            var pass1 = document.forms["formGame"]["pass1"].value;
            var pass2 = document.forms["formGame"]["pass2"].value;
            var noNumbersExpression = /^[a-zA-Z]+$/;
            if(login=="" || nick=="" || pass1=="" || pass2=="" || email==""){
            }else{
                if(login.match(noNumbersExpression)==null) {
                    return false;
                }if(nick.match(noNumbersExpression==null)){
                    return false;
                }
                if(pass1==pass2){
                    var regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/;
                    if(!regularExpression.test(pass1)){
                        alert("Hasło nie spełnia założeń bezpieczeństwa");
                        return false;
                    }
                }else {
                    return false;
                }
                if(!validateEmail(email)){
                    return false;
                }

            }
                function validateEmail(email) {
                    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(email);
                }

        }
    </script>
    </div>
</div>

</body>
</html>