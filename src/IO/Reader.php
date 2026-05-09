<?php

namespace App\IO;

use App\Game\Game;

class Reader
{
    public static function initialize(): Game
    {
        $game = new Game();
        Referee::addEntry('>>>--------- initialize -----------');

        // TODO: read initialization data from STDIN (runs once before the game loop)
        //
        // Single integer:
        //   fscanf(STDIN, "%d", $count);
        //   Referee::addEntry((string) $count);
        //
        // Space-separated values on one line:
        //   $line = fgets(STDIN);
        //   Referee::addEntry($line);
        //   $inputs = explode(' ', trim($line));
        //
        // Loop over N lines:
        //   for ($i = 0; $i < $count; $i++) {
        //       fscanf(STDIN, "%d %d", $a, $b);
        //       Referee::addEntry(sprintf("%d %d", $a, $b));
        //   }

        return $game;
    }

    public static function readRound(Game $previousGame): Game
    {
        $game = new Game($previousGame);

        // TODO: read per-turn data from STDIN (runs every round)
        //
        // fscanf(STDIN, "%d %d %d", $a, $b, $c);
        // Referee::addEntry(sprintf("%d %d %d", $a, $b, $c));

        return $game;
    }
}
