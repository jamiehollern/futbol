<?php

namespace jamiehollern\futbol\League;

use jamiehollern\futbol\Match;
use jamiehollern\futbol\Team;
use jamiehollern\futbol\Traits\MatchEnsureTrait;

/**
 * Class LeagueRow
 *
 * @package Futbol\LeagueTable
 */
class LeagueRow
{

    use MatchEnsureTrait;

    /**
     * 3 points for a win.
     */
    const WIN = 3;

    /**
     * 1 point for a draw.
     */
    const DRAW = 1;

    /**
     * 0 points for a loss.
     */
    const LOSS = 0;

    /**
     * @var \jamiehollern\futbol\Team
     */
    private $team;

    /**
     * @var array
     */
    private $matches;

    /**
     * @var int
     */
    private $games_played = 0;

    /**
     * @var int
     */
    private $wins = 0;

    /**
     * @var int
     */
    private $draws = 0;

    /**
     * @var int
     */
    private $losses = 0;

    /**
     * @var int
     */
    private $home_wins = 0;

    /**
     * @var int
     */
    private $home_draws = 0;

    /**
     * @var int
     */
    private $home_losses = 0;

    /**
     * @var int
     */
    private $away_wins = 0;

    /**
     * @var int
     */
    private $away_draws = 0;

    /**
     * @var int
     */
    private $away_losses = 0;

    /**
     * @var int
     */
    private $goals_for = 0;

    /**
     * @var int
     */
    private $goals_against = 0;

    /**
     * @var int
     */
    private $goal_difference = 0;

    /**
     * @var int
     */
    private $home_goals_for = 0;

    /**
     * @var int
     */
    private $home_goals_against = 0;

    /**
     * @var int
     */
    private $home_goal_difference = 0;

    /**
     * @var int
     */
    private $away_goals_for = 0;

    /**
     * @var int
     */
    private $away_goals_against = 0;

    /**
     * @var int
     */
    private $away_goal_difference = 0;

    /**
     * @var int
     */
    private $points = 0;

    /**
     * LeagueRow constructor.
     *
     * @param \jamiehollern\futbol\Team $team
     * @param array                     $matches
     */
    public function __construct(Team $team, array $matches)
    {
        $this->team = $team;
        $this->matches = $matches;
        $this->ensureMatches();
        foreach ($this->matches as $match) {
            if ($this->isHomeTeam($match)) {
                $this->processMatchHome($match);
            }
            if ($this->isAwayTeam($match)) {
                $this->processMatchAway($match);
            }
        }
    }

    /**
     * @param \jamiehollern\futbol\Match $match
     *
     * @return bool
     */
    private function isHomeTeam(Match $match)
    {
        return $match->getHomeTeam()->getId() === $this->team->getId();
    }

    /**
     * @param \jamiehollern\futbol\Match $match
     *
     * @return bool
     */
    private function isAwayTeam(Match $match)
    {
        return $match->getAwayTeam()->getId() === $this->team->getId();
    }

    /**
     * @param \jamiehollern\futbol\Match $match
     */
    private function processMatchHome(Match $match)
    {
        $hg = $match->getHomeGoals();
        $ag = $match->getAwayGoals();
        $gd = $hg - $ag;
        if ($hg > $ag) {
            $this->incr('wins');
            $this->incr('home_wins');
            $this->incr('points', self::WIN);
        } elseif ($hg === $ag) {
            $this->incr('draws');
            $this->incr('home_draws');
            $this->incr('points', self::DRAW);
        } else {
            $this->incr('losses');
            $this->incr('home_losses');
        }
        $this->incr('goals_for', $hg);
        $this->incr('home_goals_for', $hg);
        $this->incr('goals_against', $ag);
        $this->incr('home_goals_against', $ag);
        $this->incr('goal_difference', $gd);
        $this->incr('home_goal_difference', $gd);
    }

    /**
     * @param \jamiehollern\futbol\Match $match
     */
    private function processMatchAway(Match $match)
    {
        $hg = $match->getHomeGoals();
        $ag = $match->getAwayGoals();
        $gd = $ag - $hg;
        if ($hg < $ag) {
            $this->incr('wins');
            $this->incr('away_wins');
            $this->incr('points', self::WIN);
        } elseif ($hg === $ag) {
            $this->incr('draws');
            $this->incr('away_draws');
            $this->incr('points', self::DRAW);
        } else {
            $this->incr('losses');
            $this->incr('home_losses');
        }
        $this->incr('goals_for', $ag);
        $this->incr('away_goals_for', $ag);
        $this->incr('goals_against', $hg);
        $this->incr('away_goals_against', $hg);
        $this->incr('goal_difference', $gd);
        $this->incr('away_goal_difference', $gd);
    }

    /**
     * Increments a value by reference.
     *
     * @param string $property
     * @param int    $number
     */
    private function incr(string $property, int $number = 1)
    {
        $this->{$property} = $this->{$property} + $number;
    }

    /**
     * Decrements a value by reference.
     *
     * @param int $property
     * @param int $number
     */
    private function decr($property, $number = 1)
    {
        $this->{$property} = $this->{$property} - $number;
    }

    /**
     * @return int
     */
    public function getTeamId()
    {
        return $this->team->getId();
    }

    /**
     * @return string
     */
    public function getTeamName()
    {
        return $this->team->getName();
    }

    /**
     * @return int
     */
    public function getGamesPlayed()
    {
        return $this->games_played;
    }

    /**
     * @return int
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * @return int
     */
    public function getDraws()
    {
        return $this->draws;
    }

    /**
     * @return int
     */
    public function getLosses()
    {
        return $this->losses;
    }

    /**
     * @return int
     */
    public function getHomeWins()
    {
        return $this->home_wins;
    }

    /**
     * @return int
     */
    public function getHomeDraws()
    {
        return $this->home_draws;
    }

    /**
     * @return int
     */
    public function getHomeLosses()
    {
        return $this->home_losses;
    }

    /**
     * @return int
     */
    public function getAwayWins()
    {
        return $this->away_wins;
    }

    /**
     * @return int
     */
    public function getAwayDraws()
    {
        return $this->away_draws;
    }

    /**
     * @return int
     */
    public function getAwayLosses()
    {
        return $this->away_losses;
    }

    /**
     * @return int
     */
    public function getGoalsFor()
    {
        return $this->goals_for;
    }

    /**
     * @return int
     */
    public function getGoalsAgainst()
    {
        return $this->goals_against;
    }

    /**
     * @return int
     */
    public function getGoalDifference()
    {
        return $this->goal_difference;
    }

    /**
     * @return int
     */
    public function getHomeGoalsFor()
    {
        return $this->home_goals_for;
    }

    /**
     * @return int
     */
    public function getHomeGoalsAgainst()
    {
        return $this->home_goals_against;
    }

    /**
     * @return int
     */
    public function getHomeGoalDifference()
    {
        return $this->home_goal_difference;
    }

    /**
     * @return int
     */
    public function getAwayGoalsFor()
    {
        return $this->away_goals_for;
    }

    /**
     * @return int
     */
    public function getAwayGoalsAgainst()
    {
        return $this->away_goals_against;
    }

    /**
     * @return int
     */
    public function getAwayGoalDifference()
    {
        return $this->away_goal_difference;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

}
