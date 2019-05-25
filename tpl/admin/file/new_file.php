<div class="wrap">

    <h2>
        افزودن فایل

        <a href="<?php echo esc_url(admin_url('admin.php?page=wpvip_file_users')); ?>" class="page-title-action">فایل
            ها</a>

        <h2>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="form-table ">
                    <tr valign="top">
                        <th scope="row">فایل خود را انتخاب نمایید</th>
                        <td>
                            <input type="file" name="file">

                        </td>
                    </tr>
                    <tr>

                        <td colspan="2">
                            <?php submit_button(); ?>

                        </td>
                    </tr>

            </form>

</div>