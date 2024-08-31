<script>
    $(document).ready(function() {
        $('#filter').keyup(function() {
            var txt = $(this).val().toLowerCase().trim();

            $("#newtable,table,tr").each(function(index) {

                if (!index) return;
                $(this).find("#uname").each(function() {
                    var id = $(this).text().toLowerCase().trim();
                    var not_found = (id.indexOf(txt) == -1);
                    $(this).closest('tr').toggle(!not_found);
                    return not_found;
                });
            });

        });
    });
</script>
<?php

require_once "../includes/dbh.inc.php";
require_once "../includes/functions.inc.php";

echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
echo '<br />Search for Student by username<div class="form-outline">
<input type="search" id="filter" class="form-control" placeholder="Type Student UserName" style="background-color: pink;"
aria-label="Search" />
</div><br />';

$sql = "SELECT * FROM atten";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo '<table id="newtable" style= "color:white;width:100%">
                          <tr>
                                <th>Picture</th>
                                <th>ID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Account Status</th>
                                <th>Permission</th>
                            </tr>';
    while ($row = mysqli_fetch_array($result)) {
        // $isEnable = $row['accountstatus'] == "enable";
        print('
        <tr>
        <td><img style="width: 50px;height: 50px;" src="includes/userphoto/' . $row['profile_picture'] . '"/></td>
        <td>' . $row['id'] . '</td>
        <td>' . $row['firstName'] . '</td>
        <td>' . $row['lastName'] . '</td>
        <td id="uname">' . $row['userName'] .  '</td>
        <td>' . $row['password'] . '</td>');
        if ($row['accountstatus'] == "enable") {
            echo '<td><button onclick = "togglestatus(this);" class="btn-enabled">ENABLED</button></td>';
        } else {
            echo '<td><button onclick = "togglestatus(this);" class="btn-disabled">DISABLED</button></td>';
        }
        echo ' <td>' . $row['status'] . '</td> </tr>';
    }
    echo '</table>';
} else {
    echo '<li class="noResult list-group-item bg-dark text-white-50"><h5>No results were found</h5></li>';
}

?>
<style>
    .btn-enabled {
        background-color: lightgreen;
    }

    .btn-disabled {
        background-color: lightcoral;
    }
</style>
<script>
    function togglestatus(clickedbutton) {
        var btn = $(clickedbutton);
        var userid = btn.parent().siblings().first().next().text();

        var newstatus = btn.text() == "ENABLED" ? "disable" : "enable";

        $.ajax('enableanddisable.php', {
            type: 'POST',
            data: {
                status: newstatus,
                id: userid
            },
            success: function(data) {
                btn.toggleClass("btn-disabled btn-enabled");
                btn.text(btn.text() == "DISABLED" ? "ENABLED" : "DISABLED");
            },
            error: function(err) {
                alert("System was unable to update record:" + err);
            }
        });

    }
</script>