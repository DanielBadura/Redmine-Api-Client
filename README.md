Redmine API Client
==================

[![Build Status](https://travis-ci.org/DanielBadura/Redmine-Api-Client.svg?branch=master)](https://travis-ci.org/DanielBadura/Redmine-Api-Client)

installation
------------

```bash
composer require danielbadura/redmine-api-client
```

usage
-----

You can initialize the client with the login of the redmine user.

```php
// user credentials
$apiClient = new Client('redmine.com', 'admin', 'password');
// or with apikey
$apiClient = new Client('redmine.com', 'jdal5723n5j7987234jjfsd');
```

After this you are ready to go. Now you can get your needed repository and get the entities you want.

```php
// to get the issue with id = 1
$apiClient->getIssueRepository()->find(1);
// get all issues
$apiClient->getIssueRepository()->findAll();
```

Creating new entities is really simple. Just create an object of this entity and fill the data. Then use the client to save it.

```php
$issue = new Issue();
$issue->setSubject('New Issue');

$apiClient->getIssueRepository()->save($issue);
```

To update an entity just get it and modify it.

```php
$issue = $apiClient->getIssueRepository()->find(1);
$issue->setSubject('New Issue Name');

$apiClient->getIssueRepository()->save($issue);
```
