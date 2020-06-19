<?php
            session_start();

            // remove all session variables
            session_unset();

            // destroy the session
            session_destroy();

            // Redirect user to login page
            header("location: index.php");
            ?>