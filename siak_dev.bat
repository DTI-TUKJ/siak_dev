@echo off
rem Memulai server Apache XAMPP

start /B "C:\xampp_8_1\xampp_start.exe"
timeout /t 5 /nobreak >nul

rem Menjalankan php spark serve di CodeIgniter 4

cd C:\xampp_8_1\htdocs\siak_dev
start /B php spark serve

rem Menunggu beberapa detik untuk memastikan server telah berjalan
timeout /t 5 /nobreak >nul

rem Membuka localhost:8080 di browser

start "" http://localhost:8080/Siak
pause