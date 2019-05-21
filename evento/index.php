<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\datetime\DateTimePicker;
use app\models\Evento;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//  $this->title = 'Eventos';
//$this->params['breadcrumbs'][] = $this->title;
?>
<script src="../js/jquery.min.js"></script>
<script src="../js/moment.min.js"></script>

<div class="evento-index" id="calendar" align="right">

    <?php
    $eventos = Evento::find()->all();
    //$a=var_dump($eventos);
    
    $arreglo = [];
    foreach ($eventos as $eve) {
        $evento = new \yii2fullcalendar\models\Event();
        $evento->id = $eve->id;
        $evento->title = $eve->nombre;
        //$evento->nombre = 'Testing';
        //$evento->descripcion = $eve->title;
        $evento->start = $eve->desde;
        $evento->url = Url::to(['evento/ver', 'id' => $eve->id]);
        if ($eve->es_feriado == 1) {
            $evento->color = "red";
        }
        $evento->allDay = true;
        $arreglo[] = $evento;
    }
    ?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php 
    // echo $this->render('_search', ['model' => $searchModel]);  ?>
    
    <!-- mostramos el calendario de fullcalendar de la siguiente manera -->
    <?= yii2fullcalendar\yii2fullcalendar::widget(array(
        'events' => $arreglo,
        //le cambia el ancho al calendario y lo alinea a la derecha
        'options' => array(
        'style' => 'width:25%;float:right;' //editar tamaño y posicion
        ),
    ));
    ?>
</div>
