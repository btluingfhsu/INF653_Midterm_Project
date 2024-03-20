Midterm Project for INF653
Brian Luing


This is an API written using php with a PostgreSQL database.
The project URL is https://luing.me/api



Luing.me API Documentation
Welcome to the documentation for the quotes API. This guide provides detailed information on how to interact with our API to access and manipulate data related to authors, categories, and quotes. The API is RESTful and uses standard HTTP methods (GET, POST, PUT, DELETE) for requests and responses. JSON is the supported datatype.

Base URL
https://luing.me/api

Endpoints Overview


Authors:

Retrieve all authors
Add a new author
Update an author
Delete an author

Categories:

Retrieve all categories
Add a new category
Update a category
Delete a category

Quotes:

Retrieve all quotes
Add a new quote
Update a quote
Delete a quote



Authors Endpoint:
GET /authors
Retrieves a list of all authors.

Body Parameters:

author (string, required): The name of the author.

PUT /authors
Updates an existing author's details.


Categories Endpoint:
GET /categories
Retrieves a list of all categories.

Content: [{"id": 1, "category": "Category Name"}, ...]
POST /categories
Adds a new category to the database.

category (string, required): The name of the category.

Content: {"id": 1, "category": "New Category Name"}
PUT /categories
Updates an existing category's details.

id (integer, required): The ID of the category to update.
Body Parameters:

name (string, required): The new name of the category.
Success Response:

Content: {"id": 1, "category": "Updated Category Name"}
DELETE /categories
Deletes a category from the database.

id (integer, required): The ID of the category to delete.


Quotes Endpoint:
GET /quotes
Retrieves a list of all quotes.

Query Parameters:

authorId (integer, optional): Filter quotes by author ID.
categoryId (integer, optional): Filter quotes by category ID.

Content: [{"authorId": "1", "Quote": "Quote text", "categoryId": "1"}, ...]
POST /quotes
Adds a new quote to the database.

quote (string, required): The text of the quote.
authorId (integer, required): The ID of the author of the quote.
categoryId (integer, required): The ID of the category of the quote.

Content: {"quote": "New Quote", "authorId": 1, "categoryId": 1}
PUT /quotes
Updates an existing quote's details.