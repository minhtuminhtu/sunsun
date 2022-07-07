<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Http\Controllers\Sunsun\Admin\AdminController;

class SalesListExport implements FromCollection,WithHeadings
{
	private $data_search;
	/**
	* @return \Illuminate\Support\Collection
	*/

	public function __construct($data_search = null)
	{
		$this->data_search = $data_search;
	}

	public function collection()
	{
		$result_data = array();
		$search = new AdminController();
		$list_data = $search->get_salse_list($this->data_search,1);
		foreach ($list_data as $row) {
			$result_data[] = array(
				'1' => $row->name,
				'2' => $row->phone,
				'3' => $row->email,
				'4' => $row->gender,
				'5' => $row->age_value,
				'6' => $row->date_value,
				'7' => $row->repeat_user,
				'8' => $row->transport,
				'9' => $row->product_name,
				'10' => $row->price,
				'11' => $row->quantity,
				'12' => $row->money,
				'13' => $row->payment_method
			);
		}
		return (collect($result_data));
	}

	public function headings(): array
	{
		return [
			'名前',
			'電話番号',
			'メールアドレス',
			'性別',
			'年齢',
			'予約日',
			'ご利用',
			'交通手段',
			'商品名',
			'単価',
			'数量',
			'金額',
			'支払'
		];
	}
}
