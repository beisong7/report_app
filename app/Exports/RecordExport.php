<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class RecordExport implements FromArray, WithHeadings, WithTitle
{
    protected $array, $headings, $title;

    public function __construct(array $array, string $title, array $headings)
    {
        $this->array = $array;
        $this->headings = $headings;
        $this->title = $title;
    }

    public function headings(): array
    {
        return $this->headings;
    }

    public function array(): array
    {
        return $this->array;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }
}
