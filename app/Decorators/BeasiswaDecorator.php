<?php

namespace App\Decorators;

class BeasiswaDecorator implements TagihanInterface
{
    protected $tagihan;
    protected $potongan;

    public function __construct(TagihanInterface $tagihan, $potongan)
    {
        $this->tagihan = $tagihan;
        $this->potongan = $potongan;
    }

    public function getNominal()
    {
        $hasil = $this->tagihan->getNominal() - $this->potongan;

        return max($hasil, 0);
    }
}
