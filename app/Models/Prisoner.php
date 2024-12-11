<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Prisoner extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = ['name', 'prison','created_by'];

    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * @param $query
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function scopeFilter($query): mixed
    {
        return $query->when(\request()->get('query') != 'null' && !empty(\request()->get('query')), function ($q) {
            $q->where('name', 'LIKE', '%' . \request()->get('query') . '%')
            ->orWhere('prison', 'LIKE', '%' . \request()->get('query') . '%');
        });
    }
}
