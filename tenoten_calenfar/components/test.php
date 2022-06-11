<?php
    if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
    /**
     * Шаблон вывода теста
     */
    if($checkAuthStatus){
?>
    <div class="cmp-popup cmp-popup_test" id="main-test">
        <div class="cmp-popup__close">
            <svg><use xlink:href="#close"></use></svg>
        </div>
        <div class="cmp-popup__block">
            <div class="cmp-popup__scroll">
                <div class="cmp-popup__scroll-test">
                    <p class="cmp-popup__title cmp-popup__title_test">Оцени свой настрой и узнай, что делать</p>

                    <div class="cmp-test">
                        <div class="cmp-test__question">
                            <p class="cmp-test__number"></p> 
                            <div class="cmp-test__header">
                                <span class="cmp-test__title"></span>
                                <svg class="cmp-test__arrow"><use xlink:href="#arrow-test"></use></svg>
                            </div>

                            <span class="cmp-test__message"></span>

                            <ul class="ul cmp-test__variants">

                            </ul>
                        </div>
                    </div>
                </div>

                <ul class="ul cmp-popup__smiles">
                    <li class="item" data-prefixclass="bad" data-moodname="Плохое">
                        <svg class="smile"><use xlink:href="#smile_upset"></use></svg>
                        <span class="mood">Я на грани</span>
                    </li>
                    <li class="item" data-prefixclass="sad" data-moodname="Грустное">
                        <svg class="smile"><use xlink:href="#smile_sad"></use></svg>
                        <span class="mood">Как-то не очень</span>
                    </li>
                    <li class="item" data-prefixclass="normal" data-moodname="Нормальное">
                        <svg class="smile"><use xlink:href="#smile_uncertain"></use></svg>
                        <span class="mood">Нормально, ни то ни сё</span>
                    </li>
                    <li class="item" data-prefixclass="positive" data-moodname="Позитивное">
                        <svg class="smile"><use xlink:href="#smile_smiling"></use></svg>
                        <span class="mood">На позитиве</span>
                    </li>
                    <li class="item" data-prefixclass="joyful" data-moodname="Радостное">
                        <svg class="smile"><use xlink:href="#smile_happy"></use></svg>
                        <span class="mood">Радуюсь жизни</span>
                    </li>
                </ul>  

                <div class="cmp-packaging">
                    <img src="/konkurs/assets/images/pack1.png" alt="">
                    <span class="text">ру №: ЛП-n (000029)-(рг-ru) от 18.12.19</span>
                </div>
            </div>
        </div>
        
        <button class="button cmp-button cmp-button__test">
            <div class="ellipse">
                <div class="ellipse">
                    <div class="button"></div>
                </div>
            </div>
        </button>
    </div>
<?php 
    }
?>