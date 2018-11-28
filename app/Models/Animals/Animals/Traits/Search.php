<?php

namespace App\Models\Animals\Animals\Traits;


trait Search
{
    public static function findByCode($interbull_code, $matricol_number, $naab, $cod_ro)
    {
        if( $interbull_code )
        {
            return self::where('interbull_code', $interbull_code)->first();
        }
        if( $matricol_number )
        {
            return self::where('matricol_number', $matricol_number)->first();
        }
        if( $naab )
        {
            return self::where('naab', $naab)->first();
        }
        if( $cod_ro )
        {
            return self::where('cod_ro', $cod_ro)->first();
        }
        return NULL;
    }
}