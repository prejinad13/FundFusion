@echo off
REM ============================================================
REM  FundFusion - Windows storage link setup
REM  Makes public\storage point at storage\app\public so files
REM  uploaded to the "public" disk are reachable at /storage/...
REM
REM  Run once after cloning, then again only if the link is lost.
REM  Double-click it, or run from cmd:  link-storage.bat
REM ============================================================
setlocal EnableExtensions

REM Always operate from the project root (this script's folder)
cd /d "%~dp0"

set "LINK=%~dp0public\storage"
set "TARGET=%~dp0storage\app\public"

echo.
echo === FundFusion: link public\storage =^> storage\app\public ===
echo.

REM --- Already linked? Nothing to do. ---
if exist "%LINK%" (
    echo [OK] "public\storage" already exists. Nothing to do.
    goto :verify
)

REM --- Make sure the target folder exists before linking. ---
if not exist "%TARGET%" (
    echo [..] Creating target "storage\app\public"
    mkdir "%TARGET%"
)

REM --- 1) Idiomatic Laravel way (needs Admin or Developer Mode). ---
where php >nul 2>&1
if %ERRORLEVEL%==0 (
    echo [..] Trying: php artisan storage:link
    php artisan storage:link
    if exist "%LINK%" (
        echo [OK] Linked via "php artisan storage:link".
        goto :verify
    )
    echo [!!] artisan could not create a symlink ^(needs Admin / Developer Mode^).
) else (
    echo [!!] "php" not found on PATH - skipping artisan, using junction.
)

REM --- 2) Fallback: directory junction. No admin / Dev Mode required. ---
echo [..] Falling back to a directory junction ^(mklink /J^).
mklink /J "%LINK%" "%TARGET%"
if exist "%LINK%" (
    echo [OK] Created junction "public\storage" =^> "storage\app\public".
    goto :verify
)

echo.
echo [ERROR] Could not create the link by any method.
echo         Fixes: run this script as Administrator, OR enable
echo         Windows Developer Mode ^(Settings ^> Privacy ^& security ^>
echo         For developers^), then run it again.
echo.
exit /b 1

:verify
echo.
if exist "%LINK%" (
    echo [DONE] Uploads now serve at  ^<APP_URL^>/storage/...  ^(e.g. http://127.0.0.1:8000/storage/...^)
    exit /b 0
) else (
    echo [ERROR] "public\storage" still missing. See messages above.
    exit /b 1
)