
## Peter Hopson

I took this opportunity to learn some Laravel, as I didn't have experience with it and it seems like one of the more popular frameworks. 

Learning the layout of a Laravel project took a little bit but it seems fairly straightforward. I decided to user Laravel's Eloquent to make the models and migrations for the user/message tables, it seems pretty great!   Figuring out to do queries against the database didn't take too long, though admittedly the queries were pretty basic.  In writing the routes, I check for the specified fields, returning a 400 code (akin to an HTTP 400 for bad request) if a field is missing. It would have been nice to use some of Laravel's built-in authentication methods and password hashing but I didn't look into them further in the interest of time.

One way to expand on the endpoints, the <em>/view_messages</em> endpoint could be restricted to only show the messages if the requesting user is one of the specified users .  Expanding on user interactions, one addition could be chat rooms/group chats.  There could also be a way to block messages from one user to another.  Emails should also probably not be shown on <em>/list_all_users</em>
