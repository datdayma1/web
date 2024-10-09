<?php 
class DB {
    public $db;
    protected $serverName;
    protected $connectionInfo;

    public function __construct() {
        // Thay đổi thông tin kết nối để phù hợp với SQL Server
        $this->serverName = "thi.database.windows.net";  // Thay đổi tên server (có thể là IP address hoặc tên server)
        $this->connectionInfo = array(
            "Database" => "thi",    // Tên database
            "UID" => "thi",                 // Tài khoản SQL Server
            "PWD" => "@A123456",      // Mật khẩu
            "CharacterSet" => "UTF-8"      // Đảm bảo sử dụng UTF-8
        );

        // Kết nối với SQL Server
        $this->db = sqlsrv_connect($this->serverName, $this->connectionInfo);

        // Kiểm tra kết nối
        if($this->db === false) {
            die(print_r(sqlsrv_errors(), true));
        }
    }

    // Bạn có thể tạo các phương thức khác để xử lý truy vấn, đóng kết nối, vv.
    public function query($sql, $params = array()) {
        $stmt = sqlsrv_query($this->db, $sql, $params);
        if($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        return $stmt;
    }

    // Đóng kết nối
    public function close() {
        sqlsrv_close($this->db);
    }
}
