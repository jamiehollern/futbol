<?php

namespace jamiehollern\Futbol;

class Table {

  const WIN = 3;

  const DRAW = 1;

  const LOSS = 0;

  protected $league_table = [];

  protected $teams = [];

  protected $results = [];

  public function __construct($config = []) {
    if (isset($config['results'])) {
      $this->results = $config['results'];
    }
    if ($this->teams = $this->getTeams()) {
      $this->league_table = $this->setDefaultTable();
    }
  }

  /**
   * @param int $value
   * @param int $number
   */
  protected function increment(&$value, $number = 1) {
    $value = $value + $number;
  }

  /**
   * @param int $value
   * @param int $number
   */
  protected function decrement(&$value, $number = 1) {
    $value = $value - $number;
  }

  public function getTeams() {
    $ids = [];
    foreach ($this->results as $result) {
      $ids[$result['home_team_id']] = $result['home_team_name'];
      $ids[$result['away_team_id']] = $result['away_team_name'];
    }
    return $ids;
  }

  /**
   * Sets up a default league table array with data set to zero.
   *
   * @todo Set up a step for deductions after this.
   * @return $this
   */
  public function setDefaultTable() {
    $league_table = [];
    $defaults = [
      // Wins.
      'w' => 0,
      // Draws.
      'd' => 0,
      // Losses.
      'l' => 0,
      // Home wins.
      'hw' => 0,
      // Home draws.
      'hd' => 0,
      // Home losses.
      'hl' => 0,
      // Away wins.
      'aw' => 0,
      // Away draws.
      'ad' => 0,
      // Away losses.
      'al' => 0,
      // Games played.
      'gp' => 0,
      // Goals for.
      'f' => 0,
      // Goals against.
      'a' => 0,
      // Home goals for.
      'hf' => 0,
      // Home goals against.
      'ha' => 0,
      // Away goals for.
      'af' => 0,
      // Away goals against.
      'aa' => 0,
      // Goal difference.
      'gd' => 0,
      // Points.
      'p' => 0,
    ];
    $ids = $this->teams;
    foreach ($ids as $id => $name) {
      $league_table[$id] = array_merge(['name' => $name], $defaults);
    }
    return $league_table;
  }

  public function calculatePositions() {
    foreach ($this->results as $result) {
      foreach ($this->getTeams() as $team_id => $team_name) {
        if ($team_id == $result['home_team_id']) {
          $this->increment($this->league_table[$team_id]['gp']);
          $this->increment($this->league_table[$team_id]['f'], $result['home_team_goals']);
          $this->increment($this->league_table[$team_id]['hf'], $result['home_team_goals']);
          $this->increment($this->league_table[$team_id]['a'], $result['away_team_goals']);
          $this->increment($this->league_table[$team_id]['ha'], $result['away_team_goals']);
          $this->increment($this->league_table[$team_id]['gd'], ($result['home_team_goals'] - $result['away_team_goals']));
          if ($result['home_team_goals'] > $result['away_team_goals']) {
            $this->increment($this->league_table[$team_id]['w']);
            $this->increment($this->league_table[$team_id]['hw']);
            $this->increment($this->league_table[$team_id]['p'], self::WIN);
          }
          elseif ($result['home_team_goals'] == $result['away_team_goals']) {
            $this->increment($this->league_table[$team_id]['d']);
            $this->increment($this->league_table[$team_id]['hd']);
            $this->increment($this->league_table[$team_id]['p'], self::DRAW);
          }
          elseif ($result['home_team_goals'] < $result['away_team_goals']) {
            $this->increment($this->league_table[$team_id]['l']);
            $this->increment($this->league_table[$team_id]['hl']);
          }
        }
        elseif ($team_id == $result['away_team_id']) {
          $this->increment($this->league_table[$team_id]['gp']);
          $this->increment($this->league_table[$team_id]['f'], $result['away_team_goals']);
          $this->increment($this->league_table[$team_id]['af'], $result['away_team_goals']);
          $this->increment($this->league_table[$team_id]['a'], $result['home_team_goals']);
          $this->increment($this->league_table[$team_id]['aa'], $result['home_team_goals']);
          $this->increment($this->league_table[$team_id]['gd'], ($result['away_team_goals'] - $result['home_team_goals']));
          if ($result['home_team_goals'] < $result['away_team_goals']) {
            $this->increment($this->league_table[$team_id]['w']);
            $this->increment($this->league_table[$team_id]['hw']);
            $this->increment($this->league_table[$team_id]['p'], self::WIN);
          }
          elseif ($result['home_team_goals'] == $result['away_team_goals']) {
            $this->increment($this->league_table[$team_id]['d']);
            $this->increment($this->league_table[$team_id]['hd']);
            $this->increment($this->league_table[$team_id]['p'], self::DRAW);
          }
          elseif ($result['home_team_goals'] > $result['away_team_goals']) {
            $this->increment($this->league_table[$team_id]['l']);
            $this->increment($this->league_table[$team_id]['hl']);
          }
        }
      }
    }
    return $this;
  }

  public function getLeagueTable() {
    return $this->league_table;
  }

}
