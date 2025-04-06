FROM ubuntu:22.04

RUN rm /bin/sh && ln -s /bin/bash /bin/sh

RUN apt-get update \
    && apt-get install -y curl \
    && apt-get -y autoclean

ENV NVM_DIR /usr/local/nvm
ENV NODE_VERSION 14.7.0


RUN curl --silent -o- https://raw.githubusercontent.com/creationix/nvm/v0.31.2/install.sh | bash


RUN source $NVM_DIR/nvm.sh \
    && nvm install $NODE_VERSION \
    && nvm alias default $NODE_VERSION \
    && nvm use default

ENV NODE_PATH $NVM_DIR/v$NODE_VERSION/lib/node_modules
ENV PATH $NVM_DIR/versions/node/v$NODE_VERSION/bin:$PATH

ENV PRIVATE_KEY_HEX="fhf7h7frh8gr9gh9rhg9rjgr9hgrhgrgjhr7ghr7hgrjg9rj9gjr9gjr9gjr9"
ENV K="1337"

WORKDIR /app

COPY package*.json ./
COPY flag.txt /
RUN npm install

COPY . .

EXPOSE 9999

CMD ["node", "/app/app.js"]
