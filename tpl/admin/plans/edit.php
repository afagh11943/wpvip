<div class="wrap">

    <h2>

        اضافه کردن محصولات

        <a href="<?php echo esc_url(add_query_arg(array('action' => 'asl'))); ?>" class="page-title-action"> محصول
            جدید</a>
    </h2>

    <table class="form-table">
        <tr valign="top">
            <th scope="row">عنوان محصول</th>
            <td>
                <input type="text" name="titel" value=""/>
            </td>
        </tr>

        <tr valign="top">
            <th scope="row">قیمت</th>
            <td><input type="text" name="price" value=""/></td>
        </tr>

        <tr valign="top">
            <th scope="row"> اعتبار روزانه</th>
            <td><input type="text" name="cerdit" value=""/></td>
        </tr>
    </table>


</div>

