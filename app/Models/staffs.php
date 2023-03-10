<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\StaffDocuments;
use App\Models\User;

class staffs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'position',
        'salary'
        
    ];

    /**
     * Get the user that owns the staffs
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Get all of the Documents for the staffs
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Documents(): HasMany
    {
        return $this->hasMany(StaffDocuments::class, 'staffs_id', 'id');
    }


}
