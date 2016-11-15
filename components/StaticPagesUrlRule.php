<?php
namespace app\components;

use yii\web\UrlRuleInterface;
use yii\base\Object;
use app\modules\pages\models\Pages;

class StaticPagesUrlRule extends Object implements UrlRuleInterface
{

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'pages/default/view') {
            if (isset($params['alias'], $params['model'])) {
                return $params['alias'] . '/' . $params['model'];
            } elseif (isset($params['alias'])) {
                return $params['alias'];
            }
        }
        return false;  // данное правило не применимо
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches)) 
        {
        	if(Pages::find(['alias' => $matches[1]])->count())
	        {
            	return ['pages/default/view', ['alias' => $matches[1]]]; 
	        }
        }
        return false;  // данное правило не применимо
    }
}