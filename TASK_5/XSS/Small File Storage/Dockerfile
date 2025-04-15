FROM node:20.5.1-slim

ENV USER=mark
ENV PORT=3000
RUN adduser --disabled-password -u 1337 $USER

RUN apt-get update \
    && apt-get install -y wget gnupg \
    && wget -q -O - https://dl-ssl.google.com/linux/linux_signing_key.pub | apt-key add - \
    && sh -c 'echo "deb [arch=amd64] http://dl.google.com/linux/chrome/deb/ stable main" >> /etc/apt/sources.list.d/google.list' \
    && apt-get update \
    && apt-get install -y google-chrome-stable fonts-ipafont-gothic fonts-wqy-zenhei fonts-thai-tlwg fonts-kacst fonts-freefont-ttf libxss1 --no-install-recommends\
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

WORKDIR /app
COPY ./deploy .
RUN npm install
COPY ./flag /
RUN mkdir ./upload

EXPOSE $PORT
CMD ["node", "app.js"]