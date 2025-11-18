# frontend/Dockerfile
FROM node:18

# Katalog roboczy
WORKDIR /usr/src/app

# Kopiujemy package.json i package-lock.json
COPY package*.json ./

# Instalacja Angular CLI globalnie i zależności
RUN npm install -g @angular/cli@16
RUN npm install

# Kopiujemy resztę projektu
COPY . .

# Domyślna komenda
CMD ["npm", "start"]
#FROM node:18
#
#WORKDIR /usr/src/app
#
#CMD [ "bash" ]
