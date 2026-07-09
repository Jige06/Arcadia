<?php

class Race
{
    private $raceId;
    private $libelle;

    public function getRaceId()
    {
        return $this->raceId;
    }

    public function setRaceId($raceId)
    {
        $this->raceId = $raceId;
        return $this;
    }

    public function getLibelle()
    {
        return $this->libelle;
    }

    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
        return $this;
    }
}
