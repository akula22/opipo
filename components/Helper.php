<?php
namespace app\components;

class Helper {
    public static function getMetaTags()  
    {
        $settings = \Yii::$app->cache->get('settings');
    
        return $settings;
    }
	public static function translit($var)
    {
        if(empty($var)) 
            return false;

        $charset = 'utf-8';
        $replace=array(
        "'"=>"",
        "`"=>"",
        "("=>"",")"=>"",
        "["=>"","]"=>"",
        "а"=>"a","А"=>"a",
        "б"=>"b","Б"=>"b",
        "в"=>"v","В"=>"v",
        "г"=>"g","Г"=>"g",
        "д"=>"d","Д"=>"d",
        "е"=>"e","Е"=>"e",
        "ж"=>"zh","Ж"=>"zh",
        "з"=>"z","З"=>"z",
        "и"=>"i","И"=>"i",
        "й"=>"y","Й"=>"y",
        "к"=>"k","К"=>"k",
        "л"=>"l","Л"=>"l",
        "м"=>"m","М"=>"m",
        "н"=>"n","Н"=>"n",
        "о"=>"o","О"=>"o",
        "п"=>"p","П"=>"p",
        "р"=>"r","Р"=>"r",
        "с"=>"s","С"=>"s",
        "т"=>"t","Т"=>"t",
        "у"=>"u","У"=>"u",
        "ф"=>"f","Ф"=>"f",
        "х"=>"h","Х"=>"h",
        "ц"=>"c","Ц"=>"c",
        "ч"=>"ch","Ч"=>"ch",
        "ш"=>"sh","Ш"=>"sh",
        "щ"=>"sch","Щ"=>"sch",
        "ъ"=>"","Ъ"=>"",
        "ы"=>"y","Ы"=>"y",
        "ь"=>"","Ь"=>"",
        "э"=>"e","Э"=>"e",
        "ю"=>"yu","Ю"=>"yu",
        "я"=>"ya","Я"=>"ya",
        "і"=>"i","І"=>"i",
        "ї"=>"yi","Ї"=>"yi",
        "є"=>"e","Є"=>"e"
        );
        $var1 = preg_replace( "/\s+/ms", "_", $var );
        $var2 = iconv($charset, $charset."//IGNORE", strtr($var1, $replace));
        return $var2;
    }


    public static function create_descr($title, $full)
    {
        $var = $title . ' ' . $full;
        $replace = array( "\x27", "\x22", "\x60", "\t","\n","\r",'"',"'", '\r', '\n', "/", "\\","&nbsp;");
        $var = trim(strip_tags($var));
        $var = str_replace($replace, '', $var );
        return substr(strip_tags(stripslashes($var)), 0, 190);
    }

    public static function create_keywords($title, $full)
    {
        $var = $title . ' ' . $full;
        $new_array = array();
        $keyword_count = 10;
        
        $replace = array( "\x27", "\x22", "\x60", "\t","\n","\r",'"',"'",",",".", '\r', '\n', "/", "\\","   &nbsp;");
        $var = trim(strip_tags($var));
        $var = str_replace($replace, '', $var );
        
        $array = explode(" ", $var);
        foreach ($array as $word) 
        {
            if(strlen($word) > 4) $new_array[] = $word;
            if(count($new_array) > 19) { break; }
        }
    
        return implode (", ", $new_array);   
    }
}
