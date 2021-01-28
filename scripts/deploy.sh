#!/usr/bin/env bash
#!/bin/sh
echo "Deploy started at $(date)."
rsync -rtvi --delete --exclude=/bootstrap/cache/* --exclude=/.env --exclude=/.git* --exclude=/.idea --exclude=/node_modules --exclude=/packages --exclude=/public/storage --exclude=/scripts --exclude=/storage --exclude=/storage/app/public/* --exclude=/storage/debugbar/* --exclude=/storage/fonts/* --exclude=/storage/framework/cache/* --exclude=/storage/framework/sessions/* --exclude=/storage/framework/testing/* --exclude=/storage/framework/views/* --exclude=/storage/logs/* --exclude=/storage/medialibrary/temp/* --exclude=/storage/oauth* --exclude=/vendor/bin/* --exclude=*.log . $1@$2:$3/$4/
ssh $1@$2 cd "$3/$4/ && composer dump-autoload && php artisan cache:clear && php artisan view:clear && php artisan route:clear && php artisan storage:link && chmod 664 bootstrap/cache/*.php && chown -R apache:apache ."
echo "Deploy ended at $(date)."
