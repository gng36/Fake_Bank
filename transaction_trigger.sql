delimiter //
create trigger transaction_trigger
after insert on transaction
for each row
begin
	declare currentAccBal decimal(20,2);
	if(new.type = "deposit") then
		set @currentAccBal = (select balance from account where account_number = new.deposit_to_acc_num);
		update account set balance=@currentAccBal + new.amount where account_number = new.deposit_to_acc_num;
	elseif(new.type = "withdraw") then
		set @currentAccBal = (select balance from account where account_number = new.withdraw_from_acc_num);
		if(@currentAccBal - new.amount < 0) then
			signal sqlstate '45000'
			set message_text = "You have overdrafted. Transaction could not be processed";
		else
			update account set balance=@currentAccBal - new.amount where account_number = new.withdraw_from_acc_num;
		end if;
	elseif(new.type = "transfer") then
		set @accToBal = (select balance from account where account_number = new.acc_num_to);
		set @accFromBal = (select balance from account where account_number = new.acc_num_from);

		if(@accFromBal - new.amount < 0) then
			signal sqlstate '45000'
			set message_text = "You have overdrafted. Transaction could not be processed";
		else
			update account set balance=@accToBal + new.amount where account_number = new.acc_num_to;
			update account set balance=@accFromBal - new.amount where account_number = new.acc_num_from;
		end if;
	end if;
end;//

delimiter ;
