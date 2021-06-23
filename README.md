Docker and Photo Gallery
====================
You can use Docker Compose to easily run Photo Gallery in an isolated environment built with Docker containers.
This guide demonstrates how to use Compose to set up and run the project.
Before starting, make sure you have [Docker](https://docs.docker.com/get-docker/) and [Docker Compose installed](https://docs.docker.com/compose/install/).

Important
=========
You should check the current USER ID on your local machine:

```bash
$ echo ${UID}
```

Output example:
```bash
$ 1000
```
Next step you should insert this USER ID into `.env` file:

```dotenv
USER_ID=1000
```

Installation
============
Clone the repository to your local machine. Rename `.env.example` with `.env`. Add the dump file into the `docker/mysql/dump`.

Run the project
---------------
The start images and containers using:

```bash
$ docker-compose up -d
```

**Note:** if you need rebuild all containers use the special param `--build`:
```bash
$ docker-compose up -d --build
```

Stop the project
----------------
The stop all containers using:

```bash
$ docker-compose stop
```

Shutdown and cleanup
--------------------
The command `docker-compose down` removes the containers and default network, but preserves your WordPress database.
Remove database data:

```bash
$ sudo rm -rf ./docker/mysql/data
```

**Note:** if you want to remove all container, run command bellow:

```bash
$ docker system prune --all
```

Xdebug
------
One of the most useful tools in software development is a proper debugger.
It allows you to trace the execution of your code and monitor the contents of the stack.
Xdebug, PHP’s debugger, can be utilized by various IDEs to provide Breakpoints and stack inspection.

if you are using the JetBrain's PhpStorm, the xdebug has already completed for using.
See full documentation [here](https://xdebug.org/docs/).

Docker Logs
===========
The `docker logs` command batch-retrieves logs present at the time of execution.
However first you should the check which containers are running:

```bash
$ docker ps
```
The output will be something like this:
```bash
CONTAINER ID   IMAGE                 COMMAND                  CREATED      STATUS         PORTS                                                  NAMES
7d54a559b738   traefik:v2.3          "/entrypoint.sh --ap…"   3 days ago   Up 2 minutes   0.0.0.0:80->80/tcp, :::80->80/tcp                      photo-gallery-traefik
8d7ceee3f46e   nginx:1.19-alpine     "/docker-entrypoint.…"   3 days ago   Up 2 minutes   80/tcp                                                 photo-gallery-nginx
7adff828f6b4   photo-gallery:1.0.0   "docker-php-entrypoi…"   3 days ago   Up 2 minutes   9000/tcp                                               photo-gallery-php
cb0eb4acee16   mysql:5.7             "docker-entrypoint.s…"   3 days ago   Up 2 minutes   33060/tcp, 0.0.0.0:3300->3306/tcp, :::3300->3306/tcp   photo-gallery-mysql
```
Then you can check logs the command below:

```bash
$ docker logs -f 7adff828f6b4 #CONTAINER ID
```