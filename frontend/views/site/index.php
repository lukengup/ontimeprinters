<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\data\ArrayDataProvider;
//use yii\bootstrap\Carousel;
use amilna\nivoslider\NivoSlider;
use drmabuse\slick\SlickWidget;

$this->title = Yii::$app->name;
?>
<div class="site-index">

    <div class="body-content">

        <div class="row clearfix">
            <div class="col-sm-6">
                <?php //Html::img('@web/images/vehicle.png', ['alt' => 'vehicle', 'class' => 'img-responsive', 'img-rounded'])   ?>

                <?=
                NivoSlider::widget([
                    // active data provider or just array of image, url, title and description, exp: [["image"=>"test1.jpg","url"=>null],["image"=>"test2.jpg","url"=>null]]
                    // [["image"=> Yii::$app->request->baseUrl."/images/vehicle.png","url"=>null]],
                    'dataProvider' => $provider,
                    'targetId' => 'nivoslider', //id of rendered nivoslider (the container will constructed by the widget with the given id)		
                    'imageKey' => 'image', //model attribute to be used as background
                    'theme' => 'default', //available themes: default, bar, dark, light
                    'css' => '', // url of css to overide default css relative from @web	  		
                    //	example to overide default options	more options on http://docs.dev7studios.com/jquery-plugins/nivo-slider
                    'options' => [
                        'effect' => 'boxRandom',
                        'manualAdvance' => false,
                        'controlNav' => false
                    ],
                ]);
                ?>
            </div>

            <div class="col-sm-6">
                <h2> <b> Alif Technologies and Investments </b> </h2>  
                <p>
                    Alif Technologies and Investments was founded by Saheed Kareem Olaore, Rafiat Amure and Ayuba Kareem with experience in both Information Technology and Printing Industry way back in 2013. It is growing fast and we are proud to meet the demand of fast growing Printing Industry.   

                </p>

                <h2> <b>Why Choose Us </b> </h2> 
                <p>
                    We believe that our success is based on an adherence to sound business principles and a commitment to service excellence. Not only are we highly competitive in our field but we believe that we also offer a level of service and expertise unsurpassed in the IT Services and Printing industry.

                </p>
            </div>

        </div>

        <h2> <b>Our Service </b> </h2> 
        <div class="row clearfix">


            <?=
            SlickWidget::widget([
                'container' => '.single-item',
                'settings' => [
                    'slick' => [
                        'infinite' => true,
                        'slidesToShow' => 6,
                        'slidesToScroll' => 1,
                        'arrows' => true,
                        'autoplay' => true,
                        'autoplaySpeed' => 2000,
                        'onBeforeChange' => new \yii\web\JsExpression('function(){
				}'),
                        'onAfterChange' => new \yii\web\JsExpression('function(){
					console.debug(this);
				}'),
                        'responsive' => [
                                [
                                'breakpoint' => 768,
                                'settings' => [
                                    'arrows' => true,
                                    'centerMode' => true,
                                    'centerPadding' => 0,
                                    'slidesToShow' => 6
                                ]
                            ]
                        ],
                    ],
                //  'slickGoTo' => 3,
                ]
            ]);
            ?>
            <div class="single-item">
                <div>

<?php echo Html::img('@web/images/t-shirt.png', ['alt' => 'Tshirt', 'class' => 'img-responsive']) ?>
                    <span>T Shirt Printing</span>
                </div>
                <div >

<?php echo Html::img('@web/images/flyers.png', ['alt' => 'Flyers', 'class' => 'img-responsive']) ?> 
                    <span>Flyers </span>
                </div>
                <div >

<?php echo Html::img('@web/images/business_card.png', ['alt' => 'Business Card', 'class' => 'img-responsive']) ?> 
                    <span>Business card </span>
                </div>
                <div>

<?php echo Html::img('@web/images/calendar.png', ['alt' => 'Calendar & Posters', 'class' => 'img-responsive']) ?> 
                    <span>Calendar & Posters</span>
                </div>
                <div>

<?php echo Html::img('@web/images/menu.png', ['alt' => 'Menus', 'class' => 'img-responsive']) ?>  
                    <span>Menus </span>
                </div>
                <div>

<?php echo Html::img('@web/images/invitations.png', ['alt' => 'Invitations & CD Cover', 'class' => 'img-responsive']) ?> 
                    <span>Invitations & CD Cover </span>
                </div>
                <div>

<?php echo Html::img('@web/images/wedding-pic.jpg', ['alt' => 'Photography', 'class' => 'img-responsive']) ?>  
                    <span>Photography </span>
                </div>

            </div>



        </div>

    </div>
</div>

</div>


