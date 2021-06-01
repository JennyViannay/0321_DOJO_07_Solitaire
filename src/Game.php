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
        $board = $this->getBoard();

        $takenPawn = $this->isMoveValid($from, $to);
 
        $board[$from[1]][$from[0]] = self::EMPTY;
        $board[$to[1]][$to[0]] = self::PAWN;
        $board[$takenPawn[1]][$takenPawn[0]] = self::EMPTY;

        $this->setBoard($board);
    }

    private function isMoveValid(array $from, array $to): array
    {
        // si il n'existe pas dans le Board[la coord from x][la coord from y] ou que 
        // Board[la coord from x][la coord from y] n'est pas self::PAWN
        // "NOT A PAWN"
        if (!isset($this->getBoard()[$from[0]][$from[1]]) || $this->getBoard()[$from[0]][$from[1]] !== self::PAWN) {
            throw new LogicException('Not a pawn');
        }

        // si Board[la coord to x][la coord to y] n'est pas self::EMPTY
        // "NOT EMPTY"
        if ($this->getBoard()[$to[1]][$to[0]] !== self::EMPTY) {
            throw new LogicException('Not empty');
        }

        // definir les coord de la takenPawn -> 
        // x = from x - (from x - to x) / 2
        // y = from y - (from y - to y) / 2 

        $takenPawn = [$from[0] - ($from[0] - $to[0]) / 2,  $from[1] - ($from[1] - $to[1]) / 2];
        
        // definir si la coup isValid 
        // (($from[1] === $to[1] && abs($from[0] - $to[0]) === 2) || ($from[0] === $to[0] && abs($from[1] - $to[1]) === 2)) && ($this->getBoard()[$takenPawn[1]][$takenPawn[0]] === self::PAWN);
        $isValid = (($from[1] === $to[1] && abs($from[0] - $to[0]) === 2) ||
            ($from[0] === $to[0] && abs($from[1] - $to[1]) === 2)) &&
            ($this->getBoard()[$takenPawn[1]][$takenPawn[0]] === self::PAWN);

        // si n'est pas valid return "Impossible move, you should take a pawn"
        if (!$isValid) {
            throw new LogicException('Impossible move, you should take a pawn');
        }

        // return takenPawn
        return $takenPawn;
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
