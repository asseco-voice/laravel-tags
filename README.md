<p align="center"><a href="https://see.asseco.com" target="_blank"><img src="https://github.com/asseco-voice/art/blob/main/evil_logo.png" width="500"></a></p>

# Tags

Purpose of this repository is to provide tag support for any Laravel model. 

**Tag** can be added on any model, without the need to add new attributes 
to a DB model.

## Installation

Require the package with ``composer require asseco-voice/laravel-tags``.
Service provider will be registered automatically.

## Setup

In order to use this repository the following must be done:

1. Each model which requires custom field support MUST use ``Taggable`` trait. 
1. Run ``php artisan migrate`` to migrate package tables
2. On each model in store method in Controller add this lines
   ``
   $type = XXXX::query()->create(Arr::except($request->all(), 'tags'));
   $type->tags()->sync(Arr::get($request->all(), 'tags'));
   ``
## RestAPI calls

1. get all tags
```
GET /api/tags
```
2. add new tag
```
POST /api/tags
{
    "name": "my tag",
    "color": "#eee"
}
```
3. edit tag {id}
```
PUT /api/tags/{id}
{
    "name": "my tag",
    "color": "#eee"
}
```
4. delete tag {id}
```
DELETE /api/tags/{id}
```

5. add/update tags on some model
```
POST api/{model}
{
    ....
    "tags": [5,2, ...],
    ...
}
```

// TODO: ER model
