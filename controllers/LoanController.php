<?php

namespace app\controllers;

use Yii;
use app\models\Loan;
use yii\web\Controller;
use yii\data\Pagination;
use yii\data\Sort;
use yii\web\NotFoundHttpException;

class LoanController extends Controller
{
    public function actionAll()
    {
        $sort = new Sort([
            'attributes' => [
                'id',
                'user_id',
                'amount'
            ],
        ]);

        $query = Loan::find()
            ->orderBy($sort->orders);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);

        $loans = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        return $this->render('all', [
            'loans' => $loans,
            'pagination' => $pagination,
            'sort' => $sort
        ]);
    }
}
