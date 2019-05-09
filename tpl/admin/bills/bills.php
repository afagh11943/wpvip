<div class="wrap">
    <h2>
        صورتحساب کاربران

    </h2>
    <table class="widefat fixed" cellspacing="0">
        <thead>
        <tr>

            <th id="columnname" class="manage-column column-columnname" scope="col">کاربر</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">نوع تراکنش</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">مبلغ</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">تاریخ</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">موجودی</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">توضیحات</th>

        </tr>
        </thead>

        <tfoot>
        <tr>

            <th id="columnname" class="manage-column column-columnname" scope="col">کاربر</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">نوع تراکنش</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">مبلغ</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">تاریخ</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">موجودی</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">توضیحات</th>

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
