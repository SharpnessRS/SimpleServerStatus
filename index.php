<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="">
    <title>Server Status</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/assets/css/main.css">
</head>
<body>
    <h1>Server Status</h1>

    <ul>
        <?php
        $servers = array(
            array('protocol' => 'Server A', 'host' => '127.0.0.1', 'port' => 10),
            array('protocol' => 'Server B', 'host' => '127.0.0.1', 'port' => 11),
            array('protocol' => 'Server C', 'host' => '127.0.0.1', 'port' => 12),
            array('protocol' => 'Server D', 'host' => '127.0.0.1', 'port' => 13),
            array('protocol' => 'Server E', 'host' => '127.0.0.1', 'port' => 14),
        );

        foreach ($servers as $server) {
            $status = checkServerStatus($server['host'], $server['port']);
            $statusText = $status ? 'UP' : 'DOWN';
            $statusClass = $status ? 'up' : 'down';
            $iconClass = $status ? 'up' : 'down';

            echo '<li>
                    <div class="server-name">' . $server['protocol'] . '</div>
                    <div class="status ' . $statusClass . '">' . $statusText . '<span class="icon ' . $iconClass . '"></span></div>
                </li>';
        }

        function checkServerStatus($host, $port) {
            $timeout = 5;
            $fp = @fsockopen($host, $port, $errno, $errstr, $timeout);

            if ($fp) {
                fclose($fp);
                return true;
            } else {
                return false;
            }
        }
        ?>
    </ul>
</body>
</html>
