<?php
/**
 * @file
 * Class that contains the league table row.
 */
namespace Futbol\LeagueTable;

/**
 * Class Row
 *
 * @package Futbol\LeagueTable
 */
class Row
{

    /**
     * @var int
     */
    protected $team_id;

    /**
     * @var string
     */
    protected $team_name;

    /**
     * @var int
     */
    protected $games_played = 0;

    /**
     * @var int
     */
    protected $wins = 0;

    /**
     * @var int
     */
    protected $draws = 0;

    /**
     * @var int
     */
    protected $losses = 0;

    /**
     * @var int
     */
    protected $home_wins = 0;

    /**
     * @var int
     */
    protected $home_draws = 0;

    /**
     * @var int
     */
    protected $home_losses = 0;

    /**
     * @var int
     */
    protected $away_wins = 0;

    /**
     * @var int
     */
    protected $away_draws = 0;

    /**
     * @var int
     */
    protected $away_losses = 0;

    /**
     * @var int
     */
    protected $goals_for = 0;

    /**
     * @var int
     */
    protected $goals_against = 0;

    /**
     * @var int
     */
    protected $goal_difference = 0;

    /**
     * @var int
     */
    protected $home_goals_for = 0;

    /**
     * @var int
     */
    protected $home_goals_against = 0;

    /**
     * @var int
     */
    protected $home_goal_difference = 0;

    /**
     * @var int
     */
    protected $away_goals_for = 0;

    /**
     * @var int
     */
    protected $away_goals_against = 0;

    /**
     * @var int
     */
    protected $away_goal_difference = 0;

    /**
     * @var int
     */
    protected $points = 0;

    public function __construct($id, $name) {
        $this->setTeamId($id);
        $this->setTeamName($name);
    }

    /**
     * This method is used to lazy increment/decrement properties.
     *
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        // If the method call starts with increment or decrement.
        if (preg_match("/increment|decrement/A", $name, $output_array)) {
            // Get the values from the method.
            preg_match("/(increment|decrement)(([A-Z]{1}[a-z]*)+)/", $name, $call);
            // If we have the values we need.
            if (isset($call[1]) && isset($call[2])) {
                $method = $call[1];
                // Change this to the correct case.
                $property = $this->stringToUnderscore($call[2]);
                $valid_method = in_array($method, ['increment', 'decrement']);
                $valid_property = property_exists($this, $property);
                // If the method and property exist in the class.
                if ($valid_method && $valid_property) {
                    call_user_func_array([$this, $method], [&$this->{$property}]);
                    return;
                }
            }
        }
        throw new \BadMethodCallException;
    }

    /**
     * Takes a pascal or camel case string and converts it to underscore case.
     *
     * @param $name
     *
     * @return string
     */
    protected function stringToUnderscore($name)
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $name));
    }

    public function incr($name, $value = 1) {
        $this->increment($this->{$name}, $value);
    }

    public function decr($name, $value = 1) {
        $this->decrement($this->{$name}, $value);
    }

    /**
     * Increments a value by reference.
     *
     * @param int $value
     * @param int $number
     */
    protected function increment(&$value, $number = 1)
    {
        $value = $value + $number;
    }

    /**
     * Decrements a value by reference.
     *
     * @param int $value
     * @param int $number
     */
    protected function decrement(&$value, $number = 1)
    {
        $value = $value - $number;
    }

    /**
     * @return int
     */
    public function getTeamId()
    {
        return $this->team_id;
    }

    /**
     * @param int $team_id
     *
     * @return $this
     */
    public function setTeamId($team_id)
    {
        $this->team_id = $team_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTeamName()
    {
        return $this->team_name;
    }

    public function setTeamName($team_name)
    {
        $this->team_name = $team_name;
        return $this;
    }

    /**
     * @return int
     */
    public function getGamesPlayed()
    {
        return $this->games_played;
    }

    /**
     * @param int $games_played
     *
     * @return $this
     */
    public function setGamesPlayed($games_played)
    {
        $this->games_played = $games_played;
        return $this;
    }

    /**
     * @return int
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * @param int $wins
     *
     * @return $this
     */
    public function setWins($wins)
    {
        $this->wins = $wins;
        return $this;
    }

    /**
     * @return int
     */
    public function getDraws()
    {
        return $this->draws;
    }

    /**
     * @param int $draws
     *
     * @return $this
     */
    public function setDraws($draws)
    {
        $this->draws = $draws;
        return $this;
    }

    /**
     * @return int
     */
    public function getLosses()
    {
        return $this->losses;
    }

    /**
     * @param int $losses
     *
     * @return $this
     */
    public function setLosses($losses)
    {
        $this->losses = $losses;
        return $this;
    }

    /**
     * @return int
     */
    public function getHomeWins()
    {
        return $this->home_wins;
    }

    /**
     * @param int $home_wins
     *
     * @return $this
     */
    public function setHomeWins($home_wins)
    {
        $this->home_wins = $home_wins;
        return $this;
    }

    /**
     * @return int
     */
    public function getHomeDraws()
    {
        return $this->home_draws;
    }

    /**
     * @param int $home_draws
     *
     * @return $this
     */
    public function setHomeDraws($home_draws)
    {
        $this->home_draws = $home_draws;
        return $this;
    }

    /**
     * @return int
     */
    public function getHomeLosses()
    {
        return $this->home_losses;
    }

    /**
     * @param int $home_losses
     *
     * @return $this
     */
    public function setHomeLosses($home_losses)
    {
        $this->home_losses = $home_losses;
        return $this;
    }

    /**
     * @return int
     */
    public function getAwayWins()
    {
        return $this->away_wins;
    }

    /**
     * @param int $away_wins
     *
     * @return $this
     */
    public function setAwayWins($away_wins)
    {
        $this->away_wins = $away_wins;
        return $this;
    }

    /**
     * @return int
     */
    public function getAwayDraws()
    {
        return $this->away_draws;
    }

    /**
     * @param int $away_draws
     *
     * @return $this
     */
    public function setAwayDraws($away_draws)
    {
        $this->away_draws = $away_draws;
        return $this;
    }

    /**
     * @return int
     */
    public function getAwayLosses()
    {
        return $this->away_losses;
    }

    /**
     * @param int $away_losses
     *
     * @return $this
     */
    public function setAwayLosses($away_losses)
    {
        $this->away_losses = $away_losses;
        return $this;
    }

    /**
     * @return int
     */
    public function getGoalsFor()
    {
        return $this->goals_for;
    }

    /**
     * @param int $goals_for
     *
     * @return $this
     */
    public function setGoalsFor($goals_for)
    {
        $this->goals_for = $goals_for;
        return $this;
    }

    /**
     * @return int
     */
    public function getGoalsAgainst()
    {
        return $this->goals_against;
    }

    /**
     * @param int $goals_against
     *
     * @return $this
     */
    public function setGoalsAgainst($goals_against)
    {
        $this->goals_against = $goals_against;
        return $this;
    }

    /**
     * @return int
     */
    public function getGoalDifference()
    {
        return $this->goal_difference;
    }

    /**
     * @param int $goal_difference
     *
     * @return $this
     */
    public function setGoalDifference($goal_difference)
    {
        $this->goal_difference = $goal_difference;
        return $this;
    }

    /**
     * @return int
     */
    public function getHomeGoalsFor()
    {
        return $this->home_goals_for;
    }

    /**
     * @param int $home_goals_for
     *
     * @return $this
     */
    public function setHomeGoalsFor($home_goals_for)
    {
        $this->home_goals_for = $home_goals_for;
        return $this;
    }

    /**
     * @return int
     */
    public function getHomeGoalsAgainst()
    {
        return $this->home_goals_against;
    }

    /**
     * @param int $home_goals_against
     *
     * @return $this
     */
    public function setHomeGoalsAgainst($home_goals_against)
    {
        $this->home_goals_against = $home_goals_against;
        return $this;
    }

    /**
     * @return int
     */
    public function getHomeGoalDifference()
    {
        return $this->home_goal_difference;
    }

    /**
     * @param int $home_goal_difference
     *
     * @return $this
     */
    public function setHomeGoalDifference($home_goal_difference)
    {
        $this->home_goal_difference = $home_goal_difference;
        return $this;
    }

    /**
     * @return int
     */
    public function getAwayGoalsFor()
    {
        return $this->away_goals_for;
    }

    /**
     * @param int $away_goals_for
     *
     * @return $this
     */
    public function setAwayGoalsFor($away_goals_for)
    {
        $this->away_goals_for = $away_goals_for;
        return $this;
    }

    /**
     * @return int
     */
    public function getAwayGoalsAgainst()
    {
        return $this->away_goals_against;
    }

    /**
     * @param int $away_goals_against
     *
     * @return $this
     */
    public function setAwayGoalsAgainst($away_goals_against)
    {
        $this->away_goals_against = $away_goals_against;
        return $this;
    }

    /**
     * @return int
     */
    public function getAwayGoalDifference()
    {
        return $this->away_goal_difference;
    }

    /**
     * @param int $away_goal_difference
     *
     * @return $this
     */
    public function setAwayGoalDifference($away_goal_difference)
    {
        $this->away_goal_difference = $away_goal_difference;
        return $this;
    }

    /**
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * @param int $points
     *
     * @return $this
     */
    public function setPoints($points)
    {
        $this->points = $points;
        return $this;
    }

}
