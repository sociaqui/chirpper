<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016-03-18
 * Time: 14:47
 */

require_once ("../src/includes.php");

User::Logout();
header ("Location: login.php");