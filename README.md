# !Quest! #

<aside>
📑
Realizziamo un’applicazione in Laravel che visualizza e permette di gestire e visualizzare dei **Ticket di supporto**.

E’ prevista una sola tipologia di utente: un Admin che ha accesso alla lista degli operatori, dei ticket e delle relative categorie assegnabili.

Sui ticket sono possibili le seguenti operazioni: creazione, aggiornamento dello stato e assegnazione ad un operatore. Un ticket deve essere obbligatoriamente assegnato ad un operatore **disponibile** in fase di creazione.

Per questa fase non è prevista alcuna visualizzazione avanzata dei ticket se non una semplice lista. Tutte le operazioni vengono svolte all’interno di un unico backoffice a disposizione dell’Admin.

**MILESTONES**
    
    1️⃣ **Milestone 1**
    Sviluppare un diagramma ER per le entità e le relazioni dell’applicativo.
    
    2️⃣ **Milestone 2**
    Seguendo il diagramma creato nella prima milestone, creiamo e popoliamo il database attraverso migrations e seeders (si consiglia l’uso dei Faker per popolare le risorse).
    Teniamo presente che una entità Ticket dovrà avere almeno le seguenti caratteristiche: id, data, stato, titolo, descrizione e inoltre dovrà avere una categoria, un operatore e uno stato (ASSEGNATO, IN LAVORAZIONE, CHIUSO).
    
    3️⃣ **Milestone 3**
    Realizziamo un setup dell’applicativo con backoffice e autenticazione riservata ad un unico utente amministratore: l’admin.
    
    4️⃣ **Milestone 4**
    Aggiungiamo la possibilità di creare un nuovo ticket, a cui andrà obbligatoriamente assegnata anche una categoria, un operatore e uno stato. In questa fase nella selezione possiamo includere tutti gli operatori.
    
    5️⃣ **Milestone 5**
    Realizziamo una pagina di dettaglio del singolo ticket, con la visualizzazione di tutte le informazioni contenute in esso.
    
    6️⃣ **Milestone 6**
    Aggiungiamo la possibilità di modificare lo stato di un ticket (ad esempio da IN LAVORAZIONE a CHIUSO). Le altre proprietà non possono essere modificate.
    
    ➕ **Bonus 1**
    Nella pagina di listato dei ticket aggiungiamo la possibilità di filtrare i ticket per stato e categoria.
    
    ➕➕ **Bonus 2**
    In fase di assegnazione di un ticket, aggiungiamo la verifica della disponibilità dell’operatore. Un operatore è occupato quando ha un ticket attivo già assegnato.
    
</aside>

## Documentation ##

### Getting start ###

- Create a new repo on `GitHub` named 'full-stack-ticket-platform'.
- Create folder on your disk with the same name.
- Open the folder on `Visual Studio Code`.
- `composer create-project laravel/laravel:^10.0` inside a **Bash** terminal.
- On *VSCode* -> *Source Controll* -> *Initialize Repository* -> *Repositories* -> *Remote* -> '+' -> 'full-stack-ticket-platform' -> enter the GitHub's page of your repo.
- Inside **Bash** initial commit.
    - `git add .`
    - `git commit -m"init"`
    - `git push --set-upstream full-stack-ticket-platform main`

### ER Diagram ###

- Let's create a ER diagram.
    - new file `tables.drawio`.
    - under *Entity Relation* pick some tables.
    - drop into page and fill with entity needed.
        - Users.
        - Tickets.
        - Operators.
        - Categories.
    - fill each table with *data-types* as well.
    - Define relationships between tables.
    - Modify tables's color.
    - Modify background.
    - *File* -> *Export* -> *.png*

### DB setup ###

- Change file `.env` information with your DB info.
    - DB_CONNECTION
    - DB_HOST
    - DB_PORT
    - DB_DATABASE
    - DB_USERNAME
    - DB_PASSWORD
- Start *MAMP* -> *Start Server* -> *TOOLS* -> *PHPMYADMIN*
- Inside a Bash terminal `php artisan serve` -> click on your port .
    - Leave this Bash open.

### Model / Migration / Seeder ###

- Open another Bash terminal and create all the **models** with migration, seeder, controller, resource.
    - `php artisan make:model Ticket -mcrsR`
    - `php artisan make:model Category -mcrsR`
    - `php artisan make:model Operator -mcrsR`
- Define relationships inside every **Model**.
    - use Illuminate\Database\Eloquent\Relations\BelongsTo; (1to1)
    - use Illuminate\Database\Eloquent\Relations\BelongsToMany; (1toN)
    - use Illuminate\Database\Eloquent\Relations\HasOne; (1to1)
    - use Illuminate\Database\Eloquent\Relations\HasMany; (1toN)
    ```php
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    ```
- Populate the **migration** file with our data-types/entities.
    - $table->id();
    - $table->string('title');
    - etc etc
- Populate **seeder** as well, with `Faker`.
    - use App\Models\Category; (include the model)
    - use Faker\Factory as Faker; (include Faker)
    - for loop with your desired number of fake info.
    ```php
    for ($i = 0; $i < 15; $i++) {
        Category::create([
            'name' => $faker->unique()->word,
        ]);
    }
    ```
    - or use an array of your desired categories.
    ```php
    $categories = [
        'PHP',
        'HTML',
        'CSS',
        'JAVASCRIPT',
        'BOOTSTRAP',
        'SASS',
        'VUEJS',
        'VITE',
        'LARAVEL',
        'MYSQL',
    ];

    foreach ($categories as $category) {
        Category::create([
            'name' => $category,
        ]);
    }
    ```
    - do it for every entities.
- Remember always to secure protected fillable inside the **Model** file.
    - `protected $fillable = ['name'];`
- Add this to **DatabaseSeeder** file for seed all togheter.
    ```php
    $this->call([
        CategorySeeder::class,
        OperatorSeeder::class,
        TicketSeeder::class,
    ]);
    ```
- Seed your **Database** with `php artisan migrate --seed`
    - if is not created yet choose 'yes'.
    - `php artisan migrate:fresh --seed` for recreate it from zero.
- Had some trouble with migration/seed because I create first **Ticket** model.
    - change the order of migration executed by changing the number in their file's name.
    - (example) 1010000 for categories migration.
    - (example) 1020000 for operators migration.
    - (example) 153856 for tickets migration.
    - `php artisan migrate:fresh --seed`

### Authentication ###

- For authentication we have to install **Breeze**.
    - `composer require laravel/breeze --dev`
    - `php artisan breeze:install`
    - blade
    - no
    - 1
- Add a controller for our Admin/Dashboard .
    - `php artisan make:controller Admin/DashboardController`
    - inside controller
    ```php
    return view('admin.dashboard');
    ```
    - inside web.php use App\Http\Controllers\Admin\DashboardController;
    - add controller inside Route::middleware
    ```php
    Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    });
    ```
    - update costant inside *RouteServiceProvider.php*
    ```php
    public const HOME = '/admin';
    ```
    - scaffolding inside *resources>views* an 'admin' folder.
        - create *dashboard.blade.php* into admin folder.
        - add a folder for each entities
            - *categories*
            - *operators*
            - *tickets*

### CRUD ###

- `C.R.U.D. -> (CREATE-READ-UPDATE-DELETE)`
- Add route in *web.php* inside the *middleware*.
    ```php
    Route::resource('tickets', TicketController::class);
    ```
- Add files inside *resources/views/admin/tickets*
    - create.blade.php
    - index.blade.php
    - show.blade.php
    - edit.blade.php
- Move all controllers inside *Http/Controllers/Admin*
- Store function of **TicketController** .
    - validate request $validatedRequest = $request->validated();
    - create it $ticket = Ticket::create($validatedRequest);
    - return a view
- Add your rules of authentication inside **StoreTicketRequest** .
    ```php
    'title' => 'required|min:10|max:50|',
    'description' => 'required|min:10|max:255|',
    'status' => 'required',
    'category_id' => 'required',
    'operator_id' => 'required',
    ```
- Populate Index,Show,Create files with some layout.

## Links ##
- [Visual Studio Code](https://code.visualstudio.com/) .
- [Create Laravel Project](https://laravel.com/docs/10.x/installation) .
- [Connect repo to Project](https://docs.github.com/en/get-started/getting-started-with-git/managing-remote-repositories) .
- [GitHub Commands](https://education.github.com/git-cheat-sheet-education.pdf) .
- [ER Diagram](https://www.geeksforgeeks.org/introduction-of-er-model/) .
- [ER with drawio](https://drawio-app.com/blog/entity-relationship-diagrams-with-draw-io/) .
- [Data-Types](https://laravel.com/docs/4.2/schema) .
- [MAMP](https://www.mamp.info/en/windows/) .
- [Laravel Model](https://laravel.com/docs/10.x/eloquent) .
- [Laravel Migration](https://laravel.com/docs/10.x/migrations#main-content) .
- [Laravel Seeder](https://laravel.com/docs/10.x/seeding#writing-seeders) .
- [Faker](https://fakerphp.org/) .
- [Laravel Controller](https://laravel.com/docs/10.x/controllers#main-content) .
- [Laravel Resource](https://laravel.com/docs/10.x/eloquent-resources#main-content) .
- [Laravel Mass Assignment](https://laravel.com/docs/10.x/eloquent#mass-assignment-json-columns) .
- [Laravel Breeze](https://laravel.com/docs/10.x/starter-kits#laravel-breeze) .
- [CRUD](https://kinsta.com/blog/laravel-crud/) .