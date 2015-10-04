<div class="container">
    <?php
    $baseurl = base_url();
    $stt = 1;
    //print_r($news);
    ?>
    <h1 class="page-header">All Videos</h1>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <table id="myTable" class="display" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>STT</th> 
                    <th>Videos</th>
                    <th>Authors</th>
                    <th>Categories</th>
                    <th>Views</th>
                    <th>Status</th>
                    <th>Remove</th>
                </tr>
            </thead>

            <tfoot>
            <tbody

                <?php foreach ($news as $key => $new): ?>
                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td>
                            <?php
                            echo "<p><strong><a href='" . $baseurl . "user/news/" . $new['id_news'] . "'>" . $new['title'] . "</a></strong></p>";
                            echo "<img style='float:left;margin-right:5px' src='" . $baseurl . "public/upload/thumbs/" . $new['img'] . "' width='152px' height='96px' />";
                            echo $new['description'];
                            ?>
                        </td>
                        <td><?php echo $new['username']; ?></td>
                        <td><?php echo $new['name_categories']; ?></td>
                        <td><?php echo $new['views']; ?></td>

                        <td style="text-align: center;">
                            <?php if ($new['status'] == 1) { ?>
                                Đã duyệt
                            <?php } else { ?> 
                                <select class="status" rel="<?= $new['id_news'] ?>">
                                    <option value="0">Đang chờ duyệt</option>
                                    <option value="1">Đã duyệt</option>
                                </select>
                            <?php } ?>
                        </td>
                        <td><a href="<?php echo $baseurl . "admin/video_remove/" . $new['id_news']; ?>">Remove</a></td>

                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', ".status", function () {
            var id = $(this).attr('rel');
            $(this).parents("td").html("Đã duyệt");
            $.ajax({
                url: '<?php echo base_url() ?>admin/audit/' + id,
                type: "GET",
                dataType: 'JSON',
                success: function (result) {
                }
            });
        });
    })
</script>
