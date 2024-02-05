<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/logo.png" rel="icon">
    <title>RuangAdmin - Login</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/ruang-admin.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f2f2f2; /* Use your preferred shade of gray */
        }

        .bg-gradient-login {
            background: linear-gradient(180deg, #f2f2f2 10%, #e6e6e6 100%);
        }

        .container-login {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }
    </style>

</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-12 col-md-9">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login</h1>
                                    </div>
                                    <form method="post" action="<?= base_url('home/aksi_login') ?>">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control" id="exampleInputEmail"
                                                aria-describedby="emailHelp" placeholder="Enter Username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control"
                                                id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <input type="hidden" name="num1" value="<?php echo $num1 ?>">
                                            <input type="hidden" name="num2" value="<?php echo $num2 ?>">
                                            <input for="captcha" type="text" class="form-control" id="captcha"
                                                name="captcha_answer"
                                                placeholder="What is <?php echo $num1 ?> + <?php echo $num2 ?>?">
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script src="<?php echo  base_url('vendor/jquery/jquery.min.js')?>"></script>
    <script src="<?php echo  base_url('vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?php echo  base_url('vendor/jquery-easing/jquery.easing.min.js')?>"></script>
    <script src="<?php echo  base_url('js/ruang-admin.min.js')?>"></script>
</body>

</html>