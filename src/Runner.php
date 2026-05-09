<?php

namespace App;

use App\IO\Reader;
use App\IO\Referee;

class Runner
{
    public const DEBUG = false;
    public const ENABLE_MESSAGE = false;
    public const DUMP_REFEREE = false;

    public function run(): void
    {
        $bot = new Bot();
        $game = Reader::initialize();

        while (true) {
            $game = Reader::readRound($game);

            if (self::DUMP_REFEREE) {
                Referee::dump();
            }

            $actions = $bot->play($game);

            foreach ($actions as $action) {
                echo $action;
            }

            if (feof(STDIN)) {
                break;
            }

            Referee::reset();
        }
    }
}
