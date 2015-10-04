<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>public/css/bs_leftnavi.css">
<link href="<?php echo base_url(); ?>public/css/bootstrap-tagsinput.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>public/js/bootstrap-tagsinput.js"></script>
<div id="banner">
</div>
<div id="cate-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="breadCrumb0" class="breadCrumb module">
                    <ul>
                        <li>
                            <a href="<?php echo base_url(); ?>">Home</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>phan-mem/tong-hop-c0-s0-l0-a0.html">Tất cả Video</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="nano-content">
                            <h4 id="cate_title">Chủ đề</h4>
                            <ul class="gw-nav gw-nav-list" id="cate">
                                <?php foreach ($categories as $row): ?>
                                    <?php if ($catecurrent != $row['id_categories']) { ?>
                                        <li class="init-arrow-down" alias="<?php echo $row['alias_categories']; ?>" name="<?php echo $row['name_categories']; ?>" value="<?php echo $row['id_categories']; ?>"> <a href="javascript:void(0)"> <span class="gw-menu-text"><?php echo $row['name_categories']; ?></span> <b class="gw-arrow"></b> </a>
                                            <ul class="gw-submenu">                                   
                                                <?php foreach ($row['child'] as $child) { ?>
                                                    <?php if ($catecurrent != $child['id_categories']) { ?>
                                                        <li alias="<?php echo $child['alias_categories']; ?>" name="<?php echo $child['name_categories']; ?>" value="<?php echo $child['id_categories']; ?>"> <a href="javascript:void(0)"> <span class="gw-menu-text"><?php echo $child['name_categories']; ?></span> <b class="gw-arrow"></b> </a></li>
                                                    <?php } else { ?>
                                                        <li class="select" alias="<?php echo $child['alias_categories']; ?>" name="<?php echo $child['name_categories']; ?>" value="<?php echo $child['id_categories']; ?>"> <a href="javascript:void(0)"> <span class="gw-menu-text"><?php echo $child['name_categories']; ?></span> <b class="gw-arrow"></b> </a><li>
                                                        <?php } ?>
                                                    <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } else { ?>
                                        <li class="init-arrow-down select" alias="<?php echo $row['alias_categories']; ?>" name="<?php echo $row['name_categories']; ?>" value="<?php echo $row['id_categories']; ?>"> <a href="javascript:void(0)"> <span class="gw-menu-text"><?php echo $row['name_categories']; ?></span> <b class="gw-arrow"></b> </a>
                                            <ul class="gw-submenu">
                                                <?php foreach ($row['child'] as $child) { ?>
                                                    <li alias="<?php echo $child['alias_categories']; ?>" name="<?php echo $child['name_categories']; ?>"value="<?php echo $child['id_categories']; ?>"> <a href="javascript:void(0)"> <span class="gw-menu-text"><?php echo $child['name_categories']; ?></span> <b class="gw-arrow"></b> </a></li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>

                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <!---

--->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="nano-content">
                            <h4 id="soft_title">Phần mềm</h4>
                            <ul class="gw-nav gw-nav-list" id="soft">
                                <?php foreach ($soft as $row) { ?>
                                    <?php if ($softcurrent != $row['id']) { ?>
                                        <li alias="<?php echo $row['alias']; ?>"name="<?php echo $row['name']; ?>"  value="<?php echo $row['id']; ?>" ><a href="javascript:void(0)"> <span class="gw-menu-text"><?php echo $row['name']; ?></span></a></li>
                                    <?php } else { ?>
                                        <li alias="<?php echo $row['alias']; ?>" name="<?php echo $row['name']; ?>" value="<?php echo $row['id']; ?>" class="select"><a href="javascript:void(0)"> <span class="gw-menu-text"><?php echo $row['name']; ?></span></a></li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="nano-content">
                            <h4 id="level_title">Trình độ</h4>
                            <ul class="gw-nav gw-nav-list" id="level">
                                <?php foreach ($level as $row) { ?>
                                    <?php if ($levelcurrent != $row['id']) { ?>
                                        <li alias="<?php echo $row['alias']; ?>" name="<?php echo $row['name']; ?>" value="<?php echo $row['id']; ?>" ><a href="javascript:void(0)"> <span class="gw-menu-text"><?php echo $row['name']; ?></span></a></li>
                                    <?php } else { ?>
                                        <li alias="<?php echo $row['alias']; ?>" name="<?php echo $row['name']; ?>"value="<?php echo $row['id']; ?>" class="select"><a href="javascript:void(0)"> <span class="gw-menu-text"><?php echo $row['name']; ?></span></a></li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="nano-content">
                            <h4>Tác giả</h4>
                            <ul class="gw-nav gw-nav-list" id="auth">

                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-9">
                <div class="panel">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="num_result">
                                    <p>Có <b></b> kết quả</p>
                                </div>
                                <div class="tags_cate">
                                    <input id="tags_cate" disabled />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="video_body">
                            <!---
                            <?php foreach ($news as $new) { ?>                                                                                                      </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                         </a>
                            <?php } ?>
                             --->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var search = '<?php echo $sSearch; ?>';
    $(document).ready(function () {
        $("#breadCrumb0").jBreadCrumb();
        $(document).off('click', '.soft span').on('click', '.soft span', function () {
            $('#soft li.select').removeClass('select');
            select();
            add_tag();
            getdata();
        });
        $(document).off('click', '.cate span').on('click', '.cate span', function () {
            $('#cate li.select').removeClass('select');
            select();
            add_tag();
            getdata();
        });
        $(document).off('click', '.level span').on('click', '.level span', function () {
            $('#level li.select').removeClass('select');
            select();
            add_tag();
            getdata();
        });
        $(document).off('click', '.auth span').on('click', '.auth span', function () {
            $('#auth li.select').removeClass('select');
            select();
            add_tag();
            getdata();
        });
        $(document).off('click', '.search span').on('click', '.search span', function () {
            search = '';
            select();
            add_tag();
            getdata();
        });

        $(document).off('click', '.gw-nav li').on('click', '.gw-nav li', function (e) {
            e.stopPropagation();
            $(this).parents('.gw-nav').find('li.select').removeClass('select');
            $(this).addClass('select');
            if ($(this).parents('#auth').length > 0) {
                add_tag();
                show_video();
                select();
                $('body,html').animate({
                    scrollTop: 0
                }, 800);
                return false;
            }
            if ($(this).parents('#cate').length > 0) { /// click vao cate
                var cate = $(this).parents('#cate').find('li.select').attr('value');
                $.ajax({
                    url: '<?php echo base_url() ?>user/get_sofware/' + cate,
                    dataType: 'JSON',
                    success: function (result) {
                        var arr = '';
                        $.each(result, function (index, value) {
                            arr += '<li alias="' + value["alias"] + '" name="' + value["name"] + '" value="' + value["id"] + '" ><a href="javascript:void(0)"> <span class="gw-menu-text">' + value["name"] + '</span></a></li>';
                        });
                        $("#soft").empty();
                        $("#soft").append(arr);
                    }
                });
            }
            nav();
            add_tag();
            getdata();
        });
        nav();
        add_tag();
        getdata();
        /*
         $(document).on('click', '.tag > span', function() {
         $(this).parent().remove();
         
         });
         */
    });
    ////////End document ready//////////
    var dataresult = [];
    function add_tag() {
        var tags = $('#tags_cate');
        tags.tagsinput({
            tagClass: function (item) {
                switch (item.type) {
                    case 'cate'   :
                        return 'label label-danger cate';
                    case 'soft'  :
                        return 'label label-primary soft';
                    case 'level':
                        return 'label label-success level';
                    case 'auth'   :
                        return 'label label-warning auth';
                    case 'search'   :
                        return 'label label-default search';
                }
            },
            itemValue: 'value',
            itemText: 'text',
            maxTags: 5,
            allowDuplicates: true
        });
        tags.tagsinput('removeAll');
        var id_cate = $("#cate li.select").attr('value');
        var name_cate = $("#cate li.select").attr('name');
        var id_soft = $("#soft li.select").attr('value');
        var name_soft = $("#soft li.select").attr('name');
        var id_level = $("#level li.select").attr('value');
        var name_level = $("#level li.select").attr('name');
        var id_auth = $("#auth li.select").attr('value');
        var name_auth = $("#auth li.select").attr('name');
        if (id_cate != undefined) {
            tags.tagsinput('add', {value: id_cate, text: name_cate, type: 'cate'});
        } else {
            tags.tagsinput('add', {value: '', text: 'Chủ đề', type: 'cate'});
        }
        if (id_soft != undefined) {
            tags.tagsinput('add', {value: id_soft, text: name_soft, type: 'soft'});
        } else {
            tags.tagsinput('add', {value: '', text: 'Phần mềm', type: 'soft'});
        }
        if (id_level != undefined) {
            tags.tagsinput('add', {value: id_level, text: name_level, type: 'level'});
        } else {
            tags.tagsinput('add', {value: '', text: 'Trình độ', type: 'level'});
        }
        if (id_auth != undefined) {
            tags.tagsinput('add', {value: id_auth, text: name_auth, type: 'auth'});
        } else {
        }
        if (search != '') {
            tags.tagsinput('add', {value: search, text: search, type: 'search'});
        }
    }
    function getdata() {
        var tags = $('#tags_cate');
        var data = tags.tagsinput('items');
        $.ajax({
            url: '<?php echo base_url() ?>user/get_video/',
            data: {data: JSON.stringify(data)},
            dataType: 'JSON',
            beforeSend: function (xhr) {
                var html = '<img src="<?php echo base_url(); ?>public/images/please_wait_final.gif" alt = "" class="img-responsive loading">';
                $('.video_body').html(html);
            },
            success: function (result) {
                var array = [];
                dataresult = result;
                $('#auth').empty();
                $.each(result, function (key, val) {
                    var name = val['username'];
                    if ($.inArray(name, array) != -1) {
                        var val = $('#auth li[name="' + name + '"] .badge').text();
                        $('#auth li[name="' + name + '"] .badge').text(++val);
                    } else {
                        array.push(name);
                        var add = '<li name="' + val['username'] + '" value="' + val['id_auth'] + '" ><a href="javascript:void(0)"><span class="gw-menu-text">' + val['username'] + '</span><span class="gw-menu-text badge pull-right">1</span></a></li>';
                        $('#auth').append(add);
                    }
                });
                //console.log(result);

                show_video();
            }
        });
    }
    function show_video() {
        var html = '';
        var name = $("#auth li.select").attr("name");
        console.log(dataresult);
        var num = 0;
        $.each(dataresult, function (key, val) {
            if (name == val['username'] || name == undefined) {
                html += '<a href="<?php echo base_url(); ?>video/' + val['id_news'] + '-' + val['alias'] + '.html" class="row">';
                html += '<div class="col-lg-4 col-sm-4 col-xs-12"><div class="thumbs_div">';
                html += '<img src="<?php echo base_url(); ?>public/upload/thumbs/' + val['img'] + '" alt = "" class="img-responsive">';
                html += '<span class="icon-play-cate"> </span></div></div><div class="col-lg-8 col-sm-8 col-xs-12 video_body-content">';
                html += '<h4 class="video_body-heading" title="' + val['title'] + '" style="color:#337ab7;">' + val['title'] + ' </h4>';
                html += '<p class="video_body-text" >' + val['description'] + ' </p>';
                html += '<p class="video_body-auth">';
                html += '<span class="glyphicon glyphicon-user"></span>' + val['username'] + '</p>';
                html += '<ul class="list-inline"><li><span></span>' + val['views'] + ' lượt xem </li> <p class="pull-right"><span class="glyphicon glyphicon-time"></span> <abbr class="timeago" title="' + val['date'] + '"></abbr> <i class="glyphicon glyphicon-comment"></i> ' + val['numcomments'] + ' Comments</p> </ul></div><div class="col-md-12"><hr></div></a>';
                num++;
            }
        });
        $('.video_body').html(html);
        $('.num_result b').html(num);
        $('.video_body').find('.video_body-heading').each(function (index, element) {
            $clamp(element, {clamp: 1});
        });
        $('.video_body').find('.video_body-text').each(function (index, element) {
            $clamp(element, {clamp: 2});
        });
        $("abbr.timeago").timeago();
    }
    ////////
    function select() {
        $.each($('.gw-nav'), function () {
            if ($(this).find("li").hasClass('select')) {
                var gw_nav = $(this);
                gw_nav.prev().removeClass("active");
                gw_nav.find('li').removeClass('active');
                var select = gw_nav.find('li.select');
                select.addClass('active');
                var ulDom = select.find('.gw-submenu')[0];
                if (ulDom == undefined) {
                    gw_nav.find('li.init-arrow-up').removeClass('init-arrow-up').addClass('arrow-down');
                    gw_nav.find('li.up').removeClass('up').addClass('arrow-down');
                    gw_nav.find('li.arrow-up').removeClass('arrow-up').addClass('arrow-down');
                    select.parent().parent().removeClass('init-arrow-down');
                    select.parent().parent().removeClass('arrow-down');
                    select.parent().parent().addClass('parentselect');
                    select.parent().parent().find('ul').slideDown();
                } else {
                    gw_nav.find('li.init-arrow-up').removeClass('init-arrow-up').addClass('arrow-down');
                    gw_nav.find('li.up').removeClass('up').addClass('arrow-down');
                    gw_nav.find('li.arrow-up').removeClass('arrow-up').addClass('arrow-down');
                    select.removeClass('init-arrow-down');
                    select.removeClass('arrow-down');
                    select.addClass('arrow-up');
                    select.addClass('parentselect');
                    select.find('ul').slideDown();
                }
            } else {
                var gw_nav = $(this);
                gw_nav.prev().addClass("active");
                gw_nav.find('li').removeClass('active');
            }
            var notsub = $(this).find("li:not(:has(li))");
            var sub = $(this).find("li:has(li)");
            notsub.removeClass('init-arrow-down');
            notsub.removeClass('arrow-down');
            notsub.removeClass('arrow-up');
            //sub.removeClass('init-arrow-down'); 
        });

    }
    //////////
    var nav = function () {
        select();
        $('.gw-nav > li').unbind('hover').hover(function () {
            if ($(this).hasClass('parentselect')) {
                select();
            } else {
                var gw_nav = $('.gw-nav');
                gw_nav.find('li').removeClass('active');
                var checkElement = $(this);
                var ulDom = checkElement.find('.gw-submenu')[0];
                if (ulDom == undefined) {
                    checkElement.addClass('active');
                    $('.gw-nav').find('li').not('.parentselect').find('ul:visible').slideUp();
                    select();
                    return false;
                } else {
                    if (ulDom.style.display != 'block') {
                        gw_nav.find('li').not('.parentselect').find('ul:visible').slideUp();
                        gw_nav.find('li.init-arrow-up').not('.parentselect').removeClass('init-arrow-up').addClass('arrow-down');
                        gw_nav.find('li.up').removeClass('up').addClass('arrow-down');
                        gw_nav.find('li.arrow-up').not('.parentselect').removeClass('arrow-up').addClass('arrow-down');
                        checkElement.removeClass('init-arrow-down');
                        checkElement.removeClass('arrow-down');
                        checkElement.addClass('arrow-up');
                        checkElement.addClass('active');
                        checkElement.find('ul').slideDown(300);
                    } else {
                        checkElement.removeClass('init-arrow-up');
                        checkElement.removeClass('up');
                        checkElement.removeClass('arrow-up');
                        checkElement.removeClass('active');
                        checkElement.addClass('arrow-down');
                        checkElement.find('ul').slideUp(300);
                    }
                }
                select();
            }
        });
        //// Remove tag
    };
</script>