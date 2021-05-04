<?php

namespace App;

use LogicException;

class Game
{
    private array $board;

    public const INVALID = 'invalid';
    public const PAWN = 'pawn';
    public const EMPTY = 'empty';

    public function __construct(?array $board = null)
    {
        $this->board = $board ?? [
            [self::INVALID, self::INVALID, self::PAWN, self::PAWN, self::PAWN, self::INVALID, self::INVALID],
            [self::INVALID, self::INVALID, self::PAWN, self::PAWN, self::PAWN, self::INVALID, self::INVALID],
            [self::PAWN, self::PAWN, self::PAWN, self::PAWN, self::PAWN, self::PAWN, self::PAWN],
            [self::PAWN, self::PAWN, self::PAWN, self::EMPTY, self::PAWN, self::PAWN, self::PAWN],
            [self::PAWN, self::PAWN, self::PAWN, self::PAWN, self::PAWN, self::PAWN, self::PAWN],
            [self::INVALID, self::INVALID, self::PAWN, self::PAWN, self::PAWN, self::INVALID, self::INVALID],
            [self::INVALID, self::INVALID, self::PAWN, self::PAWN, self::PAWN, self::INVALID, self::INVALID],
        ];
    }

    public function play(array $from, array $to): void
    {
 
    }

    /**
     * Get the value of board
     */
    public function getBoard(): array
    {
        return $this->board;
    }

    /**
     * Set the value of board
     *
     * @return  self
     */
    public function setBoard(array $board)
    {
        $this->board = $board;

        return $this;
    }
}
