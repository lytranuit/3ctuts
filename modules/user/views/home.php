<div id="software-home">
    <div class="container" style="padding: 0px;">
        <div id="solugan">
            <h1> Kết nối đam mê </h1>
        </div>
        <div id="main-software">
            <ul class="da-thumbs">
                <?php $stt = 1; ?>
                <?php foreach ($num_video_software as $row): ?>
                    <li class="bg_thumbs">
                        <a href="<?php echo base_url() .'phan-mem/'. $row['alias']. '-c0-s' . $row['id'] . '-l0-a0' .'.html'; ?>">
                            <div class="card effect__hover view">
                                <div class="card__front">
                                    <img src="<?php echo base_url() . 'public/images/' . $row['img']; ?>" class="img-responsive">
                                </div>
                                <div class="card__back soft<?php echo $row['pos'];?>">
                                    <p > 
                                        <strong><?php echo $row['tong'] ?></strong>
                                        <span>Videos</span>
                                    </p>
                                </div>
                            </div><!-- /card -->
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul> 
        </div>  <!-- end row-->
        <div id="more">
            <a href=""><img src="<?php echo base_url(); ?>public/images/btn-more.png"/></a>
        </div>
    </div>
</div>
<!-- Title -->
<div id="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-first">
                <p> Video Mới </p>
                <hr>
            </div>
            <?php $stt = 1; ?>
            <?php foreach ($software as $soft) { ?>
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <p class="tieude-home"><span><?php echo $soft['name']; ?></span></p>
                    </div>
                    <!-- /.row -->
                    <!-- Page Features -->
                    <div class="carousel slide" id="Carousel<?php echo $stt; ?>">
                        <div class="carousel-inner">
                            <div class="item active">
                                <div class="row list-unstyled video-list-thumbs">
                                    <?php
                                    $ss = 0;
                                    foreach ($soft['videos'] as $video) {
                                        if ($ss > 3) {
                                            ?>
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <div class="item">
                                        <div class="row list-unstyled video-list-thumbs">
                                            <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                <a href="<?php echo base_url() .'video/'. $video['id_news'] . '-' . $video['alias'] . '.html'; ?>" title="<?php echo $video['title']; ?>">
                                                    <img src="<?php echo base_url() . 'public/upload/thumbs/' . $video['img']; ?>" alt="" class="img-responsive" height="130px" />
                                                    <p class="title" id="title-home"><?php echo $video['title']; ?></p>
                                                    <span class="icon-play"></span>
                                                    <span class="duration"></span>
                                                </a>
                                            </li>

                                            <?php
                                            $ss = 1;
                                        } else {
                                            $ss++;
                                            ?> 
                                            <li class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                <a href="<?php echo base_url() .'video/'. $video['id_news'] . '-' . $video['alias'] . '.html'; ?>" title="<?php echo $video['title']; ?>">
                                                    <img src="<?php echo base_url() . 'public/upload/thumbs/' . $video['img']; ?>" alt="" class="img-responsive" height="130px" />
                                                    <p class="title" id="title-home"><?php echo $video['title']; ?></p>
                                                    <span class="icon-play"></span>
                                                    <span class="duration"></span>
                                                </a>
                                            </li>
                                            <?php
                                        }
                                    }
                                    ?>  
                                </div>

                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                    <a class="left carousel-control" href="#Carousel<?php echo $stt; ?>" data-slide="prev"><i class="btn-left"></i></a>
                    <a class="right carousel-control" href="#Carousel<?php echo $stt; ?>" data-slide="next"><i class="btn-right"></i></a>
                </div> <!-- end col-12-->
                <?php
                $stt++;
            }
            ?>

        </div>
    </div>
</div>

<div id="tintuc">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="tieude-home">Tin tức </p>
            </div>
            <!-- /.row -->
            <!-- Page Features -->
            <div class="carousel slide" id="CreoCarousel">
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="row text-center">
                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail">
                                    <img src="http://placehold.it/800x500" alt="">
                                    <div class="caption">
                                        <h3>Feature Label</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                        <p>
                                            <a class="btn btn-mini" href="#">&raquo; Read More</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail">
                                    <img src="http://placehold.it/800x500" alt="">
                                    <div class="caption">
                                        <h3>Feature Label</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                        <p>
                                            <a class="btn btn-mini" href="#">&raquo; Read More</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail">
                                    <img src="http://placehold.it/800x500" alt="">
                                    <div class="caption">
                                        <h3>Feature Label</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                        <p>
                                            <a class="btn btn-mini" href="#">&raquo; Read More</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail">
                                    <img src="http://placehold.it/800x500" alt="">
                                    <div class="caption">
                                        <h3>Feature Label</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                        <p>
                                            <a class="btn btn-mini" href="#">&raquo; Read More</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="item">
                        <div class="row text-center">

                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail">
                                    <img src="http://placehold.it/800x500" alt="">
                                    <div class="caption">
                                        <h3>Feature Label</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                        <p>
                                            <a class="btn btn-mini" href="#">&raquo; Read More</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail">
                                    <img src="http://placehold.it/800x500" alt="">
                                    <div class="caption">
                                        <h3>Feature Label</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                        <p>
                                            <a class="btn btn-mini" href="#">&raquo; Read More</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail">
                                    <img src="http://placehold.it/800x500" alt="">
                                    <div class="caption">
                                        <h3>Feature Label</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                        <p>
                                            <a class="btn btn-mini" href="#">&raquo; Read More</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 hero-feature">
                                <div class="thumbnail">
                                    <img src="http://placehold.it/800x500" alt="">
                                    <div class="caption">
                                        <h3>Feature Label</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                        <p>
                                            <a class="btn btn-mini" href="#">&raquo; Read More</a>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.row -->
                    </div>

                </div>
                <a class="left carousel-control" href="#CreoCarousel" data-slide="prev"><i class="btn-left"></i></a>
                <a class="right carousel-control" href="#CreoCarousel" data-slide="next"><i class="btn-right"></i></a>
            </div>
        </div> <!-- end Container-->
    </div>
</div>