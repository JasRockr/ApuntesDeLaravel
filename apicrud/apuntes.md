# Api Publica con Laravel

### Crear nuevo proyecto

```shell
laravel new apicrud
```

### Crear base de datos

```mysql
CREATE DATABASE 'apicrud'
```

#### Configurar la base de datos

configurar la base de datos en el archivo '.env'

### Crear modelos y migraciones

```shell
php artisan make:model Note --migration
```

-   Automaticamente se crean los archivos correspondientes en la respectiva ruta: app > Models | app > database > migrations

### Definir lógica del modelo y estructurar las migraciones

#### Models

En el modelo, al definirse como _protected_ con un array vacío, esto indica que todos los elementos para este módelo son cumplimentables por el usuario.

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $guarded = [];
}

```

#### Migrations

-- Ejemplo para tabla notes

```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('content', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};

```

### Ejecutar las migraciones

```shell
php artisan migrate
```

### Crear controlador con sus respectivos recursos

```shell
php artisan make:controller NoteController --resource
```

-   Configuración de las rutas en routes > api.php

```php
<?php

use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;

Route::resource('/note', NoteController::class);
```

### Comprobación de rutas disponibles

```shell
php artisan route:list
```

-   El proveedor de servicios de rutas de Laravel es el encargado de crear todas las ruta y su configuración se enceuntra en la ruta: _app > Providers > RouteServiceProvider.php_
