import Navbar from "./Navbar"

export default function Layout({children}) {
    return (
        <>
            <Navbar/>
            <main className='bg-gray-50 h-screen'>
                <section className="p-5 py-14">
                {children}
                </section>
            </main>
        </>
    )
}