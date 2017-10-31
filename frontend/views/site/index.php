<?php

/* @var $this yii\web\View */
use yii\widgets\LinkPager;

$this->title = 'Catalog';
?>
<div class="site-index">

    <div class="jumbotron">
        <div class="search-box">
            <p>Bewertungen lesen. Das passende Produkt finden. Bewertungen schreiben.</p>
            <div class="search">
                <input type="text">
                <button><i class="fa fa-search"></i>suchen</button>
            </div>
        </div>
    </div>

    <div class="body-content catalog">
        <div class="grids">
            <div class="pull-right">
            <i class="fa fa-th-list active"></i>
            <i class="fa fa-th"></i>
            <span>Vergleichen</span>
            </div>
        </div>
        <div class="relevanz">
            <select name="relevanz" id="relevanz" class="pull-right">
                <option selected value="Relevanz">Relevanz</option>
                <option value="1">Option1</option>
                <option value="2">Option2</option>
            </select>
        </div>

        <?php foreach ($products as $product){ ?>
            <div class="row item">
                <div class="col-lg-4 section">
                    <img src="<?=$product->Picture?>" alt="item">
                </div>
                <div class="col-lg-4 section">
                    <a href="#"><span class="title"><?=$product->Title?></span></a>
                    <span class="brand">von <?=$product->Brand?></span>
                    <div class="score">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <i class="fa fa-star-o"></i>
                    </div>
                    <a href="#"><span class="val">745 Bewertungsanalysen</span></a>
                </div>
                <div class="col-lg-4 section">
                    <div class="price-block pull-left col-md-6 nopadding">
                        <span class="title bold">SEHR GUT</span>
                        <span class="price"><?=$product->Price?> €</span>
                        <a href="#"><span class="foot semibold">ReviewScore</span></a>
                    </div>
                    <div class="pull-left reviews col-md-6 nopadding">
                        <div class="line">
                            <a href="#"><div class="number pull-left">219<i class="fa fa-comment-o"></i></div></a>
                            <div class="type pull-left">Akku</div>
                        </div>
                        <div class="line">
                            <a href="#"><div class="number pull-left">11<i class="fa fa-comment-o"></i></div></a>
                            <div class="type pull-left">Fingerprint</div>
                        </div>
                        <div class="line">
                            <a href="#"><div class="number pull-left">16<i class="fa fa-comment-o"></i></div></a>
                            <div class="type pull-left">Gear Vr</div>
                        </div>
                        <a href="#"><span class="more">20 weitere Schlüsselthemen</span></a>
                    </div>
                </div>
            </div>
        <?php } ?>


    </div>
</div>
<?php
    echo LinkPager::widget([
    'pagination' => $pages,
    ]);
?>
