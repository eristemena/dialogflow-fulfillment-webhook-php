# Dialogflow\Action\Device\Location  







## Methods

| Name | Description |
|------|-------------|
|[__construct](#location__construct)||
|[getCity](#locationgetcity)|City.|
|[getCoordinates](#locationgetcoordinates)|Geo coordinates.|
|[getFormattedAddress](#locationgetformattedaddress)|Display address, e.g., "1600 Amphitheatre Pkwy, Mountain View, CA 94043".|
|[getZipCode](#locationgetzipcode)|Zip code.|




### Location::__construct  

**Description**

```php
public __construct (array $data)
```

 

 

**Parameters**

* `(array) $data`
: request array  

**Return Values**




### Location::getCity  

**Description**

```php
public getCity (void)
```

City. 

Requires the DEVICE_PRECISE_LOCATION or DEVICE_COARSE_LOCATION permission. 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|string`





### Location::getCoordinates  

**Description**

```php
public getCoordinates (void)
```

Geo coordinates. 

Requires the DEVICE_PRECISE_LOCATION permission. 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|\Dialogflow\Action\Device\Location\LatLang`





### Location::getFormattedAddress  

**Description**

```php
public getFormattedAddress (void)
```

Display address, e.g., "1600 Amphitheatre Pkwy, Mountain View, CA 94043". 

Requires the DEVICE_PRECISE_LOCATION permission. 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|string`





### Location::getZipCode  

**Description**

```php
public getZipCode (void)
```

Zip code. 

Requires the DEVICE_PRECISE_LOCATION or DEVICE_COARSE_LOCATION permission. 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|string`




