<div class="wrap">

    <h2>
        مدیریت کاربران

        <a href="<?php echo esc_url(add_query_arg(array('action' => 'new'))) ?>" class="page-title-action">کار بر
            ویژه</a>

        <h2>
            <table class="widefat fixed" cellspacing="0">
                <thead>
                <tr>

                    <th id="columnname" class="manage-column column-columnname" scope="col">شناسه کاربری</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">نام و نام خانوادگی</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">طرح فعال</th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">تاریخ انقضاء</th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">کیف پول </th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">عملیات</th>

                </tr>
                </thead>

                <tfoot>
                <tr>

                    <th id="columnname" class="manage-column column-columnname" scope="col">شناسه کاربری</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">نام و نام خانوادگی</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">طرح فعال</th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">تاریخ انقضاء</th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">کیف پول </th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">عملیات</th>


                </tr>
                </tfoot>

                <tbody>
                <?php if (isset($wp_users) && count($wp_users) > 0): ?>
                    <?php foreach ($wp_users as $wp_user): ?>
                        <tr class="alternate">
                            <th class="column-columnname" scope="row"><?php echo $wp_user->idasli; ?></th>
                            <td class="column-columnname"><?php echo $wp_user->display_name; ?></td>
                            <td class="column-columnname"><?php echo $wp_user->titel; ?></td>


                                <td class="column-columnname"><?php echo parsidate("Y-m-d", $wp_user->expire_date, 'per');
                                ?></td>
                            <td class="column-columnname"><?php echo wpvip_get_user_wallet($wp_user->idasli); ?></td>

                                <td class="column-columnname">

                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit', 'usid' => $wp_user->ID))) ?>"
                                       class=""><span class="dashicons dashicons-image-flip-vertical"></span></a>
                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'delete', 'usid' => $wp_user->ID))) ?>"
                                       class="" onclick="return confirm('برای حذف ایتم مطمئن هستید؟')"><span
                                            class="dashicons dashicons-trash"></span></a>

                                    <a href="<?php echo esc_url(add_query_arg(array('action' => 'balanc', 'usid' => $wp_user->idasli))) ?>"
                                       class=""><span class="dashicons dashicons-plus-alt"></span></a>
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