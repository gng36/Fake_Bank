create database fake_bank;

use fake_bank;

create table user (
	first_name varchar(255) not null,
	last_name varchar(255) not null,
	address varchar(255),
	state char(2),
	zipcode varchar(15),
	username varchar(255) not null,
	password varchar(25) not null,
	primary key(username)
);

create table account (
	account_number int not null auto_increment,
	type varchar(255) not null,
	username varchar(255) not null,
	balance decimal(20,2) not null default 0.0,
	interest_rate decimal(4,2) not null default 1,
	foreign key (username) references user(username),
	primary key (account_number)
);

create table transaction (
	trans_id int not null auto_increment,
	type varchar(255) not null,
	acc_num_to int,
	acc_num_from int,
	withdraw_from_acc_num int,
	deposit_to_acc_num int,
	trans_date Date,
	amount decimal(20,2),
	foreign key (acc_num_to) references account(account_number),
	foreign key (acc_num_from) references account(account_number),
	foreign key (withdraw_from_acc_num) references account(account_number),
	foreign key (deposit_to_acc_num) references account(account_number),
	primary key(trans_id)
);

