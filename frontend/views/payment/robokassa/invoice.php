


<form name="payment" method="post" action="https://sci.interkassa.com/" accept-charset="UTF-8">
    <input type="hidden" name="ik_co_id" value="620a1d5c61a8e529093dea4d"/>
    <input type="hidden" name="ik_sign" value="620a1d5c61a8e529093dea4d"/>
    <input type="hidden" name="ik_pm_no" value="<?= time() ?>"/>
    <input type="hidden" name="ik_am" value="<?=$ee->cost?>"/>
    <input type="hidden" name="ik_cur" value="uah"/>
    <input type="hidden" name="ik_desc" value="description"/>
    <input type="submit" value="Pay">
</form>

<!--<form name="payment" method="post" action="https://sci.interkassa.com/" accept-charset="UTF-8">
    <input type="hidden" name="ik_co_id" value="51237daa8f2a2d8413000000"/>
    <input type="hidden" name="ik_pm_no" value="ID_4233"/>
    <input type="hidden" name="ik_am" value="1.44"/>
    <input type="hidden" name="ik_cur" value="uah"/>
    <input type="hidden" name="ik_desc" value="Payment Description"/>
    <input type="submit" value="Pay">
</form>-->



<!--<form id="payment" name="payment" method="POST" action="https://sci.interkassa.com/" enctype="utf-8">
    <input type="hidden" name="s" value="4B0RQxlA9v" />
    <input type="submit" value="Pay">
</form>-->



