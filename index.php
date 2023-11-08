<?php

// AppService名
echo "WEBSITE_SITE_NAME: ";
echo getenv('WEBSITE_SITE_NAME');
echo '<br>';

// プライベートIP
echo "WEBSITE_PRIVATE_IP: ";
echo getenv('WEBSITE_PRIVATE_IP');
echo '<br>';

// 接続元IP
echo "SOURCE_IP: ";
echo getenv('REMOTE_ADDR');
echo '<br>';

// PostgreSQLパスワード
// パスワードが空の場合は処理を中断
if(empty(getenv('POSTGRESQL_PASSWORD'))){
exit;
}
echo "password: ";
echo getenv('POSTGRESQL_PASSWORD');
echo '<br>';

// PostgreSQL接続確認
// 接続文字列
$conn = "host=team-a-prod-psql.postgres.database.azure.com port=5432 dbname=postgres user=teamaprod@team-a-prod-psql sslmode=require password=";
$conn .= getenv('POSTGRESQL_PASSWORD');
echo "PostgreSQL Connection Strings: ";
echo $conn;
echo '<br>';

// DB接続
$link1 = pg_connect($conn);
if (!$link1) {
    print('PostgreSQL Connection Result: Failed<br>');
} else {
    print('PostgreSQL Connection Result: Success<br>');
}

// 切断
$close_flag1 = pg_close($link1);
if ($close_flag1){
print('PostgreSQL Disconnection Result: Success<br>');
}

// SQLServerパスワード
// パスワードが空の場合は処理を中断
if(empty(getenv('SQLSERVER_PASSWORD'))){
exit;
}
echo "SQLServer_Password: ";
echo getenv('SQLSERVER_PASSWORD');
echo '<br>';

// SQLServer接続確認
// 接続文字列
$connectionInfo = array("UID" => "teamaprod", "pwd" => getenv('SQLSERVER_PASSWORD'), "Database" => "team-a-prod-sqldb", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:team-a-prod-sql.database.windows.net,1433";
echo "SQLServer Connection Strings: ";
echo $serverName;
echo implode(" ", $connectionInfo);
echo '<br>';

// DB接続
$link2 = sqlsrv_connect($serverName, $connectionInfo);
if (!$link2) {
print('SQLServer Connection Result: Failed<br>');
} else {
print('SQLServer Connection Result: Success<br>');
}

// 切断
$close_flag2 = sqlsrv_close($link2);
if ($close_flag2){
print('SQLServer Disconnection Result: Success<br>');
}

