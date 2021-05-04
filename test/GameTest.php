<?php

use App\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testPlay()
    {
        $game = new Game();
        $this->assertEquals(Game::EMPTY, $game->getBoard()[3][3]);
        $game->play([3,5], [3,3]);
        $this->assertEquals(Game::PAWN, $game->getBoard()[3][3]);
    }

    public function testMoveNotEmpty()
    {
        $this->expectException(LogicException::class);
        $game = new Game();
        $game->play([3,5], [3,4]);
    }

    public function testMoveFromNotPawn()
    {
        $this->expectExceptionMessage('Not a pawn');
        $game = new Game();
        $game->play([0,0], [3,3]);
    }

    public function testOutOfBoard()
    {
        $this->expectException(LogicException::class);
        $game = new Game();
        $game->play([3,5], [0,0]);
    }

    public function testNotTakePawn()
    {
        $this->expectExceptionMessage('Impossible move, you should take a pawn');
        $game = new Game();
        $game->play([6,3], [3,3]);
    }

    public function testMiddlePawn()
    {
        $this->expectExceptionMessage('Impossible move, you should take a pawn');
        $game = new Game();
        $game->play([3,5], [3,3]);
        $game->play([3,3], [3,5]);
    }
    
    public function testTakePawn()
    {
        $game = new Game();
        $this->assertEquals(Game::EMPTY, $game->getBoard()[3][3]);
        $game->play([3,5], [3,3]);
        $this->assertEquals(Game::EMPTY, $game->getBoard()[4][3]);
    }
}
