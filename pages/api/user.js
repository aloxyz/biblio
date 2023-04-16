function register() {

}

export default function handler(req, res) {
    const body = req.body

    

    switch (req.method) {
        case 'POST':
            res.status(200).json({ name: 'register' });
        case 'GET':
            res.status(200).json({ name: 'login' });
    }

  }
  