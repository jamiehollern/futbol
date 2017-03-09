<?php

namespace jamiehollern\futbol\Model;

/**
 * Class Team
 *
 * @package jamiehollern\futbol\Model
 */
final class Team
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * Team constructor.
     *
     * @param int    $id
     * @param string $name
     *
     * @throws \Exception
     */
    public function __construct(int $id, string $name)
    {
        if ($id < 1) {
            throw new \InvalidArgumentException('The team ID must be a non-zero positive integer.');
        }
        if (empty($name)) {
            throw new \InvalidArgumentException('The team name must not be an empty string.');
        }
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}
