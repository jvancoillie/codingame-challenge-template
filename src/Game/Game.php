<?php

namespace App\Game;

class Game
{
    /** @var int */
    public $round;
    /** @var Player */
    public $me;
    /** @var Player */
    public $opponent;

    public function __construct(?Game $previousGame = null)
    {
        $this->round = $previousGame ? $previousGame->round + 1 : 1;
        $this->me = new Player();
        $this->opponent = new Player();
    }
}
