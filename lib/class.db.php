<?php
/*
 * Domai CIM
 * 哆麦 客户信息管理系统
 * Copyright @2018 Hito
 *
 * 此文件是系统的数据库操作API
 * 目前只支持mysql，使用mysqli扩展操作
 *
 * 注意: 为了保证系统实现简洁方便
 * 系统所有的SQL操作中的表名称前缀都为'##_'
 * 系统在进行查询的时候会把'##_'替换成配置文件中制定的table_prefix
 *
 */
class DM_DB {
    private $dbuser;
    private $dbpassword;
    private $dbname;
    private $dbhost;
    private $connect;
    private $show_errors=false;
    private $tables=array();
    public $insert_id;


	public function __construct($host,$user,$password,$name){
        $this->dbuser=$user;
        $this->dbpassword=$password;
        $this->dbname=$name;
        $this->dbhost=$host;
        if(DEBUG&&DEBUG===true){
            $this->show_errors=true;
        }
		$this->connect=mysqli_connect($host,$user,$password);
		if($this->connect){
			mysqli_select_db($this->connect,$name);
        }
	}

	//执行不需要结果的sql:insert update等等
	public function query($queryString){
        global $table_prefix;
        if($queryString==null) return;
        $queryString=preg_replace('/([\s|\(|\"|\'|,]*)##_([^\s\.]*)([\s|\.]*)/i','\\1'.$table_prefix.'\\2\\3',$queryString);
		$result = mysqli_query($this->connect,$queryString);
        if(preg_match('/^\s*(insert|replace|update)\s/i',$queryString)){
            $this->insert_id=mysqli_insert_id($this->connect);
        }
        if($this->show_errors){
            echo mysqli_error($this->connect);
        }
        return $result;
	}

    //获取插入之后的主键id
    public function get_insert_id(){
        return $this->insert_id;
    }

	//获取一个变量
	public function get_var($queryString){
		$re=$this->query($queryString);
		$res=@mysqli_fetch_array($re,MYSQLI_NUM);
        return $res[0];
	}
    //获取一行记录
    public function get_row($queryString,$type=MYSQLI_ASSOC){
		$re=$this->query($queryString);
        return @mysqli_fetch_array($re,$type);
    }

	//获取多行记录，返回二维数组
	public function get_results($queryString,$type=MYSQLI_ASSOC){
		$re=$this->query($queryString);
		$res=array();
		while($a=@mysqli_fetch_assoc($re)){
			$res[]=$a;
		}
		if(empty($res)){
			return;
		}else{
			return $res;
		}
	}

    public function db_version(){
        $server_info = mysqli_get_server_info( $this->connect);
        return preg_replace('/[^0-9.].*/','',$server_info);
    }

    //自动关闭mysqli
	public function __destruct(){
		if($this->connect){
			mysqli_close($this->connect);
		}
	}
}
