#!/bin/bash

# curl --header "Content-Type: application/json" \
#   --request POST \
#   --data '{"email":"curl@email.com","password":"curl123"}' \
#   http://localhost:8000/users/create.php

curl --header "Content-Type: application/json" \
  --request POST \
  --data '{"user_id":"1","readlist_id":"3", "name":"Giacomo Poretti"}' \
  http://localhost:8000/user_profiles/create.php