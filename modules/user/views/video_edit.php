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
                <form class="form-horizontal" id="fileupload" action="" method="post">
                    <div class="form-group">
                        <label class="control-label col-lg-2">Hiện thị</label>
                        <div class="col-lg-8">
                            <label class="radio-inline">
                                <?php if ($video[0]['show'] == 1) { ?>
                                    <input type="radio" name="show" value="1" checked> Có
                                <?php } else { ?>
                                    <input type="radio" name="show" value="1"> Có
                                <?php } ?>
                            </label>
                            <label class="radio-inline">
                                <?php if ($video[0]['show'] == 0) { ?>
                                    <input type="radio" name="show" value="0" checked> Không
                                <?php } else { ?>
                                    <input type="radio" name="show" value="0"> Không
                                <?php } ?>
                            </label>
                        </div>
                    </div>
                    <!-- The file upload form used as target for the file upload widget -->
                    <div class="form-group">
                        <label class="control-label col-lg-2">Tiêu đề:<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input class="form-control" name="title" value="<?php echo $video[0]['title']; ?>" data-validation="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Mô tả: <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <textarea class="form-control" name="description" rows="3" value=""  data-validation="required"><?php echo $video[0]['description']; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Chuyên mục</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="categories" id="categories" data-validation="required">
                                <option value="">Chọn chuyên mục</option>
                                <?php foreach ($categories as $row): ?>
                                    <?php if ($video[0]['id_categories'] != $row['id_categories']) { ?>
                                        <option value="<?php echo $row['id_categories']; ?>"><?php echo $row['name_categories']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $row['id_categories']; ?>" selected=""><?php echo $row['name_categories']; ?></option>
                                    <?php } ?>
                                    <?php foreach ($row['child'] as $child) { ?>
                                        <?php if ($video[0]['id_categories'] != $child['id_categories']) { ?>
                                            <option value="<?php echo $child['id_categories']; ?>">&nbsp;&nbsp;&nbsp;<?php echo $child['name_categories']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $child['id_categories']; ?>" selected="">&nbsp;&nbsp;&nbsp;<?php echo $child['name_categories']; ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Phần mềm</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="software" id="software" data-validation="required">
                                <option value="">Chọn software</option>
                                <?php foreach ($software as $row): ?>
                                    <?php if ($video[0]['id_software'] != $row['id']) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $row['id']; ?>" selected=""><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                <?php endforeach
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Trình độ</label>
                        <div class="col-lg-8">
                            <select class="form-control" name="level" data-validation="required">
                                <option value="">Chọn Trình độ</option>
                                <?php foreach ($level as $row): ?>
                                    <?php if ($video[0]['id_level'] != $row['id']) { ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $row['id']; ?>" selected=""><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Nội dung:<span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <textarea class="form-control" name="content" id="content" rows="3" value=""><?php echo $video[0]['content']; ?></textarea>
                        </div>
                    </div>
                    <?php echo form_hidden('type_up', 'video'); ?>
                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-8">
                            <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#categories").change(function() {
            var cate = $(this).val();
            $.ajax({
                url: '<?php echo base_url() ?>user/get_sofware/' + cate,
                dataType: 'JSON',
                success: function(result) {
                    var arr;
                    $.each(result, function(index, value) {
                        arr += '<option value="' + value["id"] + '">' + value["name"] + '</option>'
                    });
                    $("#software").html(arr);
                }
            });
        });
        if (CKEDITOR.instances['content']) {
            CKEDITOR.remove(CKEDITOR.instances['content']);
        }
        CKEDITOR.replace('content', {});

    });

</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.1/jquery.form-validator.min.js"></script>

<script>
    (function($, window) {

        var dev = '.dev'; //window.location.hash.indexOf('dev') > -1 ? '.dev' : '';

        // setup datepicker
        $("#datepicker").datepicker();

        // Add a new validator
        $.formUtils.addValidator({
            name: 'even_number',
            validatorFunction: function(value, $el, config, language, $form) {
                return parseInt(value, 10) % 2 === 0;
            },
            borderColorOnError: '',
            errorMessage: 'You have to give an even number',
            errorMessageKey: 'badEvenNumber'
        });

        window.applyValidation = function(validateOnBlur, forms, messagePosition) {
            if (!forms)
                forms = 'form';
            if (!messagePosition)
                messagePosition = 'top';

            $.validate({
                form: forms,
                language: {
                    requiredFields: 'Không được bỏ trống'
                },
                validateOnBlur: validateOnBlur,
                errorMessagePosition: messagePosition,
                scrollToTopOnError: true,
                lang: 'sv',
                // borderColorOnError : 'purple',
                modules: 'security' + dev + ', location' + dev + ', sweden' + dev + ', html5' + dev + ', file' + dev + ', uk' + dev,
                onModulesLoaded: function() {
                    $('#country-suggestions').suggestCountry();
                    $('#swedish-county-suggestions').suggestSwedishCounty();
                    $('#password').displayPasswordStrength();
                },
                onValidate: function($f) {

                    console.log('about to validate form ' + $f.attr('id'));

                    var $callbackInput = $('#callback');
                    if ($callbackInput.val() == 1) {
                        return {
                            element: $callbackInput,
                            message: 'This validation was made in a callback'
                        };
                    }
                },
                onError: function($form) {
                    alert("Đăng kí không thành công");
                },
                onSuccess: function($form) {

                }
            });
        };

        $('#text-area').restrictLength($('#max-len'));

        window.applyValidation(true, '#fileupload', 'element');


        // Load one module outside $.validate() even though you do not have to
        $.formUtils.loadModules('date' + dev + '.js', false, false);

        $('input')
                .on('beforeValidation', function() {
                    console.log('About to validate input "' + this.name + '"');
                })
                .on('validation', function(evt, isValid) {
                    var validationResult = '';
                    if (isValid === null) {
                        validationResult = 'not validated';
                    } else if (isValid) {
                        validationResult = 'VALID';
                    } else {
                        validationResult = 'INVALID';
                    }
                    console.log('Input ' + this.name + ' is ' + validationResult);
                });

    })(jQuery, window);
</script>