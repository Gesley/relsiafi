LOCATION=$1

TODAY_FILES=$(ls $LOCATION -ltr --full-time | grep `date +"%Y-%m-%d"` |  awk '{print $9}')

for FILE in $TODAY_FILES; do
    case $(file $LOCATION/$FILE --mime-type | awk '{print $2}') in
        'application/gzip'|'application/x-gzip')
            echo -e $FILE'\t'$(gunzip -c $LOCATION$FILE | sed -e '/^[[:alpha:]]/d' | wc -l)
        ;;
        'text/plain' | 'application/octet-stream')
            echo -e $FILE'\t'$(sed '/^[[:alpha:]]/d' $LOCATION$FILE | wc -l)
        ;;
        'application/x-empty')
                echo -e $FILE'\t'0
        ;;
        esac

done
