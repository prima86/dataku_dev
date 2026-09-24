<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

class Import_Dss_2_11 implements ToCollection
{
    private $current = 0;
    /**
    * @param Collection $collection
    */

    public function collection(Collection $collection)
    {
        // Mengambil bulan dan tahun saat ini
        $bulan = date('m');
        $tahun = date('Y');

        if ($bulan >= 1 && $bulan <= 6) {
            // Antara bulan Januari sampai Maret
            $year_input = date('Y')-1;
        }
        else {
            // Antara bulan April sampai Oktober
            $year_input = date('Y').'_1';
        }


        // Cek apakah data sudah ada atau belum (by_year)
        $cek = DB::table('dss_2_11')
                    ->where('year', $year_input)
                    ->get();

        if ($cek->count() > 0) {
            $delete = DB::table('dss_2_11')
                            ->where('year', $year_input)
                            ->delete();
        }

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

        // Membuat array insert_data
        $insert_data = [];
        for($i=0; $i < $collection->count() ; $i++)
        {
            if ($i > 0) {
                $data = array(
                  'id' => $last_id+$i,
                  'id_opd' => $collection[$i][1],
                  'table_name' => 'dss_2_11',
                  'total_struktural_l' => $collection[$i][2],
                  'total_struktural_p' => $collection[$i][3],
                  'total_umum_l' => $collection[$i][4],
                  'total_umum_p' => $collection[$i][5],
                  'total_tertentu_l' => $collection[$i][6],
                  'total_tertentu_p' => $collection[$i][7],
                  'year' => $year_input,
                  'status' => '1'
                );
                $insert_data[] = $data;
            }            
        }
        // dd($insert_data);
        $query = DB::table('dss_2_11')->insert($insert_data);


        // Insert status TOC
        $toc_status = array(
                              'table_name' => 'dss_2_11',
                              'year' => $year_input,
                              'status' => '1'
                            );
        $insert_dss_toc = DB::table('dss_toc_status')->insert($toc_status);
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
