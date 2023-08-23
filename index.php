<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="https://www.nywhash.com/apps/main/public/assets/img/extras/header-logo.png">
    <title>Server Status</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
	 <link rel="stylesheet" type="text/css" href="/assets/css/white.css">
	<!-- <link rel="stylesheet" type="text/css" href="/assets/css/dark.css"> -->
</head>
<body>
    <div class="container">
        <h1>Server Status</h1>
        <ul>
            <?php
            $servers = array(
                array('protocol' => 'Server A', 'host' => '127.0.0.1', 'port' => 80),
                array('protocol' => 'Server B', 'host' => '127.0.0.1', 'port' => 81),
                array('protocol' => 'Server C', 'host' => '127.0.0.1', 'port' => 82),
                array('protocol' => 'Server D', 'host' => '127.0.0.1', 'port' => 83),
                array('protocol' => 'Server E', 'host' => '127.0.0.1', 'port' => 84)
            );

            foreach ($servers as $server) {
                $status = checkServerStatus($server['host'], $server['port']);
                $statusText = $status ? 'UP' : 'DOWN';
                $statusClass = $status ? 'up' : 'down';
                $iconClass = $status ? 'fas fa-check-circle' : 'fas fa-times-circle';

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
    </div>
</body>
</html>
