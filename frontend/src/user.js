export function getUser(id) {
    var url = new URL("http://localhost:8000/users/read.php");
    url.searchParams.append("id", id);

    return fetch(url).then((res) => {
        if (res.ok) {
            return res.json();
        } 

        else if (res.status === 404) {
            throw new Error("User does not exist");
        }
    });
}

export function getReadlist(user_id) {
    var url = new URL("http://localhost:8000/readlists/read.php");
    url.searchParams.append("user_id", user_id);

    return fetch(url).then((res) => {
        if (res.ok) {
            return res.json();
        } 
        
        else if (res.status === 404) {
            throw new Error("No books in readlist");
        }

        else if (res.status === 500) {
            throw new Error("Failed to retrieve records");
        }
    });
}

export function getBook(olid) {
    var url = new URL("http://localhost:8000/books.php");
    url.searchParams.append("olid", olid);

    return fetch(url).then((res) => {
        if (res.ok) {
            return res.json();
        } 
        
        else if (res.status === 404) {
            throw new Error("No book found");
        }
    });
}
