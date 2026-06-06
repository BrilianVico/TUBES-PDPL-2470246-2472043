<?php

namespace App\Abstracts;

class BeasiswaNominal extends Beasiswa
{
    protected $nominalPotongan;

    public function __construct($nominalPotongan)
    {
        $this->nominalPotongan = $nominalPotongan;
    }

    public function hitungPotongan($nominal)
    {
        return min($nominal, $this->nominalPotongan);
    }

    public function getNama()
    {
        return "Beasiswa Nominal";
    }
}
