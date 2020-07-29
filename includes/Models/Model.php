<?php

/**
 * Created by PhpStorm.
 * User: Пётр
 * Date: 29.03.2019
 * Time: 15:51
 */
abstract class Model
{
    protected $connection;
    protected $table;
    private static $_db;
    private static $_table;
    protected $types;

    public function __construct()
    {
        $this->connection = DI::get('db');
        self::$_db = $this->connection;
        $modelName = get_called_class();
        if(!isset($this->table) or empty($this->table)){

            $tableName = strtolower($modelName.'s');
        }else{
            $tableName = $this->table;
        }
        $this->table = $tableName;
        self::$_table = $tableName;
        self::checkTable($tableName);

    }

    private static function checkTable($tableName)
    {
    	$data = self::$_db->table($tableName)->get();
    	if(empty((array)$data)){
    		$query = "CREATE TABLE IF NOT EXISTS  `".$tableName."`(
    		`id` int(11) NOT NULL,
			`updated_at` int(11) NOT NULL,
			`created_at` int(11) NOT NULL
    	)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

		ALTER TABLE `".$tableName."`
  			ADD PRIMARY KEY (`id`);
  		ALTER TABLE `".$tableName."`
  			MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
  		COMMIT;
    	";
		self::$_db->query($query, [$tableName], true);
    	}
    }

    public function type($col, $type)
    {
    	$this->types[$col]['type'] = $type;
    }

    public function unique($col)
    {
    	$this->types[$col]['unique'] = true;
    }

    private function checkColumn($col)
    {
    	$query = "SHOW COLUMNS FROM `".self::$_table."` LIKE '".self::$_table."'";
    	$answer = self::$_db->query($query, [$col], true);

    	if(empty($answer)){
    		
    		

    		$query = "ALTER TABLE `".self::$_table."` ADD  `".$col."` ".$this->types[$col]['type']." AFTER `id` ";

    		$answer = self::$_db->query($query, [$col], true);
    		$is_unique = $this->types[$col]['unique'] ?? false;
    		if($is_unique) {
    			$query = "ALTER TABLE `".self::$_table."` ADD  UNIQUE KEY `".$col."` (`".$col."`)";
    			$answer = self::$_db->query($query, [$col], true);
    		}

    	}
    }

    private function checkColumns($params)
    {
    	$i = 0;
    	foreach ($params as $key => $value) {
    		$array[$i] = $key;
    		//$this->checkColumn($key);
    		$i++;
    	}

    	krsort($array);

    	foreach ($array as $key => $value) {
    		$this->checkColumn($value);
    	}
    }


    public static function all()
    {
        $table = self::$_table;
        $data = self::$_db->table($table)->get();
        $objects = [];
        $model = get_called_class();

        foreach ($data as $object => $value){
            $objects[$object] = new $model();

            foreach ($value as $key => $val){
                $objects[$object]->$key = $val;
            }

        }

        return $objects;
    }

    public function save()
    {
        $params = get_object_vars($this);
        unset($params['connection']);
        unset($params['table']);
        unset($params['types']);
        $this->checkColumns($params);
        $timestamp = time();
        $params['updated_at'] = $timestamp;

        if(!isset($this->id)){
            $params['created_at'] = $timestamp;
            $result = self::$_db->insert(self::$_table, $params);
        }else{
            $result = self::$_db->update(self::$_table, $params)->where($this->id)->exec();
        }

        return $result;
    }

    public static function find($key)
    {
        $model = get_called_class();

        $data = self::$_db->table(self::$_table)->where($key)->get();
        $model = new $model();
        if(empty(get_object_vars($data))){
            return $model;
        }
        $data = $data[0];
        $data = get_object_vars($data);

        foreach ($data as $key=>$val){
            $model->$key = $val;
        }
        return $model;
    }





}