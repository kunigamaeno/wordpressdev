#!/bin/sh

#sh filelist.sh ./ > list.txt
# 第一引数で指定したディレクトリ配下のテキストファイルを一覧表示する。
for file in `find $1 -name "*.*"`; do
  echo "$file"
done
