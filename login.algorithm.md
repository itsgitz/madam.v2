# LOGIN

1. User input username and password, set mysql prepared / escape string (prevent sql injection)
2. Check username and password, if empty, then throw error message `Username or password cannot be empty` to login page (error_message)
3. Get user data from `users` table where `username` = username and `password` = password (entered by user)
4. If user is empty or doesn't exist, then throw error `Invalid username or password`
5. If user exist, then create session for `id`, `username`, `name`, and `email`
6. Redirect user to Home page.