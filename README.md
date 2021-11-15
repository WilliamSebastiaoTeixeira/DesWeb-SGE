## SGE - Estacimentos

> Desenvolvido utilizando Laravel
> Múltiplos Usuários; Múltiplos Roles; Google Maps API (Utilizindo Composer); MVC. 

## Configuracões
    Copie o arquivo .env.example e cole no mesmo diretório como .env

    Altere com campos os dados do Banco de Dados: 
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3306
    - DB_DATABASE=laravel
    - DB_USERNAME=root
    - DB_PASSWORD=

    Ainda no arquivo .env, será necessário a configuracão da chave de API do Google MAPS(Javascript) no campo: 
    - GOOGLE_API_KEY="exemploexemplo"

    Abra um terminal no diretório principal e rode os comandos: 
    - $composer install
    - $php artisan key:generate
    - $php artisan migrate:fresh --seed
    - $npm install && npm run dev
    - $php artisan serve

## Licença
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)


