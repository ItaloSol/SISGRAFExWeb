<?php
    session_start();
  if(isset($_SESSION['ESCALA'])){
    echo "<script>window.location = 'login/logout.php'</script>";
  }
    if(isset($_SESSION["usuario"]) && is_array($_SESSION["usuario"])){
        echo "<script>window.location = 'html/painel.php'</script>";
}?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>SISGRAFEx - Login</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="img/logo.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->
    
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <img style = "width: 80px; margin-left: 135px;"src = "http://www.graficadoexercito.eb.mil.br/images/grafex1.png"><br></br>
              <div class="app-brand justify-content-center">
                <a href="index.php" class="app-brand-link gap-2">
                  <span style = "font-size:30px;" class="app-brand-text text-body fw-bolder">SISGRAFEx</span>
                </a>
              </div>
              <!-- /Logo -->
              <?php 
            if(isset($_SESSION['msg'])){
              echo $_SESSION['msg'];
              unset($_SESSION['msg']);
            }  
              ?>
               <?php 
            if(isset($_SESSION['sucesso'])){
              echo $_SESSION['sucesso'];
              unset($_SESSION['sucesso']);
            }  
              ?>
              
              <h4 class="mb-2">Login </h4>
              
              <form id="formAuthentication" class="mb-3" action="login/authentic.php" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Usuário</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="usuario"
                    name="email-username"
                    placeholder="Insira seu usuário "
                    autofocus 
                  />
                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label password" name="password" for="password">Senha</label>
                  
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="Insira a Senha"
                      aria-describedby="password"
                    />
                    
                    <span id="olho"  class="lnr lnr-eye input-group-text cursor-pointer"><i  class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                 
                </div>
                <!-- <div style="margin-left:25px;" class="g-recaptcha" data-sitekey="6Ld7-RMjAAAAAPaO8C8U7cqUhOOvOQn0TIoV3A1Q" require></div> -->
               <br>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Login</button>
                </div>
              
              </form>
                <p class="text-center">

                  <a href="login/tela-recuperacao-senha.php">
                      <small>Esqueceu sua senha?</small>
                    </a>
              </p>
            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

   


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>


    <!-- Captcha --> 
    <script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
 </script>
    <script>
      // CODIGO DO CAPTCHA // NÃO FUNCIONA LOCALHOST
  //   window.onload = function() {
  //   var recaptcha = document.forms["formAuthentication"]["g-recaptcha-response"];
  //   recaptcha.required = true;
  //   recaptcha.oninvalid = function(e) {
  //   // fazer algo, no caso to dando um alert
  //   alert("Por favor complete o captcha");
  //     }
  //  } 
    </script>

   <!-- Senha para Text -->
  <script>
    const btn = document.getElementById('olho');
    const input = document.getElementById('password');
    btn.addEventListener('click', function() { 
      console.log(input.getAttribute('type'))
    if(input.getAttribute('type') === 'password') {
      input.setAttribute('type', 'text');
    } else {
       input.setAttribute('type', 'password');
    }
    });
  </script>



  </body>
</html>
