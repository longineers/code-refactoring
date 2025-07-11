<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame2 implements TennisGame
{
    private int $player1Point = 0;

    private int $player2point = 0;

    private string $player1Result = '';

    private string $player2Result = '';

    public function __construct(
        private string $player1Name,
        private string $player2Name
    ) {
    }

    public function getScore(): string
    {
        $score = '';
        if ($this->player1Point === $this->player2point && $this->player1Point < 4) {
            if ($this->player1Point === 0) {
                $score = 'Love';
            }
            if ($this->player1Point === 1) {
                $score = 'Fifteen';
            }
            if ($this->player1Point === 2) {
                $score = 'Thirty';
            }
            $score .= '-All';
        }

        if ($this->player1Point === $this->player2point && $this->player1Point >= 3) {
            $score = 'Deuce';
        }

        if ($this->player1Point > 0 && $this->player2point === 0) {
            if ($this->player1Point === 1) {
                $this->player1Result = 'Fifteen';
            }
            if ($this->player1Point === 2) {
                $this->player1Result = 'Thirty';
            }
            if ($this->player1Point === 3) {
                $this->player1Result = 'Forty';
            }

            $this->player2Result = 'Love';
            $score = "{$this->player1Result}-{$this->player2Result}";
        }

        if ($this->player2point > 0 && $this->player1Point === 0) {
            if ($this->player2point === 1) {
                $this->player2Result = 'Fifteen';
            }
            if ($this->player2point === 2) {
                $this->player2Result = 'Thirty';
            }
            if ($this->player2point === 3) {
                $this->player2Result = 'Forty';
            }
            $this->player1Result = 'Love';
            $score = "{$this->player1Result}-{$this->player2Result}";
        }

        if ($this->player1Point > $this->player2point && $this->player1Point < 4) {
            if ($this->player1Point === 2) {
                $this->player1Result = 'Thirty';
            }
            if ($this->player1Point === 3) {
                $this->player1Result = 'Forty';
            }
            if ($this->player2point === 1) {
                $this->player2Result = 'Fifteen';
            }
            if ($this->player2point === 2) {
                $this->player2Result = 'Thirty';
            }
            $score = "{$this->player1Result}-{$this->player2Result}";
        }

        if ($this->player2point > $this->player1Point && $this->player2point < 4) {
            if ($this->player2point === 2) {
                $this->player2Result = 'Thirty';
            }
            if ($this->player2point === 3) {
                $this->player2Result = 'Forty';
            }
            if ($this->player1Point === 1) {
                $this->player1Result = 'Fifteen';
            }
            if ($this->player1Point === 2) {
                $this->player1Result = 'Thirty';
            }
            $score = "{$this->player1Result}-{$this->player2Result}";
        }

        if ($this->player1Point > $this->player2point && $this->player2point >= 3) {
            $score = 'Advantage player1';
        }

        if ($this->player2point > $this->player1Point && $this->player1Point >= 3) {
            $score = 'Advantage player2';
        }

        if ($this->player1Point >= 4 && $this->player2point >= 0 && ($this->player1Point - $this->player2point) >= 2) {
            $score = 'Win for player1';
        }

        if ($this->player2point >= 4 && $this->player1Point >= 0 && ($this->player2point - $this->player1Point) >= 2) {
            $score = 'Win for player2';
        }

        return $score;
    }

    public function wonPoint(string $player): void
    {
        if ($player === 'player1') {
            $this->P1Score();
        } else {
            $this->P2Score();
        }
    }

    private function SetP1Score(int $number): void
    {
        for ($i = 0; $i < $number; $i++) {
            $this->P1Score();
        }
    }

    private function SetP2Score(int $number): void
    {
        for ($i = 0; $i < $number; $i++) {
            $this->P2Score();
        }
    }

    private function P1Score(): void
    {
        $this->player1Point++;
    }

    private function P2Score(): void
    {
        $this->player2point++;
    }
}
