<div class="wrap">
    <h2>
        مدیریت محصولات

        <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit'))) ?>" class="page-title-action"> محصول
            جدید</a>

    </h2>


    <table class="widefat fixed" cellspacing="0">
        <thead>
        <tr>

            <th id="columnname" class="manage-column column-columnname" scope="col">نام پنل</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">قیمت</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">مدت اعتبار</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">عملیات</th>

        </tr>
        </thead>

        <tfoot>
        <tr>

            <th id="columnname" class="manage-column column-columnname" scope="col">نام پنل</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">قیمت</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">مدت اعتبار</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">عملیات</th>


        </tr>
        </tfoot>

        <tbody>
        <?php if (isset($plans) && count($plans) > 0): ?>
            <?php foreach ($plans as $plan): ?>
                <tr class="alternate">
                    <th class="column-columnname" scope="row"><?php echo $plan->titel; ?></th>
                    <td class="column-columnname"><?php echo number_format($plan->price) . ' ریال'; ?></td>
                    <td class="column-columnname"><?php echo $plan->credit . ' روز'; ?></td>
                    <td class="column-columnname">

                        <a href="<?php echo esc_url(add_query_arg(array('action' => 'edit', 'item-id' => $plan->plan_ID))) ?>" class=""><span class="dashicons dashicons-edit"></span></a>
                        <a href="<?php echo esc_url(add_query_arg(array('action' => 'delete', 'item-id' => $plan->plan_ID))) ?>" class="" onclick="return confirm('برای حذف ایتم مطمئن هستید؟')"><span class="dashicons dashicons-trash"></span></a>
                    </td>
                </tr>

            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="4">
                    هیچ رکوردی برای نمایش وجود ندارد
                </td>
            </tr>
        <?php endif; ?>


        </tbody>
    </table>

</div>