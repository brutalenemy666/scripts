#!/bin/bash

echo "Enter svn directory:"
read svn_directory

# enter into the directory
cd $svn_directory

# remove missing/deleted files
svn status | grep '^\!' | cut -c8- | while read f; do svn rm "$f"; done
