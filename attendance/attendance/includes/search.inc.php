<?php
require_once "dbh.inc.php";
require_once "functions.inc.php";
// if (isset($_POST['searchsub'])) {
//     $result = mysqli_real_escape_string($conn, $_POST['searchbar']);
//     $sql = "SELECT * FROM atten `firstName` LIKE '%$result%' OR `lastName` LIKE '%$result%' OR `userName` LIKE '%$result%' ";
//     $result = mysqli_query($conn, $sql);
//     $queryResult = mysqli_num_rows($result);

//     if ($queryResult > 0) {
//         while ($row = mysqli_fetch_array($result)) {
//             print('
//                                     <tr>
//  <td><img style="width: 50px;height: 50px;" src="includes/userphoto/' . $row['profile_picture'] . '"/></td>
//         <td>' . $row['firstName'] . '</td>
//         <td>' . $row['lastName'] . '</td>
//         <td>' . $row['userName'] .  '</td>
// ');
//             echo '<td><button onclick = "">A D D </button></td>';
//             echo '  </tr>';
//         }
//         echo '</table>';
//     } else {
//         echo 'There are no result matching your search!';
//     }
// }
