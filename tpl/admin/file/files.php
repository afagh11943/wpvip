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
            <th id="columnname" class="manage-column column-columnname" scope="col">نام فایل</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">هش کد</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">تعداد دانلود</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">اندازه</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">کد کوتاه</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">وضعیت</th>

        </tr>
        </thead>

        <tfoot>
        <tr>

            <th id="columnname" class="manage-column column-columnname" scope="col">شناسه فایل</th>
            <th id="columnname" class="manage-column column-columnname" scope="col">نام فایل</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">هش کد</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">تعداد دانلود</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">اندازه</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">کد کوتاه</th>
            <th id="columnname" class="manage-column column-columnname num" scope="col">وضعیت</th>

        </tr>
        </tfoot>

        <tbody>


        <?php if ($allfiles && count($allfiles) > 0): ?>
            <?php foreach ($allfiles as $allfile): ?>
                <tr class="alternate">
                    <td class="column-columnname" scope="row"><?php echo $allfile->ID; ?></td>
                    <td class="column-columnname" scope="row"><?php echo $allfile->file_name; ?></td>
                    <td class="column-columnname" scope="row"><?php echo $allfile->hash_code; ?></td>
                    <td class="column-columnname" scope="row"><?php echo $allfile->download_count; ?></td>
                    <td class="column-columnname" scope="row"><?php echo wpvip_show_file_size( $allfile->file_size); ?></td>
                    <td class="column-columnname" scope="row"><?php echo '[wpvip_file_dl  id='.$allfile->ID .']'; ?></td>
                    <td class="column-columnname" scope="row"><?php echo $allfile->status; ?></td>
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