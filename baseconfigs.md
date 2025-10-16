 # Migrate single migration
 php artisan migrate:fresh --path=/database/migrations/2025_01_25_174149_product.php

# Package for sluggable behaviour
composer require cviebrock/eloquent-sluggable

php artisan make:mail Newpurchase
php artisan vendor:publish --tag=laravel-mail

# HTML sanitization tags
composer require mews/purifier

# To push the current branch and set the remote as upstream, use
git push --set-upstream gradestar main
