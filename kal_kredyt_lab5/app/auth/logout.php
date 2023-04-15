<?php
session_start();
session_destroy();
header('Location: ' . $config->action_url . 'login');
