<?php
/*
 * Domai CIM
 * 哆麦 客户信息管理系统
 * Copyright @2018 Hito
 *
 * 客户信息对象
 */
class DM_INFO{
    public $ID;
    public $infoid;
    public $infocontent;
    public $infoattachment;
    public $inforank;
    public $infotype;
    public $infoperson;
    public $inforurl;

    public $name;
    public $email;
    public $tel;
    public $whatsapp;
    public $wechat;
    public $QQ;
    public $website;
    public $other;
    public $product;
    public $county;
    public $address;
    public $creationtime;
    public $modifiedtime;

    public $saleman;

    /*
     * 通过INFOID或者信息数组获取对象
     * @param INT|ARRAY
     *
     */
    public static function get_instance($args){
        global $dmdb;
        $instance = new self();
        if(is_int($args)){
            $arr = $dmdb->get_row('select * from ##_info where ID = '.$args);
        }elseif(is_array($args)){
            $arr = $args;
        }
        if(!isset($arr)) return NULL;

        /*
         * 以后要增加验证
         */

        foreach($arr as $name=>$value){
            if(isset($this->$name))
                $this->$name = $value;
        }
        return $instance;
    }

    /*
     * 获取信息ID
     */
    public function get_infoid(){
        global $dmdb;
        if($this->infoid) return $this->infoid;
        $count = $dmdb->get_var('select cound(ID) from ##_info to_days(now()) = to_days(creationtime)');
        $cuont++;
        $this->infoid = date("Ymd").str_pad($count,3,'0',STR_PAD_LEFT);
        return $this->infoid;
    }

    public function get_nextinfo(){
        global $dmdb;
        $next = $dmdb->get_var('select * from ##_info where ID > '.$this->ID.' limit 0,1');
        return self::get_instance($next);
    }

    public function get_pervinfo(){
        global $dmdb;
        $prev = $dmdb->get_var('select * from ##_info where ID < '.$this->ID.' limit 0,1');
        return self::get_instance($next);
    }

    public function save(){
        global $dmdb;
        $this->get_infoid();
        $result = $dmdb->query("insert into ##_info(saleman,infoid,infocontent,infoattachment,name,email,tel,whatsapp,wechat,QQ,website,other,product,country,address,creationtime,modifiedtime,inforank,infotype,infoperson,infourl) values (\"$this->saleman\",\"$this->infoid\",\"$this->infocontent\",\"$this->infoattachment\",\"$this->name\",\"$this->email\",\"$this->tel\",\"$this->whatsapp\",\"$this->wechat\",\"$this->QQ\",\"$this->website\",\"$this->other\",\"$this->product\",\"$this->country\",\"$this->address\",\"$this->creationtime\",\"$this->modifiedtime\",\"$this->inforank\",\"$this->infotype\",\"$this->infoperson\",\"$this->infourl\")"); 
        return $result;
    }

    public function update(){
        global $dmdb; 
        $result = $dmdb->query("update ##_info set saleman = $this->saleman, infocontent=\"$infocontent\", infoattachment=\"$this->infoattachment\", name= \"$this->name\", email=\"$this->email\", tel=\"$this->tel\", whatsapp=\"$this->whatsapp\", wechat=\"$this->wechat\", QQ=\"$this->QQ\",website=\"$this->website\",other=\"$other\",product=\"$this->product\",country=\"$this->country\", address=\"$this->address\", creationtime=\"$this->creationtime\",modifiedtime=\"$this->modifiedtime\",inforank=\"$this->inforank\",infotype=\"$this->infotype\",infoperson=\"$this->infoperson\",infourl=\"$this->infourl\"");
        return $result;
    }

    public function __construct(){}
}
