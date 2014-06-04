<!DOCTYPE html5>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Rapid Design - Admin Login</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
 
<!-- StyleSheet -->
<link rel="stylesheet" href="../../client/bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="../../client/bootstrap/css/bootstrap-theme.css" />
<link rel="stylesheet" href="../../client/css/login.css" />
</head>
 
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Rapid Design Admin Panel</h1>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
					<form class="form-signin" action="<?=$login_base_url; ?>" method="post">
                <input type="text" class="form-control" placeholder="Login" required autofocus name='login'>
                <input type="password" class="form-control" placeholder="Password" required name='password'>
                <button class="btn btn-lg btn-primary btn-block" type="submit">
                    Sign in</button>
                </form>
            </div>
        </div>
    </div>
</div>
 
<!-- JavaScript -->
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="../../client/bootstrap/js/bootstrap.js"></script>
</body>
</html>