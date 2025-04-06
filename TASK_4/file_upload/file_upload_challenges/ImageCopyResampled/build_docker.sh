#!/bin/bash
docker rm -f "bkctf2023-imagecopyresampled"
docker build --tag="bkctf2023-imagecopyresampled" .
docker run -p 1337:1337 --rm --name="bkctf2023-imagecopyresampled" --volume ./challenge:/www "bkctf2023-imagecopyresampled" 