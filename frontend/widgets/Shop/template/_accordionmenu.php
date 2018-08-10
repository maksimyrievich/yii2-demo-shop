<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>
<?php if($cat['id'] > 1):?>
    <li type="none">
        <a href="<?= Url::to(['/shop/catalog/category', 'id' => $cat['id']])?>"><?= '&nbsp;&nbsp;&nbsp;'.$cat['name']?></a>
        <?php if(isset($cat['childs'])):?>
            <ul type="none" style="padding: 5px 0px 0px 20px">
                <?= $this->getMenuHtml($cat['childs']) ?>
            </ul>
        <?php endif;?>
    </li>
<? endif;?>



