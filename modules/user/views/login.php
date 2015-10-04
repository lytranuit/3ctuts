
<div class="container scale">
    <div class="row">
        <div class="col-xs-6">
            <div class="well">
                <?php echo form_open("auth/login"); ?>
                <div class="form-group">
                    <label for="username" class="control-label">Tên đăng nhập</label>
                    <?php echo form_input($identity); ?>
                    <span class="help-block"></span>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Mật khẩu</label>
                    <?php echo form_input($password); ?>
                    <span class="help-block"></span>
                </div>
                <div id="loginErrorMsg" class="alert alert-error hide">Tên đăng nhập hoặc mật khẩu không đúng</div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" id="remember"> Ghi nhớ
                    </label>
                </div>
                <p><a href="<?php echo base_url(); ?>auth/forgot_password">Quên mật khẩu</a></p>
                <button type="submit" class="btn btn-success btn-block">Đăng nhập</button>

                </form>
            </div>
        </div>
        <div class="col-xs-6">
            <p class="lead">Đăng kí hoàn toàn<span class="text-success"> Miễn phí</span></p>
            <ul class="list-unstyled" style="line-height: 2">
                <li><span class="fa fa-check text-success"></span> Xem được tất cả các Video</li>
                <li><span class="fa fa-check text-success"></span> Có thêm nhiều thông tin về Video</li>
                <li><span class="fa fa-check text-success"></span> Có sự hướng dẫn tận tình từ các Mod</li>

            </ul>
            <p><a href="<?php echo base_url(); ?>auth/create_user" class="btn btn-info btn-block">Đừng ngại! Đăng kí ngay </a></p>
        </div>
    </div>
</div>
