#!/bin/bash

echo "Enter the absolute path to the directory:"
echo "example 1: /path/to/base/dir"
echo "example 2: /var/www/html/wp-project"
read directory_to_fix

# To recursively give directories read&execute privileges:
find $directory_to_fix -type d -exec chmod 755 {} +

# To recursively give files read privileges:
find $directory_to_fix -type f -exec chmod 644 {} +
