CREATE TABLE IF NOT EXISTS `user` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `username` varchar(255) NOT NULL,

  `email` varchar(255) NOT NULL,

  `password` varchar(255) NOT NULL,

  `active` tinyint(1) NOT NULL,

  PRIMARY KEY (`id`),

  UNIQUE KEY `username` (`username`)

)
