<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Whoops\Run;

class Job extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
   
        'title',
        'description',
   
        'min_salary',
        'max_salary',
        'show_salary',
        'type_id',
        'workday_id',
        'category_id',
        'education_id',
        'modality_id',
        'country_id',
        'state_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function education()
    {
        return $this->belongsTo(Education::class);
    }

    public function workday(){
        return $this->belongsTo(Workday::class);
    }
    
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function modality(){
        return $this->belongsTo(Modality::class);

    }

    public function category(){
        return $this->belongsTo(Category::class);

    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }


    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }


    public function excerpt(){
       return strip_tags(\Illuminate\Support\Str::limit($this->description, 200));
    }

    public function salaryRange(){
        return '$' . number_format($this->min_salary, 0, ',', '.') . ' - $' . number_format($this->max_salary, 0, ',', '.');
    }
}
