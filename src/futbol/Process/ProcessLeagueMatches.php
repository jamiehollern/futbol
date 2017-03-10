<?php

namespace jamiehollern\futbol\Process;

use jamiehollern\futbol\Helpers\MatchEnsureTrait;
use jamiehollern\futbol\Model\League\TableRow;
use jamiehollern\futbol\Model\Match;
use jamiehollern\futbol\Model\Team;

/**
 * Class ProcessLeagueMatches
 *
 * @package jamiehollern\futbol\Process
 */
final class ProcessLeagueMatches
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
     * @var \jamiehollern\futbol\Model\Team
     */
    private $team;

    /**
     * @var array
     *   An array of Match objects.
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
     * ProcessLeagueMatches constructor.
     *
     * @param \jamiehollern\futbol\Model\Team $team
     * @param array                           $matches
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
     * Returns true if this team is the home team in the specified match.
     *
     * @param \jamiehollern\futbol\Model\Match $match
     *
     * @return bool
     */
    private function isHomeTeam(Match $match)
    {
        return $match->getHomeTeam()->getId() === $this->team->getId();
    }

    /**
     * Returns true if this team is the away team in the specified match.
     *
     * @param \jamiehollern\futbol\Model\Match $match
     *
     * @return bool
     */
    private function isAwayTeam(Match $match)
    {
        return $match->getAwayTeam()->getId() === $this->team->getId();
    }

    /**
     * Processes the match with this team as the home team.
     *
     * @param \jamiehollern\futbol\Model\Match $match
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
     * Processes the match with this team as the home team.
     *
     * @param \jamiehollern\futbol\Model\Match $match
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

    /**
     * Returns a TableRow with data.
     *
     * @return \jamiehollern\futbol\Model\League\TableRow
     */
    public function getTableRow(): TableRow
    {
        return new TableRow($this->team, $this->games_played,
          $this->home_games_played, $this->away_games_played, $this->wins,
          $this->draws, $this->losses, $this->home_wins, $this->home_draws,
          $this->home_losses, $this->away_wins, $this->away_draws,
          $this->away_losses, $this->goals_for, $this->goals_against,
          $this->goal_difference, $this->home_goals_for,
          $this->home_goals_against, $this->home_goal_difference,
          $this->away_goals_for, $this->away_goals_against,
          $this->away_goal_difference, $this->points, $this->home_points,
          $this->away_points);
    }

}
