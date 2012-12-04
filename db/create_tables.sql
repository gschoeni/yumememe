CREATE TABLE IF NOT EXISTS users (
	id int(11) NOT NULL AUTO_INCREMENT,
	first_name varchar(255) NOT NULL,
	last_name varchar(255) NOT NULL,
	email varchar(255) NOT NULL,
	hased_password varchar(255) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS likes (
	id int(11) NOT NULL AUTO_INCREMENT,
	user_id int(11) NOT NULL,
	meme_id int(11) NOT NULL,
	timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS followers (
	id int(11) NOT NULL AUTO_INCREMENT,
	user_id int(11) NOT NULL,
	follower_id int(11) NOT NULL,
	timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS memes (
	id int(11) NOT NULL AUTO_INCREMENT,
	title varchar(255) NOT NULL,
	user_id int(11) NOT NULL,
	timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS comments (
	id int(11) NOT NULL AUTO_INCREMENT,
	comment varchar(255) NOT NULL,
	meme_id int(11) NOT NULL,
	user_id int(11) NOT NULL,
	timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id)
);