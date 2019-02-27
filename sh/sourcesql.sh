DBNAME="1123_cn"
create_db_sql="source /home/wwwroot/cms/cms/database/init/database.sql"
mysql -uroot -p2014gaokao -D ${DBNAME} -e "${create_db_sql}"