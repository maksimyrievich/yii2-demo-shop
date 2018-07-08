<?php
/**
 * Created by PhpStorm.
 * User: Maksim
 * Date: 08.07.2018
 * Time: 1:23
 */

namespace backend\forms\Shop;


use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use shop\entities\Shop\options\Country;

class CountrySearch extends Model
{
    public $iso2;
    public $country;
    public $publish;


    public function rules()
    {
        return [
            [['iso2', 'country'], 'string'],
            [['publish'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'iso2' => 'Код страны',
            'country' => 'Название страны',
            'publish' => 'Состояние',
        ];
    }

    public function search($params)
    {
        $query = Country::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 11,
            ],
            'sort' => [
                'defaultOrder' => ['country' => SORT_ASC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'country' => $this->country,
            'publish' => $this->publish,
        ]);

        $query
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'publish', $this->publish]);

        return $dataProvider;
    }
}