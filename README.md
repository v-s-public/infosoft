1. Clone repository.
2. Run `composer install`.
3. Rename `.env.example` file to `.env`. Setup database connection in the `.env` file.
4. Run `php artisan migrate`.
5. Add new CRON job `* * * * * cd /path_to_your_app && php artisan schedule:run >> /dev/null 2>&1`
