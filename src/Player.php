<?php


namespace MMunoz;


class Player extends APIObject
{
    public $name;
    public $sex;
    public $vocation;
    public $level;
    public $achievement_points;
    public $world;
    public $residence;
    public $guild;
    public $last_login;
    public $account_status;
    public $status;

    public function isPremium() {
        return $this->vocation == VOCATION_ROYAL_PALADIN || $this->vocation == VOCATION_MASTER_SORCERER || $this->vocation == VOCATION_ELDER_DRUID || $this->vocation == VOCATION_ELITE_KNIGHT;
    }
}