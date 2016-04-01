<?php
/**
 * @file
 *
 * Contains \Futbol\LeagueTable;
 */
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

    /**
     * @var \Underscore\Types\Arrays
     */
    protected $array_league;

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
                //var_dump($rows);
                $this->league_table = new Arrays($rows);
                var_dump($this->league_table);

            }
        }
        return $this;
    }

    public function __toString() {
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

            /*foreach ($this->getTeams() as $team_id => $team_name) {
                if ($team_id == $result['home_team_id']) {
                    $this->increment($this->league_table[$team_id]['gp']);
                    $this->increment($this->league_table[$team_id]['f'],
                      $result['home_team_goals']);
                    $this->increment($this->league_table[$team_id]['hf'],
                      $result['home_team_goals']);
                    $this->increment($this->league_table[$team_id]['a'],
                      $result['away_team_goals']);
                    $this->increment($this->league_table[$team_id]['ha'],
                      $result['away_team_goals']);
                    $this->increment($this->league_table[$team_id]['gd'],
                      ($result['home_team_goals'] - $result['away_team_goals']));
                    if ($result['home_team_goals'] > $result['away_team_goals']) {
                        $this->increment($this->league_table[$team_id]['w']);
                        $this->increment($this->league_table[$team_id]['hw']);
                        $this->increment($this->league_table[$team_id]['p'],
                          self::WIN);
                    } elseif ($result['home_team_goals'] == $result['away_team_goals']) {
                        $this->increment($this->league_table[$team_id]['d']);
                        $this->increment($this->league_table[$team_id]['hd']);
                        $this->increment($this->league_table[$team_id]['p'],
                          self::DRAW);
                    } elseif ($result['home_team_goals'] < $result['away_team_goals']) {
                        $this->increment($this->league_table[$team_id]['l']);
                        $this->increment($this->league_table[$team_id]['hl']);
                    }
                }
                if ($team_id == $result['away_team_id']) {
                    $this->increment($this->league_table[$team_id]['gp']);
                    $this->increment($this->league_table[$team_id]['f'],
                      $result['away_team_goals']);
                    $this->increment($this->league_table[$team_id]['af'],
                      $result['away_team_goals']);
                    $this->increment($this->league_table[$team_id]['a'],
                      $result['home_team_goals']);
                    $this->increment($this->league_table[$team_id]['aa'],
                      $result['home_team_goals']);
                    $this->increment($this->league_table[$team_id]['gd'],
                      ($result['away_team_goals'] - $result['home_team_goals']));
                    if ($result['home_team_goals'] < $result['away_team_goals']) {
                        $this->increment($this->league_table[$team_id]['w']);
                        $this->increment($this->league_table[$team_id]['aw']);
                        $this->increment($this->league_table[$team_id]['p'],
                          self::WIN);
                    } elseif ($result['home_team_goals'] == $result['away_team_goals']) {
                        $this->increment($this->league_table[$team_id]['d']);
                        $this->increment($this->league_table[$team_id]['ad']);
                        $this->increment($this->league_table[$team_id]['p'],
                          self::DRAW);
                    } elseif ($result['home_team_goals'] > $result['away_team_goals']) {
                        $this->increment($this->league_table[$team_id]['l']);
                        $this->increment($this->league_table[$team_id]['al']);
                    }
                }
            }*/
        }
        return $this;
    }

    public function obtain()
    {
        return $this->league_table;
    }

}
