<div class="wrap">

    <h2>
		مدیریت کاربران
        <h2>
            <table class="widefat fixed" cellspacing="0">
                <thead>
                <tr>

                    <th id="columnname" class="manage-column column-columnname" scope="col">شناسه کاربری</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">نام و نام خانوادگی</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">طرح فعال</th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">تاریخ انقضاء</th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">عملیات</th>

                </tr>
                </thead>

                <tfoot>
                <tr>

                    <th id="columnname" class="manage-column column-columnname" scope="col">شناسه کاربری</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">نام و نام خانوادگی</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">طرح فعال</th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">تاریخ انقضاء</th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">عملیات</th>


                </tr>
                </tfoot>

                <tbody>
		        <?php if (isset($wp_users) && count($wp_users) > 0): ?>
			        <?php foreach ($wp_users as $wp_user): ?>
                        <tr class="alternate">
                            <th class="column-columnname" scope="row"><?php echo $wp_user->ID; ?></th>
                            <td class="column-columnname"><?php echo $wp_user->display_name; ?></td>
                            <td class="column-columnname"><?php echo $wp_user->titel;?></td>
                            <td class="column-columnname"><?php echo parsidate("Y-m-d" ,$wp_user->expire_date,'per');
                               ?></td>
                            <td class="column-columnname">

                                <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit', 'item-id' => $plan->plan_ID))) ?>" class=""><span class="dashicons dashicons-edit"></span></a>
                                <a href="<?php echo esc_url(add_query_arg(array('action' => 'delete', 'item-id' => $plan->plan_ID))) ?>" class="" onclick="return confirm('برای حذف ایتم مطمئن هستید؟')"><span class="dashicons dashicons-trash"></span></a>
                            </td>
                        </tr>

			        <?php endforeach; ?>

		        <?php else: ?>
                    <tr>
                        <td colspan="5">
                            هیچ رکوردی برای نمایش وجود ندارد
                        </td>
                    </tr>
		        <?php endif; ?>


                </tbody>
            </table>
</div>