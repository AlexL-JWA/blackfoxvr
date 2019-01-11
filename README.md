# HTML\ CSS And WP Themes.

Project blackfoxvr

# HTML \ CSS

To start the project `git clone https://github.com/lovik1468/blackfoxvr.git`

To install a theme and configure demo content

1. Download the WordPress distribution https://wordpress.org/download/
2. Install it on your server
3. Copy the contents of the folder wp_themes to the wp-content folder
4. Import the database

Import the database and change domain SQL query

```
UPDATE wp_options SET option_value = REPLACE(option_value, 'http://translation.alscon-clients.com', 'https://new-domain.com') WHERE option_name = 'home' OR option_name = 'siteurl';
UPDATE wp_posts SET post_content = REPLACE (post_content, 'http://translation.alscon-clients.com', 'https://new-domain.com');
UPDATE wp_postmeta SET meta_value = REPLACE (meta_value, 'http://translation.alscon-clients.com','https://new-domain.com');
```
