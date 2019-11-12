<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MskubunTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert("
                INSERT INTO ms_kubun (kubun_type,kubun_id,kubun_value,sort_no, notes)
                VALUES
                        ('001','01','はじめて','1',''),
                        ('001','02','リピート','2',''),
                        ('002','01','車','1',''),
                        ('002','02','バス','2',''),
                        ('003','01','09:08着（高速舞子08:25発）福良行','1',''),
                        ('003','02','09:29着（三宮08:25発）福良行','2',''),
                        ('003','03','10:06着（三宮09:00発）陸の港西淡行','3',''),
                        ('003','04','10:29着（三宮09:25発）福良行','4',''),
                        ('003','05','11:14着（三宮10:10発）福良行','5',''),
                        ('003','06','11:49着（三宮10:45発）福良行','6',''),
                        ('003','07','12:14着（三宮11:10発）福良行','7',''),
                        ('003','08','12:38着（高速舞子11:55発）福良行','8',''),
                        ('003','09','13:06着（三宮12:00発）陸の港西淡行','9',''),
                        ('003','10','13:14着（三宮12:10発）福良行','10',''),
                        ('003','11','13:38着（高速舞子12:55発）福良行','11',''),
                        ('003','12','14:14着（三宮13:10発）福良行','12',''),
                        ('003','13','15:06着（三宮14:00発）陸の港西淡行','13',''),
                        ('003','14','15:14着（三宮14:10発）福良行','14',''),
                        ('003','15','16:14着（三宮15:05発）福良行','15',''),
                        ('003','16','16:38着（高速舞子15:55発）福良行','16',''),
                        ('003','17','16:49着（三宮15:40発）福良行','17',''),
                        ('003','18','17:06着（三宮16:00発）陸の港西淡行','18',''),
                        ('003','19','17:38着（高速舞子16:55発）福良行','19',''),
                        ('003','20','17:39着（三宮16:30発）福良行','20',''),
                        ('003','21','18:14着（三宮17:05発）福良行','21',''),
                        ('004','01','希望する','1',''),
                        ('004','02','希望しない','2',''),
                        ('005','01','酵素浴','1',''),
                        ('005','02','1日リフレッシュプラン','2',''),
                        ('005','03','酵素部屋1部屋貸切プラン','3',''),
                        ('005','04','断食プラン','4',''),
                        ('005','05','ペット酵素浴','5',''),
                        ('006','01','男性','1',''),
                        ('006','02','女性','2',''),
                        ('007','01','0','1',''),
                        ('007','02','100','2',''),
                        ('008','01','無し','1',''),
                        ('008','02','有り','2',''),
                        ('009','01','追加しない','1',''),
                        ('009','02','追加する','2',''),
                        ('010','01','追加しない','1',''),
                        ('010','02','追加する','2',''),
                        ('011','01','無し','1',''),
                        ('011','02','A：１～３名（畳）','2',''),
                        ('011','03','B：１～２名（ツイン）','3',''),
                        ('011','04','C：１名（セミダブル）','4',''),
                        ('012','01','1名','1','1'),
                        ('012','02','2名','2','2'),
                        ('012','03','3名','3','3'),
                        ('013','01','09:45','1','0945'),
                        ('013','02','10:15','2','1015'),
                        ('013','03','10:45','3','1045'),
                        ('013','04','13:15','4','1315'),
                        ('013','05','13:45','5','1345'),
                        ('013','06','14:15','6','1415'),
                        ('013','07','15:15','7','1515'),
                        ('013','08','15:45','8','1545'),
                        ('013','09','16:15','9','1615'),
                        ('013','10','17:45','10','1745'),
                        ('013','11','18:15','11','1815'),
                        ('013','12','18:45','12','1845'),
                        ('014','01','9:45～','1','0945'),
                        ('014','02','13:15～','2','1315'),
                        ('014','03','15:15～','3','1515'),
                        ('015','01','1名','1','1'),
                        ('015','02','2名','2','2'),
                        ('015','03','3名','3','3'),
                        ('015','04','4名','4','4'),
                        ('015','05','5名','5','5'),
                        ('015','06','6名','6','6'),
                        ('016','01','1匹','1','1'),
                        ('016','02','2匹','2','2'),
                        ('016','03','3匹','3','3'),
                        ('017','01','1','1',''),
                        ('017','02','2','2',''),
                        ('017','03','3','3',''),
                        ('018','01','1','1',''),
                        ('018','02','2','2',''),
                        ('018','03','3','3',''),
                        ('018','04','4','4',''),
                        ('019','01','1','1',''),
                        ('020','01','9:30～10:30','1','0930-1030'),
                        ('020','02','11:00～12:00','2','1100-1200'),
                        ('020','03','14:00～15:00','3','1400-1500'),
                        ('020','04','15:30～16:30','4','1530-1630'),
                        ('021','01','11:30～','1','1130'),
                        ('021','02','13:30～','2','1330'),
                        ('022','01','無し','1',''),
                        ('022','02','有り','2',''),
                        ('023','01','無し','0','0'),
                        ('023','02','1名','1','1'),
                        ('023','03','2名','2','2'),
                        ('023','04','3名','3','3'),
                        ('023','05','4名','4','4'),
                        ('023','06','5名','5','5'),
                        ('023','07','6名','6','6')
        ");

    }
}
