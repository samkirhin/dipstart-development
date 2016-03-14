dipstart-development
====================

Для развертывание окружения для разработки установите [`vagrant`](https://www.vagrantup.com/downloads.html) и [`Virtualbox`](https://www.virtualbox.org/wiki/Downloads).
> Если ваш ОС Linux или MAC то убедитесь что в системе установлен `nfs-server`(Обычно он преустановлен).

Затем выполните команду:
```
    vagrant up
```

> Если ваш ОС `windows` то в настройте ваш IDE для синхронизации с `sftp`.
  Пример для `phpstorm`:
  1. Откройте `Tools>Deployment>Configuration` и нажмите `insert`
  2. В поле `name` напишите `dipstart.dev`, В поле `type` выберите `sftp`
  3. Заполните все поле используя следующие данные:
    SFTP host: `dipstart.dev`
    root path: `/srv`
    user: `vagrant`
    password: `vagrant`

  4. Выберите вкладку `mappings` и заполните поле `deployment path on server 'dipstart.dev'` со значением `/`

  5. Нажмите ок
  6. Ставьте флаг `Tools>Deployment>Automatic Upload(always)`

> Для Linux/Mac синхронизация работает автоматически.

Все проект запущен в виртуалке и доступен по адресу `dipstart.dev`.