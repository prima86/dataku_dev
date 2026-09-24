<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\DB;

class Import_Dss_2_15 implements ToCollection
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
        $cek = DB::table('dss_2_15')
                    ->where('year', $year_input)
                    ->get();

        if ($cek->count() > 0) {
            $delete = DB::table('dss_2_15')
                            ->where('year', $year_input)
                            ->delete();
        }

        // Membuat id 
        $row_count_dss_2_15 = DB::table('dss_2_15')->get()->count();
        if($row_count_dss_2_15 > 0)
        {
            $last_id = DB::table('dss_2_15')->orderBy('id', 'DESC')->first()->id;
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
                  'table_name' => 'dss_2_15',
                  'total_1a' => $collection[$i][2],
                  'total_1b' => $collection[$i][3],
                  'total_1c' => $collection[$i][4],
                  'total_1d' => $collection[$i][5],
                  'total_2a' => $collection[$i][6],
                  'total_2b' => $collection[$i][7],
                  'total_2c' => $collection[$i][8],
                  'total_2d' => $collection[$i][9],
                  'total_3a' => $collection[$i][10],
                  'total_3b' => $collection[$i][11],
                  'total_3c' => $collection[$i][12],
                  'total_3d' => $collection[$i][13],
                  'total_4a' => $collection[$i][14],
                  'total_4b' => $collection[$i][15],
                  'total_4c' => $collection[$i][16],
                  'total_4d' => $collection[$i][17],
                  'total_4e' => $collection[$i][18],
                  'total_i' => $collection[$i][19],
                  'total_ii' => $collection[$i][20],
                  'total_iii' => $collection[$i][21],
                  'total_iv' => $collection[$i][22],
                  'total_v' => $collection[$i][23],
                  'total_vi' => $collection[$i][24],
                  'total_vii' => $collection[$i][25],
                  'total_viii' => $collection[$i][26],
                  'total_ix' => $collection[$i][27],
                  'total_x' => $collection[$i][28],
                  'total_xi' => $collection[$i][29],
                  'total_xii' => $collection[$i][30],
                  'total_xiii' => $collection[$i][31],
                  'total_xiv' => $collection[$i][32],
                  'total_xv' => $collection[$i][33],
                  'total_xvi' => $collection[$i][34],
                  'total_xvii' => $collection[$i][35],
                  'year' => $year_input,
                  'status' => '1'
                );
                $insert_data[] = $data;
            }            
        }
        // dd($insert_data);
        $query = DB::table('dss_2_15')->insert($insert_data);


        // Insert status TOC
        $toc_status = array(
                              'table_name' => 'dss_2_15',
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
    }
}
