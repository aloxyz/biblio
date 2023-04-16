import Link from "next/link"
import Logo from "../components/Logo"

export default function signup() {
    return (
        <form action='/api/user' method="post" className="flex flex-grow flex-col gap-8 text-center">
            <Logo className="self-center"/>
            <h1>Create an account</h1>

            <input 
            required
            type="email" 
            name="email" 
            id="email" 
            placeholder="john.doe@email.com"/>
            
            <input
            required
            type="password" 
            name="password" 
            id="password" 
            placeholder="Password" 
            pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" 
            title="Password must have a minimum of eight characters, at least one letter, one number and one special character"/>
            
            <input
            required
            type="password" 
            name="confirm-password" 
            id="confirm-password" 
            placeholder="Confirm password"/>

            
            <div className="space-x-2 self-start">
                <input name="terms" type="checkbox"/>
                <label htmlFor="terms">I accept the terms and conditions</label>
            </div>

            
            <button className="btn" type="submit">Sign up</button>

            <div>
            <p>You already have an account?</p>
            <Link href="login">Click here to sign in</Link>
            </div>

        </form>
    )
}