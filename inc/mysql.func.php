<?php
/**
     * connect() 数据库连接函数
     * @param string $host
     * @param string $user
     * @param string $password
     * @param string $database
     * @param string $port
     * @return $link
     */
    function connect($host=DB_HOST, $user=DB_USER, $password=DB_PWD, $database=DB_DATABASE, $port=DB_PORT){
        $link = @mysqli_connect($host, $user, $password, $database, $port);
        if (mysqli_connect_errno()){
            exit(mysqli_connect_error());
        }
        mysqli_set_charset($link, 'utf8');
        return $link;
    }

    /**
     * execute() 执行一条sql语句函数
     * @param resource $link
     * @param string $query
     * @return $result 返回结果集或布尔值
     */
    function execute($link, $sql){
        $result = mysqli_query($link, $sql);
        if (mysqli_errno($link)) {
            exit(mysqli_error($link));
        }
        return $result;
    }

    /**
     * nums() 获取记录数
     * @param resource $link
     * @param string $query
     * @return number
     */
    function nums($link, $sql){
        return mysqli_num_rows(execute($link, $sql));
    }

    /**
     * escape() 数据入库之前进行转义，确保数据能够顺利入库
     * @param resource $link
     * @param string/array $data
     * @return string $data
     */
    function escape($link, $data){
        //判断$data是否为string类型，如果是直接转义返回
        if (is_string($data)) {
            return mysqli_real_escape_string($link, $data);
        }
        //判断$data是否为数组，如果是则继续调用自身直至$data为string类型
        if (is_array($data)) {
            foreach ($data as $key=>$val) {
                $data[$key] = escape($link, $val);
            }
        }
        return $data;
    }

    /**
     * fetch_array() 将结果集转换为关联数组
     * @param resource $result
     * @return array 关联数组
     */
    function fetch_array($result){
        return mysqli_fetch_assoc($result);
    }

?>