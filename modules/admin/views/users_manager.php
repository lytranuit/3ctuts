<div class="container">
    <?php $baseurl = base_url(); ?>
    <h1 class="page-header">All User</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading text-primary">
        <a href="<?php echo $baseurl . "auth/create_user/"; ?>" ><button type="button" class="btn btn-primary btn-sm">Thêm User</button></a>
    </div>
    <div class="panel-body">
        <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Group</th>
                    <th>Status</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($user->email, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($user->address, ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <?php foreach ($user->groups as $group): ?>
                                <?php echo anchor($baseurl . "admin/user_edit/" . $user->id, htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8')); ?><br />
                            <?php endforeach ?>
                        </td>
                        <td><?php echo ($user->active) ? anchor($baseurl . "auth/deactivate/" . $user->id, 'Active') : anchor($baseurl . "auth/activate/" . $user->id, 'Deactive'); ?></td>
                        <td><?php echo anchor($baseurl . "auth/remove_user/" . $user->id, 'Remove'); ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
