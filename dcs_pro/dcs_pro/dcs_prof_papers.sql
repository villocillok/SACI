CREATE DATABASE dcs_prof_papers;


CREATE TABLE `authors` (
	author_id INT NOT NULL AUTO_INCREMENT,
	fname varchar(256) NOT NULL,
	lname varchar(256) NOT NULL,
	mname varchar(256) NOT NULL,
	PRIMARY KEY(author_id) 
);

CREATE TABLE `papers` (

	paper_id INT NOT NULL AUTO_INCREMENT,
	author_id INT NOT NULL,
	title varchar(512) NOT NULL,
	classification varchar(512) NOT NULL,
	date_published varchar(512) NOT NULL,
	isbn varchar(512) NOT NULL,
	issn varchar(512) NOT NULL,
	inter varchar(512) NOT NULL,
	doi varchar(512) NOT NULL,
	venue_publication varchar(1024) NOT NULL,
	FOREIGN KEY (author_id) REFERENCES authors(author_id),
	PRIMARY KEY (paper_id)
);

