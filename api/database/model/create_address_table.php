<?php

return <<<"SQL"
    CREATE TABLE IF NOT EXISTS `addresses` (
        `id` varchar (36), 
        `street` varchar (255) NOT NULL, 
        `city` varchar(255)  NOT NULL, 
        PRIMARY KEY (`id`)
    );
SQL;
