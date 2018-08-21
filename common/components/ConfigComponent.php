<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 19.08.2018
 * Time: 22:51
 */
namespace common\components;

use yii\base\Component;
use shop\entities\Shop\options\Config;

/**
 * Class ConfigComponent
 * @package common\components
 * 
 */


class ConfigComponent extends Component
{
    protected $data = array();

    public function init()
    {
        /** @var \shop\entities\Shop\options\Config $items */
        $items = Config::find()->all();
        foreach ($items as $item){
            if ($item->param)
                $this->data[$item->param] = $item->value === '' ?  $item->default : $item->value;
        }
        parent::init();
    }

    public function get($key)
    {
        if (array_key_exists($key, $this->data)){
            return $this->data[$key];
        } else {
            throw new \RuntimeException('Undefined parameter '.$key);
        }
    }

    public function set($key, $value)
    {
        $model = Config::findOne(['param' => $key]);
        if (!$model)
            throw new \RuntimeException('Undefined parameter '.$key);

        $this->data[$key] = $value;
        $model->value = $value;
        $model->save();
    }
}