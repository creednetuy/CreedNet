#!/bin/bash


while true; do

    echo "Gestor de CreedNet"
    echo "1) Subir la app"
    echo "2) Migraciones y permisos"
    echo "3) Bajar la app"
    echo "4) Salir"
    echo -n "Opción: "
    read op

    case $op in
        1)
            sudo docker compose up -d
            ;;
        2)

            sudo docker exec laravel_app chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache
            sudo docker exec laravel_app chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
            sudo docker exec laravel_app php artisan migrate
        ;;
        3)

            sudo docker compose down
        ;;
        4)
            exit
            ;;

    esac
done
