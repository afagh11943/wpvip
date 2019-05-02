<div class="wrap">

    <h2>
        افزایش و کاهش اعتبار کاربران
        <a href="<?php echo esc_url(admin_url('admin.php?page=wpvip_admin_users')); ?>" class="page-title-action"> لیست
            کاربران</a>

        <h2>

            <form action="" method="post">
                <table class="form-table wpvip">
                    <tr valign="top">
                        <th scope="row">  عملیات اعتبار کاربری</th>
                        <td>
                            <select name="type" id="user-id">

                                <option value="1">افزایش اعتبار کاربر </option>
                                <option value="2">کاهش اعتبار کاربر</option>

                            </select>
                        </td>
                    </tr>


                    <tr valign="top">
                        <th scope="row"> اعتبار روزانه</th>
                        <td><input type="text" name="credit" value="1"/></td>
                    </tr>

                </table>

                <input type="hidden" name="uid" value="<?php echo $usid;?>">

                <?php submit_button(); ?>
            </form>
</div>