<?php



class DB{
    public $db;
    protected $serverName;
    protected $connectionOptions;

    public function __construct(){
        $this->serverName = "thi.database.windows.net";
        
        // Cấu hình thông tin kết nối
        $this->connectionOptions = array(
            "Database" => "sinhvien",     // Tên database
            "UID" => "thi",               // Tên người dùng
            "PWD" => "@A123456",          // Mật khẩu
            "CharacterSet" => "UTF-8"     // Sử dụng mã hóa ký tự UTF-8
        );

        // Kết nối với SQL Server
        $this->db = sqlsrv_connect($this->serverName, $this->connectionOptions);

        // Kiểm tra kết nối
        if($this->db === false){
            die(print_r(sqlsrv_errors(), true)); // Hiển thị lỗi kết nối nếu có
        }
    }

    // Hàm đóng kết nối
    public function closeConnection(){
        sqlsrv_close($this->db);
    }
}

?>
