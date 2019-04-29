<div class="wrap">

    <h2>
        اضافه کردن کاربر

        <a href="<?php echo esc_url(admin_url('admin.php?page=wpvip_admin_users')); ?>" class="page-title-action"> لیست
            کاربران</a>

        <h2>
            <form action="" method="post">
                <table class="form-table wpvip">
                    <tr valign="top">
                        <th scope="row"> شناسه کاربری</th>
                        <td>
                            <select name="user-id" id="user-id">

                                <option value="0">لطفا انتخاب کنید ...</option>
                                <?php if(isset($users)): ;?>
                                    <?php foreach($users as $user):?>
                                        <option value="<?php echo $user->ID; ?>"><?php echo $user->display_name; ?></option>

                                        <?php endforeach;?>

                                <?php endif;?>

                            </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">شناسه طرح</th>
                        <td>
                            <select name="plan-id" id="plan-id">

                                <option value="0">لطفا انتخاب کنید ...</option>
                                <?php if(isset($plans)): ;?>
                                    <?php foreach($plans as $plan):?>
                                        <option value="<?php echo $plan->plan_ID; ?>"><?php echo $plan->titel; ?></option>

                                    <?php endforeach;?>

                                <?php endif;?>


                            </select>

                        </td>

                    </tr>

                    <tr valign="top">
                        <th scope="row"> اعتبار روزانه</th>
                        <td><input type="text" name="credit" value="1"/></td>
                    </tr>

                </table>



                <?php submit_button(); ?>
            </form>

</div>