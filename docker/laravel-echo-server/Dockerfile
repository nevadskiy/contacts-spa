# Image
FROM node:10-alpine

# Create app directory
RUN mkdir -p /usr/src/app

# Set up work directory
WORKDIR /usr/src/app

# Add init packages file
COPY package.json /usr/src/app/

# Install service dependencies
RUN apk add --update python python-dev py-pip build-base

# Install node dependencies
RUN npm install

# Bundle app source
COPY laravel-echo-server.json /usr/src/app/laravel-echo-server.json

# Run command for running laravel-echo-server
CMD [ "npm", "start" ]
