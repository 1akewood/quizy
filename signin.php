<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = :username";

        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "잘못된 계정 이름 혹은 비밀번호 입니다";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "잘못된 계정 이름 혹은 비밀번호 입니다";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            unset($stmt);
        }
    }

    // Close connection
    unset($pdo);
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../que.ico">

    <title>Signin for Quizy</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="form-signin">
      <img id="logo" class="mb-4" src="../que.svg" alt="" width="72" height="72" onclick='location.href="index.php";'>
      <?php   
          if(!empty($login_err)){
              echo '<div class="alert alert-danger">' . $login_err . '</div>';
          }
      ?>
      <!-- <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1> -->
      <div class="form-group">
          <label for="username" class="sr-only">Username</label>
	  <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="Username" required autofocus>
          <span class="invalid-feedback"><?php echo $username_err; ?></span>
      </div>
      <div class="form-group">
	  <label for="password" class="sr-only">Password</label>
	  <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" placeholder="Password" required autofocus>
          <span class="invalid-feedback"><?php echo $password_err; ?></span>
      </div>
      <div class="form-group">
          <button type="submit" class="btn mb-3 mt-3 btn-lg btn-primary btn-block">로그인</button>
      </div>
      <a data-toggle="modal" data-target="#findPwModal" href="#findPwModal">비밀번호를 잊어버리셨나요?</a>
      <hr> 
    <button class="btn btn-success btn-lg" type="button" onclick='location.href="signup.php";'>가입하기</button>
    <!-- <button class="btn btn-success btn-lg" type="button" data-toggle="modal" data-target="#signUpModal">Create New Account</button> -->
    <p class="mt-4 mb-3 text-muted">&copy; Quizy 2021</p>
    </form>
    <div class="modal modal-center fade" id="signUpModal" tabindex="-1" role="dialog" aria-labelledby="my80sizeModalLabel">
      <div class="modal-dialog modal-center" role="document">
        <div class="modal-content modal-center">
          <div class="modal-header">
	    <h4 class="modal-title" id="myModalLabel">Sign Up</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            응~ 아직못해~
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal modal-center fade" id="findPwModal" tabindex="-1" role="dialog" aria-labelledby="my80sizeModalLabel">
        <div class="modal-dialog modal-center" role="document">
            <div class="modal-content modal-center">
                <div class="modal-header">
                    <h4 class="modal-title" id="findPwModal">Find Password</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    부족한 만큼 둥근 마음을 갖고 있습니다.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
  </body>
</html>


