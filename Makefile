.PHONY: test build

# User editable vars
PLUGIN_NAME := wp-morphext

# Shortcuts
DOCKER_RUN := docker run --rm -v `pwd`:/workspace
PHPCS_DOCKER_IMAGE := wpengine/phpcs --standard=./test/phpcs.xml --warning-severity=8
WORDPRESS_INTEGRATION_DOCKER_IMAGE := worldpeaceio/wordpress-integration
COMPOSER_DOCKER_IMAGE := composer
COMPOSER_DIR := -d "/workspace/"
BUILD_DIR := ./build

# Commands
all: lint composer_install test

lint:
	$(DOCKER_RUN) $(PHPCS_DOCKER_IMAGE) .

phpcbf:
	$(DOCKER_RUN) --entrypoint "/composer/vendor/bin/phpcbf" $(PHPCS_DOCKER_IMAGE) .

composer_install:
	$(DOCKER_RUN) $(COMPOSER_DOCKER_IMAGE) install $(COMPOSER_DIR)

composer_update:
	$(DOCKER_RUN) $(COMPOSER_DOCKER_IMAGE) update $(COMPOSER_DIR)

test:
	$(DOCKER_RUN) $(WORDPRESS_INTEGRATION_DOCKER_IMAGE) ./vendor/bin/phpunit --testsuite="integration"

get_version:
	@awk '/Version:/{printf $$NF}' $(PLUGIN_NAME).php

build:
	@rm -rf $(BUILD_DIR)/$(PLUGIN_NAME)
	@rm -rf $(BUILD_DIR)/$(PLUGIN_NAME)-$(shell make get_version).zip
	@mkdir -p $(BUILD_DIR)/$(PLUGIN_NAME)
	@rsync -rR $(PLUGIN_NAME).php css/ js/ $(BUILD_DIR)/$(PLUGIN_NAME)/
	@cd $(BUILD_DIR)/ && zip -r $(PLUGIN_NAME)-$(shell make get_version).zip $(PLUGIN_NAME)

wordpress_org_deploy:
	# passing this for now
