<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;

/**
 * @method static orderBy(string $string, string $string1)
 * @method static where(string $string, int|string|null $id)
 * @method static create(array $array)
 * @method static findOrFail($id)
 * @method static find($value)
 */
class Opportunity extends Model
{
    use HasFactory;
    use Searchable;
    protected $fillable = [
        'title',
        'start',
        'end',
        'email',
        'description',
        'company_id',
        'user_id',
        'contract_id'
    ];

    /**
     * @return array{id: int, title: mixed, typeContract: mixed}
     */
    public function toSearchableArray()
    {
        return [
            'id' => (int) $this->id,
            'title' => $this->title,
            'description' => $this->description,
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }

}
