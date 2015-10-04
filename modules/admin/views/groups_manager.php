<div class="container">
    <?php
    $baseurl = base_url();
    $stt = 1;
    //print_r($groups);
    ?>
    <h1 class="page-header">All Groups</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading text-primary">
        <a href="<?php echo $baseurl . "auth/create_group/";?>" ><button type="button" class="btn btn-primary btn-sm">Thêm Group</button></a>
    </div>
    <div class="panel-body">
        <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>STT</th> 
                    <th>Name</th>
                    <th>Description</th>
                    <th>Edit</th>
                    <th>Remove</th>

                </tr>
            </thead>

            <tfoot>
            <tbody
            <?php foreach ($groups as $group): ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><?php echo $group['name']; ?></td>
                        <td><?php echo $group['description']; ?></td>
                        <td><?php echo anchor($baseurl . "auth/edit_group/" . $group['id'], 'Edit'); ?></td>
                        <td><?php echo anchor($baseurl . "auth/remove_group/" . $group['id'], 'Remove'); ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
