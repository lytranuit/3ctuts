<?php $baseurl = base_url(); ?>
<div class="container scale">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?php echo base_url() . 'public/upload/thumbs/' . $user->img_user; ?>" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <?php echo $user->username; ?>
                    </div>

                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->

                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li>
                            <a href="">
                                <i class="glyphicon glyphicon-home"></i>
                                Trang chủ </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . 'edit-user-' . $user->id; ?>.html">
                                <i class="glyphicon glyphicon-user"></i>
                                Thay đổi thông tin </a>
                        </li>
                         <li>
                            <a href="<?php echo base_url() . 'doi-pass-' . $user->id; ?>.html">
                                <i class="glyphicon glyphicon-lock"></i>
                                Thay đổi mật khẩu </a>
                        </li>
                        <li class="active">
                            <a href="<?php echo base_url() . "video-manager-$user->id"; ?>.html">
                                <i class="glyphicon glyphicon-folder-open"></i>
                                Video của tôi </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>create-video.html">
                                <i class="glyphicon glyphicon-film"></i>
                                Đăng Video </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9">
            <div class="profile-content">
                <div class="row">
                    <?php foreach ($videos as $video) { ?>
                        <a href="<?php echo base_url() . 'video/'.$video['id_news'] . '-' . $video['alias'] . '.html'; ?>">
                            <div class="video_manager">
                                <div class="media col-md-3">
                                    <figure class="pull-left">
                                        <img class="media-object img-responsive"  src="<?php echo base_url() . 'public/upload/thumbs/' . $video['img']; ?>" alt="" >
                                    </figure>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="list-group-item-heading"> <?php echo $video['title']; ?> </h4>
                                    <p class="list-group-item-text"> <?php echo $video['description']; ?></p>
                                </div>
                                <div class="col-md-3 text-center">
                                    <a href="<?php echo base_url() . 'user/video_edit/' . $video['id_news']; ?>"> <button type="button" class="btn btn-default btn-lg btn-block"> Chỉnh sửa </button></a>
                                    <a href="<?php echo base_url() . 'user/video_remove/' . $video['id_news']; ?>"> <button type="button" class="btn btn-default btn-lg btn-block"> Xóa </button></a>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                </div>
                            </div>
                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
