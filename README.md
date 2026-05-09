# CodinGame Challenge Template

PHP starter kit for building CodinGame bots locally, with a multi-file workflow and single-file submission.

## Start a new challenge

```bash
git clone git@github.com:jvancoillie/codingame-challenge-template.git codingame-<challenge-name>
cd codingame-<challenge-name>
make build
```

Then fill in order:
1. **`src/IO/Reader.php`** — implement the STDIN protocol provided by CodinGame
2. **`src/Game/Game.php`** and **`src/Game/Player.php`** — model the game state
3. **`src/Bot.php`** — implement the decision logic

## Structure

```
src/
├── Runner.php        ← game loop (do not modify)
├── Bot.php           ← bot decision logic            ← edit here
│
├── IO/
│   ├── Reader.php    ← STDIN parsing                 ← edit here
│   ├── Action.php    ← output formatting
│   └── Referee.php   ← input recording (debug/replay)
│
├── Game/
│   ├── Game.php      ← world state                   ← edit here
│   └── Player.php    ← per-player state              ← edit here
│
├── AI/               ← reusable algorithms (MCTS, etc.)
│
└── Utils/
    └── Collection.php ← generic typed collection
```

## Implementing a challenge

### 1. Parse the protocol

Fill `Reader.php` according to the CodinGame protocol:

```php
// Initialization (before the loop) — Reader::initialize()
fscanf(STDIN, "%d", $count);
Referee::addEntry((string) $count);

// Per turn — Reader::readRound()
fscanf(STDIN, "%d %d %d", $a, $b, $c);
Referee::addEntry(sprintf("%d %d %d", $a, $b, $c));
```

### 2. Model the state

Add properties to `Game.php` and `Player.php`:

```php
// Game.php — PHP 7.3 compatible (no typed properties)
/** @var Cell[] */
public $cells = [];

// Player.php
/** @var int */
public $score = 0;
```

### 3. Implement the bot

Write the logic in `Bot::play(Game $game): array` — return an array of `Action`.

```php
public function play(Game $game): array
{
    // $game->me, $game->opponent, $game->round
    return [(new Action())->setInstruction(Action::WAIT)];
}
```

## Commands

| Command | Description |
|---|---|
| `make build` | Build the Docker image |
| `make tests` | Run PHPUnit |
| `make format` | Format code (php-cs-fixer) |
| `make combine` | Generate `public/ide.php` for CodinGame submission |
| `make play` | Replay the bot against `public/referee.json` |

## Submission workflow

```bash
make combine   # generates public/ide.php
# paste public/ide.php into the CodinGame editor
```

## Debug and replay

1. Capture a game session into `public/referee.json`
2. `make play` replays the bot against that input locally

Enable logs in `Runner.php`:
```php
public const DEBUG = true;        // enables dump()
public const DUMP_REFEREE = true; // prints recorded input
```

## PHP constraints

CodinGame runs **PHP 7.3.9** — no typed properties (PHP 7.4+):

```php
// ✗ PHP 7.4+
public int $round;

// ✓ PHP 7.3
/** @var int */
public $round;
```

Method return types and nullable types (`?Game`) are supported (PHP 7.1+).
