# Dialogflow\Context  







## Methods

| Name | Description |
|------|-------------|
|[__construct](#context__construct)||
|[getLifespan](#contextgetlifespan)|The number of queries this context will remain active after being invoked|
|[getName](#contextgetname)|The name of the context|
|[getParameters](#contextgetparameters)|The parameters being passed through the context|
|[renderV1](#contextrenderv1)|Render response as array for API V1|
|[renderV2](#contextrenderv2)|Render response as array for API V2|




### Context::__construct  

**Description**

```php
public __construct (void)
```

 

 

**Parameters**

`This function has no parameters.`

**Return Values**




### Context::getLifespan  

**Description**

```php
public getLifespan (void)
```

The number of queries this context will remain active after being invoked 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|string`





### Context::getName  

**Description**

```php
public getName (void)
```

The name of the context 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`string`





### Context::getParameters  

**Description**

```php
public getParameters (void)
```

The parameters being passed through the context 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`





### Context::renderV1  

**Description**

```php
public renderV1 (void)
```

Render response as array for API V1 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`array`





### Context::renderV2  

**Description**

```php
public renderV2 (string $session)
```

Render response as array for API V2 

 

**Parameters**

* `(string) $session`
: session  

**Return Values**

`array`




