IMAGE-NAME := ubunut-env-website-stock
CONTAINER-NAME := website-stock
WORKING-DIR := $(PWD)
PORT := 81
CONTAINER-PORT = 80

PORT-MOUNT := -p $(PORT):$(CONTAINER-PORT)
DOCKER-FLAGS := -d -t --rm --user root
HTML-MOUNT := -v $(WORKING-DIR)/src:/var/www/html
DB-MOUNT := -v $(WORKING-DIR)/database:/database 
DOCKER-NAME := --name $(CONTAINER-NAME) 
DOCKER-RUN-CMD := docker run $(DOCKER-FLAGS) $(PORT-MOUNT) $(HTML-MOUNT) $(DB-MOUNT) $(DOCKER-NAME) $(IMAGE-NAME)


.PHONE: default doc

default: doc

doc: 
	@echo "Possible Targets:"
	@echo "==doc:"
	@echo "    Dependencies:"
	@echo "    Description:"
	@echo "      Display this message about available Targets."
	@echo "    Variables:"
	@echo "==build-image:"
	@echo "    Dependencies:"
	@echo "      Dockerfile via .docker target"
	@echo "    Description:"
	@echo "      Creates the docker image of the current directory with name '$(IMAGE-NAME)'"
	@echo "    Variables:"
	@echo "      IMAGE-NAME: Sets the image name. Currently '$(IMAGE-NAME)'"
	@echo "==container:"
	@echo "    Dependencies:"
	@echo "      build-image"
	@echo "    Description: "
	@echo "      Starts a container from '$(IMAGE-NAME)' with the name '$(CONTAINER-NAME)'."
	@echo "      It mounts '$(WORKING-DIR)/src' as '/var/www/html' and '$(WORKING-DIR)/database' as '/database'."
	@echo "      It also sets the local port '$(PORT)' to the container port '$(CONTAINER-PORT)'."
	@echo "    Variables:"
	@echo "      PORT: Sets local port. Currently '$(PORT)'"
	@echo "      CONTAINRT-PORT: Sets port to connect to the local port. Currently '$(CONTAINER-PORT)'"
	@echo "      WORKING-DIR: Sets the root for mounting src and database to. Currently '$(WORKING-DIR)'"
	@echo "      IMAGE-NAME: Sets the name of the image to start. Currently '$(IMAGE-NAME)'"
	@echo "      CONTAINER-NAME: Sets the name to start the images as. Currently '$(CONTAINER-NAME)'"
	@echo "==bash:"
	@echo "    Dependencies:"
	@echo "    Description:"
	@echo "      Executes /bin/bash in the container '$(CONTAINER-NAME)' in interactive mode."
	@echo "    Variables:"
	@echo "      CONTAINER-NAME: Sets the container in which to start /bin/bash. Currently '$(CONTAINER-NAME)'"
	@echo "==stop:"
	@echo "    Dependencies:"
	@echo "    Description:"
	@echo "      Stops the container '$(CONTAINER-NAME)'."
	@echo "    Variables:"
	@echo "      CONTAINER-NAME: Sets the container name to stop. Currently '$(CONTAINER-NAME)'"

build-image: .docker

.docker: Dockerfile
	docker build -t $(IMAGE-NAME) .
	touch .docker

container: build-image
	$(DOCKER-RUN-CMD) 

bash:
	docker exec -it $(CONTAINER-NAME) /bin/bash

stop:
	docker stop $(CONTAINER-NAME)
