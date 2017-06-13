<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Large Format Printing';
$this->params['breadcrumbs'][] = $this->title;



/* echo GridView::widget([
  'dataProvider' => $provider,
  'columns' => [
  ['attribute' => 'image',]
  // ...
  ],
  ]) */
?>
<div class="site-large-printing">
    <div class="body-content">
        <div class="row">

            <?php
            $i = 0;
            foreach ($files as $file):
                ?>
                <div class="col-lg-4">
                    <?= Html::img('@web/' . $file, ['class' => 'img-responsive img-rounded']) ?>
                </div>
                <?php if (++$i % 3 == 0): ?>
            <div class="clearfix"></div> </div><div class="row">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>



