<?php


namespace App\Skills;


class RapidStrike extends Skill implements SkillInterface
{

    protected $key = 'RapidStrike';

    public function specialDamage(&$damage)
    {
        $damage = $damage * 2;
    }

}