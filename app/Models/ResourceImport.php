<?php
namespace App\Models;
use App\Models\Resource;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class ResourceImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        return new Resource([
           'url' => $row[0],
           'user_id' => $row[1]
        ]);
    }
}
