<?php
$user_id = $this->session->userdata('user_id');
$username = $this->session->userdata('username');
$session = $this->session->userdata('__ci_last_regenerate');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="<?php echo base_url(); ?>public/images/favicon.png" type="image/png" sizes="32x32">
        <title><?php echo $title; ?></title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/default.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/BreadCrumb.css" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>public/css/social-share-kit.css" type="text/css">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="<?php echo base_url(); ?>public/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>public/js/bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>public/js/action.js"></script>
        <script src="<?php echo base_url(); ?>public/ckeditor/ckeditor.js"></script>
        <script src="<?php echo base_url(); ?>public/js/timeago.js"></script>
        <script src="<?php echo base_url(); ?>public/js/jquery.jBreadCrumb.1.1.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>public/js/clamp.js" type="text/javascript"></script>   
        <script src="<?php echo base_url(); ?>public/js/social-share-kit.min.js" type="text/javascript"></script>  
        <script type="text/javascript" src="<?php echo base_url(); ?>public/flowplayer/flowplayer-3.2.13.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>

        <script>
            $(document).ready(function() {
                var session = '<?= $session; ?>';
                var user = '<?= $user_id; ?>';
                var page = $(location).attr('pathname');
                $.ajax({
                    url: '<?php echo base_url(); ?>user/trackuser',
                    data: {session: session, user: user, page: page},
                    success: function(data) {
                        console.log(data);
                    }
                })
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 50) {
                        $('#back-to-top').fadeIn();
                    } else {
                        $('#back-to-top').fadeOut();
                    }
                });
                // scroll body to 0px on click
                $('#back-to-top').click(function() {
                    $('#back-to-top').tooltip('hide');
                    $('body,html').animate({
                        scrollTop: 0
                    }, 800);
                    return false;
                });
                $('#back-to-top').tooltip('show');
                // Just to disable href for other example icons
                $('.ssk').on('click', function(e) {
                    e.preventDefault();
                });
            });
        </script>
        <?php
        //print_r($accounts);
        $user_id = $this->session->userdata('user_id');
        $username = $this->session->userdata('username');
        $this->load->view('template/top_header.php');
        $this->load->view('template/header.php');
        $this->load->view($main);
        //$this->load->view('categories');
        //$this->load->view('articles');
        ?>

        <?php
        //$this->load->view('auth/login');
        $this->load->view('template/footer.php');
        ?>
        <a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
        <!-- Left & centered positioning -->
        <div class="ssk-sticky ssk-left ssk-center ssk-md">
            <a href="" class="ssk ssk-facebook"></a>
            <a href="" class="ssk ssk-google-plus"></a>
        </div>
        <script type="text/javascript">
            SocialShareKit.init({
                url: '<?= current_url(); ?>',
                text: 'Chia sẽ mạng xã hội',
            });
        </script>
    </body>
</html>