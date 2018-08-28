# Dialogflow\Action\Questions\DateTime  



## Implements:
Dialogflow\Action\Interfaces\QuestionInterface



## Methods

| Name | Description |
|------|-------------|
|[__construct](#datetime__construct)|Constructor for DateTime object.|
|[renderRichResponseItem](#datetimerenderrichresponseitem)|Render a single Rich Response item as array.|
|[renderSystemIntent](#datetimerendersystemintent)|Render System Intent as array.|




### DateTime::__construct  

**Description**

```php
public __construct (string $requestDateTimeText, string $requestDateText, string $requestTimeText)
```

Constructor for DateTime object. 

 

**Parameters**

* `(string) $requestDateTimeText`
: initial question  
* `(string) $requestDateText`
: follow up question about the exact date  
* `(string) $requestTimeText`
: follow up question about the exact time  

**Return Values**

`\Dialogflow\Action\Questions\DateTime`





### DateTime::renderRichResponseItem  

**Description**

```php
public renderRichResponseItem (void)
```

Render a single Rich Response item as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`





### DateTime::renderSystemIntent  

**Description**

```php
public renderSystemIntent (void)
```

Render System Intent as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`




