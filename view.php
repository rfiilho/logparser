<?php
require_once("parser.php");
$arq_log = 'access.log';
$apache_log_parser = new apache_log_parser();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Apache | Logs de Acesso</title>
  </head>
  <body>

  <table class="table table-striped" style="white-space:nowrap;">
  <thead>
    <tr>
      <th scope="col">IP</th>
      <th scope="col">Data</th>
      <th scope="col">Hora</th>
      <th scope="col">Método</th>
      <th scope="col">Status</th>
      <th scope="col">Agent</th>
      <th scope="col">Path</th>
    </tr>
  </thead>
  <tbody>
  <?php
    if ($apache_log_parser->open_log_file($arq_log)){
        while ($line = $apache_log_parser->get_line()){
        
            $parsed_line = $apache_log_parser->format_line($line);
            $ip = $parsed_line['ip'];
            $identity = $parsed_line['identity'];
            $log_user = $parsed_line['user'];
            $log_date = $parsed_line['date'];
            $log_time = $parsed_line['time'];
            $timezone = $parsed_line['timezone'];
            $method = $parsed_line['method'];
            $path = $parsed_line['path'];
            $protocol = $parsed_line['protocol'];
            $status = $parsed_line['status'];
            $log_bytes = $parsed_line['bytes'];
            $referer = $parsed_line['referer'];
            $agent = $parsed_line['agent'];
            $clean_line = $line;
          
          
            echo "<tr>
                <td>$ip</td>
                <td>$log_date</td>
                <td>$log_time</td>
                <td>$method</td>
                <td>$status</td>
                <td>$agent</td>
                <td>$path</td>
            </tr>";
          
        }
                      
      }
  ?>
  </tbody>
</table>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>

<?php
$apache_log_parser->close_log_file();
?>