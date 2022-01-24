
------------
This is a API for `Blog ` use JWT authorization

Installation
------------


```
composer install
```

Then create .env file and edit database credentials there

```
cp .env.example .env
```
After run command you can find .env has copy from .env.example

Then generate APP_KEY
```
php artisan key:generate
```
After run command you can find APP_KEY in .env file has created

Create JWT key
```
php artisan jwt:secret
```

Final migrate database table. if want to seed some data you can add "--seed" after the command line
```
php artisan migrate
```

Start serve
```
php artisan serve
```
Then [http://127.0.0.1:8000/api](http://127.0.0.1:8000/api) will work.

Start
-----
 ### You also can see `api doc` [here](http://localhost/Post/public/docs/index.html)


End Point | Description | Method | Auth | 
|---|---|---|---|
| [api/register](http://127.0.0.1:8000/api/register) | Register User Account | POST | No |
| [api/login](http://127.0.0.1:8000/api/login) | Log User In  | POST | No |
| [api/logout](http://127.0.0.1:8000/api/logout) | Log User Out  | POST | Yes |
| [api/users](http://127.0.0.1:8000/api/users) | Show User Information  | GET | Yes |
| [api/users.posts](http://127.0.0.1:8000/api/users.posts) | Show all posts of  Auth Users  | GET | Yes |
| [api/users.comments](http://127.0.0.1:8000/api/users.comments) | Show all comments of  Auth Users  | GET | Yes |
| [api/posts](http://127.0.0.1:8000/api/posts) | Show All Posts  | GET | No |
| [api/posts/{post}](http://127.0.0.1:8000/api/posts/1}) | Show Specified Post  | GET | No |
| [api/posts](http://127.0.0.1:8000/api/posts) | Create Post  | POST | Yes |
| [api/posts](http://127.0.0.1:8000/api/posts) | Update Post  | PUT | Yes |
| [api/posts/{post}](http://127.0.0.1:8000/api/posts/1) | Delete Specified Post  | DELETE | Yes |
| [api/comments](http://127.0.0.1:8000/api/comments) | Get All Comments  | GET | No |
| [api/comments/{comment}](http://127.0.0.1:8000/api/commenst/1}) | Show Specified Comment  | GET | No |
| [api/comments](http://127.0.0.1:8000/api/comments) | Update Comment  | PUT | Yes |
| [api/comments/{comment}](http://127.0.0.1:8000/api/comments/1) | Delete Specified Comment  | DELETE | Yes |
| [api/posts.comments](http://127.0.0.1:8000/api/posts.comments) | Create Comment of Post  | POST | Yes |
| [api/posts.comments/{post}](http://127.0.0.1:8000/api/posts.comments/1) | Show Comments of Post  | GET | No |
| [api/posts/{post}/likes](http://127.0.0.1:8000/api/posts/1/likes) | Can Like Posts  | POST | Yes |
| [api/posts/{post}/likes](http://127.0.0.1:8000/api/posts/1/likes) | Show Specified Post Total Likes  | GET | No |
| [api/comments/{comment}/likes](http://127.0.0.1:8000/api/comments/1/likes) | Can Like Comments  | POST | Yes |
| [api/users.follow](http://127.0.0.1:8000/api/users.follow) | User Can Follow Other User  | POST | Yes |
| [api/users.following](http://127.0.0.1:8000/users.following) | Show User's Following  | GET | No |
| [api/users.follower](http://127.0.0.1:8000/users.follower) | Show User's Follower | GET | No |
| [api/dashboard/users](http://127.0.0.1:8000/api/dashboard/users) | Search The Users By Keyword.  | GET | No |
| [api/dashboard/posts](http://127.0.0.1:8000/api/dashboard/posts) | Search The Posts By Keyword.  | GET | No |
| [api/dashboard/comments](http://127.0.0.1:8000/api/dashboard/comments) | Search The Comments By Keyword.  | GET | No |

