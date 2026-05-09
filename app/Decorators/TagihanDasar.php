<?php

namespace App\Decorators;

class TagihanDasar implements TagihanInterface
{
    protected $nominal;

    public function __construct($nominal)
    {
        $this->nominal = $nominal;
    }

    public function getNominal()
    {
        return $this->nominal;
    }
}
