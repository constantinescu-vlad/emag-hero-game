<?php

namespace App\Characters;

abstract class Character
{

    protected $name;

    protected $health;

    protected $strength;

    protected $defence;

    protected $speed;

    protected $luck;

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setHealth($health)
    {
        $this->health = $health;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function setStrength($strength)
    {
        $this->strength = $strength;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function setDefence($defence)
    {
        $this->defence = $defence;
    }

    public function getDefence()
    {
        return $this->defence;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function setLuck($luck)
    {
        $this->luck = $luck;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function attack(Character $character)
    {
        return $this->getStrength() - $character->getDefence();
    }

}