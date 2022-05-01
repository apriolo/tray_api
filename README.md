
# Teste Tray
Create a system to save Seller and Sales, Sellers has 8.5% of comission.
This project is based on a API developed with Laravel 9.X and a Frontend developed with Vue.JS
The project running with docker-compose
## API Backend

- Method Create Seller
- Method Create Sale
- Method Get all Sellers
- Method Get all Sales by a Seller
- Send a Daily Report by Email at every 20:00


## Commands

First need install the project and build on docker(need docker installed [install here](https://www.github.com/octokatherine))

UP Containers
```bash
  sudo docker-compose up -d --build
```
After up, need execute composer install
```bash
  sudo docker-compose run composer install
```

After install, need execute the migrations and seeders of backend
```bash
  sudo docker-compose run artisan migrate --seed
```

To install frontend
```bash
  sudo docker exec -ti laravel-project_front_1 /bin/sh
  npm install
```
The backend laravel will be running on: http://localhost:7000/

The frontend Vue.JS will be running on:  http://localhost:8080/

## API Documentation

#### Return Sellers

```http
  GET /api/sellers
```

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
|  | |  |

Response
```
"status": "GET",
"data": [
  {
      "id": 1,
      "name": "Seller Name",
      "email": "goldner.candelario@example.org",
      "comission": "415.99"
  },
]

```


#### Add Seller

```http
  POST /api/sellers
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `name`      | `string` | **Required**. The seller name |
| `email`      | `email` | **Required/unique**. A valid email |

Response
```
"status": "Created",
"data": {
    "id": 13,
    "name": "Teste Tray",
    "email": "tray@teste.com"
}
```

#### Add Sale

```http
  POST /api/sales
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `value`      | `double` | **Required**. The sale amount |
| `seller_id`      | `id` | **Required**. Seller id previously added |

Response
```
"status": "Created",
"data": {
    "id": 13,
    "name": "Teste Tray",
    "email": "tray@teste.com"
}
```

#### Get sales by seller

```http
  GET /api/sales/seller/{id}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `id`      | `url param` | **Required**. Seller id on URL PARAM |

Response
```
"status": "GET",
"data": {
"seller": {
    "name": "Teste Tray",
    "email": "tray@teste.com"
},
"sales": [
    {
        "id": 23,
        "date": "2022-05-01 22:00:20",
        "value": "200.00",
        "comission": "17.00",
        "seller_id": 13,
        "name": "Teste Tray",
        "email": "tray@teste.com"
    },
    {
        "id": 24,
        "date": "2022-05-01 22:00:27",
        "value": "214.00",
        "comission": "18.19",
        "seller_id": 13,
        "name": "Teste Tray",
        "email": "tray@teste.com"
    }
]
}
```
## Screenshots

### Home Page
#### GET all sellers with comission
![image](https://user-images.githubusercontent.com/77355017/166166407-59746e10-ba51-41b9-a34a-b0c7676a6c2b.png)

### Add Seller
#### Success
![image](https://user-images.githubusercontent.com/77355017/166166528-a39d5af8-c19c-4692-a3a0-15abbc102c38.png)
##### Result
![image](https://user-images.githubusercontent.com/77355017/166166562-e7fb0d3d-29b2-4e22-91b6-d940febe4413.png)


#### Error
![image](https://user-images.githubusercontent.com/77355017/166166591-449344a0-6e54-4947-9e4d-b3eeea7584b3.png)
##### Result
![image](https://user-images.githubusercontent.com/77355017/166166621-268ac0ad-d8b6-4bfc-8bfc-e226e666d9a0.png)


### Add Sale
#### Success
![image](https://user-images.githubusercontent.com/77355017/166166686-454f428a-6239-4029-8589-1cbe7b39097e.png)
##### Result
![image](https://user-images.githubusercontent.com/77355017/166166698-d7b84400-182e-4057-a2f5-868a06d46e49.png)

#### Error
![image](https://user-images.githubusercontent.com/77355017/166166714-bea6ef11-a269-4da4-ab29-f2ab3626aac7.png)

### Get Sales by Seller
#### On home page click on names
![image](https://user-images.githubusercontent.com/77355017/166166775-e3f2b1ee-f88a-4b31-b178-8483e0dee584.png)




