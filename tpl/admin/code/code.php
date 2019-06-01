<div class="wrap">

    <h2>
کد های تخفیف
        <a href="<?php echo esc_url(add_query_arg(array('action' => 'new'))) ?>" class="page-title-action">
ایجاد کد تخفیف جدید
        </a>

        <h2>
            <table class="widefat fixed" cellspacing="0">
                <thead>
                <tr>

                    <th id="columnname" class="manage-column column-columnname" scope="col">شناسه کد </th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">کد تخفیف</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">درصد کد تخفیف </th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">تاریخ انقضاء</th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">تعداد محدودیت  </th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">وضعیت</th>

                </tr>
                </thead>

                <tfoot>
                <tr>

                    <th id="columnname" class="manage-column column-columnname" scope="col">شناسه کد </th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">کد تخفیف</th>
                    <th id="columnname" class="manage-column column-columnname" scope="col">درصد کد تخفیف </th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">تاریخ انقضاء</th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">تعداد محدودیت  </th>
                    <th id="columnname" class="manage-column column-columnname num" scope="col">وضعیت</th>


                </tr>
                </tfoot>

                <tbody>
                <?php if (isset($allcodes) && count($allcodes) > 0): ?>
                    <?php foreach ($allcodes as $allcode): ?>
                        <tr class="alternate">
                            <th class="column-columnname" scope="row"><?php echo $allcode->code_id; ?></th>
                            <td class="column-columnname"><?php echo $allcode->code_hash; ?></td>
                            <td class="column-columnname"><?php echo $allcode->code_persent; ?></td>


                            <td class="column-columnname"><?php echo parsidate("Y-m-d", $allcode->code_expire_date, 'per');
                                ?></td>
                            <td class="column-columnname"><?php echo $allcode->code_count_limit; ?></td>
                            <td class="column-columnname"><?php echo $allcode->code_status; ?></td>



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