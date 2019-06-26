
REATE USER 'finance_1'@'localhost' IDENTIFIED BY 'finance_1';
GRANT ALL PRIVILEGES ON *.finance_1 TO 'finance_1'@'localhost' WITH GRANT OPTION;

CREATE USER 'finance_1'@'%' IDENTIFIED BY 'finance_1';
GRANT ALL PRIVILEGES ON *.finance_1 TO 'finance_1'@'%' WITH GRANT OPTION;

FLUSH PRIVILEGES;
