<?php 
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    $this->setFrameMode(true);

    if($arResult["ITEMS"]){

    ?> 
        <div class="reviews__items"> 
    <?php
            foreach($arResult["ITEMS"] as $index => $arItem){
                $reviewProp = $arItem["PROPERTIES"];
                $userName = $reviewProp["USER_NAME"]["VALUE"];
                $reviewDate = date('d.m.Y',strtotime($reviewProp["REVIEW_DATETIME"]["VALUE"]));
                $reviewText = $reviewProp["REVIEW_TEXT"]["VALUE"]["TEXT"];
    ?>
                <div class="item">
                    <img src="/konkurs/assets/images/prizes/avatar.png" alt="" class="avatar">
                    <div class="info">
                        <p class="name"><?php echo $userName;?></p>
                        <p class="date"><?php echo $reviewDate;?></p>
                        <p class="text"><?php echo nl2br($reviewText)?></p>
                    </div>
                </div>
    <?php } ?> 
        </div> 
        <div class="reviews__pagination"><?php echo $arResult["NAV_STRING"];?></div>
<?php 
    }else{
?>      <div class="reviews__items"> 
            <div class="item">
                <div class="info">
                    <p class="text">Отзывов еще нет! Добавьте свой отзыв о препарате Тенотен!</p>
                </div>
            </div>
        </div> 
<?php
    }
?>