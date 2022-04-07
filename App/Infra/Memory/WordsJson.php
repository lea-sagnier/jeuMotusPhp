<?php

declare(strict_types=1);

namespace App\Infra\Memory;

use App\Elo\Word;

class WordsJson implements ConnectorInterface
{
    private const FILE_PATH = __DIR__ . '/../../../var/words.json';
    private static array $words = [];

    private static function loadFile()
    {
        if (empty(self::$words)) {
            self::$words = json_decode(file_get_contents(self::FILE_PATH), true);
        }

        return self::$words;
    }

    public static function findWord(): Word
    { 
        if (!isset($_COOKIE["word"])){
        self::loadFile();

        $words = self::$words;

        $one_item = $words[rand(0, count($words) - 1)];

        $cookie_save = $one_item['mot'];
        setcookie("word", $cookie_save);

        $mot = reset($words);
        return new Word($mot['mot']);
        }

        else {
            return new Word($_COOKIE['word']);
        }
       
    }
}
