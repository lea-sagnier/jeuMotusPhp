<?php

declare(strict_types=1);

namespace App\Infra\Memory;

use App\Elo\Word;

class WordsJson implements ConnectorInterface
{
    private const FILE_PATH = __DIR__ . '/../../../var/db.json';
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
        self::loadFile();

        $word = reset($words);
        return new Word($word['mot']);
    }
}
