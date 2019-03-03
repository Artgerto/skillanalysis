# SuperJob Skill Analysis

Проект представляет собой инструмент для анализа резюме по навыкам. В проекте используется SuperJob API.

## Поиск резюме по навыкам

Введите название должности в поле поиска
![Поиск по должности](https://github.com/Artgerto/skillanalysis/blob/7d5c4e0f1b2a3425aded99577ec5ace47bd0022d/userguide/2019-03-03_14-46-53.png?raw=true "Поиск по должности")
Добавьте нужные навыки. После введения навыка нажмите Enter:
![Ввод навыков](https://github.com/Artgerto/skillanalysis/blob/7d5c4e0f1b2a3425aded99577ec5ace47bd0022d/userguide/2019-03-03_14-48-11.png?raw=true "Ввод навыков")
Вы можете выбрать способ сортировки по навыкам: по приоритету или по сумме навыков.
Нажмите кнопку поиска.
Выборка по навыкам выполняется из первых 100 резюме.
![Результат выборки](https://github.com/Artgerto/skillanalysis/blob/7d5c4e0f1b2a3425aded99577ec5ace47bd0022d/userguide/2019-03-03_14-50-48.png?raw=true "Результат выборки")
Для более точного подбора можно выбрать дополнительные условия. Если не хотите использовать дополнительные условия, оставьте эти поля пустыми.
![Дополнительные условия](https://github.com/Artgerto/skillanalysis/blob/7d5c4e0f1b2a3425aded99577ec5ace47bd0022d/userguide/2019-03-03_14-51-10.png?raw=true "Дополнительные условия")
## Настройка проекта

1. Необходимо зарегистировать свое приложение на сайте SuperJob - https://api.superjob.ru/.
2. Создать собственный конфигурационный файл Laravel .env (аналогично .env.example). В файле .env определить переменные CLIENT_ID и CLIENT_SECRET:
```
    CLIENT_ID = 0000
    CLIENT_SECRET = v1.r.5656...
```
3. Выполнить команду Composer для импорта зависимостей проекта:
```
composer install
```
4. Выполнить команду npm для импорта Node.js зависимостей проекта:
```
npm install
```
5. Выполнить сборку компонентов для работы в режиме разработчика:
```
npm run dev
```
6.  Запустить проект на локальном компьютере с помощью команды Laravel artisan:
```
php artisan serve
```
## Использемые библиотеки 
- [Laravel](https://laravel.com/ "Laravel")
- [VueMaterial](https://vuematerial.io "VueMaterial")
- [SuperJob API Client](https://github.com/superjobru/superjob-api-client "SuperJob API Client")
- [mdbootstrap](https://mdbootstrap.com/ "mdbootstrap") (free version)
