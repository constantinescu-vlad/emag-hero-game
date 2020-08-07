<?php

namespace App\Characters;

use App\Skills\Skill;

class Hero extends Character
{

    protected $name = "Orderus";

    protected $skills = [];

    public function addSkill(Skill $skill)
    {
        $this->skills[$skill->getKey()] = $skill;
    }

    public function getSkills()
    {
        return $this->skills;
    }

}