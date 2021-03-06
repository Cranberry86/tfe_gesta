<?php

/**
 * @todo : centraliser les appels à DB::insert dans une classe
 */
class Observer_Logging extends Orm\Observer
{

    /**
     * A exécuter après un INSERT
     * @param Orm\Model $model
     */
    public function after_insert(Orm\Model $model)
    {
        $user = \Auth::instance()->get_user_id();
        $uid = $user[1];
        $id = $model::get_primary_key_name();
        $now = date('Y-m-d h:i:s');
        \DB::insert('logs')
                ->set(array(
                    'user_id' => $uid,
                    'action' => 'insert',
                    'model' => get_class($model),
                    'tms' => $now,
                    'model_id' => $model->$id,
                ))
                ->execute();
    }
    
    /**
     * A exécuter après un UPDATE
     * @param Orm\Model $model
     */
    public function after_update(Orm\Model $model)
    {
        $user = \Auth::instance()->get_user_id();
        $uid = $user[1];
        $id = $model::get_primary_key_name();
        $now = date('Y-m-d h:i:s');
        \DB::insert('logs')
                ->set(array(
                    'user_id' => $uid,
                    'action' => 'update',
                    'model' => get_class($model),
                    'tms' => $now,
                    'model_id' => $model->$id,
                ))
                ->execute();
    }
    
    /**
     * A exécuter après un DELETE
     * @param Orm\Model $model
     */
    public function after_delete(Orm\Model $model)
    {
        $user = \Auth::instance()->get_user_id();
        $uid = $user[1];
        $id = $model::get_primary_key_name();
        $now = date('Y-m-d h:i:s');
        \DB::insert('logs')
                ->set(array(
                    'user_id' => $uid,
                    'action' => 'delete',
                    'model' => get_class($model),
                    'tms' => $now,
                    'model_id' => $model->$id,
                ))
                ->execute();
    }

}

?>
