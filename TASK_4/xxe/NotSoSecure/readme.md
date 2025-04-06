# Tên chall: Not So Secure
# Deploy
chạy command trong thư mục chứa file Dockerfile
```sh
build: sudo docker build -t not-so-secure .
run: sudo docker run -d -p 9999:9999 not-so-secure
```