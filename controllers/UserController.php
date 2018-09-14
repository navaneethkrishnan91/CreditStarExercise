<?php

namespace app\controllers;

use Yii;
use app\models\Users;
use yii\web\Controller;
use yii\data\Pagination;
use yii\data\Sort;
use yii\web\NotFoundHttpException;

class UserController extends Controller
{
    public function actionAll()
    {
        $sort = new Sort([
            'attributes' => [
                'id',
                'first_name',
                'last_name'
            ],
        ]);

        $query = Users::find()
            ->orderBy($sort->orders);

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count]);

        $users = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        foreach($users as $user){
            $user->age = $this->userAge($user->getAttribute('personal_code'));  
        }

        return $this->render('all', [
            'users' => $users,
            'pagination' => $pagination,
            'sort' => $sort
        ]);
    }

    /**
     * To calculate user's age
     * @param $personal_code int Personal Identiy Code
     * @return $age int Person's age
     */
    public function userAge($personal_code)
    {
        $age = 0;
        $dateBits = substr($personal_code, 1, -4);
        $dateTime = \DateTime::createFromFormat('ymd', $dateBits);

        if ($dateTime) {
            $birthDate = $dateTime->format('m/d/Y');
            $birthDate = explode("/", $birthDate);

            $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                ? ((date("Y") - $birthDate[2]) - 1)
                : (date("Y") - $birthDate[2]));
        }

        return abs($age);
    }
}
