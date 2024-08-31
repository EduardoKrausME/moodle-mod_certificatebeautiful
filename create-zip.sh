#!/usr/bin/env bash


mv ./amd/src/*.min.js ./amd/build/
rm -f ./amd/build/*.min.min.js

#cp ./amd/src/mod_form.js      ./amd/build/mod_form.min.js
#cp ./amd/src/player_create.js ./amd/build/player_create.min.js

cd ..
rm  -f  mod_certificatebeautiful.zip
zip -rq mod_certificatebeautiful.zip certificatebeautiful/ \
        --exclude=*sh --exclude=*zip --exclude=*.git* --exclude=.gitignore \
        --exclude=*ai

