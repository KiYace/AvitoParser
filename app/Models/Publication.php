<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
  /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

  protected $table = 'publications';
  // protected $primaryKey = 'id';
  // public $timestamps = false;
  protected $guarded = ['id'];
  // protected $fillable = [];
  protected $hidden = ['created_at', 'updated_at'];
  // protected $dates = [];

  /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */


  /**
  * Save publications to db.
  *
  * @param $publications array of publications
  *
  * @return boolean with results
  * @throws \Exception
  */
  public static function publicationsSave($publications) {
    foreach($publications as $publication) {

      $publicationFind = Publication::where('area_name', $publication['area_name'])->firstWhere('post_id', $publication['post_id']);

      if(empty($publicationFind)) {
        $publication = Publication::create((array) $publication);
      }
    }

    return true;
  }

  /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

  /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

  /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

  /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
