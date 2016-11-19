# CHANGELOG

## 0.1.x

### 0.2.0
- Dispatch only published posts
- Added ID getter and setter for Posts
- Added permalink property to prevent multiple db acces
- Fixed preventing Symfony models to assign key values to properties
- Fixed glitch when a property's value is null would throw an exception

### 0.1.4
- Application handles only outside of admin panel
- Improved dispatching (Custom permalinks & custom post types)
- Override WordPress status code to allow user to decide
- Using WordPress default charset

### 0.1.3 (2016-07-18)
- Added model class for media posts
- Added getPermalink method for Posts model
- Registering services on Application construction
- Dispatcher support for post type archives
- Fix TermTaxonomy relationship with Terms
- Updated documentation

### 0.1.2 (2016-07-14)
- Added static routes support
- Routes support default WordPress htaccess configuration

### 0.1.1 (2016-07-11)
- Improved template dispatching
- Improved documentation

### 0.1.0 (2016-06-14)
- Initial alpha testing release
