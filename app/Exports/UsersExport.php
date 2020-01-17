<?php

namespace App\Exports;

use App\Models\MsUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Sunsun\Admin\AdminController;

class UsersExport implements FromCollection,WithHeadings
{
    private $username;
    private $phone;
    private $email;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(string $username = null, string $phone = null, string $email = null)
    {
        $this->username = $username;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function collection()
    {
        $result_data = array();
        $search = new AdminController();
        if (!empty($this->username) || !empty($this->phone) || !empty($this->email)) {
            $arr_data = array(
                'username' => $this->username,
                'phone' => $this->phone,
                'email' => $this->email
            );
            $data = $search->get_list_search_user($arr_data);
            if (!empty($data)) {
                $data = $search->get_list_search_user($arr_data);
            }else{
                $data = MsUser::whereNotIn('ms_user_id', [1])->get();
            }
        }else{
            $data = MsUser::whereNotIn('ms_user_id', [1])->get();
        }
        return $data;
        foreach ($data as $row) {
            $result_data[] = array(
                '1' => $row->ms_user_id,
                '2' => $row->username,
                '3' => $row->tel,
                '4' => $row->email,
                '5' => $row->gender,
                '6' => $row->birth_year,
                '7' => $row->user_type,
                '8' => $row->password,
                '9' => $row->created_at,
                '10' => $row->updated_at,
            );
        }
        return (collect($result_data));
    }

    public function headings(): array
    {
        return [
            'ms_user_id',
            'username',
            'tel',
            'email',
            'gender',
            'birth_year',
            'user_type',
            'password',
            'created_at',
            'updated_at'
        ];
    }
}
