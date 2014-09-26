<?php
class Like extends CComponent
{
    public function init()
    {
    }

    public function likeUser($id_user)
    {
        if ($like = LikeUsers::model()->findByAttributes(array('id_user' => $id_user))) {
            $like->delete();
            $label = "Like";
        } else {
            $like = new LikeUsers();
            $like->id_user = $id_user;
            $like->save();
            $label = "UnLike";
        }
        return $label;
    }

    public function likeRepo($id_repo)
    {
        if ($like = LikeRepo::model()->findByAttributes(array('id_repo' => $id_repo))) {
            $like->delete();
            $label = "Like";
        } else {
            $like = new LikeRepo();
            $like->id_repo = $id_repo;
            $like->save();
            $label = "UnLike";
        }
        return $label;
    }
}