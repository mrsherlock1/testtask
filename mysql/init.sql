CREATE
DATABASE IF NOT EXISTS reward_test;
CREATE
DATABASE IF NOT EXISTS main_service;

GRANT ALL PRIVILEGES ON reward_test.* TO
'laravel'@'%';
GRANT ALL PRIVILEGES ON main_service.* TO
'laravel'@'%';

-- Apply the privileges
FLUSH
PRIVILEGES;
