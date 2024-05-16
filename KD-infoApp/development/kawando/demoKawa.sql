# kawandoDB demo deta

# データベース「prosite」を使用
use prosite;

# テーブル「users」にデータを挿入
insert into users (user_name, user_pass, email_address, profile_title, profile_text)
values ('densuke', '$2y$10$ocv0VLCWjSgoXjCHNeWuVueGpq8MI.ETE7Q9YQkmkHXfY7Lf8fXka', 'densuke@kobedenshi.ac.jp', 'NW大好きクラブ名誉会長', 'ソフトⅤコース６組の伝助です。NWの勉強が大好きです。よろしくお願いします！')
,('tsubo tea', '$2y$10$zk4LbDbdSmNr6J/FKSkePe3ThIq5dHaH84SGCxYTc3O6TMN3GFG3m', 'tsubo@kobedenshi.ac.jp', '神戸電子が生んだ異端児', 'ソフトⅠコース２組の坪ノ内です。DBが好きで、普段からDBことしか考えてないです。DB以外のことに興味はありません！')
,('PonkotsuCoding','' ,'ponpon@kobedenshi.ac.jp', 'プログラミングは日課！', 'ソフトⅧコース１組の碰骨と申します。毎日プログラミングをすることが日課で、今は就職先で使うCOBOLとBrainfuckを勉強中です。' );

# densukeのハッシュ化前パスワード→Denden1234
# tsubo teaのハッシュ化前パスワード→teaOcha1234
# PonkotsuCodingのハッシュ化前パスワード→Ponkotsu1234

# タグテーブルに仮のデータを追加
insert into tag(tag_name) values('Java'), ('Python')
, ('PHP'), ('C'), ('C++'), ('C#'), ('HTML'), ('Ruby'), ('AWS'), ('TypeScript'), ('React'), ('JavaScript')
, ('Flutter'), ('Next.js'), ('Docker'), ('Golang'), ('Rails'), ('GitHub'), ('Rust'), ('iOS'), ('Linux'), ('Swift')
, ('Android'), ('Unity'), ('Git'), ('VS Code'), ('Node.js'), ('CSS'), ('Dart'), ('Azure'), ('Laravel'), (''), ('')
, (''), (''), (''), (''), (''), (''), (''), (''), (''), (''), ('')
, (''), (''), (''), (''), (''), (''), (''), (''), (''), (''), ('')
, (''), (''), (''), (''), (''), (''), (''), (''), (''), (''), ('');