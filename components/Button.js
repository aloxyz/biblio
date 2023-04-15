export default function Button(props) {
    return (
        <button className='transition duration-150 hover:brightness-125 p-2 bg-emerald-800 rounded-md text-white'>
            {props.children}
        </button>
    )
}