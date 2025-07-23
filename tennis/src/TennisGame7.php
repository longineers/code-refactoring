<?php

declare(strict_types=1);

namespace TennisGame;

class TennisGame7 implements TennisGame
{
    public function __construct(
        private string $player1Name,
        private string $player2Name,
        private int $player1Score = 0,
        private int $player2Score = 0
    ) {
    }

    public function wonPoint(string $playerName): void
    {
        if ($playerName === 'player1') {
            $this->player1Score++;
        } else {
            $this->player2Score++;
        }
    }

    public function getScore(): string
    {
        $result = 'Current score: ';

        if ($this->player1Score === $this->player2Score) {
            // tie score
            switch ($this->player1Score) {
                case 0:
                    $result .= 'Love-All';
                    break;
                case 1:
                    $result .= 'Fifteen-All';
                    break;
                case 2:
                    $result .= 'Thirty-All';
                    break;
                default:
                    $result .= 'Deuce';
                    break;
            }
        } elseif ($this->player1Score >= 4 || $this->player2Score >= 4) {
            // end-game score
            if ($this->player1Score - $this->player2Score === 1) {
                $result .= 'Advantage ' . $this->player1Name;
            } elseif ($this->player1Score - $this->player2Score === -1) {
                $result .= 'Advantage ' . $this->player2Name;
            } elseif ($this->player1Score - $this->player2Score >= 2) {
                $result .= 'Win for ' . $this->player1Name;
            } else {
                $result .= 'Win for ' . $this->player2Name;
            }
        } else {
            // regular score
            $result .= match ($this->player1Score) {
                0 => 'Love',
                1 => 'Fifteen',
                2 => 'Thirty',
                default => 'Forty',
            };
            $result .= '-';
            $result .= match ($this->player2Score) {
                0 => 'Love',
                1 => 'Fifteen',
                2 => 'Thirty',
                default => 'Forty',
            };
        }

        return $result . ', enjoy your game!';
    }
}
