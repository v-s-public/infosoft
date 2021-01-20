# Суть: Создание депозита юзером для получения прибыли по депозиту.

Язык: PHP >=7.0 
Framework: Laravel >=5.6
Database: PostgreSQL

## План
1. Развернуть таблицы с помощью миграций
2. Развернуть Авторизацию, Регистрацию, Создать Кошелек пользователя при регистрации
3. Вывести баланс пользователя
4. Создать простую форму для пополнения баланса (только для авторизованных); сопровождаются транзакцией типа  "enter"
5. Создать простую форму для вклада на депозит со снятием с баланса (только для авторизованных); сопровождаются транзакцией типа "create_deposit"
    * сумма депозита - от 10 до 100 единиц
    * процент начисления: 20%

6. Создать Команду которая будет начислять раз в минуту процент от депозита на баланс пользователя; сопровождаются транзакцией типа "accrue"
    * количество начислений - 10 для одного депозита
    * 1 начисление в минуту
    * 1 начисление 20% от тела депозита
    * после последнего начисления депозит должен изменить статус на закрытый; сопровождаются транзакцией типа "close_deposit"
7. Вывести таблицу с депозитами текущего юзера(ID, Сумма вклада, Процент, Количество текущих начислений, Сумма начислений, Статус депозита, Дата)
8. Вывести таблицу с транзакциями (ID, Тип, Сумма, Дата)

## Структура БД

### Таблица users
id int autoincrement

login character varying(30)

email character varying(191)

password character varying(191)

created_at timestamp 

### Таблица wallets
id int autoincrement

user_id id int

balance double precision [0]

created_at timestamp 

_referenses:_

user_id	users(id)	

### Таблица deposits
id int autoincrement

user_id int

wallet_id int

invested double precision [0]

percent double precision [0]

active smallint [0]

duration smallint [0]

accrue_times smallint [0]

created_at timestamp 

**_referenses_**:

user_id	users(id)

wallet_id	wallets(id)

### Таблица transactions
id int autoincrement

type varying(30)

user_id int

wallet_id int

deposit_id int [NULL]

amount double precision [0]

created_at timestamp 

**_referenses:_**

user_id	users(id)	

wallet_id	wallets(id)

depoit_id	deposits(id)
