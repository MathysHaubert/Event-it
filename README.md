Here's the translation of the README.md in English:

# ISEP-APP-Computing

This project is a web application for the ISEP school. 

## Summary
- [Tools](#tools)
- [How to setup the project](#how-to-setup-the-project)
  - [Install the setup](#install-the-setup)
  - [Composer](#composer)
  - [Clone the repository with Git](#clone-the-repository-with-git)
  - [Install dependencies via Composer](#install-dependencies-via-composer)
  - [PHP server](#php-server)
  - [Finally](#finally)
- [Documentation](#documentation)
    - [Understanding the Project's MVC Architecture](#understanding-the-projects-mvc-architecture)
    - [Understanding the Project's Structure](#understanding-the-projects-structure)
- [PHP Doc](#php-doc)
- [Create your first page!](#create-your-first-page)
  - [Controller PHP](#controller-php)
  - [Routes.yaml](#routesyaml)
  - [Twig Tutoriel](#twig-tutoriel)
  - [Create translations in your twig files!](#create-translations-in-your-twig-files)
- [Deal with Git](#deal-with-git)
- [How to contribute](#how-to-contribute)

> link doesn't work, fuck it.

# 🧰Tools
- Dependency manager: [Composer](https://getcomposer.org/doc/00-intro.md)
- Server: [XAMPP](https://www.apachefriends.org/index.html) (optional)
- Version control: [Git](https://git-scm.com/)
- Design: [Figma](https://www.figma.com/)
- Project management: [Notion](https://www.notion.so/)
- Entity mapping: [Doctrine](https://www.doctrine-project.org)

# How to setup the project

## Install the setup
The install should be simple, if you're on **linux** you can execute the setup.sh:

```
sudo ./setup.sh
```

On windows, you have 2 choices:
- First, you can use [WSL](https://learn.microsoft.com/fr-fr/windows/wsl/install) (with an ubuntu  and return on the linux's setup)
- Install [WAMPP](https://www.infowebmaster.fr/tutoriel/debuter-wamp)  (not difficult but you need to configure it).
## Composer
> Composer is a tool for dependency management in PHP. It allows you to declare the libraries your project depends on and it will manage (install/update) them for you.
> To verify if Composer is installed on the project, type in the CLI:
> ``` composer ```

If Composer is not installed, use your best friend [Google](https://google.com) 😉 .

## Install dependencies via Composer
``` composer install ``` 
will create the `vendor` folder and install the necessary dependencies.
> Be aware, this command must be run in the project folder.

## Location

If you have installed by setup.sh, the project will be in the `/var/www/Event-it` folder. If you have installed by yourself, you can choose the location you want.

## Finally
Open your browser and go to [http://localhost](http://localhost) to see the website.

# 📚Documentation
Now the best part, the documentation. 
## Understanding the Project's MVC Architecture
> MVC stands for Model-View-Controller. It is a software design pattern that divides the related program logic into three interconnected elements. This is done to separate internal representations of information from the ways that information is presented to and accepted from the user. [Check here](https://www.tutorialspoint.com/mvc_framework/mvc_framework_introduction.htm) for more information.

- **M for Model:** This represents the application's data logic. The model communicates with the database and processes data (e.g., retrieve, insert, update, delete). In our case, PHP manages the model.

- **V for View:** The view is responsible for displaying data or the user interface. In your case, Twig is used to create your view templates. Twig allows separating the presentation logic from PHP code by offering a flexible and powerful template system.

- **C for Controller:** The controller manages the application's business logic. It responds to user inputs (usually through a web interface), interacts with the model, and returns a view. In PHP, the controller is often a set of classes or methods that define actions. Always PHP 😁

## 🧠 Understanding the Project's Structure
To keep it simple, we will illustrate the project's structure using an example. Imagine our client **EVENT IT** has just arrived on the site! 😱

1. **Open Sesame:** the `index.php` file will be used every time. This file is the application's entry point. It is responsible for directing requests to the right controllers. For this, it reads in the `routes.yaml` file to know where to redirect the client.

2. **The right controller:** Once your controller is called, as well as the right method, the controller will interact with the model to retrieve the necessary data. Once it has the data, it will pass it to the view. ```$this->webRender('blablabla');``` will have the responsibility of generating the HTML to display from the twig. Later other file's name will be available.

    > Controllers are in the `src/Controller` folder.

    **Please,** keep the used syntax `$this->webRender( 'folder' . self::INDEX, $data);` for views. This will facilitate understanding of the code. 😉

3. **The model:** The model communicates with the database and processes data (e.g., retrieve, insert, update, delete). In our case, PHP manages the model.

4. **The view:** The view is responsible for displaying data or the user interface. In your case, Twig is used to create the templates for your views. Twig allows separating the presentation logic from PHP code by offering a flexible and powerful template system. 

    > Views are in the `templates` folder.
    > In `templates/public`, if the view is "public to all", otherwise in `templates/admin` if the view is "private".

# ⚠PHP Doc⚠
PHPDoc is a tool that allows generating documentation from PHP source code. It is similar to Javadoc, documenting the source code using special comments. [Check here](https://www.sitepoint.com/introduction-to-phpdoc/)

### It allows to:
- Describe classes, methods, properties, parameters, return types, exceptions, etc.
- Better understand how the code works.
- Describe what parameters a method expects, and what type of data is returned.

I will make an effort to document the code to facilitate its understanding. Thank you for doing the same! 😁

A small example of documentation:
```php
    /**
     * Here the php doc
     * What it does: dispatch the request to the appropriate controller
     * 
     * @param string $url pass the url in string format
     * @return void 
     */
    public function dispatch($url) {
        // blablabla
        }
```
# Create your first page !
## 🐘 Controller PHP
Don't forget to use the `use` statement to import the necessary classes. It will facilitate the understanding of the code. Moreover, extends de `BaseController` to have access to the `Twig` object. example:

```php
<?php

declare(strict_types=1); // requirement to have one type per variable

namespace App\Controller\Home; // namespace of the controller, ask me if you don't understand it

use App\Controller\Controller as BaseController; // import the Controller class

/**
 * Class HomeController for the home page
 * @package App\Controller\Home
 */
class HomeController extends BaseController {

    public function index(): void
{
    $this->webRender('public/homePage/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page'
    ]); // will render the index.html.twig with variable title and content
}

}
```	
## 👾 routes.yaml
```yaml	
# routes.yaml
name: # name of the routes
  path: / # the path of the route to the url
  controller: namespace\controllerName # namespace of the controller
  method: index # method of the controller
```
Don't hesitate to give clear and precise names for the routes.
So, for the HomeController, we have:
```yaml
# routes.yaml
event_it.public.homepage:
  path: /
  controller: App\Controller\Home\HomeController
  method: index
```

> Nothing prevents you from having several methods for 1 controller.

> In the future, I will try to pass arguments in the url, example: have urls with ``/user/{id}/manage`` and id will be the id of the user. Very easy to create [CRUD](https://developer.mozilla.org/fr/docs/Glossary/CRUD) pages.

## 🍃Twig Tutoriel
Twig is a powerful templating engine for PHP, and it's used to create dynamic HTML templates for your web application. Here's a simple guide to get you started with Twig in our project.

## What is Twig?

Twig is a template engine that allows you to write concise and expressive syntax to generate HTML output. It separates your logic (PHP code) from your presentation (HTML), making your code more maintainable and clean.

## How Does Twig Work?

Twig works by defining templates, which are HTML files with Twig code that can insert variables, control structures (like loops and conditions), and more. When the server processes a request, it fills in these templates with dynamic content before sending the HTML to the user's browser.

## Basic Twig Syntax

- `{{ ... }}` - Output content into the template (e.g., variables or expressions).
- `{% ... %}` - Execute control structures (e.g., loops, conditions).
- `{# ... #}` - Add comments that will not be rendered in the HTML.
  
Here is a small tutorial on how to use Twig. Firslty, we have the `base.html.twig` file that will be the base of all the pages. It will contain the basic structure of the HTML page. Then, we will have the `index.html.twig` file that

```twig
{# base.html.twig #}
<head>
    <title>Hello, World!</title>

    {% block title %}{% endblock %}
    {% block stylesheets %}{% endblock %}
    {% block javascripts %}{% endblock %}
</head>
<body>
    {% block body %}{% endblock %}
</body>
```
extends the `base.html.twig` and that will fill the blocks.

```twig
{# index.html.twig #}
{% extends 'base.html.twig' %}

{% block title %}Index{% endblock %}

{% block stylesheets %} <link rel="stylesheet" href="style.css"> {% endblock %}
{% block javascripts %} <script src="script.js"></script> {% endblock %}

{% block body %}
    {# mettre le html ici #}
    <h1>Hello, World!</h1>
{% endblock %}
{% include 'grille.html.twig' %} {# pour inclure un fichier externe si besoin #}
```

[//]: <> (Part 2 about the translation)

## Create translations in your twig files !
I managed to keep it simple. In you twig files, you should just use it like this to translate the text:
```twig
{{ 'event_it.teste.hello_world'|trans }}
```

So, if your key is `event_it.teste.hello_world`, you should have a file (depends the local) like this `translation.fr.yaml` for french text in the `translations` folder. In this file, you should have:
```yaml
event_it:
  teste:
    hello_world: "Bonjour le monde"
```

<span style="color:red">WARNING:</span> If you don't have the translation, it will display the key. So, be careful to have **all the translations in all the files**.

# Bonus tips:

## The path function:
```twig
<a href="{{ path("nom_de_votre_route")}}">Don't forget to contribute</a>
```
example:
if my route is something like that:
```yaml
# routes.yaml
event_it.public.homepage:
path: /my-paypal
controller: App\Controller\Home\HomeController
method: index
```
I will have:
```twig
<a href="{{ path("event_it.public.homepage") }}">Don't forget to contribute</a>
```
The result will be:
```html
<a href="/my-paypal">Don't forget to contribute</a>
```
The main advantage is if you need to change the path for X reason, if **ANYBODY** do the same
you juste have to change the path in your ```routes.yaml ```.

Your documentation is mostly correct, but there are a few minor grammatical errors and areas that could be clarified. Here's a revised version:

## Passing Parameters Through a URL *(beta)*
> NOTE: This currently only works for integers such as IDs. Handling strings is more complex.

```yaml
event_it.public.homepage:
  path: /{id}
  controller: App\Controller\Home\HomeController
  method: index
  parameters:
    id:
      type: int
```
With this configuration, you can create a URL with any integer you want. For example, `/1` and `/9223372036854775807` are both valid. The integer can then be accessed in your controller:

```php
# Your controller
public function index($data = []): void
{
    /**
     * Here, $data will be your array:
     *  [
     *    "id" => *yourNumber*
     *  ]
     */
    $this->webRender('public/homePage/' . self::INDEX, [
        'title' => 'Home Page',
        'content' => 'Welcome to the home page',
        'cookieSet' => CookieHandler::isCookieSet(),
    ]);
}
```
I haven't tested this with multiple IDs yet, but it should work in theory.

### What's the benefit?
This allows you to manage users or objects! For example, you could have a URL like `/edit-profile/5`, where `5` is the ID of a user.

# 🐥 Deal with git
## First create a branch
2 options, you can use the command line or the github interface. name it with the feature you are working on and your name. For example, if i work on the home page, I can name it `mh-feature-homePage`. With it, I will know that it's a feature, it's for the home page and who work on it. After that, don't forget to switch to it.

Now you can work on your feature !

## Commit
When you have finished a part of the feature, you can commit your changes. Don't forget to write a clear message to explain what you have done. If you have to do several commits, it's not a problem.

## Push
When you have finished the feature, you can push your branch to the remote repository. It will be available for the others.

## Pull request
When you have pushed your branch, you can create a [pull request](https://docs.github.com/en/pull-requests/collaborating-with-pull-requests/proposing-changes-to-your-work-with-pull-requests). It will be reviewed by the others. If everything is ok, it will be merged to the main branch.
Don't forget to put someone in the review, to assign the pull request to yourself, to put a label and please, <span style="color:red">**PLEASE**</span>, don't merge your pull request by yourself. Wait for the validation of the reviewer, some died for less than that...

### Explanation:
When you **merge** a pull request, it will be add to the main branch, so it will be available for everyone. If you merge it by yourself, you can have some conflicts with the main branch. So, it's better to wait for the validation of the reviewer.

## How to contribute
💸[My paypal](https://paypal.me/VictorGermain)💸

If you have questions, don't hesitate to ask me. I will be happy to help you. 😁
I can't verify all function of the app, so if you find a bug, please report it. I will try to fix it as soon as possible. 😁

XOXO

## Dependencies you may need
- mbstring
- phpenmod
