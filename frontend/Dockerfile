# base image
FROM node:12.2.0-alpine

# set working directory
WORKDIR /app

# add `/app/node_modules/.bin` to $PATH
ENV PATH /app/node_modules/.bin:$PATH

# install and cache app dependencies
COPY package.json /app/package.json
RUN npm install
RUN npm install @vue/cli@3.7.0 -g
RUN npm install axios
RUN npm install vuex --save
RUN npm install vue-router --save
RUN npm install vue bootstrap bootstrap-vue --save
RUN npm install js-cookie --save
RUN npm install vuex-persistedstate --save 

# start app
CMD ["npm", "run", "serve"]