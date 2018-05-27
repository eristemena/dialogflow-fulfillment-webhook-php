# Dialogflow\Action\Questions\ListCard\Option  







## Methods

| Name | Description |
|------|-------------|
|[create](#optioncreate)|Create a new Option instance.|
|[description](#optiondescription)|Option description.|
|[image](#optionimage)|Set the image for list option.|
|[key](#optionkey)|Option key that will be used to capture user's response.|
|[render](#optionrender)|Render response as array.|
|[synonyms](#optionsynonyms)|Possible synonyms of the option that can be said/typed by user to select this option.|
|[title](#optiontitle)|Option title.|




### Option::create  

**Description**

```php
public static create (void)
```

Create a new Option instance. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`\Dialogflow\Action\Questions\ListCard\Option`





### Option::description  

**Description**

```php
public description (string $description)
```

Option description. 

 

**Parameters**

* `(string) $description`

**Return Values**

`\Dialogflow\Action\Questions\ListCard\Option`





### Option::image  

**Description**

```php
public image (string $imageUrl, string $accessibilityText)
```

Set the image for list option. 

 

**Parameters**

* `(string) $imageUrl`
: image URL  
* `(string) $accessibilityText`
: (optional) accessibility text of the image  

**Return Values**

`\Dialogflow\Action\Questions\ListCard\Option`





### Option::key  

**Description**

```php
public key (string $key)
```

Option key that will be used to capture user's response. 

 

**Parameters**

* `(string) $key`

**Return Values**

`\Dialogflow\Action\Questions\ListCard\Option`





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





### Option::synonyms  

**Description**

```php
public synonyms (array $synonyms)
```

Possible synonyms of the option that can be said/typed by user to select this option. 

 

**Parameters**

* `(array) $synonyms`

**Return Values**

`\Dialogflow\Action\Questions\ListCard\Option`





### Option::title  

**Description**

```php
public title (string $title)
```

Option title. 

 

**Parameters**

* `(string) $title`

**Return Values**

`\Dialogflow\Action\Questions\ListCard\Option`




