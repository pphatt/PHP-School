create database msw;
use msw;

create table category
(
    categoryID   int auto_increment primary key,
    categoryName varchar(30) not null unique
);

create table product
(
    productID      varchar(10)  not null primary key,
    productName    varchar(100) not null,
    productPrice   int          not null,
    productImage   varchar(100) not null,
    productDetails varchar(125) null,
    productStatus  int          not null,
    categoryID     int          not null
);

create table productStatus
(
    statusID   int auto_increment primary key,
    statusName varchar(20) not null
);

create table user
(
    userID       int auto_increment primary key,
    userName     varchar(50)  not null,
    userEmail    varchar(100) not null,
    userPassword varchar(100) not null,
    roll         int          not null
);

/* Do asm without roll but demo with roll*/

create table roll
(
    rollID   int primary key,
    rollName varchar(10)
);

create table log
(
    adminEmail     int not null,
    `current_time` datetime     not null,
    logTypes       int          not null,
    log_note       varchar(500) not null
);

create table logTypes
(
    logTypeID   int          not null primary key,
    logTypeName varchar(100) not null
);

alter table product
    add constraint FK_CategoryID foreign key (categoryID) references category (categoryID);

alter table product
    add constraint FK_ProductStatus foreign key (productStatus) references productStatus (statusID);

alter table log
    add constraint FK_userEmail foreign key (adminEmail) references user (userID);

alter table log
    add constraint FK_logTypes foreign key (logTypes) references logTypes (logTypeID);

alter table user
    add constraint FK_RollID foreign key (roll) references roll (rollID);

insert into category (categoryName)
values ('Samsung'),
       ('Apple'),
       ('Sony');

insert into productStatus(statusName)
values ('On Stock'),
       ('Out of Stock');

insert into logTypes(logTypeID, logTypeName)
values ('1', 'Add'),
       ('2', 'Edit'),
       ('3', 'Delete');

insert into roll (rollID, rollName) values (1, 'User'), (2, 'Admin');

insert into user (userName, userEmail, userPassword, roll) value ('Phat', 'admin111', '111', 2);

insert into product
values ('P001', 'iPhone 14 Pro Leather Case with MagSafe - Ink', 59.99,
        'iphone-14-pro-leather-case-with-mag-safe-ink.jpg',
        '', 1, 2),
       ('P002', 'iPhone 14 Pro Leather Case with MagSafe - Umber', 59.99,
        'iphone-14-pro-leather-case-with-mag-safe-umber.jpg', '', 1, 2),
       ('P003', 'iPhone 14 Pro Leather Case with MagSafe - Forest Green', 59.99,
        'iphone-14-pro-leather-case-with-mag-safe-forest-green.jpg', '', 1, 2),
       ('P004', 'iPhone 14 Pro Leather Case with MagSafe - Midnight', 59.99,
        'iphone-14-pro-leather-case-with-mag-safe-midnight.jpg', '', 1, 2),
       ('P005', 'iPhone 14 Pro Leather Case with MagSafe - Orange', 59.99,
        'iphone-14-pro-leather-case-with-mag-safe-orange.jpg', '', 1, 2),
       ('P006', 'iPhone 14 White Clear Case with MagSafe', 49.00, 'iphone-14-white-clear-case-with-mag-safe.jpg', '',
        1, 2),
       ('P007', 'iPhone 14 Black Clear Case with MagSafe', 49.00, 'iphone-14-black-clear-case-with-mag-safe.jpg', '',
        1, 2),
       ('P008', 'iPhone 14 Pro White Clear Case with MagSafe', 49.00,
        'iphone-14-pro-white-clear-case-with-mag-safe.jpg',
        '', 1, 2),
       ('P009', 'iPhone 14 Pro Black Clear Case with MagSafe', 49.00,
        'iphone-14-pro-black-clear-case-with-mag-safe.jpg',
        '', 1, 2),
       ('P010', 'iPhone 14 Pro Yellow Clear Case with MagSafe', 49.00,
        'iphone-14-pro-yellow-clear-case-with-mag-safe.jpg',
        '', 1, 2),
       ('P011', 'iPhone 14 Pro Purple Clear Case with MagSafe', 49.00,
        'iphone-14-pro-purple-clear-case-with-mag-safe.jpg',
        '', 1, 2);

select *
from log
where timestampdiff(day, log.`current_time`, current_timestamp) = 0
  and adminEmail = 'admin111'
order by log.`current_time`;

select distinct cast(`current_time` as date) as d, timestampdiff(day, `current_time`, current_timestamp) as diff
from log
where timestampdiff(day, `current_time`, current_timestamp) <= 30
order by d;

select distinct cast(`current_time` as date) as d, datediff(`current_time`, current_date) as diff
from log
where datediff(`current_time`, current_date) >= -30
order by d;

select * from user where userEmail='phat1@gmail.com' and userPassword='123';

insert into user value (2, 'p', 'p@gmail.com', '123', '1')