<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'All Loans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
    <thead>
        <tr>
            <th scope="col"><?php echo $sort->link('id'); ?></th>
            <th scope="col"><?php echo $sort->link('user_id'); ?></th>
            <th scope="col"><?php echo $sort->link('amount'); ?></th>
            <th scope="col">Interest</th>
            <th scope="col">Duration</th>
            <th scope="col">Start</th>
            <th scope="col">End</th>
            <th scope="col">Campaign</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
            <?php
                foreach ($loans as $loan) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $loan->getAttribute('id') . "</th>";
                    echo "<td>" . $loan->getAttribute('user_id')  . "</td>";        
                    echo "<td>" . $loan->getAttribute('amount')  . "</td>";
                    echo "<td>" . $loan->getAttribute('interest')  . "</td>";
                    echo "<td>" . $loan->getAttribute('duration')  . "</td>";
                    echo "<td>" . $loan->getAttribute('start_date')  . "</td>";
                    echo "<td>" . $loan->getAttribute('end_date')  . "</td>";
                    echo "<td>" . $loan->getAttribute('campaign')  . "</td>";
                    echo "<td>" . $loan->getAttribute('status')  . "</td>";
                    echo "</tr>";
                }
            ?>
    </tbody>
    </table>

    <?php
        echo LinkPager::widget([
            'pagination' => $pagination,
        ]);
    ?>
</div>