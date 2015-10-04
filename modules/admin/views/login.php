<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Trang Quản Trị</title>

        <!-- Bootstrap CSS -->

        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/admin.css" />
        <script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <div class="container">
            <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 
                <div class="panel panel-default" >
                    <div class="panel-heading">
                        <div class="panel-title text-center">3ctuts.com</div>
                    </div>     

                    <div class="panel-body" >

                        <form name="form" id="form" autocomplete="off" action="auth/login" class="form-horizontal" enctype="multipart/form-data" method="POST">
                               
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input id="user" type="text" class="form-control" name="identity" value="" placeholder="User">                                        
                            </div>

                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
                            </div>                                                                  

                            <div class="form-group">
                                <!-- Button -->
                                <div class="col-sm-12 controls">
                                    <button type="submit" href="#" class="btn btn-primary pull-right"><i class="glyphicon glyphicon-log-in"></i> Log in</button>                          
                                </div>
                            </div>

                        </form>     

                    </div>                     
                </div>  
            </div>
        </div>

        <div id="particles"></div>
    </body>
</html>