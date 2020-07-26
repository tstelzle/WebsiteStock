# Website Stock
This container will host a simple website. This website is used to manage a stock of items (preferable groceries).

## Instructions
This container uses nginx, php and sqlite3.
To start it use the provided Makefile.
You can see all possible target use ```make default```.
The basic targets are these two:

```Shellscript
make build-image
make container
```

Now the website is available on port 81 on your machine.
To change the port set the 'PORT' variable when starting the container.

```Shellscript
make container PORT=82
```

The database will be mounted into the database directory. 
For development it can be useful to see the database file.

The 'container_start.sh' starts the services needed in the docker container and creates the database.

The 'nginx_conf' provides the configuration for the nginx service.
