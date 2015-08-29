#!/usr/bin/env bash
app/console doctrine:fixtures:load --fixtures=src/Tulsie/Bundle/PageBundle/DataFixtures/ORM
app/console sonata:page:update-core-routes  --site=all
app/console sonata:page:create-snapshots --site=all
