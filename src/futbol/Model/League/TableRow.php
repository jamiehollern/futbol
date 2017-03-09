<?php

namespace jamiehollern\futbol\Model\League;

use jamiehollern\futbol\Model\Team;

/**
 * Class TableRow
 *
 * @package Futbol\LeagueTable
 */
class TableRow
{

    /**
     * @var \jamiehollern\futbol\Model\Team
     */
    private $team;

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
     * TableRow constructor.
     *
     * @param \jamiehollern\futbol\Model\Team $team
     * @param int                             $games_played
     * @param int                             $home_games_played
     * @param int                             $away_games_played
     * @param int                             $wins
     * @param int                             $draws
     * @param int                             $losses
     * @param int                             $home_wins
     * @param int                             $home_draws
     * @param int                             $home_losses
     * @param int                             $away_wins
     * @param int                             $away_draws
     * @param int                             $away_losses
     * @param int                             $goals_for
     * @param int                             $goals_against
     * @param int                             $goal_difference
     * @param int                             $home_goals_for
     * @param int                             $home_goals_against
     * @param int                             $home_goal_difference
     * @param int                             $away_goals_for
     * @param int                             $away_goals_against
     * @param int                             $away_goal_difference
     * @param int                             $points
     * @param int                             $home_points
     * @param int                             $away_points
     */
    public function __construct(
      Team $team,
      $games_played = 0,
      $home_games_played = 0,
      $away_games_played = 0,
      $wins = 0,
      $draws = 0,
      $losses = 0,
      $home_wins = 0,
      $home_draws = 0,
      $home_losses = 0,
      $away_wins = 0,
      $away_draws = 0,
      $away_losses = 0,
      $goals_for = 0,
      $goals_against = 0,
      $goal_difference = 0,
      $home_goals_for = 0,
      $home_goals_against = 0,
      $home_goal_difference = 0,
      $away_goals_for = 0,
      $away_goals_against = 0,
      $away_goal_difference = 0,
      $points = 0,
      $home_points = 0,
      $away_points = 0
    ) {
        $this->team = $team;
        $this->games_played = $games_played;
        $this->home_games_played = $home_games_played;
        $this->away_games_played = $away_games_played;
        $this->wins = $wins;
        $this->draws = $draws;
        $this->losses = $losses;
        $this->home_wins = $home_wins;
        $this->home_draws = $home_draws;
        $this->home_losses = $home_losses;
        $this->away_wins = $away_wins;
        $this->away_draws = $away_draws;
        $this->away_losses = $away_losses;
        $this->goals_for = $goals_for;
        $this->goals_against = $goals_against;
        $this->goal_difference = $goal_difference;
        $this->home_goals_for = $home_goals_for;
        $this->home_goals_against = $home_goals_against;
        $this->home_goal_difference = $home_goal_difference;
        $this->away_goals_for = $away_goals_for;
        $this->away_goals_against = $away_goals_against;
        $this->away_goal_difference = $away_goal_difference;
        $this->points = $points;
        $this->home_points = $home_points;
        $this->away_points = $away_points;
    }

    /**
     * @return \jamiehollern\futbol\Model\Team
     */
    public function getTeam(): Team
    {
        return $this->team;
    }

    /**
     * @param \jamiehollern\futbol\Model\Team $team
     */
    public function setTeam(Team $team)
    {
        $this->team = $team;
    }

    /**
     * @return int
     */
    public function getGamesPlayed(): int
    {
        return $this->games_played;
    }

    /**
     * @param int $games_played
     */
    public function setGamesPlayed(int $games_played)
    {
        $this->games_played = $games_played;
    }

    /**
     * @return int
     */
    public function getHomeGamesPlayed(): int
    {
        return $this->home_games_played;
    }

    /**
     * @param int $home_games_played
     */
    public function setHomeGamesPlayed(int $home_games_played)
    {
        $this->home_games_played = $home_games_played;
    }

    /**
     * @return int
     */
    public function getAwayGamesPlayed(): int
    {
        return $this->away_games_played;
    }

    /**
     * @param int $away_games_played
     */
    public function setAwayGamesPlayed(int $away_games_played)
    {
        $this->away_games_played = $away_games_played;
    }

    /**
     * @return int
     */
    public function getWins(): int
    {
        return $this->wins;
    }

    /**
     * @param int $wins
     */
    public function setWins(int $wins)
    {
        $this->wins = $wins;
    }

    /**
     * @return int
     */
    public function getDraws(): int
    {
        return $this->draws;
    }

    /**
     * @param int $draws
     */
    public function setDraws(int $draws)
    {
        $this->draws = $draws;
    }

    /**
     * @return int
     */
    public function getLosses(): int
    {
        return $this->losses;
    }

    /**
     * @param int $losses
     */
    public function setLosses(int $losses)
    {
        $this->losses = $losses;
    }

    /**
     * @return int
     */
    public function getHomeWins(): int
    {
        return $this->home_wins;
    }

    /**
     * @param int $home_wins
     */
    public function setHomeWins(int $home_wins)
    {
        $this->home_wins = $home_wins;
    }

    /**
     * @return int
     */
    public function getHomeDraws(): int
    {
        return $this->home_draws;
    }

    /**
     * @param int $home_draws
     */
    public function setHomeDraws(int $home_draws)
    {
        $this->home_draws = $home_draws;
    }

    /**
     * @return int
     */
    public function getHomeLosses(): int
    {
        return $this->home_losses;
    }

    /**
     * @param int $home_losses
     */
    public function setHomeLosses(int $home_losses)
    {
        $this->home_losses = $home_losses;
    }

    /**
     * @return int
     */
    public function getAwayWins(): int
    {
        return $this->away_wins;
    }

    /**
     * @param int $away_wins
     */
    public function setAwayWins(int $away_wins)
    {
        $this->away_wins = $away_wins;
    }

    /**
     * @return int
     */
    public function getAwayDraws(): int
    {
        return $this->away_draws;
    }

    /**
     * @param int $away_draws
     */
    public function setAwayDraws(int $away_draws)
    {
        $this->away_draws = $away_draws;
    }

    /**
     * @return int
     */
    public function getAwayLosses(): int
    {
        return $this->away_losses;
    }

    /**
     * @param int $away_losses
     */
    public function setAwayLosses(int $away_losses)
    {
        $this->away_losses = $away_losses;
    }

    /**
     * @return int
     */
    public function getGoalsFor(): int
    {
        return $this->goals_for;
    }

    /**
     * @param int $goals_for
     */
    public function setGoalsFor(int $goals_for)
    {
        $this->goals_for = $goals_for;
    }

    /**
     * @return int
     */
    public function getGoalsAgainst(): int
    {
        return $this->goals_against;
    }

    /**
     * @param int $goals_against
     */
    public function setGoalsAgainst(int $goals_against)
    {
        $this->goals_against = $goals_against;
    }

    /**
     * @return int
     */
    public function getGoalDifference(): int
    {
        return $this->goal_difference;
    }

    /**
     * @param int $goal_difference
     */
    public function setGoalDifference(int $goal_difference)
    {
        $this->goal_difference = $goal_difference;
    }

    /**
     * @return int
     */
    public function getHomeGoalsFor(): int
    {
        return $this->home_goals_for;
    }

    /**
     * @param int $home_goals_for
     */
    public function setHomeGoalsFor(int $home_goals_for)
    {
        $this->home_goals_for = $home_goals_for;
    }

    /**
     * @return int
     */
    public function getHomeGoalsAgainst(): int
    {
        return $this->home_goals_against;
    }

    /**
     * @param int $home_goals_against
     */
    public function setHomeGoalsAgainst(int $home_goals_against)
    {
        $this->home_goals_against = $home_goals_against;
    }

    /**
     * @return int
     */
    public function getHomeGoalDifference(): int
    {
        return $this->home_goal_difference;
    }

    /**
     * @param int $home_goal_difference
     */
    public function setHomeGoalDifference(int $home_goal_difference)
    {
        $this->home_goal_difference = $home_goal_difference;
    }

    /**
     * @return int
     */
    public function getAwayGoalsFor(): int
    {
        return $this->away_goals_for;
    }

    /**
     * @param int $away_goals_for
     */
    public function setAwayGoalsFor(int $away_goals_for)
    {
        $this->away_goals_for = $away_goals_for;
    }

    /**
     * @return int
     */
    public function getAwayGoalsAgainst(): int
    {
        return $this->away_goals_against;
    }

    /**
     * @param int $away_goals_against
     */
    public function setAwayGoalsAgainst(int $away_goals_against)
    {
        $this->away_goals_against = $away_goals_against;
    }

    /**
     * @return int
     */
    public function getAwayGoalDifference(): int
    {
        return $this->away_goal_difference;
    }

    /**
     * @param int $away_goal_difference
     */
    public function setAwayGoalDifference(int $away_goal_difference)
    {
        $this->away_goal_difference = $away_goal_difference;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @param int $points
     */
    public function setPoints(int $points)
    {
        $this->points = $points;
    }

    /**
     * @return int
     */
    public function getHomePoints(): int
    {
        return $this->home_points;
    }

    /**
     * @param int $home_points
     */
    public function setHomePoints(int $home_points)
    {
        $this->home_points = $home_points;
    }

    /**
     * @return int
     */
    public function getAwayPoints(): int
    {
        return $this->away_points;
    }

    /**
     * @param int $away_points
     */
    public function setAwayPoints(int $away_points)
    {
        $this->away_points = $away_points;
    }

}
