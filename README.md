# Клиент сервиса геокодирования Яндкекс.Геокодер

Для развертывания необходимо указать ключ разработчика 
сервисов Яндекса apiKey в файле /config/services.yaml. Корневая директория /public/

Для работы с API включен веб-клиент
### API-запросы

| Наименование | Метод | Описание |
| ------ | ------ | ------ |
|/api/address | POST | Получение данных о заданном местоположении |

Параметры запроса

| Имя | Тип | Обязательный | Значение по умолчанию | Описание |
| ------ | ------ | ------ | ------ | ------ |
| address | string | Да |  | Строка поискового запроса |
| lang | string | Нет | en_US | Язык поиска |
| count | integer | Да |  | Количество получаемых данных |
| offset | integer | Да |  | Пропуск перед первым получаемым резульатом |

Параметры ответа

| Имя | Тип | Описание |
| ------ | ------ | ------ |
| count | integer | Количество фактически полученных результатов поиска |
| data | array | Массив объектов dataItem |

Объект dataItem

| Имя | Тип | Обязательный | Описание |
| ------ | ------ | ------ | ------ |
| structAddress | string | Да | Структурированный адрес объекта |
| longitude | float | Да | Географическая долгота объекта (от -180 до 180) |
| latitude | float | Да | Географическая долгота объекта (от -180 до 180) |
| metro | string | Нет | Метро, расположенное рядом с объектом (при его наличии) |
