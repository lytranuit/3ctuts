<div class="container">
    <div class="row">
        <?php $baseurl = base_url(); ?>
        <h1 class="page-header">Sửa bài viết</h1>


        <div id="infoMessage"><?php echo $message; ?></div>
        <form class="form-horizontal" action="" method="post">

            <div class="form-group">
                <label class="control-label col-lg-2">Tiêu đề:<span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <input class="form-control" name="title" value="<?php echo $news[0]['title'];?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-2">Mô tả: <span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <textarea class="form-control" name="description" rows="3" value=""><?php echo $news[0]['description'];?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-lg-2">Thể loại</label>
                <div class="col-lg-10">
                    <select class="form-control" name="categories">
                        <?php
                        foreach ($categories as $row) {
                            if ($row['id_categories'] == $news[0]['id_categories']) {
                                ?>
                                <option value="<?php echo $row['id_categories']; ?>" selected=""><?php echo $row['name_categories']; ?></option>
                            <?php } else { ?>
                                <option value="<?php echo $row['id_categories']; ?>"><?php echo $row['name_categories']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2">Loại</label>
                <div class="col-lg-10">
                    <select class="form-control" name="type">
                        <?php
                        foreach ($type as $row) {
                            if ($row['id_type'] == $news[0]['id_type']) {
                                ?>
                                <option value="<?php echo $row['id_type']; ?>" selected=""><?php echo $row['name_type']; ?></option>
                            <?php } else { ?>
                                ?>
                                <option value="<?php echo $row['id_type']; ?>"><?php echo $row['name_type']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-lg-2">Nội dung:<span class="text-danger">*</span></label>
                <div class="col-lg-10">
                    <textarea class="form-control" name="content" id="content" rows="3" value=""><?php echo $news[0]['content'];?></textarea>
                </div>
            </div>


            <?php echo form_hidden('id_auth', $id_auth); ?>
            <?php echo form_hidden('type_up', 'news'); ?>
            <div class="form-group">
                <div class="col-xs-offset-2 col-xs-10">
                    <button type="submit" class="btn btn-primary">edit</button>
                </div>
            </div>
        </form>

    </div>
</div>
<script type="text/javascript"> $(function() {
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


