<div class="wrap">

    <h2>
افزودن کد تخفیف

        <a href="<?php echo esc_url(admin_url('admin.php?page=wpvip_code_users')); ?>" class="page-title-action">

            لیست کدهای تخفیف
        </a>

        <h2>

            <form action="" method="post" >
                <table class="form-table ">
                    <tr valign="top">
                        <th scope="row"> درصد کد تخفیف   </th>
                        <td>
                            <input type="text" name="persent">

                        </td>
                    </tr>
                    <tr>
                    <tr valign="top">
                        <th scope="row"> تعداد روز برای تاریه انقضا</th>
                        <td>
                            <input type="text" name="expire_date">

                        </td>
                    </tr>
                    <tr>


                    <td colspan="2">
                            <?php submit_button(); ?>

                        </td>
                    </tr>

            </form>

</div>