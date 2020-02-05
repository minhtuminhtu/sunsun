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
                  ('003','01','09:08着（高速舞子08:25発）福良行','1','0908'),
                  ('003','02','09:29着（三宮08:25発）福良行','2','0929'),
                  ('003','03','10:06着（三宮09:00発）陸の港西淡行','3','1006'),
                  ('003','04','10:29着（三宮09:25発）福良行','4','1029'),
                  ('003','05','11:14着（三宮10:10発）福良行','5','1114'),
                  ('003','06','11:49着（三宮10:45発）福良行','6','1149'),
                  ('003','07','12:14着（三宮11:10発）福良行','7','1214'),
                  ('003','08','12:38着（高速舞子11:55発）福良行','8','1238'),
                  ('003','09','13:06着（三宮12:00発）陸の港西淡行','9','1306'),
                  ('003','10','13:14着（三宮12:10発）福良行','10','1314'),
                  ('003','11','13:38着（高速舞子12:55発）福良行','11','1338'),
                  ('003','12','14:14着（三宮13:10発）福良行','12','1414'),
                  ('003','13','15:06着（三宮14:00発）陸の港西淡行','13','1506'),
                  ('003','14','15:14着（三宮14:10発）福良行','14','1514'),
                  ('003','15','16:14着（三宮15:05発）福良行','15','1614'),
                  ('003','16','16:38着（高速舞子15:55発）福良行','16','1638'),
                  ('003','17','16:49着（三宮15:40発）福良行','17','1649'),
                  ('003','18','17:06着（三宮16:00発）陸の港西淡行','18','1706'),
                  ('003','19','17:38着（高速舞子16:55発）福良行','19','1738'),
                  ('003','20','17:39着（三宮16:30発）福良行','20','1739'),
                  ('003','21','18:14着（三宮17:05発）福良行','21','1814'),
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


                  ('022','01','無し','1',''),
                  ('022','02','有り','2',''),
                  ('023','01','無し','0','0'),
                  ('023','02','1名','1','1'),
                  ('023','03','2名','2','2'),
                  ('023','04','3名','3','3'),
                  ('023','05','4名','4','4'),
                  ('023','06','5名','5','5'),
                  ('023','07','6名','6','6'),

                  ('024', '01', '3390', '1', '酵素浴:  大人'),
                  ('024', '02', '2800', '2', '酵素浴:  学生'),
                  ('024', '03', '2000', '3', '酵素浴:  小学生'),
                  ('025', '01', '8390', '1', '1 day refresh (Include lunch)'),
                  ('026', '01', '20000', '1', '3'), -- 貸切 3人
                  ('026', '02', '3000', '2', '貸切+1人'),
                  ('027', '01', '9800', '1', '断食コース 1 ngày'),
                  ('027', '02', '45000', '2', '断食コース 5 ngày'),
                  ('028', '01', '3500', '1', 'Pet'),
                  ('029', '01', '1200', '1', 'Lunch'),
                  ('029', '02', '7000', '2', '宿泊 1人 モーニング'),
                  ('029', '03', '10000', '3', '宿泊 1人 > 2人 モーニング'),
                  ('029', '04', '500',   '4', 'pet 円 / h'),
                  ('029', '05', '1000', '5', 'pet 1 day refresh'),
                  ('029', '06', '3500', '6', 'Whitening 円 / h')

                  ,('030', '01', '3500回', '1', '酵素浴（大人）')
                  ,('030', '02', '2800回', '2', '酵素浴（学生）')
                  ,('030', '03', '2000回', '3', '酵素浴（小学生）')
                  ,('030', '04', '1200名', '4', 'ランチ')
                  ,('030', '05', '8500名', '5', '１日リフレッシュプラン')
                  ,('030', '06', '22000回', '6', '酵素部屋１部屋貸切プラン')
                  ,('030', '07', '3300名', '7', '酵素部屋１部屋貸切プラン（追加）')
                  ,('030', '08', '10780回', '8', '断食コース（1日プラン）')
                  ,('030', '09', '49500回', '9', '断食コース（体質改善5日間コース ）')
                  ,('030', '10', '7700泊', '10', '宿泊A（畳、1名）')
                  ,('030', '11', '11000泊', '11', '宿泊A（畳、2名以上）')
                  ,('030', '12', '7700泊', '12', '宿泊B（ツイン、1名）')
                  ,('030', '13', '11000泊', '13', '宿泊B（ツイン、2名）')
                  ,('030', '14', '7700泊', '14', '宿泊C（セミダブル、1名）')
                  ,('030', '15', '600名', '15', 'モーニング')
                  ,('030', '16', '3500回', '16', 'ペット酵素浴')
                  ,('030', '17', '2500回', '17', 'ペット酵素浴（1匹追加）')
                  ,('030', '18', '500回', '18', 'ペット預かり（酵素浴1回）')
                  ,('030', '19', '1000回', '19', 'ペット預かり（リフレッシュプラン）')
                  ,('030', '20', '3500回', '20', 'ホワイトニング')





            ");
            DB::insert("
                INSERT INTO ms_kubun (kubun_type,kubun_id,kubun_value,sort_no, notes,time_holiday)
                VALUES
                        ('013','01','09:45','1','0945','0945'),
                        ('013','02','10:15','2','1015','1015'),
                        ('013','03','10:45','3','1045','1045'),
                        ('013','04','13:15','4','1315','1315'),
                        ('013','05','13:45','5','1345','1345'),
                        ('013','06','14:15','6','1415','1415'),
                        ('013','07','15:15','7','1515','1515'),
                        ('013','08','15:45','8','1545','1545'),
                        ('013','09','16:15','9','1615','1615'),
                        ('013','10','17:45','10','1745','1745'),
                        ('013','11','18:15','11','1815','1815'),
                        ('013','12','18:45','12','1845','1845'),
                        ('014','01','9:45～','1','0945','0945'),
                        ('014','02','13:15～','2','1315','1315'),
                        ('014','03','15:15～','3','1515','1515'),
                        ('020','01','9:30～10:30','1','0930-1030','0930'),
                        ('020','02','11:00～12:00','2','1100-1200','1100'),
                        ('020','03','14:00～15:00','3','1400-1500','1400'),
                        ('020','04','15:30～16:30','4','1530-1630','1530'),

                        ('021','01','9:30～10:00','1','0930-1000|1','0930'),
                        ('021','02','10:30～11:00','2','1030-1100|0','1030'),
                        ('021','03','11:00～11:30','3','1100-1130|1','1100'),
                        ('021','04','12:00～12:30','4','1200-1230|0','1200'),
                        ('021','05','12:30～13:00','5','1230-1300|0','1230'),
                        ('021','06','13:00～13:30','6','1300-1330|1','1300'),
                        ('021','07','14:00～14:30','7','1400-1430|0','1400'),
                        ('021','08','14:30～15:00','8','1430-1500|0','1430'),
                        ('021','09','15:00～15:30','9','1500-1530|1','1500'),
                        ('021','10','16:00～16:30','10','1600-1630|0','1600'),
                        ('021','11','16:30～17:00','11','1630-1700|1','1630')
            ");
      }
}
