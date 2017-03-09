<?php

namespace jamiehollern\futbol\Traits;

use jamiehollern\futbol\Match;

trait MatchEnsureTrait
{

    /**
     * Ensures that the matches array can be used to build a league table.
     *
     * @throws \Exception
     */
    public function ensureMatches()
    {
        if (!isset($this->matches) || !is_array($this->matches)) {
            throw new \InvalidArgumentException('Matches must be set as an array.');
        }
        array_walk($this->matches, function ($match) {
            if (!$match instanceof Match) {
                throw new \Exception('Cannot create ' . static::class . ' object as not all matches are Match objects.');
            }
        });
    }

}
