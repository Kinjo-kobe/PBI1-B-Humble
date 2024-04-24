# データベース php の作成
set names utf8;
# もしprositeというデータベースが存在すれば削除
drop database if exists prosite;
# prositeというデータベースを作成
create database prosite character set utf8 collate utf8_general_ci;
