<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserImport implements ToCollection, ToModel
{
    private $current = 0;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // Membuat id 
        $row_count_dss_2_11 = DB::table('dss_2_11')->get()->count();
        if($row_count_dss_2_11 > 0)
        {
            $last_id = DB::table('dss_2_11')->orderBy('id', 'DESC')->first()->id;
        }
        else
        {
            $last_id = 0;
        }

        $insert_data = [];
        for($i=0; $i < $collection->count() ; $i++)
        {
            if ($i > 0) {
                $data = array(
                  'id' => $last_id+($i+1),
                  'id_opd' => $collection[$i][1],
                  'table_name' => 'dss_2_11',
                  'total_struktural_l' => $collection[$i][2],
                  'total_struktural_p' => $collection[$i][3],
                  'total_umum_l' => $collection[$i][4],
                  'total_umum_p' => $collection[$i][5],
                  'total_tertentu_l' => $collection[$i][6],
                  'total_tertentu_p' => $collection[$i][7],
                  'year' => session('dss_toc_year'),
                  'status' => '1'
                );
                $insert_data[] = $data;
            }            
        }
        // dd($insert_data);
        $query = DB::table('dss_2_11')->insert($insert_data);
    }

    public function model(array $row)
    {
        // $this->current++;
        // if($this->current > 1)
        // {
        //     dd($row);
        // }
        // dd($row);
    }


}
