<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>public/css/jquery.fileupload-ui.css">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<div class="row">
    <?php $baseurl = base_url(); ?>
    <h1 class="page-header">Thêm Bài Viết </h1>

    <div class="panel panel-default ">
        <div class="panel-heading">
            Thêm Bài Viết
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#news" data-toggle="tab">Bài Viết</a>
                </li>
                <li><a href="#video" data-toggle="tab">Video</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="news">
                    <hr>
                    <div id="infoMessage"><?php echo $message; ?></div>
                    <form class="form-horizontal" id="form-new" action="" method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="control-label col-lg-2">Tiêu đề:<span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input class="form-control" name="title" value="" data-validation="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Mô tả: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <textarea class="form-control" name="description" rows="3" value="" data-validation="required"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Hình: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input id="img" name="img" type="file" data-validation="required">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Thể loại</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="categories">
                                    <?php foreach ($categories as $row): ?>
                                        <?php if ($row['id_categories'] != 5) { ?>
                                            <option value="<?php echo $row['id_categories']; ?>"><?php echo $row['name_categories']; ?></option>
                                            <?php foreach ($row['child'] as $child) { ?>
                                                <option value="<?php echo $child['id_categories']; ?>">&nbsp;&nbsp;&nbsp;<?php echo $child['name_categories']; ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="<?php echo $row['id_categories']; ?>" selected="">Tổng hợp</option>
                                        <?php } ?>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Loại</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="type">
                                    <?php foreach ($type as $row): ?>
                                        <option value="<?php echo $row['id_type']; ?>"><?php echo $row['name_type']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Nội dung:<span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <textarea class="form-control" name="content" id="content" rows="3" value=""></textarea>
                            </div>
                        </div>


                        <?php echo form_hidden('id_auth', $id_auth); ?>
                        <?php echo form_hidden('type_up', 'news'); ?>
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-8">
                                <button type="submit" class="btn btn-primary">Thêm</button>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="tab-pane fade" id="video">
                    <div id="infoMessage"><?php echo $message; ?></div>
                    <form class="form-horizontal" id="fileupload" action="" method="post" enctype="multipart/form-data">
                        <hr>
                        <!-- The file upload form used as target for the file upload widget -->
                        <div class="form-group">
                            <label class="control-label col-lg-2">Video:<span class="text-danger">*</span></label>
                            <div class="col-lg-10">
                                <div class="row fileupload-buttonbar">
                                    <div class="col-lg-7">
                                        <!-- The fileinput-button span is used to style the file input field as button -->
                                        <span class="btn btn-success fileinput-button">
                                            <i class="glyphicon glyphicon-plus"></i>
                                            <span>Add files...</span>
                                            <input type="file" name="file">
                                        </span>

                                        <!-- The global file processing state -->
                                        <span class="fileupload-process"></span>
                                    </div>
                                    <!-- The global progress state -->
                                    <div class="col-lg-5 fileupload-progress fade">
                                        <!-- The global progress bar -->
                                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                        </div>
                                        <!-- The extended global progress state -->
                                        <div class="progress-extended">&nbsp;</div>
                                    </div>
                                </div>
                                <!-- The table listing the files available for upload/download -->
                                <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>

                                <script id="template-upload" type="text/x-tmpl">
                                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                                    <tr class="template-upload fade">
                                    <td>
                                    <span class="preview"></span>
                                    </td>
                                    <td>
                                    <p class="name">{%=file.name%}</p>
                                    <strong class="error text-danger"></strong>
                                    </td>
                                    <td>
                                    <p class="size">Processing...</p>
                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                                    </td>
                                    <td>
                                    {% if (!i && !o.options.autoUpload) { %}
                                    <button class="btn btn-primary start" disabled>
                                    <i class="glyphicon glyphicon-upload"></i>
                                    <span>Start</span>
                                    </button>
                                    {% } %}
                                    {% if (!i) { %}
                                    <button class="btn btn-warning cancel">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span>Cancel</span>
                                    </button>
                                    {% } %}
                                    </td>
                                    </tr>
                                    {% } %}
                                </script>
                                <!-- The template to display files available for download -->
                                <script id="template-download" type="text/x-tmpl">
                                    {% for (var i=0, file; file=o.files[i]; i++) { %}
                                    <tr class="template-download fade">
                                    <td>
                                    <span class="preview">
                                    {% if (file.thumbnailUrl) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                                    {% } %}
                                    </span>
                                    </td>
                                    <td>
                                    <p class="name">
                                    {% if (file.url) { %}
                                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                                    {% } else { %}
                                    <span>{%=file.name%}</span>
                                    {% } %}
                                    </p>
                                    {% if (file.error) { %}
                                    <div><span class="label label-danger">Error</span> {%=file.error%}</div>
                                    {% } %}
                                    </td>
                                    <td>
                                    <span class="size">{%=o.formatFileSize(file.size)%}</span>
                                    </td>
                                    <td>
                                    {% if (file.deleteUrl) { %}
                                    <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                                    <i class="glyphicon glyphicon-trash"></i>
                                    <span>Delete</span>
                                    </button>
                                    <input type="checkbox" name="delete" value="1" class="toggle">
                                    {% } else { %}
                                    <button class="btn btn-warning cancel">
                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                    <span>Cancel</span>
                                    </button>
                                    {% } %}
                                    </td>
                                    </tr>
                                    {% } %}
                                </script>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Tiêu đề:<span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <input class="form-control" name="title" value="" data-validation="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-lg-2">Mô tả: <span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <textarea class="form-control" name="description" rows="3" value="" data-validation="required"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Chuyên mục</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="categories" id="categories">
                                    <?php foreach ($categories as $row): ?>
                                        <?php if ($row['id_categories'] != 5) { ?>
                                            <option value="<?php echo $row['id_categories']; ?>"><?php echo $row['name_categories']; ?></option>
                                            <?php foreach ($row['child'] as $child) { ?>
                                                <option value="<?php echo $child['id_categories']; ?>">&nbsp;&nbsp;&nbsp;<?php echo $child['name_categories']; ?></option>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <option value="<?php echo $row['id_categories']; ?>" selected="">Tổng hợp</option>
                                        <?php } ?>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Phần mềm</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="software" id="software">
                                    <?php foreach ($software as $row): ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php endforeach
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Trình độ</label>
                            <div class="col-lg-8">
                                <select class="form-control" name="level">
                                    <?php foreach ($level as $row): ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-2">Nội dung:<span class="text-danger">*</span></label>
                            <div class="col-lg-8">
                                <textarea class="form-control" name="content" id="content1" rows="3" value=""></textarea>
                            </div>
                        </div>
                        <?php echo form_hidden('id_auth', $id_auth); ?>
                        <?php echo form_hidden('type_up', 'video'); ?>
                        <div class="form-group">
                            <div class="col-xs-offset-2 col-xs-8">
                                <button type="submit" class="btn btn-primary them">Thêm</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".them").click(function() {
        //alert("ok");
        var namevideo = $('.name > a').text();
        if (namevideo != "") {
            var input = $("<input>").attr("type", "hidden").attr("name", 'video_name').val(namevideo);
            $('#fileupload').append($(input));
        } else {
            alert("post video")
            return false;
        }
    });
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
    $(function() {
        if (CKEDITOR.instances['content']) {
            CKEDITOR.remove(CKEDITOR.instances['content']);
        }
        CKEDITOR.replace('content', {});
        if (CKEDITOR.instances['content1']) {
            CKEDITOR.remove(CKEDITOR.instances['content1']);
        }
        CKEDITOR.replace('content1', {});


    })

</script>
<script src="<?php echo base_url(); ?>public/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="//blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="//blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo base_url(); ?>public/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-process.js"></script>
<!-- The File Upload imae preview & resize plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo base_url(); ?>public/js/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="<?php echo base_url(); ?>public/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->
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
        window.applyValidation(true, '#form-new', 'element');

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

