export default function signup() {
    return (
        <form action="" className="flex flex-grow flex-col gap-3 text-center">
            <h1>Create an account</h1>
            <input type="text" name="username" id="username" placeholder="Username"/>
            <input type="password" name="password" id="password" placeholder="Password"/>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm password"/>

            
            <div className="space-x-4 self-start">
                <input name="terms" type="checkbox"/>
                <label htmlFor="terms">I accept the terms and conditions</label>
            </div>

            
            <button className="btn" type="submit">Sign up</button>
        </form>
    )
}