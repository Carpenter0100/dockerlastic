
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
docker login -u carpenter0100 -p dckr_pat_DNncrdMf9DsYxeE0d2bu5wS1jcI
```

# logout
```
docker logout
```

# push
```
docker push carpenter0100/dockerlastic-php:latest
```

# pull
```
docker push carpenter0100/dockerlastic-php:latest
```

# network
```
docker network create -d bridge backend_net
```

# run
```
docker run --name gc_prod_php -d carpenter0100/dockerlastic-php:latest
docker run -d --name dockerlastic_prod_php --network backend_net --restart=always carpenter0100/dockerlastic-php:latest
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
