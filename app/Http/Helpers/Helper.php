<?php
namespace App\Http\Helpers;
use \Session;
use App\Models\MsHoliday;
class Helper
{
    public static function getDisableAll($date) {
        $disable_all = "";
        $date_holiday = Session::get("date_holiday");
        $date_check = str_replace("/","",$date);
        foreach ($date_holiday as $key => $value) {
            $where_date = str_replace("/","",$value);
            if ($where_date == $date_check) {
                $disable_all = "1"; // ngay nghi
                break;
            }
        }
        return $disable_all;
    }
    public static function setHoliday($list_time, $time, $type, $disable_all) {
        if (empty($disable_all)) {
            foreach ($list_time as $row) {
                if  (   ($type==$row["type_holiday"]) &&
                        ($time==$row["time_holiday"] || empty($row["time_holiday"]))
                    )
                    return " bg-dis";
            }
            return "";
        }
        return " bg-dis";
    }
    public static function getTimeHoliday($date) {
        $date = str_replace("/","",$date);
        return MsHoliday::whereRaw("type_holiday is not null and date_holiday = '$date' ")->get();
    }
}