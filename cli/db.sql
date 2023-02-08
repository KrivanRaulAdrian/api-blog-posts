CREATE DATABASE IF NOT EXISTS api_post;

USE api_post;

CREATE TABLE IF NOT EXISTS posts(
    post_id VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(50) NOT NULL,
    content VARCHAR(255) NOT NULL,
    thumbnail LONGBLOB NOT NULL,
    author VARCHAR(255) NOT NULL,
    posted_at DATETIME NOT NULL,
    PRIMARY KEY(post_id)
);
CREATE TABLE IF NOT EXISTS categories(
    category_id VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    PRIMARY KEY(category_id)
);
CREATE TABLE IF NOT EXISTS posts_categories(
    id_post VARCHAR(255) NOT NULL,
    id_category VARCHAR(255) NOT NULL,
    PRIMARY KEY(id_post, id_category),
    FOREIGN KEY(id_post) REFERENCES posts(post_id),
    FOREIGN KEY(id_category) REFERENCES categories(category_id)
);