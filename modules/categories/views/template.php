<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title; ?></title>

        <!-- Bootstrap CSS -->

        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/default.css" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/style.css" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>public/js/action.js"></script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>
        <?php
        $this->load->view('template/top_header.php');
        $this->load->view('template/header.php');
        $this->load->view($main);
        //$this->load->view('categories');
        //$this->load->view('articles');
        ?>
        <!--
        <div class="container-fluid">
            <section class="container">
                <div class="container-page">				
                    <div class="col-md-6">
                        <h3 class="dark-grey">Registration</h3>

                        <div class="form-group col-lg-12">
                            <label>Username</label>
                            <input type="" name="" class="form-control" id="" value="">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Password</label>
                            <input type="password" name="" class="form-control" id="" value="">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Repeat Password</label>
                            <input type="password" name="" class="form-control" id="" value="">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Email Address</label>
                            <input type="" name="" class="form-control" id="" value="">
                        </div>

                        <div class="form-group col-lg-6">
                            <label>Repeat Email Address</label>
                            <input type="" name="" class="form-control" id="" value="">
                        </div>			

                        <div class="col-sm-6">
                            <input type="checkbox" class="checkbox" />Sigh up for our newsletter
                        </div>

                        <div class="col-sm-6">
                            <input type="checkbox" class="checkbox" />Send notifications to this email
                        </div>				

                    </div>

                    <div class="col-md-6">
                        <h3 class="dark-grey">Terms and Conditions</h3>
                        <p>
                            By clicking on "Register" you agree to The Company's' Terms and Conditions
                        </p>
                        <p>
                            While rare, prices are subject to change based on exchange rate fluctuations - 
                            should such a fluctuation happen, we may request an additional payment. You have the option to request a full refund or to pay the new price. (Paragraph 13.5.8)
                        </p>
                        <p>
                            Should there be an error in the description or pricing of a product, we will provide you with a full refund (Paragraph 13.5.6)
                        </p>
                        <p>
                            Acceptance of an order by us is dependent on our suppliers ability to provide the product. (Paragraph 13.5.6)
                        </p>

                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </section>
        </div>
        -->

        <?php
        //$this->load->view('auth/login');
        $this->load->view('template/footer.php');
        ?>
    </body>
</html>