# kawandoDB demo deta

# データベース「prosite」を使用
use prosite;

# テーブル「users」にデータを挿入
insert into users (user_name, user_pass, email_address, profile_title, profile_text)
values ('densuke', 'Denden1234', 'densuke@kobedenshi.ac.jp', 'NW大好きクラブ名誉会長', 'ソフトⅤコース６組の伝助です。NWの勉強が大好きです。よろしくお願いします！')
,('tsubo tea', 'teaOcha1234', 'tsubo@kobedenshi.ac.jp', '神戸電子が生んだ異端児', 'ソフトⅠコース２組の坪ノ内です。DBが好きで、普段からDBことしか考えてないです。DB以外のことに興味はありません！')
,();
