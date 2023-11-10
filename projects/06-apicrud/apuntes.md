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

-   El proveedor de servicios de rutas de Laravel es el encargado de crear todas las rutas y su configuración se enceuntra en la ruta: _app > Providers > RouteServiceProvider.php_

### Prefijo Personalizado

```php	
Route::prefix('/v1')->resource('/note', NoteController::class);
```

### Preparar y configurar el controllador creado previamente

- Para el correcto uso de Eloquent, lo primero es importar o hacer uso del modelo:

```php	
use App\Models\Note;
```

- Una vez configurado se crean las función para cada recurso:

  - Index: Listará los elementos del recurso

```php	
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all notes
        $notes = Note::all();
        // Rest API
        // Return json response (data, status code, headers [Optional])
        return response()->json($notes, 200);
    }

```
- Create: Creará una nueva nota

  - Creación con artisan de un request para validar que los datos cumplan con los requisitos minimos.
```shell
php artisan make:request NoteRequest
```
```php	
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Set True for give authorization to all users
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        //  Define rules for validations that match the current request
        return [
            //
            'title' => 'required|max:255|min:3',
            'content' => 'nullable|max:255|min:3'
        ];
    }
```
Importación o Uso del request para la validación de los datos recibidos por el NoteController
```php 
use App\Http\Requests\NoteRequest;
```
Función del recurso Crear

```php 
    /**
     * Show the form for creating a new resource.
     */
    public function create(NoteRequest $request)
    {
        // Create element with values from request
        Note::create($request->all());
        return response()->json([
            'succeed' => true
        ], 201);
    }

```

```php 

```

```php 

```

```php 

```
