
<?php $this->fb_comments->create(); ?>
<div id="banner">
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Thông báo</h4>
            </div>
            <div class="modal-body">
                <p class="alert">Vui lòng <a href="<?php echo base_url(); ?>dang-nhap">đăng nhập</a> để có thể xem toàn bộ video <br>
                    Hoặc nếu chưa có tài khoản đăng nhập, vui lòng đăng kí miễn phí <a href="<?php echo base_url(); ?>dang-ki">tại đây</a>
                </p>
            </div>

        </div>

    </div>
</div>

<div id="news-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="breadCrumb0" class="breadCrumb module">
                    <ul>
                        <li class="first">
                            <a href="<?php echo base_url(); ?>"></a>
                        </li>
                        <?php foreach ($breadcrumb as $row) { ?>
                            <li>
                                <a href="<?php echo $row['url']; ?>"><?php echo $row['name']; ?></a>
                            </li>
                        <?php } ?>

                    </ul>
                </div>
            </div>

            <div class="col-md-7">
                <article>
                    <?php if ($news[0]['video']) { ?>
                        <a id="player"></a>
                        <script>
                            $(document).ready(function() {
                                var user = '<?php echo $this->ion_auth->logged_in(); ?>';
                                $f("player", "<?php echo base_url(); ?>public/flowplayer/flowplayer-3.2.18.swf", {
                                    plugins: {
                                        secure: {
                                            url: "<?php echo base_url(); ?>public/flowplayer/flowplayer.securestreaming-3.2.9.swf",
                                            timestampUrl: "<?php echo base_url(); ?>public/flowplayer/timestamp.php"
                                        },
                                        controls: {
                                            fullscreen: true,
                                        }
                                    },
                                    clip: {
                                        url: "<?php echo base_url() . 'public/upload/' . $news[0]['video']; ?>", //Change this to any mp3 file in the secure folder
                                        autoPlay: false,
                                        urlResolvers: "secure",
                                        baseUrl: "<?php echo base_url(); ?>",
                                        bufferLength: 3,
                                        autoBuffering: false,
                                        onStart: function(clip) {
                                            if (user == '') {
                                                var duration = parseInt(clip.duration / 2) * 1000;
                                                this.onCuepoint([duration], function(c, cuepoint) {
                                                    this.stop();
                                                    $('#myModal').modal('show');
                                                });
                                            }
                                        },
                                        onSeek: function(clip, pos) {
                                            if (clip.duration / 2 < pos && user == '') {
                                                this.stop();
                                                $('#myModal').modal('show');
                                            }
                                        }
                                    }

                                });
                            });</script>

                    <?php } else { ?>

                    <?php } ?>
                    <div class="panel panel-default video-info">
                        <div class="row">
                            <div class="watch-title col-md-12">
                                <h3><a href=""><span><?php echo $news[0]['title']; ?></span></a></h3>
                            </div>
                            <div class="watch-user col-xs-9">
                                <div>
                                    <a href="" class="a-img-user pull-left"><img src="<?php echo base_url() . 'public/upload/thumbs/' . $news[0]['img_user']; ?>" width="48" height="48"/></a>
                                    <div class="div-w-user"><a href="" class="a-w-user"><?php echo $news[0]['username']; ?></a></div>
                                    <div><span class="glyphicon glyphicon-time"></span> <?php echo date("F j, Y, g:i a", strtotime($news[0]['date'])); ?></div>

                                </div>

                            </div>
                            <div class="watch-add col-xs-3">
                                <div class="watch-social">&nbsp;&nbsp;&nbsp;&nbsp;</div>
                                <div class="watch-view"><span class="pull-right"><?php echo $news[0]['views']; ?> lượt xem</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default" id="content-video">
                        <div class="panel-body">
                            <?php echo $news[0]['content']; ?>
                            <hr>
                            <div class="fb-share-button"data-layout="button" data-href="<?= current_url(); ?>"></div>
                            <div class="fb-like" data-layout="button_count"></div>
                            <!-- Đặt thẻ này vào nơi bạn muốn Nút +1 kết xuất. -->
                            <div class="g-plusone" data-size="medium"></div>
                        </div>
                    </div>
                </article>
                <div class = "well" id="comments">
                    <h4>Bình luận</h4>
                    <div class = "input-group">
                        <input type = "text" id="userComment" class = "form-control input-sm chat-input" placeholder = "Viết bình luận ở đây..." />
                        <input hidden="" id="id_news" value="<?php echo $id_news; ?>">
                        <input hidden="" id="id_user" value="<?php echo $this->session->userdata('user_id'); ?>">
                        <span class = "input-group-btn">
                            <a href = "#" class = "btn btn-primary btn-sm addComment"><span class = "glyphicon glyphicon-comment"></span> Thêm bình luận</a>
                        </span>
                    </div>
                    <hr data-brackets-id = "12673">
                    <ul data-brackets-id = "12674" id = "sortable" class = "list-unstyled ui-sortable row">
                        <?php foreach ($comments as $comment) { ?>
                            <div class="col-md-1 img_comment">
                                <a href="">
                                    <img src="<?php echo base_url() . 'public/upload/thumbs/' . $comment['img_user']; ?>" alt="" class="img-responsive">
                                </a>
                            </div>
                            <div class="col-md-11">
                                <strong class="pull-left primary-font"><?php echo $comment['username']; ?></strong>
                                <small class="pull-right text-muted">
                                    <span class="glyphicon glyphicon-time"></span> <abbr class="timeago" title="<?php echo $comment['date']; ?>"></abbr>
                                </small>
                                </br>
                                <li class="ui-state-default"><?php echo $comment['comment']; ?></li>
                                <hr data-brackets-id = "12673">
                            </div>

                        <?php } ?>
                    </ul>

                </div>
            </div>
            <div class="col-md-5">
                <!--Categories -->
                <!--Latest Posts -->
                <div class = "panel panel-default">
                    <div class="panel-body widget_news_lq">
                        <p>Các Video khác </p>
                        <ul class = "list-group">
                            <?php foreach ($news_lq as $new) { ?>
                                <li class = "news_lq">
                                    <img src="<?php echo base_url() . 'public/upload/thumbs/' . $new['img']; ?>" alt="<?php echo $new['title']; ?>" class="img-responsive thumb_img">
                                    <div class="caption_lq">
                                        <a class="title_lq" href="<?php echo base_url() . 'video/' . $new['id_news'] . '-' . $new['alias'] . '.html'; ?>" alt="<?php echo $new['title']; ?>" title="<?php echo $new['title']; ?>"><span><?php echo $new['title']; ?></span></a>
                                        <p class="user_lq"><span class="glyphicon glyphicon-user"></span> <?php echo $new['username']; ?></p>
                                        <p class="view_lq"><?php echo $new['views']; ?> lượt xem</p>
                                    </div>
                                </li>
                                <hr>
                            <?php } ?>

                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
<?php if ($this->ion_auth->logged_in()) { ?>
            $('.addComment').click(function() {
                var comment = $('#userComment').val();
                var id_news = $('#id_news').val();
                var id_user = $('#id_user').val();
                if (comment != "") {
                    $.ajax({
                        url: '<?php echo base_url(); ?>user/addcomment',
                        data: {comment: comment, id_news: id_news, id_user: id_user},
                        success: function(data) {
                            var add = '<div class="col-md-1 img_comment"><a href=""><img src="<?php echo base_url() . 'public/upload/thumbs/' . $this->session->userdata['img']; ?>" alt="" class="img-responsive"></a></div><div class="col-md-11"><strong class="pull-left primary-font"><?php echo $this->session->userdata['username']; ?></strong><small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span> <abbr class="timeago" title="<?php echo date("Y-m-d h:i:sa"); ?>">1 giây trước</abbr></small></br><li class="ui-state-default">' + comment + '</li><hr data-brackets-id = "12673"></div>';
                            $('#sortable').prepend(add);
                            $("abbr.timeago").timeago();
                        }
                    })
                }
                $('#userComment').val('');
                return false;
            });
            $('#userComment').keypress(function(event) {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    var comment = $('#userComment').val();
                    var id_news = $('#id_news').val();
                    var id_user = $('#id_user').val();
                    if (comment != "") {
                        $.ajax({
                            url: '<?php echo base_url(); ?>user/addcomment',
                            data: {comment: comment, id_news: id_news, id_user: id_user},
                            success: function(data) {
                                var add = '<div class="col-md-1 img_comment"><a href=""><img src="<?php echo base_url() . 'public/upload/thumbs/' . $this->session->userdata['img']; ?>" alt="" class="img-responsive"></a></div><div class="col-md-11"><strong class="pull-left primary-font"><?php echo $this->session->userdata['username']; ?></strong><small class="pull-right text-muted"><span class="glyphicon glyphicon-time"></span> <abbr class="timeago" title="<?php echo date("Y-m-d h:i:sa"); ?>">1 giây trước</abbr></small></br><li class="ui-state-default">' + comment + '</li><hr data-brackets-id = "12673"></div>';
                                $('#sortable').prepend(add);
                                $("abbr.timeago").timeago();
                            }
                        })
                    }
                    $('#userComment').val('');
                    return false;
                }
            });
<?php } else { ?>
            $('#comments .input-group').hide();
<?php } ?>
        $("abbr.timeago").timeago();
        $(this).find('.title_lq > span').each(function(index, element) {
            $clamp(element, {clamp: 2});
        });
    })
</script>
<!-- Đặt thẻ này sau thẻ Nút +1 cuối cùng. -->
<script type="text/javascript">
    window.___gcfg = {lang: 'vi'};

    (function() {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/platform.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
    })();
</script>