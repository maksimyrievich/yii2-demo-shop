<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 27.08.2018
 * Time: 21:56
 */

namespace backend\forms\Shop\delivery;


use yii\base\Model;

class RusPostSetForm extends Model
{
    //Переменные со вкладки "Общие"
    public $public;
    public $nalplatej;
    public $tiprasch;
    public $maxves;

    //Переменные со вкладки "Наценка"
    public $nacenMin1;
    public $nacenMin2;
    public $nacenMin3;
    public $nacenMin4;
    public $nacenMin5;

    public $nacenMax1;
    public $nacenMax2;
    public $nacenMax3;
    public $nacenMax4;
    public $nacenMax5;

    public $nacenSumm1;
    public $nacenSumm2;
    public $nacenSumm3;
    public $nacenSumm4;
    public $nacenSumm5;

    //Переменные со вкладки "Упаковка"
    public $upakovMin1;
    public $upakovMin2;
    public $upakovMin3;
    public $upakovMin4;
    public $upakovMin5;

    public $upakovMax1;
    public $upakovMax2;
    public $upakovMax3;
    public $upakovMax4;
    public $upakovMax5;

    public $upakovSumm1;
    public $upakovSumm2;
    public $upakovSumm3;
    public $upakovSumm4;
    public $upakovSumm5;

    public $nacenDiffEnable;
    public $upakovDiffEnable;

    public function rules(): array
    {
        return [
            [['nacenMin1', 'nacenMin2', 'nacenMin3', 'nacenMin4', 'nacenMin5',
              'nacenMax1', 'nacenMax2', 'nacenMax3', 'nacenMax4', 'nacenMax5',
              'nacenSumm1', 'nacenSumm2', 'nacenSumm3', 'nacenSumm4', 'nacenSumm5',
              'upakovMin1', 'upakovMin2', 'upakovMin3', 'upakovMin4', 'upakovMin5',
              'upakovMax1', 'upakovMax2', 'upakovMax3', 'upakovMax4', 'upakovMax5',
              'upakovSumm1', 'upakovSumm2', 'upakovSumm3', 'upakovSumm4', 'upakovSumm5',
              'maxves', 'tiprasch', 'nalplatej', 'public'], 'integer'],
             [['maxves'], 'required'],
            [['nacenDiffEnable','upakovDiffEnable'], 'boolean']
        ];
    }

    public function attributeLabels()
    {
        return [
            'public' => 'Опубликовать этот способ доставки?',
            'nalplatej' => 'Делать расчет наложенным платежом?',
            'tiprasch' => 'Расчитывать доставку',
            'maxves' => 'Максимальный вес отправления (грамм)',

            'nacenMin1' => '1 Мин вес',
            'nacenMin2' => '2 Мин вес',
            'nacenMin3' => '3 Мин вес',
            'nacenMin4' => '4 Мин вес',
            'nacenMin5' => '5 Мин вес',

            'nacenMax1' => '1 Макс вес',
            'nacenMax2' => '2 Макс вес',
            'nacenMax3' => '3 Макс вес',
            'nacenMax4' => '4 Макс вес',
            'nacenMax5' => '5 Макс вес',

            'nacenSumm1' => '1 наценка',
            'nacenSumm2' => '2 наценка',
            'nacenSumm3' => '3 наценка',
            'nacenSumm4' => '4 наценка',
            'nacenSumm5' => '5 наценка',

            'upakovMin1' => '1 Мин вес',
            'upakovMin2' => '2 Мин вес',
            'upakovMin3' => '3 Мин вес',
            'upakovMin4' => '4 Мин вес',
            'upakovMin5' => '5 Мин вес',

            'upakovMax1' => '1 Макс вес',
            'upakovMax2' => '2 Макс вес',
            'upakovMax3' => '3 Макс вес',
            'upakovMax4' => '4 Макс вес',
            'upakovMax5' => '5 Макс вес',

            'upakovSumm1' => '1 вес',
            'upakovSumm2' => '2 вес',
            'upakovSumm3' => '3 вес',
            'upakovSumm4' => '4 вес',
            'upakovSumm5' => '5 вес',

            'nacenDiffEnable' => 'Вкл/Выкл диф наценку',
            'upakovDiffEnable' => 'Вкл/Выкл диф прибавку'
        ];
    }
}