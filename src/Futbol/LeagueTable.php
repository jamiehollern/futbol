<?php

namespace Futbol;

use Futbol\LeagueTable\Row;
use Underscore\Types\Arrays;

/**
 * Class LeagueTable
 *
 * @package \Futbol
 */
class LeagueTable
{

    const WIN = 3;

    const DRAW = 1;

    const LOSS = 0;

    protected $league_table = [];

    protected $teams = [];

    protected $results = [];

    /**
     * Constructor.
     */
    public function __construct($config = [])
    {
        // If there are matches.
        if (isset($config['results'])) {
            // Set them internally.
            $this->results = $config['results'];
            // If there are teams.
            if ($this->teams = $this->getTeams()) {
                $rows = [];
                // Build the default table.
                foreach ($this->teams as $id => $name) {
                    $rows[$id] = new Row($id, $name);
                }
                //$this->league_table = new Arrays($rows);
                $this->league_table = $rows;
            }
        }
        return $this;
    }

    public function __toString()
    {
        // Return a cheeky ASCII table.
        return '';
    }

    public function getTeams()
    {
        $ids = [];
        foreach ($this->results as $result) {
            $ids[$result['home_team_id']] = $result['home_team_name'];
            $ids[$result['away_team_id']] = $result['away_team_name'];
        }
        return $ids;
    }

    public function calculatePositions()
    {
        foreach ($this->results as $result) {
            foreach ($this->league_table as $row) {
                if ($team_id = $row->getTeamId() == $result['home_team_id']) {
                    $row->incr('games_played');
                    $row->incr('goals_for', $result['home_team_goals']);
                    $row->incr('home_goals_for', $result['home_team_goals']);
                    $row->incr('goals_against', $result['away_team_goals']);
                    $row->incr('home_goals_against',
                      $result['away_team_goals']);
                    $row->incr('goal_difference',
                      ($result['home_team_goals'] - $result['away_team_goals']));
                    $row->incr('home_goal_difference',
                      ($result['home_team_goals'] - $result['away_team_goals']));
                    if ($result['home_team_goals'] > $result['away_team_goals']) {
                        $row->incr('wins');
                        $row->incr('home_wins');
                        $row->incr('points', self::WIN);
                    } elseif ($result['home_team_goals'] == $result['away_team_goals']) {
                        $row->incr('draws');
                        $row->incr('home_draws');
                        $row->incr('points', self::DRAW);
                    } elseif ($result['home_team_goals'] < $result['away_team_goals']) {
                        $row->incr('losses');
                        $row->incr('home_losses');
                    }
                }
                if ($team_id = $row->getTeamId() == $result['away_team_id']) {
                    $row->incr('games_played');
                    $row->incr('goals_for', $result['away_team_goals']);
                    $row->incr('away_goals_for', $result['away_team_goals']);
                    $row->incr('goals_against', $result['home_team_goals']);
                    $row->incr('away_goals_against',
                      $result['home_team_goals']);
                    $row->incr('goal_difference',
                      ($result['away_team_goals'] - $result['home_team_goals']));
                    $row->incr('away_goal_difference',
                      ($result['away_team_goals'] - $result['home_team_goals']));
                    if ($result['home_team_goals'] < $result['away_team_goals']) {
                        $row->incr('wins');
                        $row->incr('away_wins');
                        $row->incr('points', self::WIN);
                    } elseif ($result['home_team_goals'] == $result['away_team_goals']) {
                        $row->incr('draws');
                        $row->incr('away_draws');
                        $row->incr('points', self::DRAW);
                    } elseif ($result['home_team_goals'] > $result['away_team_goals']) {
                        $row->incr('losses');
                        $row->incr('away_losses');
                    }
                }
            }
        }
        var_dump($this->league_table);
        return $this;
    }

    public function obtain()
    {
        return $this->league_table;
    }

}
