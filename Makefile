
IMAGE-NAME := ubunut-env-website-stock
CONTAINER-NAME := website-stock
WORKING-DIR := $(PWD)
PORT := 81

default:
    @echo "Possible Targets:"

build-image:
	docker build -t $(IMAGE-NAME) .

container:
	docker run -d -t --rm -p $(PORT):80 -v $(WORKING-DIR)/src:/var/www/html -v $(WORKING-DIR)/database:/database --user root --name $(CONTAINER-NAME) $(IMAGE-NAME)

exec:
	docker exec -it $(CONTAINER-NAME) /bin/bash