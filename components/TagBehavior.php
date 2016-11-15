<?php
namespace app\components;
use yii\helpers\Html;

class TagBehavior extends \sjaakp\taggable\TagBehavior {
  
    public function getLink($options = [])   
    {
        $owner = $this->owner;
       
        $tags = \app\components\Helper::translit($owner->getAttribute($this->nameAttribute));

        return Html::a('#' . $owner->getAttribute($this->nameAttribute), '/tag/' . $owner->{$this->linkAttr}, $options);
    }
}