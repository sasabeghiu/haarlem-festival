# Haarlem Festival 
This is the repository for Haarlem Festival Project of Group 6

## URL
URL to live website: [Haarlem Festival](http://localhost/page/festival)

## Login Credentials
```
User with role Customer:
- Username = customer
- Password = customer123

User with role Employee:
- Username = employee
- Password = employee123

User with role Admin:
- Username = admin
- Password = admin123


You can either use the provided test accounts or create your own account. 
!!!Important: You need access to the email of these accounts in order to confirm change password/get invoice and tickets.
You can not create an account with the role admin or employee, only customer.

NOTE: You should provide an existing email.
```

### Installation
1. Install Docker Desktop on Windows or Mac, or Docker Engine on Linux.
1. Clone the project

### Usage
In a terminal, run:
```bash
docker-compose up
```

NGINX will now serve files in the app/public folder. Visit localhost in your browser to check.
PHPMyAdmin is accessible on localhost:8080

If you want to stop the containers, press Ctrl+C. 
Or run:
```bash
docker-compose down
```