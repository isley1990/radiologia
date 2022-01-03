<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\FilterByUser;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

/**
 * Class File
 *
 * @package App
 * @property string $uuid
 * @property string $folder
 * @property string $created_by
*/
class File extends Model implements HasMedia
{
    use SoftDeletes,HasMediaTrait;

    protected $fillable = ['uuid', 'folder_id', 'created_by_id'];
    
}
