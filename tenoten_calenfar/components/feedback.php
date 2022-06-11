<?php
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    /**
     * Шаблон окна для вывода отзыва
     */

    if($checkAuthStatus){
?>
    <div class="cmp-popup cmp-popup_green" id="feedback">
        <div class="cmp-popup__close">
            <svg><use xlink:href="#close"></use></svg>
        </div>
        <div class="cmp-popup__block">
            <div class="cmp-popup__scroll">
                <p class="cmp-popup__title"><span class="text_dargreen">Напишите нам, как Тенотен и Календарь настроения</span><br><span class="text_orange">изменили вашу жизнь</span></p>
                <div class="cmp-popup__feedback">
                    <div class="user">
                        <div class="avatar">
                            <img src="/konkurs/assets/images/prizes/avatar.png" alt="" class="image">
                        </div>
                        <div class="info">
                            <p class="name"><?php echo $userName;?></p>
                            <p class="date"><?php echo date("d.m.Y");?></p>
                        </div>
                    </div>
                    <div class="cmp-form">
                        <form id="review_form">
                            <div class="cmp-form__elements">
                                <textarea name="review" placeholder="Расскажите о результатах" required class="textarea cmp-form__textarea"></textarea>
                                <button class="button cmp-button cmp-button_green">Отправить</button>
                            </div>
                            <p class="cmp-form__message">Оставляя отзыв, вы соглашаетесь c условиями использования сервиса </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>