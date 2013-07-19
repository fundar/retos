CREATE TABLE users (
	user_id  serial,
	name	  varchar(255),
	email	  varchar(255),
	pwd		  varchar(50),
	id_user   varchar(255),
	image_url varchar(255),
	url 	  varchar(255),
	admin     boolean default false, 	  
	type	  varchar(50) default 'normal',
	PRIMARY KEY(user_id)
);

CREATE TABLE posts (
	post_id     serial,
	user_id		integer,
	category_id integer,
	title	    varchar(255),
	slug	    varchar(255),
	abstract    text,
	descr	  	text,
	image_url 	varchar(150),
	votes 	  	integer default 0,
	status    	boolean default true,
	PRIMARY KEY(post_id)
);

CREATE TABLE comments (
	comment_id serial,
	post_id	   integer,
	user_id	   integer,
	comment	   text,
	votes 	   integer default 0,
	status     boolean default false,
	PRIMARY KEY(comment_id)
);

CREATE TABLE categories (
	category_id serial,
	name		varchar(255),
	status      boolean default true,
	PRIMARY KEY(category_id)
);
