<?php

function isNotNullOrEmpty($str) {
    return isset($str) && !empty($str);
}

function isNullOrEmpty($str) {
    return !isNotNullOrEmpty($str);
}

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}