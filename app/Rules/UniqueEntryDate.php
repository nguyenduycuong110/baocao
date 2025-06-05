<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UniqueEntryDate implements ValidationRule
{

    protected $table;

    protected $ignoreId;
    protected $column;

    public function __construct(string $table, $ignoreId = null, string $column = 'entry_date')
    {
        $this->table = $table;
        $this->ignoreId = $ignoreId;
        $this->column = $column;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $auth = Auth::user();
        $auth->load('teams');
       
        $teamUserIds = DB::table('users')->where('team_id', $auth->team_id)->pluck('id')->toArray();

        
        $entryDate = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
        $query = DB::table($this->table)->whereDate($this->column, $entryDate)->whereIn('user_id', $teamUserIds);
        if($this->ignoreId){
            $query->where('id', '!=', $this->ignoreId);
        }
        $exists = $query->exists();
        if($exists){
            $fail("Đã có bản ghi được tạo vào ngày {$value}. Mỗi ngày chỉ được tạo 1 bản ghi");
        }
    }
}
