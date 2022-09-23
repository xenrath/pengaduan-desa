<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ComplaintCategory;
use App\User;

class Complaint extends Model
{
    protected $guarded = [];

    public function complaintCategory(){
        return $this->belongsTo(ComplaintCategory::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
