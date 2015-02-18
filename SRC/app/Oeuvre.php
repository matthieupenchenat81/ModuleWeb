<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Oeuvre extends Model {

	protected $table = 'oeuvre';

	protected $guarded = ['idoeuvre', 'id'];

	public $timestamps = false;
}
