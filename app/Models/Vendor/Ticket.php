<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Vendor\TicketFile;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['vendor'];

    protected $appends = ['ticket_file'];

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

    public function getTicketFileAttribute()
    {
        $image = [];
        $ticket = TicketFile::where('ticket_id', $this->id)->get() ?? [];
        if(count($ticket) > 0) {
            foreach($ticket as $key=>$r){
                $image[$key] = [
                    'uid' => $key,
                    'url' => env('APP_URL'). Storage::url($r->path),
                ];
            }
            return $image;
        }
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor\Vendor','vendor_id', 'id');
    }
}
