<?php

namespace App\Enums;

enum ElementoTipos: int
{
    case TITULO = 1;
    case IMAGENPORTADA = 2;
    case CAJATEXTODOCUMENTO = 3;
    case CAJATEXTOCORREO = 4;
    case CAJATEXTOCELULAR = 5;
    case COMBOTIPOINGRESO = 6;
    case COMBOTIPODEPARTAMENTO = 7;
    case CHECKCONDICIONES = 9;
    case CHECKACEPTO = 10;

    public function label(): int {
        return static::getLabel($this);
    }

    public static function getLabel(self $value): int {
        return match ($value) {
            ElementoTipos::TITULO => 1,
            ElementoTipos::IMAGENPORTADA => 2,
            ElementoTipos::CAJATEXTODOCUMENTO => 3,
            ElementoTipos::CAJATEXTOCORREO => 4,
            ElementoTipos::CAJATEXTOCELULAR => 5,
            ElementoTipos::COMBOTIPOINGRESO => 6,
            ElementoTipos::COMBOTIPODEPARTAMENTO => 7,
            ElementoTipos::CHECKCONDICIONES => 8,
            ElementoTipos::CHECKACEPTO => 9,
        };
    }
}