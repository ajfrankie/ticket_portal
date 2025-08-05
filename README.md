Run php artisan db:seed to seed the database with initial data.

The seeding creates an admin user with the following credentials:

<!--?Email: franklinroswer@gmail.com -->
<!--?Password: 12345678 -->

Use these credentials to log in and access the system.

Repositories:
All database queries and data handling logic are written inside repository classes (e.g., TicketRepository).
Repositories help keep controllers clean by separating data access logic.
Use repository methods to create, update, delete, and fetch data for tickets and related models.

Request Validation:
All API request validation rules are defined in custom Form Request classes inside the app/Http/Requests folder (e.g., StoreTicketRequest).
These classes handle input validation before reaching controller logic.

<!-- Public Auth Routes:

POST /login — User login (FrontloginController@login)

POST /register — User registration (FrontRegisterController@register)

POST /logout — User logout (FrontloginController@logout)

Authenticated User:

GET /user — Get authenticated user info (middleware auth:sanctum)

Admin Routes (prefix: /admin):

Ticket Routes (prefix: /admin/ticket):

GET /index — List all tickets (TicketController@index)

POST /store — Create a ticket (TicketController@store)

PUT /update/{id} — Update a ticket by ID (TicketController@update)

GET /delete/{id} — Delete a ticket by ID (TicketController@destroy)

GET /show/{id} — Show ticket details by ID (TicketController@show)

Replay Routes (prefix: /admin/replay):

POST /store — Store a ticket replay (TicketReplayController@store)

POST /show/{id} — Show ticket replay(s) for ticket (TicketReplayController@show)

Test Auth Route:

GET /test-auth — Returns current authenticated user info (user ID and user object) -->