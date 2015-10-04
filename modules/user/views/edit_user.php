<?php $baseurl = base_url(); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/black-tie/jquery-ui.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/theme-default.css" />
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
                        <li class="active">
                            <a href="<?php echo base_url() . 'edit-user-' . $user->id; ?>.html">
                                <i class="glyphicon glyphicon-user"></i>
                                Thay đổi thông tin </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url() . 'doi-pass-' . $user->id; ?>.html">
                                <i class="glyphicon glyphicon-lock"></i>
                                Thay đổi mật khẩu </a>
                        </li>
                        <li>
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
                <form class="form-horizontal" id="form1" action="<?php echo $baseurl; ?>auth/edit_user/<?php echo $id; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-lg-2">Họ:<span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <input class="form-control" name="first_name" value="<?php echo $user->first_name; ?>" data-validation="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Tên: <span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <input class="form-control" name="last_name" value="<?php echo $user->last_name; ?>" data-validation="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Địa chỉ:<span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <textarea class="form-control" name="address" rows="3" value="" data-validation="required"><?php echo $user->address; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Điện thoại: <span class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <input class="form-control" name="phone"value="<?php echo $user->phone; ?>" data-validation="number" data-validation-error-msg="Định dạng số không đúng">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-lg-2">Hình đại diện: <span class="text-danger"></span></label>
                        <div class="col-lg-7">
                            <input class="form-control" name="img" type="file" data-validation="mime size" 
                                   data-validation-allowing="jpg, png, gif" 
                                   data-validation-max-size="2M"  data-validation-error-msg-size="File ảnh quá 2mb"
                                   data-validation-error-msg-mime="Định dạng ảnh không đúng"/>
                        </div>
                    </div>
                    <?php echo form_hidden('id', $user->id); ?>

                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-7">
                            <button type="submit" class="btn btn-primary">Sửa</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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
                    alert("Nhập đúng đầy đủ thông tin");
                },
                onSuccess: function($form) {

                }
            });
        };

        $('#text-area').restrictLength($('#max-len'));

        window.applyValidation(true, '#form1', 'element');


        // Load one module outside $.validate() even though you do not have to
        $.formUtils.loadModules('date' + dev + '.js', false, false);

        $('input').on('beforeValidation', function() {
            console.log('About to validate input "' + this.name + '"');
        }).on('validation', function(evt, isValid) {
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
<!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->
