<?php
namespace common\rbac;

use yii\rbac\Rule;

class AccessOwnData extends Rule
{
    public $name = 'AccessOwnData';

    public function execute($user_id, $item, $params)
    {
        //return Admin Full control;
        if($user_id === 1){
            return TRUE;
        }
        return $params['model']->$params['attr'] == $user_id;
    }
}
 ?>
