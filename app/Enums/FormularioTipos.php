<?php

namespace App\Enums;

enum FormularioTipos: int
{
    case GENERAL = 1;
    case AHORROS = 2;
    case CREDITOS = 3;

    public function label(): int {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): int {
        return match ($value) {
            FormularioTipos::GENERAL => 1,
            FormularioTipos::AHORROS => 2,
            FormularioTipos::CREDITOS => 3,
        };
    }
}