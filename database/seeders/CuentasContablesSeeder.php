<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Csv;

class CuentasContablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $route = public_path('bd_puc.csv');
            $file = new \Illuminate\Http\UploadedFile($route, 'bd_puc.csv');
            $reader = new Csv();
            $spreadsheet = $reader->load($file);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

            $fields = $sheetData[0];
            $fields[] = 'padre_id';
            $parent_id = 0;
            for ($i=1; $i < count($sheetData); $i++) {

                if ($sheetData[$i][2] == 'clase') {
                    $sheetData[$i][] = null;
                } else {
                    $sheetData[$i][] = $parent_id;
                }

                $data = array_combine($fields, $sheetData[$i]);

                $account = new \App\Modules\Accounting\Models\CuentaContable($data);
                $account->save();
                if ($account->nivel == \App\Modules\Accounting\Utils\Constants\AccountConstants::classAccName) {
                    $parent_id = $account->id;
                }
            }


            DB::commit();
        } catch (\Exception|\Throwable $e) {
            DB::rollBack();
            dd($e);
        }

    }
}