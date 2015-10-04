<div class="container">
    <div class="row">
        <?php $baseurl = base_url(); ?>
        <h1 class="page-header">Edit User </h1>

        <div class="panel panel-default ">
            <div class="panel-heading">
                <?php echo $user->username; ?>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" action="" method="post">
                    <div class="form-group">
                        <label class="control-label col-lg-2">Groups</label>
                        <div class="col-lg-10">
                            <?php foreach ($groups as $group): ?>
                                <label class="checkbox">
                                    <?php
                                    $gID = $group['id'];
                                    $checked = null;
                                    $item = null;
                                    foreach ($currentGroups as $grp) {
                                        if ($gID == $grp->id) {
                                            $checked = ' checked="checked"';
                                            break;
                                        }
                                    }
                                    ?>
                                    <input type="checkbox" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
                                    <?php echo htmlspecialchars($group['name'], ENT_QUOTES, 'UTF-8'); ?>
                                </label>
                            <?php endforeach ?>
                        </div>
                    </div>
                    <?php echo form_hidden('id', $user->id); ?>

                    <div class="form-group">
                        <div class="col-xs-offset-2 col-xs-10">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


