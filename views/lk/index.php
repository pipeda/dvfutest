<?php
/**
 * Created by PhpStorm.
 * User: pipeda
 * Date: 03.10.2020
 * Time: 4:20
 */
use app\widgets\Alert;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\LkAsset;
use yii\bootstrap4\Modal;
use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
use yii\helpers\StringHelper;

LkAsset::register($this);
?>
<div class="container emp-profile" style="margin-top: 110px;">

                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                <?=  !Yii::$app->user->isGuest ?
                                    Html::beginForm(['/site/logout'], 'post')
                                    . Html::submitButton(
                                        'Выход (' . Yii::$app->user->identity->dvfu_name . ')',
                                        ['class' => 'btn btn-link logout']
                                    )
                                    . Html::endForm():'' ?>
                            </div>
                        </div>
                        <div class="profile-work">
                            <i class="fa fa-phone fa-2x"  aria-hidden="true"><?= Yii::$app->user->identity->dvfu_phone ?></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <?php foreach ($mag as $item): ?>

                            <div class="row">
                                <div class="col-md-4">
                                    <div>
                                        <?= Html::img('@web/image/'.$item->mag_image, ['alt' => 'domovid']) ?>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-4">Бесплатная доставка : <span class="badge badge-success"><?= $item->mag_dost?>Р.</span></div>
                                        <div class="col-md-4">В копилке на доставку: <span class="badge badge-info"><?= $item->mag_dost?>Р.</span></div>
                                        <div class="col-md-4">
                                        <?php
                                        Modal::begin([
                                            'closeButton' => [
                                                'id'=>'close-button',
                                                'class'=>'close',
                                                'data-dismiss' =>'modal',
                                            ],
                                        'toggleButton' => ['label' => 'Сложится!','tag' => 'button', 'class' => 'btn btn-info'],
                                            'id' => 'modal',
                                        ]);
                                        $form = ActiveForm::begin([
                                            'action' => Url::to(['/shopcart/add', 'id' => $item->mag_id]),
                                            'options' => ['class'=>'form-row align-items-center','id'=>'form_tel'],
                                            'fieldConfig' => [
                                                'template' => "\n{beginWrapper}\n{input}\n{hint}\n{endWrapper}\n<br>",
                                                'horizontalCssClasses' => [
                                                    'label' => 'col-sm-4',
                                                    'offset' => 'offset-sm-2',
                                                    'wrapper' => 'col-sm-8',
                                                    'error' => '',
                                                    'hint' => '',
                                                ],
                                            ],
                                        ]);
                                         ?>
                                        <?= $form->field($model, 'zakaz_cena',['options' => ['class' => 'col-md-12']])->label('zakaz_cena'); ?>

                                        <?= $form->field($model, 'zakaz_chek',['options' => ['class' => 'col-md-12']])->label(false); ?>

                                            <?= $form->field($model, 'zakaz_opis',['options' => ['class' => 'col-md-12']])->label(false); ?>
                                    <?php
                                        ActiveForm::end();
                                        Modal::end();?>
                                        </div>
                                       </div>
                                    <hr>
<p><?= StringHelper::truncate($item->mag_opis,200,'...') ;?></p>
                                </div>
                            </div>
                            <hr>
                        <?php endforeach ?>


                        </div>

                </div>
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-8">

                    </div>
                </div>

        </div>