# GitHub Copilot Hackathon Part 2: Bonus Exercises

Welcome to Bonus Part of the Copilot PHP Hackathon! These exercises build on your beginner skills and guide you through modernizing, scaling, and securing your PHP Task Manager project. You'll work with containers, databases, APIs, and best practices for real-world development.

---

## Exercise 1: Dockerize the Application

1. **Create a Dockerfile**
   - Containerize the PHP application.
   - Use official PHP images and install required extensions.
2. **Write a `docker-compose.yml`**
   - Define services for PHP, PostgreSQL, and optionally Nginx/Apache.
   - Configure environment variables for DB credentials.
3. **Run the app in containers**
   - Start all services with `docker-compose up`.
   - Verify the app is accessible and connected to the database.

---

## Exercise 2: PostgreSQL Backend Integration

1. **Set up PostgreSQL container**
   - Configure persistent storage and initial database/schema.
2. **Design database schema**
   - Create tables for tasks, comments, and tags.
   - Define relationships and constraints.
3. **Refactor PHP backend**
   - Replace JSON storage with PostgreSQL using PDO or an ORM.
   - Implement CRUD operations for all entities.
4. **Migrate existing data**
   - Write a script to import JSON data into PostgreSQL tables.

---

## Exercise 3: Testing & CI/CD

1. **Add PHPUnit tests for DB logic**
   - Test CRUD operations and edge cases.
2. **Integrate with CI pipeline**
   - Set up GitHub Actions or similar to run tests on push/PR.
   - Use a test database container for integration tests.

---

## Exercise 4: Security & Best Practices

1. **Secure credential management**
   - Use `.env` files or Docker secrets for sensitive data.
2. **Input validation & sanitization**
   - Prevent SQL injection and XSS in all DB queries.
3. **Authentication/Authorization**
   - Add user login and restrict access to sensitive endpoints.

---

## Exercise 5: Advanced Features

1. **Implement RESTful API endpoints**
   - Expose CRUD operations for tasks, comments, and tags.
2. **Add pagination, filtering, and sorting**
   - Enhance API responses for scalability.
3. **Create a frontend client (optional)**
   - Build a simple React/Vue/Angular app to consume the API.

---

## Exercise 6: Performance & Monitoring

1. **Optimize DB queries and indexing**
   - Analyze and improve query performance.
2. **Integrate logging and monitoring**
   - Add basic logging and health check endpoints.
   - (Optional) Use Prometheus/Grafana for metrics.

---

## Exercise 7: Documentation & Developer Experience

1. **Update README for Docker usage**
   - Add setup, run, and troubleshooting instructions.
2. **Document API endpoints**
   - Use OpenAPI/Swagger or markdown tables.
3. **Onboarding instructions**
   - Guide new contributors through setup and development.

---

Happy hacking with GitHub Copilot!
