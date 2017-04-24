<!--  
* ## Copyleft by Niklas Linz ##
* This is a detailed explanation
* EnigmarCommunityFramework is licensed under the
* GNU Lesser General Public License v3.0

* Permissions of this copyleft license are conditioned on making available complete 
* source code of licensed works and modifications under the same license or the GNU 
* GPLv3. Copyright and license notices must be preserved. Contributors provide an 
* express grant of patent rights. However, a larger work using the licensed work through 
* interfaces provided by the licensed work may be distributed under different terms and 
* without source code for the larger work.
 -->
<?php
// cpu stat
$prevVal = shell_exec ( "cat /proc/stat" );
$prevArr = explode ( ' ', trim ( $prevVal ) );
$prevTotal = $prevArr [2] + $prevArr [3] + $prevArr [4] + $prevArr [5];
$prevIdle = $prevArr [5];
usleep ( 0.15 * 1000000 );
$val = shell_exec ( "cat /proc/stat" );
$arr = explode ( ' ', trim ( $val ) );
$total = $arr [2] + $arr [3] + $arr [4] + $arr [5];
$idle = $arr [5];
$intervalTotal = intval ( $total - $prevTotal );
$stat ['cpu'] = intval ( 100 * (($intervalTotal - ($idle - $prevIdle)) / $intervalTotal) );
$cpu_result = shell_exec ( "cat /proc/cpuinfo | grep model\ name" );
$stat ['cpu_model'] = strstr ( $cpu_result, "\n", true );
$stat ['cpu_model'] = str_replace ( "model name	: ", "", $stat ['cpu_model'] );
// memory stat
$stat ['mem_percent'] = round ( shell_exec ( "free | grep Mem | awk '{print $3/$2 * 100.0}'" ), 2 );
$mem_result = shell_exec ( "cat /proc/meminfo | grep MemTotal" );
$stat ['mem_total'] = round ( preg_replace ( "#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result ) / 1024 / 1024, 3 );
$mem_result = shell_exec ( "cat /proc/meminfo | grep MemFree" );
$stat ['mem_free'] = round ( preg_replace ( "#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result ) / 1024 / 1024, 3 );
$stat ['mem_used'] = $stat ['mem_total'] - $stat ['mem_free'];

echo "CPU Model: " . $stat ['cpu_model'] . "<br>";
echo "CPU Usage: " . $stat ['cpu'] . "<br>";
echo "Memory percent: " . $stat ['mem_percent'] . "<br>";
echo "Memory total: " . $stat ['mem_total'] . "<br>";
echo "Memory usage: " . $stat ['mem_used'] . "<br>";
echo "Memory free: " . $stat ['mem_free'] . "<br>";
?>