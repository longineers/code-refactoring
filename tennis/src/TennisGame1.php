<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame1 implements TennisGame
{
    public function __construct(
        private int $player1Score = 0,
        private int $player2Score = 0
    ) {
    }

    public function wonPoint(string $playerName): void
    {
        if ($playerName === 'player1') {
            $this->player1Score++;

            return;
        }

        $this->player2Score++;
    }

    public function getScore(): string
    {
        $score = $this->scoreDraw($this->player1Score, $this->player2Score);
        if ($score !== '') {
            return $score;
        }

        $finalResult = $this->scoreFinalSet($this->player1Score, $this->player2Score);
        if ($finalResult !== '') {
            return $finalResult;
        }

        return $this->nextScore($this->player1Score, $this->player2Score);
    }

    private function nextScore(int $p1Score, int $p2Score): string
    {
        $score = '';
        for ($i = 1; $i < 3; $i++) {
            if ($i === 1) {
                $tempScore = $p1Score;
            } else {
                $score .= '-';
                $tempScore = $p2Score;
            }

            $score .= match ($tempScore) {
                0 => 'Love',
                1 => 'Fifteen',
                2 => 'Thirty',
                3 => 'Forty',
                default => 'Undefined',
            };
        }

        return $score;
    }

    private function scoreFinalSet(int $p1Score, int $p2Score): string
    {
        if ($p1Score >= 4 || $p2Score >= 4) {
            $minusResult = $p1Score - $p2Score;
            if ($minusResult === 1) {
                return 'Advantage player1';
            }
            if ($minusResult === -1) {
                return 'Advantage player2';
            }
            if ($minusResult >= 2) {
                return 'Win for player1';
            }

            return 'Win for player2';
        }

        return '';
    }

    private function scoreDraw(int $p1Score, int $p2Score): string
    {
        if ($p1Score === $p2Score) {
            $score = match ($p1Score) {
                0 => 'Love-All',
                1 => 'Fifteen-All',
                2 => 'Thirty-All',
                default => 'Deuce',
            };

            return $score;
        }

        return '';
    }
}
