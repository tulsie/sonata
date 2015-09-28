Tulsie site
============

A Symfony project created on July 6, 2015, 7:50 pm.
# sonata




## Installation
To install this app do the following steps:


```bash
git clone https://github.com/tulsie/sonata.git
```


Edit app/config/parameters to match your db settings

```bash
./tuslie_start.bash
```
cd into /project-name/web and type bower install ../vendor/sonata-project/admin-bundle/bower.json
then in the same directory type bower install  ../vendor/sonata-project/core-bundle/bower.json

## Menu configuration
The footer en main navigation is configured fromout
src/Tulsie/Bundle/PageBundle/Menu/Builder.php

## Template configuration
Templates are configured in "app/config/sonata/page.yml"
the two templates used are
1. tulsie home file: src/Tulsie/Bundle/PageBundle/Resources/views/tulsie_home.html.twig
2. tulsie default file: src/Tulsie/Bundle/PageBundle/Resources/views/tulsie_layout.html.twig


## Google Tag Manager
The google tag manager include can be found in:
src/Tulsie/Bundle/PageBundle/Resources/views/gtm.html.twig


## Contact form
The contact form is configured in app/config/mremi/mremi_contact.yml
The bundle is used can be found in: src/Rsh/Bundle/ContactBundle which is an extend of MremiBundle

## Authentication
The fixtures use user:admin password:admin
To change this go to admin and change the credentials
