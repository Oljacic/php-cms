<?php

function restartSes($username, $password, $first, $last) {
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['firstname'] = $password;
        $_SESSION['lastname'] = $first;
        $_SESSION['role'] = $last;
}