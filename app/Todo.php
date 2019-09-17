<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;




class Todo extends Model
{
    //
    protected $fillable = [
        'title',
        'user_id'  // 追記
    ];
    // ここから追記
    public function getByUserId($id)
    {
        return $this->where('user_id', $id)->get(); //where(フィールド名, 値); 指定されたレコードに絞ります。 これにより指定したフィールドの値が第二引数の値と同じレコードを検索します。
    }
    use SoftDeletes;
    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

}
