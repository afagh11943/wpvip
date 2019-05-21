<div class="metabox_insid">


    <label for="mpvip-plans">لطفا طرح خود را انتخاب نمایید .....</label>
    <select name="mpvip_plane" id="mpvip-plans">
        <?php if ($plans && count($plans) > 0): ?>
            <option value="0">در دسترس همه ...</option>
            <?php foreach ($plans as $plan) : ?>

                <option value="<?php echo $plan->plan_ID  ?>" <?php selected($wpvip_cuurent_post_vip,$plan->plan_ID ) ?>><?php echo $plan->titel ?></option>
            <?php endforeach; ?>

        <?php endif; ?>

    </select>
    </p>
</div>