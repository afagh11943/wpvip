<div class="wrap">
    <h2>
مدیریت فایل ها
        <a href="<?php echo esc_url(add_query_arg(array('action' => 'filenew'))) ?>" class="page-title-action"> فایل
            جدید</a>

    </h2>
    <table class="widefat fixed" cellspacing="0">
        <thead>
        <tr>

            <th id="columnname" class="manage-column column-columnname" scope="col">شناسه فایل</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">نام فایل </th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">هش کد</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">تعداد دانلود</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">اندازه</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">وضعیت</th>

        </tr>
        </thead>

        <tfoot>
        <tr>

            <th id="columnname" class="manage-column column-columnname" scope="col">شناسه فایل</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">نام فایل </th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">هش کد</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">تعداد دانلود</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">اندازه</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">وضعیت</th>

        </tr>
        </tfoot>

        <tbody>


        <?php if (count($bills) > 0): ?>
            <?php foreach ($bills as $bill): ?>
                <tr class="alternate">
                    <td class="column-columnname" scope="row"><?php echo $bill->display_name; ?></td>
                    <td class="column-columnname" scope="row"><?php echo mpvip_get_status_bills($bill->type) ; ?></td>
                    <td class="column-columnname" scope="row"><?php echo number_format($bill->amount).'ریال'; ?></td>
                    <td class="column-columnname" scope="row"><?php echo parsidate("Y-m-d", $bill->date, 'per'); ?></td>
                    <td class="column-columnname" scope="row"><?php echo number_format( $bill->balance).'ریال'; ?></td>
                    <td class="column-columnname" scope="row"><?php echo $bill->description; ?></td>
                </tr>
            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td>
                    اطلاعات یافت نشد .....
                </td>
            </tr>


        <?php endif; ?>


        </tbody>
    </table>





    </div>