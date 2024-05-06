Prerequisites:

   1.Install MSSQL drivers for PHP. You can find them [here](https://learn.microsoft.com/en-us/sql/connect/php/download-drivers-php-sql-server?view=sql-server-ver16).
   2.SQL Server Development Edition.
   3.SQL Server Management Studio.
   4.Download PHP (thread safe) from [here](https://windows.php.net/download#php-8.3).
   5.VS Code with the PHP Server extension.
   
Step 1:
Download PHP (thread safe).

Step 2:
Download drivers corresponding to your PHP version.

Step 3:
Move the downloaded drivers, named php_sqlrv_[x64/x86]ts.dll and php_pdp_sqlrv[x64/x86]_ts.dll, to your PHP extension directory (your_drive:\php\ext).

Step 4:
Open the php.ini file in your PHP folder using a text editor. Search for "extension" and uncomment the lines by adding:

extension=php_sqlsrv_82_ts_x64.dll (replace version and system architecture accordingly)
extension=php_pdo_sqlsrv_82_ts_x64.dll (replace version and system architecture accordingly)

Step 5:
Check if the SQL Server instance is running in Services. If not, start the service.

Step 6:
Open SQL Server Management Studio, select Database Engine, and choose your running SQL Server instance. Copy the server name and paste it into your code where $serverName = "[here]";. Import the provided database file.

Step 7:
Once your connection is set up, install the PHP Server extension in VS Code. Set up the PHP path in System variables. Run the server by right-clicking and selecting "Start the Server".

Step 8:
With everything configured, your system is ready to go.


   
   
   
