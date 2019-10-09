# Image
FROM node:10-alpine

# Install service dependencies
RUN apk update
RUN apk add --no-cache git
RUN apk add libpq

# Set up work directory
WORKDIR /var/www
