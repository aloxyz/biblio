export async function addBook(user_id, book_olid) {
    return await fetch("http://localhost:8000/readlists/create.php", {
        method: "post",
        mode: 'cors',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ user_id: user_id, book_olid: book_olid }),

    })
        .then(res => {
            if (res.ok) {
                return res.json();
            }

            else if (res.status === 503) {
                throw new Error('Failed to insert book into readlist.');
            }

            else if (res.status === 400) {
                throw new Error('Malformed data');
            }

            else {
                throw new Error(`Unexpected status code: ${res.status}`);
            }

        })
}

export function userHasBook (user_id, book_olid) {
    return new Promise((resolve) => {
        fetch(`http://localhost:8000/readlists/book.php?user_id=${user_id}&book_olid=${book_olid}`, {
            method: "get",
            mode: 'cors',
            headers: { "Content-Type": "application/json" },
        })
        .then(res => {
            if(res.status === 200) {
                resolve(true);
            }
    
            else if(res.status === 204) {
                resolve(false);
            }
    
            else {
                throw new Error(`Failed to retrieve user id. Error code ${res.status}`)
            }
        })
    })

}

export async function removeBook(user_id, book_olid) {
    return await fetch("http://localhost:8000/readlists/delete.php", {
        method: "delete",
        mode: 'cors',
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ user_id: user_id, book_olid: book_olid }),

    })
        .then(res => {
            if (res.ok) {
                return res.json();
            }

            else if (res.status === 503) {
                throw new Error('Failed to delete book from readlist.');
            }

            else {
                throw new Error(`Unexpected status code: ${res.status}`);
            }

        })
}

