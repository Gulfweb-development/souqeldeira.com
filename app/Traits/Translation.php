<?php

namespace App\Traits;

trait Translation
{

    public function translate($db_field_name)
    {
        if ($db_field_name !== null) {
            return $this->{$db_field_name . '_' . app()->getLocale()} ?? '';
        }
        return '';
    }
}
