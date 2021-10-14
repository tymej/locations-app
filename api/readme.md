### Architecture
#### Configs `./config`
#### Secrets `./.secrets`
#### Database migrations/feeders `./database`


#### Domain layer (business logic, entities)`./src/Application`

#### Entry points (controllers, cli)`./src/Entry`
Controllers:
* `./src/Entry/Controller` - http entry points
* `./config/routes`

#### Infrastructure  `./src/Infrastructure`:
Service providers (container service definitions):
* `./src/Infrastructure/Container/` - service providers - instance of `ContainerInterface`
* `./src/Infrastructure/ServiceContainer` - dependencies container
* `./config/service_providers`

Routing and http:
* `./src/Infrastructure/Router` - application router
* `./config/routes` - routes definition
* `./src/Infrastructure/Http` - http protocol objects

Database and data mapping:
* `./config/database` - database cofnig
* `./src/Infrastructure/Mapper` - data mappers for entities - instance of `AbstractDataMapper`
* `./src/Infrastructure/Repository` - repositories

External api's communication - `./src/ApiClient`

Additional tools:
* `./src/Infrastructure/Uuid.php` - uuid v4 generator
* `./src/Infrastructure/Parameters.php` - application parameters
