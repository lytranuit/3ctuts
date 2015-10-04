<style>
    #menu .dropdown-menu{
        margin-left: -15px;
        background-image: linear-gradient(bottom, #D7D7D7 10%, #FCFCFC 65%);
        background-image: -o-linear-gradient(bottom, #D7D7D7 10%, #FCFCFC 65%);
        background-image: -moz-linear-gradient(bottom, #D7D7D7 10%, #FCFCFC 65%);
        background-image: -webkit-linear-gradient(bottom, #D7D7D7 10%, #FCFCFC 65%);
        background-image: -ms-linear-gradient(bottom, #D7D7D7 10%, #FCFCFC 65%);

        background-image: -webkit-gradient(
            linear,
            left bottom,
            left top,
            color-stop(0.1, #D7D7D7),
            color-stop(0.65, #FCFCFC)
            );  
    }
</style>
<header id="header">
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#menu">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div class="navbar-collapse collapse" id="menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown dropdown-large "><a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon-th-large glyphicon"></span> Thư Viện<span class="caret"></span></a>
                        <ul class="dropdown-menu container" style="">
                            <div class="col-xs-3">
                                <ul class="nav nav-tabs tabs-left root">
                                    <?php foreach ($library as $row) { ?>
                                        <li title="<?php echo base_url() . $row['aliasparent'] . '-c' . $row['idparent'] . '-s0-l0-a0.html'; ?>"><a href="#<?php echo $row['idparent']; ?>" data-toggle="tab"><?php echo $row['nameparent']; ?></a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="col-xs-9">
                                <div class="tab-content">
                                    <?php foreach ($library as $row) { ?>
                                        <div class="tab-pane row" id="<?php echo $row['idparent']; ?>">
                                            <div class="col-xs-6 lib-li">
                                                <ul><h2>Chủ đề</h2>
                                                    <?php foreach ($row['child'] as $child) { ?>
                                                        <li>
                                                            <a href="<?php echo base_url() . $row['aliasparent'] . '/' . $child['aliascon'] . '-c' . $child['idcon'] . '-s0-l0-a0.html'; ?>"><?php echo $child['namecon']; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <div class="col-xs-6 lib-li">
                                                <ul><h2>Phần mềm</h2>
                                                    <?php foreach ($row['soft'] as $soft) { ?>
                                                        <li>
                                                            <a href="<?php echo base_url() . $row['aliasparent'] . '/' . $soft['aliassoft'] . '-c' . $row['idparent'] . '-s' . $soft['idsoft'] . '-l0-a0.html'; ?>"><?php echo $soft['namesoft']; ?></a>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </ul>
                    </li>
                    <li>
                        <form class="navbar-form navbar-left" role="search" action="<?php echo base_url() . 'tim-kiem/'; ?>">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search" name="q">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (!$this->ion_auth->logged_in()) {
                        ?>
                        <li class="dropdown"><a href="<?php echo base_url(); ?>dang-ki">Đăng kí</a></li>
                        <li class="dropdown"><a href="<?php echo base_url(); ?>dang-nhap" >Đăng nhập</a></li>

                    <?php } else { ?>
                        <li class="dropdown qluser" title="<?php echo base_url(); ?>edit-user-<?php echo $this->session->userdata('user_id'); ?>.html"><a href = "" class = "dropdown-toggle" data-toggle = "dropdown"><span
                                    class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('username'); ?> <sapn class = "caret"></span></a>
                            <ul class = "dropdown-menu">
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url(); ?>create-video.html"><span class="glyphicon glyphicon-film"></span> Đăng Video</a></li>
                                <li class="divider"></li>
                                <li><a href="<?php echo base_url(); ?>log-out.html"><span class="glyphicon-off glyphicon"></span> Thoát</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
                <!--
               <form class="navbar-form navbar-right" role="search">
                   <button id='search-button' class='btn btn-default '><span class='glyphicon glyphicon-search'></span></button>
    
                   <input type="text" id='search-form'class="form-control" placeholder="Search" >
               </form>
                -->
            </div>

        </div>
    </nav>
</header>
<script type='text/javascript'>
    // When your page loads
    $(function () {
        // When the toggle areas in your navbar are clicked, toggle them
        $(".root li").click(function () {
            var link = $(this).attr('title');
            window.location = link;
        })
        $(".qluser").click(function () {
            var link = $(this).attr('title');
            window.location = link;
        })
    })
</script>