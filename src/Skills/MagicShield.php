<?php


namespace App\Skills;


class MagicShield extends Skill implements SkillInterface
{

    protected $key = 'MagicShield';

    public function specialDamage(&$damage)
    {
        $damage = $damage / 2;
    }
}