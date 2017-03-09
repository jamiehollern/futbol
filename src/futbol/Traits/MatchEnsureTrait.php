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
        if (empty($this->matches)) {
            throw new \Exception(static::class . ' objects needs at least one match.');
        }
        array_walk($this->matches, function ($match) {
            if (!$match instanceof Match) {
                throw new \Exception('Cannot create ' . static::class . ' object as not all matches are Match objects.');
            }
        });
    }

}
