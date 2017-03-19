insert into user (first_name, last_name, username, password) values ("Gary", "Ng", "gng", "derp123");

insert into account (type, username, balance, interest_rate) values ("savings", "gng", 100200.000, 1.0000);
insert into account (type, username, balance, interest_rate) values ("checkings", "gng", 9001000.00, 0.0000);
insert into transaction (type, acc_num_to, acc_num_from, amount) values ("transfer", 2, 1, 10);
insert into transaction (type, acc_num_to, acc_num_from, amount) values ("transfer", 2, 1, 120);
insert into transaction (type, acc_num_to, acc_num_from, amount) values ("transfer", 2, 1, 1890);

