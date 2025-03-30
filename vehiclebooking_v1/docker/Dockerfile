# Bước 1: Dùng Node.js 20.15 để build
FROM node:20.15 AS build-stage

# Set thư mục làm việc trong container
WORKDIR /app

# Copy file package.json và package-lock.json (nếu có)
COPY package*.json ./

# Cài đặt dependencies
RUN npm install

# Copy toàn bộ mã nguồn vào container
COPY . .

# Build production với Vite
RUN npm run build

# Bước 2: Dùng Nginx để serve file build
FROM nginx:alpine AS production-stage
COPY --from=build-stage /app/dist /usr/share/nginx/html

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
