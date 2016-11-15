<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\modules\FootballNews\Client\Client;
use app\modules\FootballNews\Transformer\RssToModel;
use app\modules\user\models\User;
use app\modules\post\models\Post;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CronController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function action15()
    {
  		#  Граббим футбольные новости
        $url = 'http://football.kulichki.net/news.rss';

        $ctx = stream_context_create(array( 
            'http' => array( 
                'timeout' => 1 
                ) 
            ) 
        ); 

        $footballNews = file_get_contents($url , 0, $ctx);
            
        if($footballNews)
        {
        	Yii::$app->cache->set('footballNews', $footballNews, 0);
        	echo "footballNews Success!\n";
        }


        #  проверяем не активированных пользователей
        $user_no_active = User::find()->where(
            [
                'status' => User::STATUS_INACTIVE,
            ]
            )->count();
        if(Yii::$app->cache->set('user_no_active', $user_no_active, $duration = 0, $dependency = null))
        {
            echo "user_no_active save Success!\n"; 
        }

        #  проверяем не активированные новости
        $post_no_active = Post::find()->where(
            [
                'status' => 0,
            ]
            )->count();
        if(Yii::$app->cache->set('post_no_active', $post_no_active, $duration = 0, $dependency = null))
        {
            echo "post_no_active save Success!\n"; 
        }
    }
}
