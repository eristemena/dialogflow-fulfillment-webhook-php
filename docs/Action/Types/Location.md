# Dialogflow\Action\Types\Location  







## Methods

| Name | Description |
|------|-------------|
|[__construct](#location__construct)||
|[getCity](#locationgetcity)|City.|
|[getCoordinates](#locationgetcoordinates)|Geo coordinates.|
|[getFormattedAddress](#locationgetformattedaddress)|Display address, e.g., \"1600 Amphitheatre Pkwy, Mountain View, CA 94043\".|
|[getName](#locationgetname)|Name of the place.|
|[getNotes](#locationgetnotes)|Notes about the location.|
|[getPhoneNumber](#locationgetphonenumber)|Phone number of the location, e.g. contact number of business location or
phone number for delivery location.|
|[getPostalAddress](#locationgetpostaladdress)|Postal address.|
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

Requires the DEVICE_PRECISE_LOCATION or  
DEVICE_COARSE_LOCATION permission. 

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

`null|\Dialogflow\Action\Types\LatLng`





### Location::getFormattedAddress  

**Description**

```php
public getFormattedAddress (void)
```

Display address, e.g., \"1600 Amphitheatre Pkwy, Mountain View, CA 94043\". 

Requires the DEVICE_PRECISE_LOCATION permission. 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|string`





### Location::getName  

**Description**

```php
public getName (void)
```

Name of the place. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|string`





### Location::getNotes  

**Description**

```php
public getNotes (void)
```

Notes about the location. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|string`





### Location::getPhoneNumber  

**Description**

```php
public getPhoneNumber (void)
```

Phone number of the location, e.g. contact number of business location or
phone number for delivery location. 

 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|string`





### Location::getPostalAddress  

**Description**

```php
public getPostalAddress (void)
```

Postal address. 

Requires the DEVICE_PRECISE_LOCATION or  
DEVICE_COARSE_LOCATION permission. 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|\Dialogflow\Action\Types\PostalAddress`





### Location::getZipCode  

**Description**

```php
public getZipCode (void)
```

Zip code. 

Requires the DEVICE_PRECISE_LOCATION or  
DEVICE_COARSE_LOCATION permission. 

**Parameters**

`This function has no parameters.`

**Return Values**

`null|string`




