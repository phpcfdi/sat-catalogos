<?php

declare(strict_types=1);

namespace PhpCfdi\SatCatalogos\CFDI;

class HusoHorario
{
    /** @var string */
    private $text;

    /** @var HusoHorarioEstacion */
    private $verano;

    /** @var HusoHorarioEstacion */
    private $invierno;

    public function __construct(string $text, HusoHorarioEstacion $verano, HusoHorarioEstacion $invierno)
    {
        $this->text = $text;
        $this->verano = $verano;
        $this->invierno = $invierno;
    }
}
