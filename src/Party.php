<?php


namespace MMunoz;


class Party
{

    /**
     * @var Player[]
     */
    private $members = [];


    public function addMember($player) {
        $this->members[] = $player;
        $this->shortByLevel();
    }

    public function removeMember($player) {
        $i = array_search($player, $this->members);
        if($i >= 0) {
            array_splice($this->members, $i, 1);
            $this->shortByLevel();
        }
    }

    public function shortByLevel() {
        usort($this->members, function($p1, $p2) { return $p2->level - $p1->level; });
    }

    public function getMaxLevel() {
        return $this->members[0];
    }

    public function getMinLevel() {
        return $this->members[count($this->members) - 1];
    }

    /**
     * @param $player Player
     * @return bool
     */
    public function isShared($player) {
        $max = $this->getMaxLevel();
        if($player->level > $max->level) {
            $level = round($player->level / 1.5);
            return ($level < $max->level);
        } else {
            $level = round($max->level / 1.5);

            return $player->level >= $level;
        }
    }

    public function getLevelRange() {
        $max = $this->getMaxLevel()->level;
        $min = $this->getMinLevel()->level;

        return [$max, $min];
    }



}