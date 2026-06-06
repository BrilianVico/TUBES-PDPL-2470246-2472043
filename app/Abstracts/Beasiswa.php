<?php

namespace App\Abstracts;

abstract class Beasiswa
{
    abstract public function hitungPotongan($nominal);

    abstract public function getNama();
}
