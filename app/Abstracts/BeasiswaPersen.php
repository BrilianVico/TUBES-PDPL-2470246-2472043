<?php

namespace App\Abstracts;

class BeasiswaPersen extends Beasiswa
{
    protected $persen;

    public function __construct($persen)
    {
        $this->persen = $persen;
    }

    public function hitungPotongan($nominal)
    {
        return ($nominal * $this->persen) / 100;
    }

    public function getNama()
    {
        return "Beasiswa Persentase";
    }
}
