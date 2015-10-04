
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/black-tie/jquery-ui.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/theme-default.css" />
<div class="container-fluid">
    <section class="container">
        <div class="container-page">
            <form action="<?php echo base_url(); ?>auth/create_user" id="form-a"method="post" class="form-horizontal">
                <h3 class="dark-grey">Đăng kí tài khoản</h3>
                <div id="infoMessage"><?php echo $message; ?></div>
                <div class="form-group">
                    <label class="control-label col-md-2">Họ</label>
                    <div class="col-md-8">
                        <input name="first_name" class="form-control" type="text" data-validation="required" />
                    </div>
                </div>  

                <div class="form-group">
                    <label class="control-label col-md-2">Tên</label>
                    <div class="col-md-8">
                        <input name="last_name" class="form-control" type="text" data-validation="required"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Tên đăng nhập</label>
                    <div class="col-md-8">
                        <input name="username" class="form-control" type="text" data-validation="server" data-validation-url="<?php echo base_url(); ?>auth/username_check" />
                        <p class="help-block">Tên đăng nhập vào website </p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Mật khẩu</label>
                    <div class="col-md-8">
                        <input name="password" class="form-control" type="password" data-validation="length" data-validation-length="min6" data-validation-error-msg="Mật khẩu phải trên 6 kí tự"/>
                        <p class="help-block">Mật khẩu dùng để đăng nhập vào website</p>
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Nhắc lại Mật khẩu</label>
                    <div class="col-md-8">
                        <input name="password_confirm" class="form-control" type="password" data-validation="confirmation" data-validation-confirm="password" data-validation-error-msg="Mật khẩu lặp lại không đúng"/>
                    </div>

                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Email</label>
                    <div class="col-md-8">
                        <input name="email" class="form-control" data-validation="server" data-validation-url="<?php echo base_url(); ?>auth/email_check" />
                        <p class="help-block">Email dùng để Active tài khoản </p>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-2">Nhắc lại Email</label>
                    <div class="col-md-8">
                        <input name="email_confirm" class="form-control" data-validation="confirmation" data-validation-confirm="email" data-validation-error-msg="Email lặp lại không đúng"/>
                    </div>

                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Phone</label>
                    <div class="col-md-8">
                        <input name="phone" type="text" data-validation="number" class="form-control" data-validation-error-msg="Định dạng số không đúng" />
                        <p class="help-block">Số điện thoại của bạn</p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">Địa chỉ</label>
                    <div class="col-md-8">
                        <input name='address' type="text" data-validation="required" class="form-control"  />
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2" id="capcha"></label>
                    <div class="col-md-8">
                        <input class="form-control" id="spamcheck" type="text" name="spamcheck" data-validation="spamcheck" data-validation-captcha="7" data-validation-error-msg="Câu trả lời không đúng">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-offset-2 col-xs-8">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.1/jquery.form-validator.min.js"></script>
<script>
    (function($, window) {
        var x = Math.floor((Math.random() * 10) + 1);
        var y = Math.floor((Math.random() * 10) + 1);
        $("#capcha").text(x + ' + ' + y + ' =');
        $("#spamcheck").attr('data-validation-captcha', x + y);
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

        window.applyValidation(true, '#form-a', 'top');


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