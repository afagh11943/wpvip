
<div class="wpfrm">
    <?php

wpvip_flash_mas();



    ?>
    <form action="" method="post">
        <div class="form-row">
            <label for="plan">طرح مورد نظر</label>
            <select name="plan" id="plan">
                <option value="0">لطفا یک طرح را انتخاب کنید..</option>
                <?php if (count($plan_order > 0) && isset($plan_order) ): ?>
                    <?php foreach ($plan_order as $plan_item): ?>

                        <option value="<?php echo $plan_item->plan_ID ?>"><?php echo $plan_item->titel." - ".$plan_item->price.'ریال' ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>

        </div>

<div class="form-row">
    <input type="submit" name="mpvip_submitfrm" value="خرید عضویت ویژه">
</div>
    </form>


</div>