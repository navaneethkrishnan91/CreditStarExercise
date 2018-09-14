<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;

$this->title = 'All Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <table class="table">
    <thead>
        <tr>
            <th scope="col"><?php echo $sort->link('id'); ?></th>
            <th scope="col"><?php echo $sort->link('first_name'); ?></th>
            <th scope="col"><?php echo $sort->link('last_name'); ?></th>
            <th scope="col">Email</th>
            <th scope="col">Personal Code</th>
            <th scope="col">Age</th>
            <th scope="col">Phone</th>
            <th scope="col">Active</th>
            <th scope="col">Dead</th>
            <th scope="col">Language</th>
        </tr>
    </thead>
    <tbody>
            <?php
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $user->getAttribute('id') . "</th>";
                    echo "<td>" . $user->getAttribute('first_name')  . "</td>";        
                    echo "<td>" . $user->getAttribute('last_name')  . "</td>";
                    echo "<td>" . $user->getAttribute('email')  . "</td>";
                    echo "<td>" . $user->getAttribute('personal_code')  . "</td>";
                    echo "<td>" . $user->age  . "</td>";
                    echo "<td>" . $user->getAttribute('phone')  . "</td>";
                    echo "<td>" . $user->getAttribute('active')  . "</td>";
                    echo "<td>" . $user->getAttribute('dead')  . "</td>";
                    echo "<td>" . $user->getAttribute('lang')  . "</td>";
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