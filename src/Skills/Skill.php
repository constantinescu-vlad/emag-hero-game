<?php


namespace App\Skills;


abstract class Skill
{

    protected $canUseSkill = false;

    protected $key;

    protected $chance;

    /**
     * @param $chance
     */
    public function __construct($chance)
    {
        $this->chance = $chance;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function getChance()
    {
        return $this->chance;
    }

    public function canUseSkill()
    {
        $rand = mt_rand(0, 100);
        $this->canUseSkill = $rand <= $this->getChance();

        return $this->canUseSkill;
    }

}