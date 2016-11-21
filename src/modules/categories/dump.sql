# Categories for all modules
CREATE TABLE IF NOT EXISTS categories
(
  id BIGINT(20) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
  rootId BIGINT(20) unsigned,
  parentId BIGINT(20) unsigned,
  name VARCHAR(255) NOT NULL,
  alias VARCHAR(255) NOT NULL,
  created TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
  updated TIMESTAMP NOT NULL,
  CONSTRAINT categories_categories_id_fk FOREIGN KEY (parentId) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE
);
CREATE UNIQUE INDEX UNIQUE_alias ON categories (parentId, alias);

LOCK TABLES `acl_privileges` WRITE;
/*!40000 ALTER TABLE `acl_privileges` DISABLE KEYS */;

REPLACE INTO `acl_privileges` (`roleId`, `module`, `privilege`)
VALUES
  (2,'categories','Management');
