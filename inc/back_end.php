<?php
function mpvip_get_status_bills($bills){
    if(intval($bills)==1){
        return "واریز";
    }elseif(intval($bills)==2){
        return "برداشت";
    }

}