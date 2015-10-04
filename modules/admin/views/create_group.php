<div class="container">
    <div class="row">
        <?php $baseurl = base_url(); ?>
        <h1 class="page-header">Create Group </h1>

        <div class="panel panel-default ">
            <div class="panel-heading">
                <?php echo lang('create_group_heading'); ?>
            </div>
            <div class="panel-body">
                <div id="infoMessage"><?php echo $message; ?></div>
                <form class="form-horizontal" action="<?php echo $baseurl; ?>auth/create_group" method="post">

                    <div class="form-group">
                        <label class="control-label col-lg-2">Group Name:</label>
                        <div class="col-lg-10">
                            <input class="form-control" type="text" name="group_name" placeholder="Group Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Description: </label>
                        <div class="col-lg-10">
                            <input class="form-control" type="text" name="description" placeholder="Description">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <button type="submit" class="btn btn-primary">Create Group</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


