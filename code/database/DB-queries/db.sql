SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS categories;
CREATE TABLE IF NOT EXISTS categories (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255),
    `slug` varchar(255),
    category_id INT UNSIGNED,

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    deleted_at TIMESTAMP NULL DEFAULT NULL,

    UNIQUE KEY `categories_slug_uniq` (`slug`),
    INDEX category_id_indx (category_id),
    CONSTRAINT category_category_id_fk FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE RESTRICT
);

DROP TABLE IF EXISTS tags;
CREATE TABLE IF NOT EXISTS tags (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(100) unique,

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL
);

DROP TABLE IF EXISTS post_tags;
CREATE TABLE IF NOT EXISTS tags (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    post_id INT UNSIGNED,
    tag_id INT UNSIGNED,

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,

    INDEX posttag_tag_indx (tag_id),
    INDEX posttag_post_indx (post_id),

    CONSTRAINT posttag_tag_fk FOREIGN KEY (tag_id) REFERENCES tags(id),
    CONSTRAINT posttag_post_fk FOREIGN KEY (post_id) REFERENCES posts(id)
);


DROP TABLE IF EXISTS posts;
CREATE TABLE IF NOT EXISTS posts (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(500),
    body TEXT,
    author_id BIGINT UNSIGNED,
    category_id INT UNSIGNED,

    publish_at TIMESTAMP NULL DEFAULT NULL,    -- schedule publish datetime
    published_at TIMESTAMP NULL DEFAULT NULL,  -- post publish datetime
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL,

    UNIQUE KEY posts_title_unique (title),
    INDEX post_user_indx (author_id),
    INDEX post_category_indx (category_id),

    CONSTRAINT post_userid_fk FOREIGN KEY (author_id) REFERENCES users(id),
    CONSTRAINT post_categoryid_fk FOREIGN KEY (category_id) REFERENCES categories(id)
);


DROP TABLE IF EXISTS comments;
CREATE TABLE IF NOT EXISTS comments (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    body TEXT,
    user_id BIGINT UNSIGNED,
    post_id INT UNSIGNED NOT NULL,
    cofirmed ENUM('0', '1') DEFAULT '0',
    comment_id BIGINT UNSIGNED,

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    deleted_at TIMESTAMP NULL DEFAULT NULL,

    INDEX comment_user_indx (user_id),
    INDEX comment_post_indx (post_id),

    CONSTRAINT comment_user_fk FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT comment_post_fk FOREIGN KEY (post_id) REFERENCES posts(id)
);

DROP TABLE IF EXISTS likes;
CREATE TABLE IF NOT EXISTS likes (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED,
    post_id INT UNSIGNED,

    INDEX like_user_indx (user_id),
    INDEX like_post_indx (post_id),

    CONSTRAINT like_user_fk FOREIGN KEY (user_id) REFERENCES users(id),
    CONSTRAINT like_post_fk FOREIGN KEY (post_id) REFERENCES posts(id)
);


DROP TABLE IF EXISTS media;
CREATE TABLE IF NOT EXISTS media (
    id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    post_id INT UNSIGNED,
    type enum('image', 'video', 'audio'),

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,

    INDEX media_post_indx (post_id),
    CONSTRAINT media_post_fk FOREIGN KEY (post_id) REFERENCES posts(id)
);


DROP TABLE IF EXISTS saves;
CREATE TABLE IF NOT EXISTS saves (    -- saved posts (each user can save each post in his/her profile for later read)
    id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    items TEXT,  -- all post_ids which are stored as a json array ---> like [{post_id:1, category_id:2, directory_name:'some name for soldering the posts. something like instagram'}, {}, {}]
    user_id BIGINT UNSIGNED,

    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,

    INDEX saves_post_indx (post_id),
    INDEX saves_user_indx (user_id),

    CONSTRAINT saves_post_fk FOREIGN KEY (post_id) REFERENCES posts(id),
    CONSTRAINT saves_user_fk FOREIGN KEY (user_id) REFERENCES users(id)
);




