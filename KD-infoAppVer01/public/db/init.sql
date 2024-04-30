# クライアントから送信される文字コードをutf8に設定
set names utf8;
# もし「prosite」というデータベースが存在すれば削除
drop database if exists prosite;
# prositeというデータベースを作成
create database prosite character set utf8 collate utf8_general_ci;
# ユーザー「kobe」にパスワード「denshi」を設定し、データベース「prosite」に対する全ての権限を付与
grant all privileges on prosite.* to kobe@localhost identified by 'denshi';
# データベース「prosite」を使用
use prosite;
# テーブル「user」を作成
create table user(
    user_id int auto_increment primary key ,
    user_name varchar(255) not null,
    email_address varchar(255) not null,
    user_pass varchar(255) ,
    profile_title varchar(50) ,
    profile_text varchar(1000)
);
# テーブル「question」を作成
create table question(
    question_id int auto_increment primary key,
    user_id int,
    question_title varchar(50) not null,
    question_text varchar(1000) not null,
    question_time timestamp default current_timestamp,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);
# テーブル「post」を作成
create table post(
    post_id int auto_increment primary key,
    user_id int,
    post_title varchar(50) not null,
    post_text varchar(1000) not null,
    post_time timestamp default current_timestamp,
    FOREIGN KEY (user_id) REFERENCES user(user_id)
);
# テーブル「reply」を作成
create table reply(
    reply_id int auto_increment primary key,
    user_id int,
    question_id int,
    post_id int,
    reply_text varchar(1000) not null,
    reply_time timestamp default current_timestamp,
    FOREIGN KEY (user_id) REFERENCES user(user_id),
    FOREIGN KEY (question_id) REFERENCES question(question_id),
    FOREIGN KEY (post_id) REFERENCES post(post_id)
);

# ユーザーテーブルに仮のデータを追加
insert into user(user_name, email_address, user_pass, profile_title, profile_text) values('kobe taro', 'kobetaro@st.kobedenshi.ac.jp', 'kobetaro0123', 'Hello', 'I am kobe taro');
# 質問テーブルに仮のデータを追加
insert into question(question_title, question_text) values('How are you?', 'How are you doing?');
# 投稿テーブルに仮のデータを追加
insert into post(post_title, post_text) values('I am fine', 'I am fine, thank you');


