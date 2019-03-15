# Dialogflow\RichMessage\Suggestion  





## Extend:

Dialogflow\RichMessage\RichMessage

## Methods

| Name | Description |
|------|-------------|
|[create](#suggestioncreate)|Create a new Suggestion instance.|
|[reply](#suggestionreply)|Set the reply for a Suggestion.|

## Inherited methods

| Name | Description |
|------|-------------|
|doesSupportRichMessage|Check if request source support rich message.|
|fallbackText|Alias of setFallbackText() to fit more inline with text(), button(), image(), etc.|
|getFallbackText|Get the fallback text.|
|render|Render response as array.|
|setFallbackText|Set the fallback text if a request source doesn't support rich messages.|



### Suggestion::create  

**Description**

```php
public static create (string|array|null $reply)
```

Create a new Suggestion instance. 

 

**Parameters**

* `(string|array|null) $reply`

**Return Values**

`\Dialogflow\Response\Suggestion`





### Suggestion::reply  

**Description**

```php
public reply (string|array $reply)
```

Set the reply for a Suggestion. 

 

**Parameters**

* `(string|array) $reply`

**Return Values**



