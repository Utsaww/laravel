<?php

namespace App\Imports;

use App\TestQuestion;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class TestQuestionImport implements ToModel,WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new TestQuestion([
            'serial_no'    => $row[0],
            'test_code'    => $row[1],
            'question'     => $row[2],
            'option_1'     => $row[3],
            'option_2'     => $row[4],
            'option_3'     => $row[5],
            'option_4'     => $row[6],
            'answer'       => $row[7],
            'solution'     => $row[8],
        ]);
    }
}
