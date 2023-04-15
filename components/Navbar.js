import {BookmarkSlashIcon, BookOpenIcon, Cog6ToothIcon, UserCircleIcon} from '@heroicons/react/24/outline'
import Link from 'next/link'

export default function Navbar() {
    return (
        <nav className='top-0 right-0 w-[50vw] bg-emerald-800 p-10 text-white fixed h-full flex flex-col items-center gap-5'>
        
        <Link href='/user' className='flex flex-col items-center hover:underline'>
            <UserCircleIcon className='w-14 stroke-1'/>
            Mario Rossi
        </Link>
        
        
        <ul>
            <li className='hover:underline'>
                <Link href='/books'>
                <BookOpenIcon className='w-5 pb-1 inline'/>
                Books
                </Link>
            </li>
            
            <li className='hover:underline'>
                <Link href='/readlist'>
                <BookmarkSlashIcon className='w-5 pb-1 inline'/>
                My readlist
                </Link>
            </li>
    
            <li className='hover:underline'>
                <Link href='/settings'>
                <Cog6ToothIcon className='w-5 pb-1 inline'/>
                Settings
                </Link>
                </li>
        </ul>
    </nav>
    )

}