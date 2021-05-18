ALTER TABLE tr_yoyaku ADD COLUMN tea tinyint(4) DEFAULT '0';

UPDATE ms_kubun
SET sort_no = sort_no + 4
WHERE
	kubun_type = '005'
	AND sort_no > 2;

INSERT INTO ms_kubun ( kubun_type, kubun_id, kubun_value, sort_no )
VALUES
	( '005', '10', 'お昼からリフレッシュコース', 3 );

INSERT INTO ms_kubun ( kubun_type, kubun_id, kubun_value, sort_no )
VALUES
	( '005', '07', 'お昼からのスイーツコース', 4 );

INSERT INTO ms_kubun ( kubun_type, kubun_id, kubun_value, sort_no )
VALUES
	( '005', '08', '美肌コース', 5 );

INSERT INTO ms_kubun ( kubun_type, kubun_id, kubun_value, sort_no )
VALUES
	( '005', '09', '免疫力アップコース', 6 );

UPDATE ms_kubun
SET kubun_value = '朝からリフレッシュコース'
WHERE
	kubun_type = '005'
	AND kubun_id = '02';

UPDATE ms_kubun
SET notes = '朝からリフレッシュコース'
WHERE
	kubun_type = '030'
	AND kubun_id = '05';

UPDATE ms_kubun
SET notes = '断食プラン（1日プラン）',
	kubun_value = '11000回'
WHERE
	kubun_type = '030'
	AND kubun_id = '08';

UPDATE ms_kubun
SET notes = '断食プラン（体質改善5日間コース ）'
WHERE
	kubun_type = '030'
	AND kubun_id = '09';

INSERT INTO ms_kubun ( kubun_type, kubun_id, kubun_value, sort_no, notes )
VALUES
	( '030', '21', '8500名', 21, 'お昼からのスイーツコース' );

INSERT INTO ms_kubun ( kubun_type, kubun_id, kubun_value, sort_no, notes )
VALUES
	( '030', '22', '8500名', 22, '美肌コース' );

INSERT INTO ms_kubun ( kubun_type, kubun_id, kubun_value, sort_no, notes )
VALUES
	( '030', '23', '7500名', 23, '免疫力アップコース' );

INSERT INTO ms_kubun ( kubun_type, kubun_id, kubun_value, sort_no, notes )
VALUES
	( '030', '24', '8500名', 24, 'お昼からリフレッシュコース' );