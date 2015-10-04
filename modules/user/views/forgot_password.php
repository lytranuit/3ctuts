<div class="container">
    <h1>Quên mật khẩu</h1>
    <p>Điền Email của bạn để có thể lấy lại mật khẩu</p>

    <div id="infoMessage"><?php echo $message; ?></div>

    <?php echo form_open("auth/forgot_password"); ?>

    <p>
        <label for="email">Email:</label> <br />
        <?php echo form_input($email); ?>
    </p>

    <p><?php echo form_submit('submit', lang('forgot_password_submit_btn')); ?></p>

    <?php echo form_close(); ?>
</div>