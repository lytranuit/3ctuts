
<?php echo form_open("auth/create_user"); ?>
<div class="container-fluid">
    <section class="container">

        <?php $baseurl = base_url(); ?>
        <h1 class="page-header">Create User </h1>
        <div class="container-page">
            <div class="col-md-6">
                <div class="form-group col-lg-6 hidden">
                    <label>First Name<span class="text-danger">*</span></label>
                    <?php echo form_input($first_name); ?>
                </div>
                <div class="form-group col-lg-6 hidden">
                    <label>Last Name<span class="text-danger">*</span></label>
                    <?php echo form_input($last_name); ?>
                </div>
                <div class="form-group col-lg-12">
                    <label>Username<span class="text-danger">*</span></label>
                    <?php echo form_input($username); ?>
                </div>
                <div class="form-group col-lg-6">
                    <label>Password<span class="text-danger">*</span></label>
                    <?php echo form_input($password); ?>
                </div>

                <div class="form-group col-lg-6">
                    <label>Repeat Password<span class="text-danger">*</span></label>
                    <?php echo form_input($password_confirm); ?>
                </div>

                <div class="form-group col-lg-6 ">
                    <label>Email Address<span class="text-danger">*</span></label>
                    <?php echo form_input($email); ?>
                </div>

                <div class="form-group col-lg-6 ">
                    <label>Repeat Email Address<span class="text-danger">*</span></label>
                    <?php echo form_input($email_confirm); ?>
                </div>
                <div class="form-group col-lg-6 hidden">
                    <label>Phone<span class="text-danger">*</span></label>
                    <?php echo form_input($phone); ?>
                </div>	
                <div class="form-group col-lg-6 hidden">
                    <label>Address<span class="text-danger">*</span></label>
                    <?php echo form_input($address); ?>
                </div>
                <div class="form-group col-lg-6">
                   <button type="submit" class="btn btn-primary">Register</button>
                </div>
                
            </div>

            <div class="col-md-6">
                <div id="infoMessage"><?php echo $message; ?></div>

            </div>
        </div>
    </section>
</div>
<?php echo form_close(); ?>