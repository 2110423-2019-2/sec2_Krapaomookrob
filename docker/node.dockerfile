FROM node:12-alpine
 
EXPOSE 3000
 
WORKDIR /app
COPY ./laravel /app
RUN npm install
 
USER node
 
# CMD [ "npm", "run", "dev"]