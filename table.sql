DROP TABLE IF EXISTS articles;
CREATE TABLE articles
(
  id                   smallint unsigned NOT NULL auto_increment,
  publicationDate      date NOT NULL,                              # When the article was published
  post_title           varchar(255) NOT NULL,                      # Full title of the article
  image_upload         varchar(255) NOT NULL,                          # The uploaded image of the article
  category             varchar(255) NOT NULL,                      # category of the article
  tags                 varchar(255) NOT NULL,                      # tags of the article
  post_content         mediumtext NOT NULL,                       # The HTML content of the article

  PRIMARY KEY     (id)
);

CREATE TABLE admin_users
(
  userid              smallint unsigned NOT NULL auto_increment, 
  username            varchar(255) NOT NULL,                      
  password            varchar(255) NOT NULL,                  


  PRIMARY KEY     (userid)
);

INSERT INTO admin_users (username, password) VALUES( 'admin','admin');
   
CREATE TABLE comments
(
  id              smallint unsigned NOT NULL auto_increment, 
  name            varchar(255) NOT NULL,                      
  email           varchar(255) NOT NULL,
  comment         mediumtext NOT NULL,  
  publicationDate      date NOT NULL,                             


  PRIMARY KEY     (id)
);
