<?php

namespace App\FormFields;

use TCG\Voyager\FormFields\AbstractHandler;

class LinkHandler extends AbstractHandler
{
    protected $codename = 'link';

    public function createContent($row, $dataType, $dataTypeContent, $options)
    {
        return view('voyager::formfields.link', [
            'row' => $row,
            'options' => $options,
            'dataType' => $dataType,
            'dataTypeContent' => $dataTypeContent,
        ]);
    }
}
