import Link from "next/link"

export default function login() {
    return (
        <form action="" className="flex flex-grow flex-col gap-3 text-center">
            <h1>Sign in</h1>
            <input type="text" name="username" id="username" placeholder="Username"/>
            <input type="password" name="password" id="password" placeholder="Password"/>
            
            <div className="space-x-2 self-start">
                <input name="terms" type="checkbox"/>
                <label htmlFor="remember">Remember me</label>
            </div>
            <button className="btn" type="submit">Sign in</button>

            <div>
            <p>You do not have an account?</p>
            <Link href="signup">Click here to create one</Link>
            </div>

        </form>
    )
}