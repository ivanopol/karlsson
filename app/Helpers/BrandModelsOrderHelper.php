<?php


namespace App\Helpers;


class BrandModelsOrderHelper
{
    public static function setOrder($model_code)
    {
        switch ($model_code) {
            case "GRANTA":
                return 627;
            case "KALINA":
                return 267;
            case "PRIORA":
                return 207;
            case "VESTA":
                return 194;
            case "NIVA":
                return 126;
            case "2131_4X4":
                return 82;
            case "PATRIOT":
                return 103;
            case "OCTAVIA":
                return 102;
            case "FOCUS":
                return 99;
            case "LOGAN":
                return 92;
            case "LARGUS":
                return 81;
            case "SOLARIS":
                return 74;
            case "POLO":
                return 64;
            case "RIO":
                return 61;
            case "XRAY":
            case "ASTRA":
                return 59;
            case "RAPID":
                return 51;
            case "AVEO":
                return 45;
            case "DUSTER":
                return 43;
            case "2114":
                return 40;
            case "LACETTI":
                return 38;
            case "LANCER":
                return 37;
            case "CRUZE":
                return 36;
            case "ALMERA":
                return 34;
            case "TIGUAN":
                return 33;
            case "MEGANE":
                return 32;
            case "FABIA":
                return 31;
            case "JETTA":
                return 26;
            case "CERATO":
            case "QASHQAI":
            case "COROLLA":
            case "NEXIA":
                return 25;
            case "SPORTAGE":
                return 24;
            case "XTRAIL":
                return 23;
            case "YETI":
            case "SANDERO":
            case "GETZ":
                return 21;
            case "GOLF":
            case "PICKUP":
            case "SOLANO":
                return 19;
            case "SORENTO":
            case "ELANTRA":
            case "PASSAT":
            case "HUNTER":
            case "ACCENT":
                return 16;
            case "FUSION":
            case "CEED":
            case "TUCSON":
            case "MATIZ":
                return 15;
            default:
                return 0;
        }
    }
}
