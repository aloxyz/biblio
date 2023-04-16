import Navbar from "./Navbar"

export default function Layout({children}) {
    return (
        <>
            <Navbar/>
            <main className='bg-gray-100 h-screen'>
                {children}
            </main>
        </>
    )
}