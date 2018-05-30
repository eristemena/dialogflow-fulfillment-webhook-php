# Dialogflow\Action\User  







## Methods

| Name | Description |
|------|-------------|
|[__construct](#user__construct)||
|[getId](#usergetid)|Random string ID for Google user.|
|[getLastSeen](#usergetlastseen)|Timestamp for the last access from the user.|
|[getName](#usergetname)|User's permissioned name info.|




### User::__construct  

**Description**

```php
public __construct (array $data)
```

 

 

**Parameters**

* `(array) $data`
: request array  

**Return Values**




### User::getId  

**Description**

```php
public getId (void)
```

Random string ID for Google user. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### User::getLastSeen  

**Description**

```php
public getLastSeen (void)
```

Timestamp for the last access from the user. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|\Carbon\Carbon`





### User::getName  

**Description**

```php
public getName (void)
```

User's permissioned name info. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|\Dialogflow\Action\User\Name`




