<div class="wrap">

    <h2>
        اضافه کردن محصول
        <a href="<?php echo esc_url(add_query_arg(array('action' => 'asl'))); ?>" class="page-title-action">لیست محصولات
        </a>

        <h2>

            <form action="" method="post">
                <table class="form-table">
                    <tr valign="top">
                        <th scope="row">عنوان محصول</th>
                        <td>
                            <input type="text" name="titel"/>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row">قیمت</th>
                        <td><input type="text" name="price"/></td>
                    </tr>

                    <tr valign="top">
                        <th scope="row"> اعتبار روزانه</th>
                        <td><input type="text" name="cerdit"/></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
</div>

