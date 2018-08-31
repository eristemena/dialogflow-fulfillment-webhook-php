# Dialogflow\Action\Responses\BrowseCarousel\Option  







## Methods

| Name | Description |
|------|-------------|
|[create](#optioncreate)|Create a new Option instance.|
|[description](#optiondescription)|Option description.|
|[footer](#optionfooter)|Hero image for the carousel item. Optional.|
|[image](#optionimage)|Set the image for Browsing Carousel option.|
|[render](#optionrender)|Render response as array.|
|[title](#optiontitle)|Option title.|
|[url](#optionurl)|URL of the document associated with the carousel item.|




### Option::create  

**Description**

```php
public static create (void)
```

Create a new Option instance. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\Action\Responses\BrowseCarousel\Option`





### Option::description  

**Description**

```php
public description (string $description)
```

Option description. 

 

**Parameters**

* `(string) $description`

**Return Values**

`\Dialogflow\Action\Responses\BrowseCarousel\Option`





### Option::footer  

**Description**

```php
public footer (string $footer)
```

Hero image for the carousel item. Optional. 

 

**Parameters**

* `(string) $footer`

**Return Values**

`\Dialogflow\Action\Responses\BrowseCarousel\Option`





### Option::image  

**Description**

```php
public image (string $imageUrl, string $accessibilityText)
```

Set the image for Browsing Carousel option. 

 

**Parameters**

* `(string) $imageUrl`
: image URL  
* `(string) $accessibilityText`
: (optional) accessibility text of the image  

**Return Values**

`\Dialogflow\Action\Responses\BrowseCarousel\Option`





### Option::render  

**Description**

```php
public render (void)
```

Render response as array. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`array`





### Option::title  

**Description**

```php
public title (string $title)
```

Option title. 

 

**Parameters**

* `(string) $title`

**Return Values**

`\Dialogflow\Action\Responses\BrowseCarousel\Option`





### Option::url  

**Description**

```php
public url (string $openUrlAction)
```

URL of the document associated with the carousel item. 

The document can contain HTML content or, if \"url_type_hint\" is set to  
AMP_CONTENT, AMP content.  
Required. 

**Parameters**

* `(string) $openUrlAction`

**Return Values**

`\Dialogflow\Action\Responses\BrowseCarousel\Option`




