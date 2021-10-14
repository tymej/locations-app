### Api service endpoints:
GET
* `/api/addresses` - fetch all addresses
* `/api/addresses/{id}` - fetch an address

POST
* `/api/addresses` - create an address - json {city: city, street: street}
* `/api/addresses/{id}/calculate/distance-to` - calculate distance from address with id to address at body - json {city: city, street: street}

PUT
* `/api/addresses/{id}` - edit an address - json {city: city, street: street}

DELETE
* `/api/addresses/{id}` - delete an address
