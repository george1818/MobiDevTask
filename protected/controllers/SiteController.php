<?php

class SiteController extends Controller
{
    public function actionIndex()
    {
        $out = 'Main';
        $this->pageTitle = Yii::app()->name;

        $repo = Yii::app()->github->getRepository('yiisoft', 'yii');
        $contributors = Yii::app()->github->getRepositoryContributors('yiisoft', 'yii');
        foreach($contributors as $contributor) {
            $contributor->liked = LikeUsers::model()->findByAttributes(array("id_user"=>$contributor->id)) ? true : false;
        }

        if(Yii::app()->request->isAjaxRequest){
            $idContr = Yii::app()->request->getPost('id');
            $label = Yii::app()->like->likeUser($idContr);
            echo CHtml::ajaxSubmitButton($label, '', array(
                    'type' => 'post',
                    'replace' => '#contr'.$idContr,
                ),
                array(
                    'type' => 'submit', 'class' => 'contribLike', 'id' => 'contr'.$idContr
                ));
            // Завершаем приложение
            Yii::app()->end();
        }
        else {
            $this->render('index', array('response' => $repo,'contributors'=>$contributors,'out'=>$out));
        }
    }

    public function actionSearch()
    {
        $out = 'Search';
        $request = $_GET["search"];

        $this->pageTitle = Yii::app()->name;
        $response = Yii::app()->github->searchRepositories($request);
        foreach($response->items as $item) {
            $item->liked = LikeRepo::model()->findByAttributes(array("id_repo"=>$item->id)) ? true : false;
        }
        if(Yii::app()->request->isAjaxRequest){
            $idContr = Yii::app()->request->getPost('id');
            $label = Yii::app()->like->likeRepo($idContr);
            echo CHtml::ajaxSubmitButton($label, '', array(
                    'type' => 'post',
                    'replace' => '#contr'.$idContr,
                ),
                array(
                    'type' => 'submit', 'class' => 'contribLike', 'id' => 'contr'.$idContr
                ));
            // Завершаем приложение
            Yii::app()->end();
        }
        else {
            $this->render('search', array('response' => $response, 'request' => $request, 'out'=>$out));
        }
    }

    public function actionInfo()
    {
        $out = 'Project';
        $id = $_GET['id_project'];

        $repo = Yii::app()->github->getRepositoryById($id);
//        $contributors = Yii::app()->github->getRepositoryContributors($repo->owner->login, $repo->name);
        $contributors = Yii::app()->github->getRepositoryContributorsByRepoId($id);
        foreach($contributors as $contributor) {
            $contributor->liked = LikeUsers::model()->findByAttributes(array("id_user"=>$contributor->id)) ? true : false;
        }

        if(Yii::app()->request->isAjaxRequest){
            $idContr = Yii::app()->request->getPost('id');
            $label = Yii::app()->like->likeUser($idContr);
            echo CHtml::ajaxSubmitButton($label, '', array(
                    'type' => 'post',
                    'replace' => '#contr'.$idContr,
                ),
                array(
                    'type' => 'submit', 'class' => 'contribLike', 'id' => 'contr'.$idContr
                ));
            // Завершаем приложение
            Yii::app()->end();
        }
        else {
            $this->render('index', array('response' => $repo,'contributors'=>$contributors,'out'=>$out));
        }
    }

    public function actionInfoUser()
    {
        $out = 'User';
        $name = $_GET['name_user'];

        $response = Yii::app()->github->getUser($name);
        $response->liked = LikeUsers::model()->findByAttributes(array("id_user"=>$response->id)) ? true : false;
        if(Yii::app()->request->isAjaxRequest){
            $idContr = Yii::app()->request->getPost('id');
            $label = Yii::app()->like->likeUser($idContr);
            echo CHtml::ajaxSubmitButton($label, '', array(
                    'type' => 'post',
                    'replace' => '#contr'.$idContr,
                ),
                array(
                    'type' => 'submit', 'class' => 'LikeUser', 'id' => 'contr'.$idContr
                ));
            // Завершаем приложение
            Yii::app()->end();
        }
        else {
            $this->render('infoUser', array('response' => $response,'out'=>$out));
        }
    }


}

/**
 * This is the action to handle external exceptions.
 */

