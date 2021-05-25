<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function uploadFiles($files): array
    {
        $uploaded = [];
        if (! $files) {
            return [];
        }

        foreach ($files as $file) {
            array_push($uploaded, ['path' => Storage::disk('public')->put('vendor/package', $file)]);
        }

        return $uploaded;
    }
}
