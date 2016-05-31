<?php

// This is the database connection configuration.
return array(
    'connectionString' => 'sqlite:' . dirname(__FILE__) . '/../data/testdrive.db',
    // uncomment the following lines to use a MySQL database
    'connectionString' => 'mysql:host=meboo.vn;dbname=zadmin_soyba',
    'emulatePrepare' => true,
    'username' => 'soyba',
    'password' => 'uzuvu8e2e',
    'charset' => 'utf8',
);
