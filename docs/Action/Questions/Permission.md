# Dialogflow\Action\Questions\Permission  



## Implements:
Dialogflow\Action\Interfaces\QuestionInterface



## Methods

| Name | Description |
|------|-------------|
|[__construct](#permission__construct)|Constructor for Permission object.|
|[create](#permissioncreate)|Create a new Permission instance.|
|[renderRichResponseItem](#permissionrenderrichresponseitem)|Render a single Rich Response item as array.|
|[renderSystemIntent](#permissionrendersystemintent)|Render System Intent as array.|




### Permission::__construct  

**Description**

```php
public __construct (string $context, array $permissions)
```

Constructor for Permission object. 

 

**Parameters**

* `(string) $context`
* `(array) $permissions`

**Return Values**

`\Dialogflow\Action\Questions\Permission`





### Permission::create  

**Description**

```php
public static create (string $context, array $permissions)
```

Create a new Permission instance. 

 

**Parameters**

* `(string) $context`
* `(array) $permissions`

**Return Values**

`\Dialogflow\Action\Questions\ListCard`





### Permission::renderRichResponseItem  

**Description**

```php
public renderRichResponseItem (void)
```

Render a single Rich Response item as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`





### Permission::renderSystemIntent  

**Description**

```php
public renderSystemIntent (void)
```

Render System Intent as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`




