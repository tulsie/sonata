#!/usr/bin/env bash
composer install
chmod -R 777 app/logs app/cache
app/console doctrine:database:create
app/console doctrine:schema:create
app/console doctrine:fixtures:load --fixtures=src/Tulsie/Bundle/PageBundle/DataFixtures/ORM
app/console sonata:page:create-site
app/console sonata:page:update-core-routes --site=all
app/console sonata:page:create-snapshots --site=all


cd web
bower install ../vendor/sonata-project/admin-bundle/bower.json
bower install  ../vendor/sonata-project/core-bundle/bower.json
