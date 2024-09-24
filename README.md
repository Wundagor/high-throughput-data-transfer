# High Throughput Data Transfer

**High Throughput Data Transfer** is a solution designed for efficient and scalable transfer of large datasets using RabbitMQ as a message broker. It leverages Laravel to queue data from a source (e.g., a database) and transfer it to RabbitMQ for further processing or consumption by external systems.

This repository is particularly focused on handling large volumes of data, optimizing performance, and ensuring memory-efficient operations.

## Features

- **RabbitMQ Integration**: Utilize RabbitMQ as a reliable and scalable message broker.
- **Command-based Interface**: Use Laravel commands to initiate data transfer operations.
- **Scalability**: Designed to handle large datasets and high-throughput data transfer with minimal memory overhead.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)

## Prerequisites

Before setting up the project, make sure you have the following installed:

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/high-throughput-data-transfer.git
cd high-throughput-data-transfer
```

### 2. Set Up Environment Variables

```bash
cp .env.example .env
```

### 3. Set Up Environment Variables

```bash
docker-compose up -d
```

### 4. Run Migrations

```bash
docker-compose exec app php artisan migrate
```

### 5. Run Seeders

```bash
docker-compose exec app php artisan db:seed
```

### 6. Usage

```bash
docker-compose exec app php artisan app:send-source-data
```
