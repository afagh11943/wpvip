<div class="wrap">

    <h2>
تغییر موجودی کاربران
        <a href="<?php echo esc_url(admin_url('admin.php?page=wpvip_admin_users')); ?>" class="page-title-action"> لیست
            کاربران</a>

        <h2>

            <form action="" method="post">
                <table class="form-table wpvip">
                    <tr valign="top">
                        <th scope="row"> نوع  تغییر : </th>
                        <td>
                            <select name="type" id="user-id">

                                <option value="1">افزایش موجودی </option>
                                <option value="2">کاهش موجودی </option>

                            </select>
                        </td>
                    </tr>


                    <tr valign="top">
                        <th scope="row">  مبلغ</th>
                        <td><input type="text" name="amount" value="1"/></td>
                    </tr>

                </table>

                <input type="hidden" name="uid" value="<?php echo $usid;?>">

                <?php submit_button(); ?>
            </form>
</div>