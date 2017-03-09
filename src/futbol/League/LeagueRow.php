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
    private $home_games_played = 0;

    /**
     * @var int
     */
    private $away_games_played = 0;

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
     * @var int
     */
    private $home_points = 0;

    /**
     * @var int
     */
    private $away_points = 0;

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
            $this->update('wins');
            $this->update('home_wins');
            $this->update('points', self::WIN);
            $this->update('home_points', self::WIN);
        } elseif ($hg === $ag) {
            $this->update('draws');
            $this->update('home_draws');
            $this->update('points', self::DRAW);
            $this->update('home_points', self::DRAW);
        } else {
            $this->update('losses');
            $this->update('home_losses');
        }
        $this->update('games_played');
        $this->update('home_games_played');
        $this->update('goals_for', $hg);
        $this->update('home_goals_for', $hg);
        $this->update('goals_against', $ag);
        $this->update('home_goals_against', $ag);
        $this->update('goal_difference', $gd);
        $this->update('home_goal_difference', $gd);
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
            $this->update('wins');
            $this->update('away_wins');
            $this->update('points', self::WIN);
            $this->update('away_points', self::WIN);
        } elseif ($hg === $ag) {
            $this->update('draws');
            $this->update('away_draws');
            $this->update('points', self::DRAW);
            $this->update('away_points', self::DRAW);
        } else {
            $this->update('losses');
            $this->update('away_losses');
        }
        $this->update('games_played');
        $this->update('away_games_played');
        $this->update('goals_for', $ag);
        $this->update('away_goals_for', $ag);
        $this->update('goals_against', $hg);
        $this->update('away_goals_against', $hg);
        $this->update('goal_difference', $gd);
        $this->update('away_goal_difference', $gd);
    }

    /**
     * Updates an integer property value.
     *
     * @param string $property
     * @param int    $number
     */
    private function update(string $property, int $number = 1)
    {
        $this->{$property} = $this->{$property} + $number;
    }

    public function getTeam()
    {
        return $this->team;
    }

    /**
     * @return int
     */
    public function getTeamId()
    {
        return $this->getTeam()->getId();
    }

    /**
     * @return string
     */
    public function getTeamName()
    {
        return $this->getTeam()->getName();
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
    public function getHomeGamesPlayed()
    {
        return $this->home_games_played;
    }

    /**
     * @return int
     */
    public function getAwayGamesPlayed()
    {
        return $this->away_games_played;
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
    public function getHomePoints()
    {
        return $this->home_points;
    }

    /**
     * @return int
     */
    public function getAwayPoints()
    {
        return $this->away_points;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

}
