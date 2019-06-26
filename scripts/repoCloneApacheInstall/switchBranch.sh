#!/bin/bash

#branchName=remotes/origin/presentation
branchName=remotes/origin/master

cd ./swigwww
git checkout ${branchName}

exit $?

