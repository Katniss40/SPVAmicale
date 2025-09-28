<?php
$conn = new mysqli("mysql-pompiers-leon.alwaysdata.net", "408942", "@Admin-2025@", "pompiers-leon_admin");

                if ($conn->connect_error) {
                    die("Échec de la connexion : " . $conn->connect_error);
                }

?>