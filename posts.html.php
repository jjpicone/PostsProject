

<html xml:lang="en" lang="en">  

  <head>  

    <title>Table of Posts</title>  

    <meta http-equiv="content-type"  

        content="text/html; charset=utf-8"/>  

  </head>  

  <body>
    
    <p><a href="?refreshpost">Refresh Post Table</a></p>

    <p>Here are all the posts:</p>  

    <?php
    $output = "<table border = '2'>";
    foreach($data as $key => $var) {
        if($key===0) {
            $output .= '<tr>';
            foreach($var as $col => $val) {
                $output .= "<td>" . '<b>' . $col . '</b>' . '</td>';
                if ($col == 'post') {
                    $output .= "<td>" . '<b>delete</b>' . '</td>';
                }
            }
            $output .= '</tr>';

            foreach($var as $col => $val) {
                if ($col == 'id') {
                    $output .= '<td>' . '<form action="?deletepost" method="post">';
                    $output .= '<input type="hidden" name="postid" value="' . $val . '"/>';
                    $output .= '<input type="submit" value="Delete" /></form></td>';    
                }
                $output .= '<td>' . $val . '</td>';
            }
            $output .= '</tr>';
        }
        else {
            foreach($var as $col => $val) {
                if ($col == 'id') {
                    $output .= '<td>' . '<form action="?deletepost" method="post">';
                    $output .= '<input type="hidden" name="postid" value="' . $val . '"/>';
                    $output .= '<input type="submit" value="Delete" /></form></td>';    
                }
                $output .= '<td>' . $val . '</td>';}
                $output .= '</tr>';
        }
    }
    $output .= '</table>';
    echo $output;
    ?>

  </body>  

</html>
