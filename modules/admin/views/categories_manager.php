<div class="container">
    <?php
    $baseurl = base_url();
    $stt = 1;
    //print_r($groups);
    ?>
    <h1 class="page-header">All Categories</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading text-primary">
        <a href=""><button type="button" class="btn btn-primary btn-sm">Thêm thể loại</button></a>
    </div>
    <div class="panel-body">
        <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>STT</th> 
                    <th>Name</th>
                    <th>Alias</th>
                    <th>Edit</th>
                    
                </tr>
            </thead>

            <tfoot>
            <tbody
            <?php foreach ($categories as $row): ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td><?php echo $row['name_categories']; ?></td>
                        <td><?php echo $row['alias_categories']; ?></td>
                        <td><?php echo anchor($baseurl . "admin/categories_edit/" . $row['id_categories'], 'Edit'); ?></td>
                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
