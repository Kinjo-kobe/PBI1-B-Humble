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
# テーブル「users」を作成
create table users(
    user_id int auto_increment primary key ,
    user_name varchar(255) ,
    user_pass varchar(255) ,
    email_address varchar(255),
    profile_title varchar(100) ,
    profile_text varchar(1000)
);
# テーブル「questions」を作成
create table questions(
    question_id int auto_increment primary key,
    user_id int,
    question_title varchar(100) not null,
    question_text varchar(1000) not null,
    question_good int default 0,
    question_code text,
    question_image_name varchar(100) default null,
    question_image mediumblob default null,
    question_time timestamp default current_timestamp,
    -- 外部キー制約
    FOREIGN KEY (user_id) REFERENCES users (user_id)
    -- 参照先をupdate/deleteした際はエラーを返す
    ON DELETE RESTRICT ON UPDATE RESTRICT
);
# テーブル「posts」を作成
create table posts(
    post_id int auto_increment primary key,
    user_id int,
    post_title varchar(100) not null,
    post_text varchar(1000) not null,
    post_good int(3) default null,
    post_code text,
    post_image_name varchar(100) default null,
    post_image mediumblob default null,
    post_time timestamp default current_timestamp,
    -- 外部キー制約
    FOREIGN KEY (user_id) REFERENCES users (user_id)
    -- 参照先をupdate/deleteした際はエラーを返す
    ON DELETE RESTRICT ON UPDATE RESTRICT
);
# テーブル「replies」を作成
create table replies(
    reply_id int auto_increment primary key,
    user_id int,
    question_id int,
    post_id int,
    reply_text varchar(1000) not null,
    reply_best_answer boolean default false,
    reply_time timestamp default current_timestamp,
    -- 外部キー制約 user_id
    FOREIGN KEY (user_id) REFERENCES users (user_id)
    -- 参照先をupdate/deleteした際はエラーを返す
    ON DELETE RESTRICT ON UPDATE RESTRICT,
    -- 外部キー制約 question_id
    FOREIGN KEY (question_id) REFERENCES questions (question_id)
    -- 参照先をupdate/deleteした際はエラーを返す
    ON DELETE RESTRICT ON UPDATE RESTRICT,
    -- 外部キー制約 post_id
    FOREIGN KEY (post_id) REFERENCES posts (post_id)
    -- 参照先をupdate/deleteした際はエラーを返す
    ON DELETE RESTRICT ON UPDATE RESTRICT
);
# テーブル「tag」を作成
create table tag(
    tag_id int auto_increment primary key,
    tag_name varchar(100) not null
);
# テーブル「tagcontrol」を作成
create table tagcontrol(
    tagcontrol_id int auto_increment primary key,
    question_id int,
    post_id int,
    tag_id int,
    -- 外部キー制約 question_id
    FOREIGN KEY (question_id) REFERENCES questions (question_id)
    -- 参照先をupdate/deleteした際はエラーを返す
    ON DELETE RESTRICT ON UPDATE RESTRICT,
    -- 外部キー制約 post_id
    FOREIGN KEY (post_id) REFERENCES posts (post_id)
    -- 参照先をupdate/deleteした際はエラーを返す
    ON DELETE RESTRICT ON UPDATE RESTRICT,
    -- 外部キー制約 tag_id
    FOREIGN KEY (tag_id) REFERENCES tag (tag_id)
    -- 参照先をupdate/deleteした際はエラーを返す
    ON DELETE RESTRICT ON UPDATE RESTRICT
);


# ユーザーテーブルに仮のデータを追加
insert into users(user_name, email_address, user_pass, profile_title, profile_text) values('kobe taro', 'kobetaro@st.kobedenshi.ac.jp', 'kobetaro0123', 'Hello', 'I am kobe taro');
# 質問テーブルに仮のデータを追加
insert into questions(question_title, question_text) values('How are you?', 'How are you doing?');
# 投稿テーブルに仮のデータを追加
insert into posts(post_title, post_text) values('I am fine', 'I am fine, thank you');
# 返信テーブルに仮のデータを追加
insert into replies(reply_text) values('I am fine too');
# タグテーブルに仮のデータを追加
insert into tag(tag_name) values('java');
insert into tag(tag_name) values('python');
insert into tag(tag_name) values('php');
insert into tag(tag_name) values('c');