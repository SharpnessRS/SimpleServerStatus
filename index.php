<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="">
    <title>Server Status</title>
    <style>
        body {
            background-color: #212121;
            color: white;
            text-align: center;
            font-family: Arial, sans-serif;
            padding: 203px;
        }

        h1 {
            margin-top: 40px;
            font-size: 24px;
            letter-spacing: 2px;
        }

        ul {
            list-style: none;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: stretch;
        }

        li {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            background-color: #000;
            padding: 10px;
            border-radius: 5px;
        }

        .server-name {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .status {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }

        .up {
            color: #5cb85c;
        }

        .down {
            color: #d9534f;
        }

        .icon {
            font-size: 24px;
            margin-left: 10px;
        }

        .icon.up::before {
            content: '\2714';
        }

        .icon.down::before {
            content: '\2716';
        }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
