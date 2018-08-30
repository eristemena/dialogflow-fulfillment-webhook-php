# Dialogflow\Action\Questions\Carousel  



## Implements:
Dialogflow\Action\Interfaces\QuestionInterface



## Methods

| Name | Description |
|------|-------------|
|[addOption](#carouseladdoption)|Add Carousel option.|
|[create](#carouselcreate)|Create a new Carousel instance.|
|[imageDisplayOptions](#carouselimagedisplayoptions)|Type of image display option. Possible value: DEFAULT, WHITE and CROPPED.|
|[renderRichResponseItem](#carouselrenderrichresponseitem)|Render a single Rich Response item as array.|
|[renderSystemIntent](#carouselrendersystemintent)|Render System Intent as array.|




### Carousel::addOption  

**Description**

```php
public addOption (\Dialogflow\Action\Questions\Carousel\Option $option)
```

Add Carousel option. 

 

**Parameters**

* `(\Dialogflow\Action\Questions\Carousel\Option) $option`

**Return Values**

`\Dialogflow\Action\Questions\Carousel`





### Carousel::create  

**Description**

```php
public static create (void)
```

Create a new Carousel instance. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\Action\Questions\Carousel`





### Carousel::imageDisplayOptions  

**Description**

```php
public imageDisplayOptions (string $imageDisplayOptions)
```

Type of image display option. Possible value: DEFAULT, WHITE and CROPPED. 

 

**Parameters**

* `(string) $imageDisplayOptions`

**Return Values**

`\Dialogflow\Action\Questions\Carousel`





### Carousel::renderRichResponseItem  

**Description**

```php
public renderRichResponseItem (void)
```

Render a single Rich Response item as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`





### Carousel::renderSystemIntent  

**Description**

```php
public renderSystemIntent (void)
```

Render System Intent as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|array`




