
## Commands:

# ps
```
docker ps -a
```

# build
```
docker compose -f docker-compose.yaml build --no-cache
docker build -f docker/dockerlastic/php/Dockerfile -t carpenter0100/dockerlastic-php:latest --target php-dockerlastic-prod .
```

# Up
```
docker compose -f docker-compose.yaml up -d
```

# stop
```
docker compose -f docker-compose.yaml stop
```

# down
```
docker compose -f docker-compose.yaml down
```

# images
```
docker images
```

# volumes
```
docker volume ls
```

# login
```
docker login -u user -p tokenentferntundnichtmehrgueltig
```

# logout
```
docker logout
```

# push
```
docker push user/dockerlastic-php:latest
```

# pull
```
docker push user/dockerlastic-php:latest
```

# network
```
docker network create -d bridge backend_net
```

# run
```
docker run --name gc_prod_php -d user/dockerlastic-php:latest
docker run -d --name dockerlastic_prod_php --network backend_net --restart=always user/dockerlastic-php:latest
```

# Kill
###

## all
```
docker system prune -f
```

### images
```
docker rmi $(docker images -a -q)
```

### volumes
```
docker volume prune -f
```



## Learn
https://github.com/docker/labs
