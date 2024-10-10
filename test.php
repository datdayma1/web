<?php
// Thông tin kết nối
$serverName = "thi.database.windows.net"; // Tên server hoặc IP server
$connectionOptions = array(
    "Database" => "sinhvien", // Tên cơ sở dữ liệu
    "Uid" => "thi",           // Tên đăng nhập
    "PWD" => "@A123456"            // Mật khẩu
);

// Kết nối đến SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Kiểm tra kết nối
if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Câu lệnh SQL để lấy dữ liệu từ bảng SinhVien
$sql = "SELECT * FROM tbl_lop";

// Chuẩn bị và thực hiện truy vấn
$stmt = sqlsrv_query($conn, $sql);

// Kiểm tra xem truy vấn có thành công không
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Hiển thị dữ liệu lấy được
echo "<table border='1'>";
echo "<tr><th>Ma Lop</th><th>Tên Lop</th></tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['ma_lop'] . "</td>";
    echo "<td>" . $row['ten_lop'] . "</td>";
    echo "</tr>";
}

echo "</table>";

// Giải phóng tài nguyên và đóng kết nối
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
