<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="static/images/logo.png">

    <title>Login</title>
    <?php 
    include 'header_links.php'; 
    ?>
    </head>

  <body>
    <div  class="form-signin">
      <div class="text-center mb-4">
        <img class="mb-4" src="static/images/logo.png" alt="" width="100%">
        <!--<h1 class="h3 mb-3 font-weight-normal">Login</h1>-->
      </div>

      <div class="form-label-group">
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputEmail">Email address</label>
      </div>

      <div class="form-label-group">
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <label for="inputPassword">Password</label>
      </div>


      <button class="btn btn-lg btn-primary btn-block" onclick="login()">Sign in</button>
      <div id="error" class="border rounded light border-danger p-3 bg-light text-danger text-center mt-3" style="display: none">Please check your credential!</div>
      <p class="mt-5 mb-3 text-muted text-center">&copy; 2017-2018</p>
      
</div>
  </body>
</html>

<script src="javascript/login.js"></script>
