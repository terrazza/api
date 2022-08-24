# API

The API will be here.

Refer to the [Getting Started Guide](https://api-platform.com/docs/distribution) for more information.

##persistence
###create entity by cli interface
```
docker-compose exec php bin/console make:entity --api-resource
```

###create migration/patch file
```
docker-compose exec php bin/console doctrine:migrations:diff
```

###execute migration/patch file(s)
```
docker-compose exec php bin/console doctrine:migrations:migrate
```
