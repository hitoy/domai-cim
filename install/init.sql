create table dm_info(
    ID bigint unsigned primary key auto_increment comment 'ID',
    saleman int unsigned not null comment '销售人员ID', 

    infoid char(15) not null comment '信息ID',
    infocontent text comment '信息内容',
    infoattachment varchar(200) comment '信息附件',
    name char(80) not null comment '客户名称',
    email char(80) not null comment '客户邮箱',
    tel char(20) comment '客户电话',
    whatsapp char(20) comment '客户whatsapp',
    wechat char(20) comment '客户微信',
    QQ char(20) comment '客户QQ',
    website char(100) not null comment '客户网站',
    other char(200) comment '客户其他联系方式',
    product char(20) comment '需求产品',
    country char(10) comment '客户所在国家',
    address varchar(128) comment '客户详细地址',
    creationtime datetime not null default now() comment '信息创建时间',
    modifiedtime datetime default '1988-04-25 00:00:00' comment '信息更改时间',

    inforank char(5) comment '信息等级',
    infotype char(5) comment '信息类型',
    infoperson char(10) default NULL comment '信息人获取人',
    infourl varchar(1024) default NULL comment '信息来源网址',

    index(saleman),
    index(infoid),
    unique(infoid),
    index(name),
    index(email),
    index(tel),
    index(whatsapp),
    index(wechat),
    index(QQ),
    index(inforank),
    index(infotype),
    index(infoperson)
)engine = myisam, charset=utf8mb4;

create table dm_role(
    id int unsigned primary key auto_increment comment '角色ID',
    name char(10) not null comment '角色名称',
    add_role boolean default false comment '增加角色',
    del_role boolean default false comment '删除角色',
    mod_role boolean default false comment '更改角色',
    cat_logs boolean default true comment '查看日志',
    del_logs boolean default false comment '删除日志',
    add_site boolean default true comment '增加网站',
    del_site boolean default false comment '删除网站',
    mod_site boolean default false comment '更改网站',
    add_user boolean default false comment '增加用户',
    del_user boolean default false comment '删除用户',
    mod_user boolean default false comment '更改用户',
    add_sale boolean default true comment '增加销售人员',
    del_sale boolean default true comment '删除销售人员',
    mod_sale boolean default true comment '更改销售人员',
    add_info boolean default true comment '增加客户信息',
    del_info boolean default false comment '删除客户信息',
    cat_info_table varchar(1024) default 'a:0:{}' comment '可以查看的客户信息表',
    mod_info_table varchar(1024) default 'a:0:{}' comment '可以更改的客户信息表',
    index(name)
)engine = myisam, charset=utf8mb4;


create table dm_strategy(
    id int unsigned primary key auto_increment comment '分配策略ID',
    name char(10) not null comment '分配策略名称'

)engine = myisam, charset=utf8mb4;


create table dm_salegroup(
    gid int unsigned primary key auto_increment comment '组ID',
    parent int unsigned default 0 comment '父组ID',
    guid int unsigned comment '组长ID',
    gname varchar(20) not null comment '组名称',
    gdescription varchar(255) comment '组说明',
    index(parent)
)engine = myisam, charset=utf8mb4;


create table dm_saleman(
    id int unsigned primary key auto_increment comment 'ID',
    gid int unsigned comment '组ID',
    name char(20) comment '姓名', 
    email char(20) comment '邮箱',
    tel char(20) comment '手机',
    role int unsigned not null comment '用户角色|权限',
    strategy int unsigned comment '客户信息分配策略ID',
    index(gid),
    index(name),
    index(email),
    index(tel),
    index(strategy)
)engine = myisam, charset=utf8mb4;


create table dm_user(
    id int unsigned primary key auto_increment comment '用户ID',
    name char(10) not null comment '用户ID',
    password char(50) not null comment '用户密码',
    email char(50) not null comment '用户邮箱',
    role int unsigned not null comment '用户角色|权限',
    lastlogin datetime,
    index(name),
    index(password)
)engine = myisam, charset=utf8mb4;


create table dm_sites(
    id int unsigned primary key auto_increment,
    uid int unsigned not null,
    site char(200) not null,
    index(uid),
    index(site)
)engine = myisam, charset=utf8mb4;


create table dm_logs(
    id bigint unsigned primary key auto_increment,
    operator char(10) not null comment '操作人',
    ip char(15)  comment '操作所在IP',
    time datetime default now() comment '操作时间',
    info varchar(255) comment '操作信息',
    index(operator),
    index(ip),
    index(time)
)engine = myisam, charset=utf8mb4;


create table dm_general_data(
    id int unsigned primary key auto_increment,
    data_name varchar(150) not null,
    data_value text,
    index(data_name)
)engine = myisam, charset=utf8mb4;
