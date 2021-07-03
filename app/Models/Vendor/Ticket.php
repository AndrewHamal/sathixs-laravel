<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['vendor','ticket_file'];

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

    public function ticket_file()
    {
        return $this->hasMany('App\Models\Vendor\TicketFile','ticket_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor\Vendor','vendor_id', 'id');
    }
}
