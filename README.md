# Desafío Técnico – Laravel 9 / API + Jobs + Cache + JWT

Este proyecto implementa una **API en Laravel 9** que cumple con los requerimientos del challenge enviado por el equipo de Astroselling.  
Integra **paginación, procesamiento asíncrono (Jobs)**, **cache temporal**, **autenticación JWT**, y **control de roles y permisos** utilizando *Spatie Laravel Permission*.

---

## Requerimientos del Desafío

### Objetivo
> Construir una funcionalidad en Laravel que combine:
> - Paginación de usuarios  
> - Ejecución de Jobs por usuario  
> - Uso de cache para guardar resultados temporales

---

## Tecnologías y Librerías

- **Laravel 9**
- **PHP 8.3**
- **JWT Auth** – [tymon/jwt-auth](https://github.com/tymondesigns/jwt-auth)
- **Spatie Laravel Permission** – Roles y permisos
- **Laravel UI** – Autenticación web
- **Jobs + Queue Worker**
- **Cache**

---

## Instalación

```bash
git clone https://github.com/iThePhran/challenge_astroselling.git
cd challenge_astroselling
composer install
cp .env.example .env  -> (En este punto, recuerda configurar las credenciales de la DB para que corran las migraciones)
php artisan key:generate
php artisan migrate --seed
php artisan jwt:secret
php artisan serve


Usuario creador por defecto con rol de administrador -> admin@admin.com / admin123