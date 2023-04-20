<script>

    let user = {
            email: "",
            password: "",
        };
    
        let disabled = true;
    
        function checkDisabled() {
            if (user.email && user.password && user.cpassword) {
                disabled = false;
            } else {
                disabled = true;
            }
        }
        
    </script>
    

    <h1>Welcome back</h1>
                <form action="/api/user" method="post">
                    <input
                        bind:value={user.email}
                        required
                        type="email"
                        name="email"
                        id="email"
                        placeholder="john.doe@email.com"
                    />
        
                    <input
                        bind:value={user.password}
                        required
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Password"
                        pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8}$"
                        title="Password must have a minimum of eight characters, at least one letter, one number and one special character"
                    />
        
                    <button disabled={disabled || null} type="submit">Sign up</button>
                    <fieldset>
                        <label for="terms">
                            <input type="checkbox" id="terms" name="terms" />
                            Remember me
                        </label>
                    </fieldset>
                
                </form>