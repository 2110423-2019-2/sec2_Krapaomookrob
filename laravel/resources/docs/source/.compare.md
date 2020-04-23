---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_aafb8541c7187becfa6d84ea038751bf -->
## tutor/payment-request
> Example request:

```bash
curl -X GET \
    -G "http://localhost/tutor/payment-request" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/tutor/payment-request"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET tutor/payment-request`


<!-- END_aafb8541c7187becfa6d84ea038751bf -->

<!-- START_5106e03becc06793cdc34a2370987fd9 -->
## admin/payment-request
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/payment-request" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/payment-request"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET admin/payment-request`


<!-- END_5106e03becc06793cdc34a2370987fd9 -->

<!-- START_ba35aa39474cb98cfb31829e70eb8b74 -->
## Handle a login request to the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST login`


<!-- END_ba35aa39474cb98cfb31829e70eb8b74 -->

<!-- START_e65925f23b9bc6b93d9356895f29f80c -->
## logout
> Example request:

```bash
curl -X POST \
    "http://localhost/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST logout`


<!-- END_e65925f23b9bc6b93d9356895f29f80c -->

<!-- START_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->
## Show the application registration form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET register`


<!-- END_ff38dfb1bd1bb7e1aa24b4e1792a9768 -->

<!-- START_d7aad7b5ac127700500280d511a3db01 -->
## Handle a registration request for the application.

> Example request:

```bash
curl -X POST \
    "http://localhost/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST register`


<!-- END_d7aad7b5ac127700500280d511a3db01 -->

<!-- START_d72797bae6d0b1f3a341ebb1f8900441 -->
## Display the form to request a password reset link.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET password/reset`


<!-- END_d72797bae6d0b1f3a341ebb1f8900441 -->

<!-- START_feb40f06a93c80d742181b6ffb6b734e -->
## Send a reset link to the given user.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/email" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/email"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/email`


<!-- END_feb40f06a93c80d742181b6ffb6b734e -->

<!-- START_e1605a6e5ceee9d1aeb7729216635fd7 -->
## Display the password reset view for the given token.

If no token is present, display the link request form.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/reset/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET password/reset/{token}`


<!-- END_e1605a6e5ceee9d1aeb7729216635fd7 -->

<!-- START_cafb407b7a846b31491f97719bb15aef -->
## Reset the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/reset`


<!-- END_cafb407b7a846b31491f97719bb15aef -->

<!-- START_b77aedc454e9471a35dcb175278ec997 -->
## Display the password confirmation view.

> Example request:

```bash
curl -X GET \
    -G "http://localhost/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET password/confirm`


<!-- END_b77aedc454e9471a35dcb175278ec997 -->

<!-- START_54462d3613f2262e741142161c0e6fea -->
## Confirm the given user&#039;s password.

> Example request:

```bash
curl -X POST \
    "http://localhost/password/confirm" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/password/confirm"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST password/confirm`


<!-- END_54462d3613f2262e741142161c0e6fea -->

<!-- START_7533e68a2349b77ce14d97a071091273 -->
## result/{paymentID}/{isAdvertisement}/{courseId}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/result/1/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/result/1/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET result/{paymentID}/{isAdvertisement}/{courseId}`


<!-- END_7533e68a2349b77ce14d97a071091273 -->

<!-- START_56a433ed7c7527cb6fea32eaf330cf13 -->
## api/course/subjects
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/course/subjects" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/course/subjects"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/course/subjects`


<!-- END_56a433ed7c7527cb6fea32eaf330cf13 -->

<!-- START_8463bd4c17b0745ac89fca44b09f75db -->
## api/course/days
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/course/days" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/course/days"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/course/days`


<!-- END_8463bd4c17b0745ac89fca44b09f75db -->

<!-- START_3582c3a15d6ca42de352ef0ffce6526a -->
## api/course/new
> Example request:

```bash
curl -X POST \
    "http://localhost/api/course/new" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/course/new"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/course/new`


<!-- END_3582c3a15d6ca42de352ef0ffce6526a -->

<!-- START_e00269cb4bd5225d0fa1a47fc2ae6374 -->
## search-courses
> Example request:

```bash
curl -X GET \
    -G "http://localhost/search-courses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/search-courses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET search-courses`


<!-- END_e00269cb4bd5225d0fa1a47fc2ae6374 -->

<!-- START_9b4a018b37214ae126fbba41a866a057 -->
## api/fetch-tutors
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/fetch-tutors" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/fetch-tutors"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/fetch-tutors`


<!-- END_9b4a018b37214ae126fbba41a866a057 -->

<!-- START_3147d0c7748e20d4f752248a549f7c91 -->
## api/fetch-days
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/fetch-days" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/fetch-days"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/fetch-days`


<!-- END_3147d0c7748e20d4f752248a549f7c91 -->

<!-- START_88674e76a858288751780ada845e8a18 -->
## api/fetch-subjects
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/fetch-subjects" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/fetch-subjects"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/fetch-subjects`


<!-- END_88674e76a858288751780ada845e8a18 -->

<!-- START_819fc5ec458eb23592a6d3ee484a2c7b -->
## api/search-courses
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/search-courses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/search-courses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/search-courses`


<!-- END_819fc5ec458eb23592a6d3ee484a2c7b -->

<!-- START_70e675c3d10dc057fad05cc1fa45c6d3 -->
## tutor-search
> Example request:

```bash
curl -X GET \
    -G "http://localhost/tutor-search" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/tutor-search"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET tutor-search`


<!-- END_70e675c3d10dc057fad05cc1fa45c6d3 -->

<!-- START_5a7f70cde40d9aeef6079c62a4849bcc -->
## api/tutor-request
> Example request:

```bash
curl -X POST \
    "http://localhost/api/tutor-request" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/tutor-request"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/tutor-request`


<!-- END_5a7f70cde40d9aeef6079c62a4849bcc -->

<!-- START_f56be9eb5c398fdb6a9fbaa698ccfae3 -->
## api/tutor-search-courses
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/tutor-search-courses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/tutor-search-courses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/tutor-search-courses`


<!-- END_f56be9eb5c398fdb6a9fbaa698ccfae3 -->

<!-- START_7b5f90bc89e715b6d99aed47f6cd05ac -->
## Login for developer

> Example request:

```bash
curl -X GET \
    -G "http://localhost/login-dev/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login-dev/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET login-dev/{id}`


<!-- END_7b5f90bc89e715b6d99aed47f6cd05ac -->

<!-- START_568bd749946744d2753eaad6cfad5db6 -->
## logout
> Example request:

```bash
curl -X GET \
    -G "http://localhost/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (302):

```json
null
```

### HTTP Request
`GET logout`


<!-- END_568bd749946744d2753eaad6cfad5db6 -->

<!-- START_f8e23df123cf972b9863d86c6413e1cd -->
## Social Login

> Example request:

```bash
curl -X GET \
    -G "http://localhost/login/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET login/{provider}`


<!-- END_f8e23df123cf972b9863d86c6413e1cd -->

<!-- START_dc6e1016b832bfbd32be18e2ebaaf8e5 -->
## login/{provider}/callback
> Example request:

```bash
curl -X GET \
    -G "http://localhost/login/1/callback" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/login/1/callback"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET login/{provider}/callback`


<!-- END_dc6e1016b832bfbd32be18e2ebaaf8e5 -->

<!-- START_b36742f01aacc8a3d1b75436d95edc3e -->
## user-role
> Example request:

```bash
curl -X POST \
    "http://localhost/user-role" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/user-role"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST user-role`


<!-- END_b36742f01aacc8a3d1b75436d95edc3e -->

<!-- START_6c1682f4a40c1555254df708bf6b4a71 -->
## api/cart
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/cart" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/cart"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/cart`


<!-- END_6c1682f4a40c1555254df708bf6b4a71 -->

<!-- START_4d3525a594e12fc6677f1018800f5149 -->
## api/cart/remove
> Example request:

```bash
curl -X POST \
    "http://localhost/api/cart/remove" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/cart/remove"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/cart/remove`


<!-- END_4d3525a594e12fc6677f1018800f5149 -->

<!-- START_8a98c0732ee823c2427f72ce7a01e965 -->
## api/cart/add
> Example request:

```bash
curl -X POST \
    "http://localhost/api/cart/add" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/cart/add"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/cart/add`


<!-- END_8a98c0732ee823c2427f72ce7a01e965 -->

<!-- START_d33cff04ae354156f15047a8fd4f7129 -->
## api/cart/current
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/cart/current" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/cart/current"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/cart/current`


<!-- END_d33cff04ae354156f15047a8fd4f7129 -->

<!-- START_22fe4d134ac16dd1428b064e97f98ced -->
## api/getPayment
> Example request:

```bash
curl -X POST \
    "http://localhost/api/getPayment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/getPayment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/getPayment`


<!-- END_22fe4d134ac16dd1428b064e97f98ced -->

<!-- START_ae113e381e10223070bfcf6d9047fa7c -->
## payment/{payment_id}/{totalprice}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/payment/1/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/payment/1/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET payment/{payment_id}/{totalprice}`


<!-- END_ae113e381e10223070bfcf6d9047fa7c -->

<!-- START_968819d5d40c8f47db134292fe8d49b8 -->
## card
> Example request:

```bash
curl -X POST \
    "http://localhost/card" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/card"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST card`


<!-- END_968819d5d40c8f47db134292fe8d49b8 -->

<!-- START_7a9d13cc829ff8f1fb73618810975c69 -->
## internet
> Example request:

```bash
curl -X POST \
    "http://localhost/internet" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/internet"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST internet`


<!-- END_7a9d13cc829ff8f1fb73618810975c69 -->

<!-- START_730fba7f8bb75fe849a517a5d371e8d7 -->
## checkrefund
> Example request:

```bash
curl -X POST \
    "http://localhost/checkrefund" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/checkrefund"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST checkrefund`


<!-- END_730fba7f8bb75fe849a517a5d371e8d7 -->

<!-- START_a91add43c4e7eaa5b5a4c16080a6f3ec -->
## api/refundPayment
> Example request:

```bash
curl -X POST \
    "http://localhost/api/refundPayment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/refundPayment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/refundPayment`


<!-- END_a91add43c4e7eaa5b5a4c16080a6f3ec -->

<!-- START_fce4f7e7970d90934783d4cecbfe1287 -->
## admin/refund-request
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/refund-request" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/refund-request"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin/refund-request`


<!-- END_fce4f7e7970d90934783d4cecbfe1287 -->

<!-- START_2d5dd9b49221dec6452232c729d057c3 -->
## my-courses
> Example request:

```bash
curl -X GET \
    -G "http://localhost/my-courses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/my-courses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET my-courses`


<!-- END_2d5dd9b49221dec6452232c729d057c3 -->

<!-- START_11829b68c6ed559ef00694ed365bb476 -->
## api/course/cancel
> Example request:

```bash
curl -X POST \
    "http://localhost/api/course/cancel" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/course/cancel"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/course/cancel`


<!-- END_11829b68c6ed559ef00694ed365bb476 -->

<!-- START_35259c5b57b10c3051c80a4a91efd080 -->
## api/course/status/{course_id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/course/status/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/course/status/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/course/status/{course_id}`


<!-- END_35259c5b57b10c3051c80a4a91efd080 -->

<!-- START_f5654969b37737356ec6ae3f6e6de087 -->
## api/class/status/{class_id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/class/status/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/class/status/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/class/status/{class_id}`


<!-- END_f5654969b37737356ec6ae3f6e6de087 -->

<!-- START_9b57dac95c8736bf7851f9fc91dae0e7 -->
## api/user/role
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/user/role" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/role"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/user/role`


<!-- END_9b57dac95c8736bf7851f9fc91dae0e7 -->

<!-- START_b6226e824fb9d7ec9b7e33a390470a0f -->
## api/class/postpone
> Example request:

```bash
curl -X POST \
    "http://localhost/api/class/postpone" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/class/postpone"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/class/postpone`


<!-- END_b6226e824fb9d7ec9b7e33a390470a0f -->

<!-- START_47f7fbb6bf98ef4cdc54b10f03cb3bdd -->
## profile
> Example request:

```bash
curl -X GET \
    -G "http://localhost/profile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/profile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET profile`


<!-- END_47f7fbb6bf98ef4cdc54b10f03cb3bdd -->

<!-- START_5b90c17a62cbf7d23979e19df5771acf -->
## profile/edit
> Example request:

```bash
curl -X GET \
    -G "http://localhost/profile/edit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/profile/edit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET profile/edit`


<!-- END_5b90c17a62cbf7d23979e19df5771acf -->

<!-- START_0bc8678a369185b91c76c9f6a357c4bf -->
## profile
> Example request:

```bash
curl -X PATCH \
    "http://localhost/profile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/profile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "PATCH",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PATCH profile`


<!-- END_0bc8678a369185b91c76c9f6a357c4bf -->

<!-- START_1f77176999dc31712c5c03c021427059 -->
## tutor/profile/{user}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/tutor/profile/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/tutor/profile/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET tutor/profile/{user}`


<!-- END_1f77176999dc31712c5c03c021427059 -->

<!-- START_16fa401db7153d30f6baa8ee49059023 -->
## tutor/star/{user}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/tutor/star/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/tutor/star/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET tutor/star/{user}`


<!-- END_16fa401db7153d30f6baa8ee49059023 -->

<!-- START_50509e2bd68e5c9086f26756203d6197 -->
## review-course/{courseId}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/review-course/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/review-course/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET review-course/{courseId}`


<!-- END_50509e2bd68e5c9086f26756203d6197 -->

<!-- START_d4ba78424660bdba36dda78bfef5a60e -->
## api/review/course
> Example request:

```bash
curl -X POST \
    "http://localhost/api/review/course" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/review/course"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/review/course`


<!-- END_d4ba78424660bdba36dda78bfef5a60e -->

<!-- START_4fb25366280aa776535df05d0448a156 -->
## api/notification
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/notification" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/notification"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/notification`


<!-- END_4fb25366280aa776535df05d0448a156 -->

<!-- START_c6ce7598b78ac858523bbf4e9e70c11d -->
## api/notification/markRead
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/notification/markRead" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/notification/markRead"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/notification/markRead`


<!-- END_c6ce7598b78ac858523bbf4e9e70c11d -->

<!-- START_6820f1c86775dadbc3d696090c69e568 -->
## admin-panel/fetchUsers
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin-panel/fetchUsers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin-panel/fetchUsers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin-panel/fetchUsers`


<!-- END_6820f1c86775dadbc3d696090c69e568 -->

<!-- START_0a1523c0750dd4a2f5fb8b29da742364 -->
## admin-panel/fetchAdmins
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin-panel/fetchAdmins" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin-panel/fetchAdmins"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin-panel/fetchAdmins`


<!-- END_0a1523c0750dd4a2f5fb8b29da742364 -->

<!-- START_1ccf30163efadde089338d2ecd13d813 -->
## admin-panel/fetchAttendanceLogs
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin-panel/fetchAttendanceLogs" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin-panel/fetchAttendanceLogs"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin-panel/fetchAttendanceLogs`


<!-- END_1ccf30163efadde089338d2ecd13d813 -->

<!-- START_b66c8f58a6f3a748aa9f1ccc380f207a -->
## admin-panel/fetchCourseLogs
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin-panel/fetchCourseLogs" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin-panel/fetchCourseLogs"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin-panel/fetchCourseLogs`


<!-- END_b66c8f58a6f3a748aa9f1ccc380f207a -->

<!-- START_b97afdc4c14c6acffc181077d5b858a8 -->
## admin-panel/promoteAdmin/{email}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin-panel/promoteAdmin/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin-panel/promoteAdmin/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin-panel/promoteAdmin/{email}`


<!-- END_b97afdc4c14c6acffc181077d5b858a8 -->

<!-- START_f700acd3ecebea540c753e091b67b85c -->
## admin-panel/demoteAdmin/{email}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin-panel/demoteAdmin/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin-panel/demoteAdmin/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin-panel/demoteAdmin/{email}`


<!-- END_f700acd3ecebea540c753e091b67b85c -->

<!-- START_3459df297225d12a81fbe70ae4916c05 -->
## admin-panel/suspend/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin-panel/suspend/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin-panel/suspend/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin-panel/suspend/{id}`


<!-- END_3459df297225d12a81fbe70ae4916c05 -->

<!-- START_088aa6c69f79ec403b4adbdd739a5e34 -->
## api/user/bank-account
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/user/bank-account" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/bank-account"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/user/bank-account`


<!-- END_088aa6c69f79ec403b4adbdd739a5e34 -->

<!-- START_30e3ab5de2487cf35b173612605ffac7 -->
## api/user/balance
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/user/balance" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/user/balance"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/user/balance`


<!-- END_30e3ab5de2487cf35b173612605ffac7 -->

<!-- START_f8a77fbc89ce5864351b63d1493c314d -->
## api/payment-request/create
> Example request:

```bash
curl -X POST \
    "http://localhost/api/payment-request/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/payment-request/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/payment-request/create`


<!-- END_f8a77fbc89ce5864351b63d1493c314d -->

<!-- START_98f630df4f88431357964363c6d2ccb3 -->
## api/payment-request/my-requests
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/payment-request/my-requests" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/payment-request/my-requests"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Login required"
}
```

### HTTP Request
`GET api/payment-request/my-requests`


<!-- END_98f630df4f88431357964363c6d2ccb3 -->

<!-- START_9f23622d1aff3494d60f65da4a559be9 -->
## transfer
> Example request:

```bash
curl -X POST \
    "http://localhost/transfer" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/transfer"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST transfer`


<!-- END_9f23622d1aff3494d60f65da4a559be9 -->

<!-- START_07240ade8588098e0bfbe1e911229fb0 -->
## checktransfer
> Example request:

```bash
curl -X GET \
    -G "http://localhost/checktransfer" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/checktransfer"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET checktransfer`


<!-- END_07240ade8588098e0bfbe1e911229fb0 -->

<!-- START_5ff626c31f57d6e038f406ab40139806 -->
## api/get-balance
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/get-balance" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/get-balance"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET api/get-balance`


<!-- END_5ff626c31f57d6e038f406ab40139806 -->

<!-- START_42898012d3c6700475db51132814b855 -->
## api/update-balance
> Example request:

```bash
curl -X POST \
    "http://localhost/api/update-balance" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/update-balance"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/update-balance`


<!-- END_42898012d3c6700475db51132814b855 -->

<!-- START_7f8fcd741bc1d4e95536176e9b78cf00 -->
## admin-panel/getReports
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin-panel/getReports" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin-panel/getReports"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin-panel/getReports`


<!-- END_7f8fcd741bc1d4e95536176e9b78cf00 -->

<!-- START_0a4237258fbcecb923042456f1dbed53 -->
## admin-panel/readReport/{id}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin-panel/readReport/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin-panel/readReport/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin-panel/readReport/{id}`


<!-- END_0a4237258fbcecb923042456f1dbed53 -->

<!-- START_e6e6c1d8554f35a2b7ff48374ad1e77b -->
## report
> Example request:

```bash
curl -X POST \
    "http://localhost/report" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/report"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST report`


<!-- END_e6e6c1d8554f35a2b7ff48374ad1e77b -->

<!-- START_5ded17559dba6dcd3f3e9af9d73c1e0b -->
## api/my-calendar
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/my-calendar" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/my-calendar"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/my-calendar`


<!-- END_5ded17559dba6dcd3f3e9af9d73c1e0b -->

<!-- START_9bdfd3d883f7ddbbfb23832bdba41adb -->
## api/course-requests
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/course-requests" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/course-requests"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/course-requests`


<!-- END_9bdfd3d883f7ddbbfb23832bdba41adb -->

<!-- START_7faf20c52ef0acab41b7e3a2aab235e0 -->
## api/get-my-course-request
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/get-my-course-request" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/get-my-course-request"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/get-my-course-request`


<!-- END_7faf20c52ef0acab41b7e3a2aab235e0 -->

<!-- START_6cba5d308fc7c2a95ad76724c9199dcb -->
## api/decline-request
> Example request:

```bash
curl -X POST \
    "http://localhost/api/decline-request" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/decline-request"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/decline-request`


<!-- END_6cba5d308fc7c2a95ad76724c9199dcb -->

<!-- START_c93c635c03eb26d3b8eb53bde50b38b5 -->
## api/accept-request
> Example request:

```bash
curl -X POST \
    "http://localhost/api/accept-request" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/accept-request"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/accept-request`


<!-- END_c93c635c03eb26d3b8eb53bde50b38b5 -->

<!-- START_d16cf36f3404aeb5b6a25a30f27c0b0b -->
## api/delete-request
> Example request:

```bash
curl -X POST \
    "http://localhost/api/delete-request" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/delete-request"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/delete-request`


<!-- END_d16cf36f3404aeb5b6a25a30f27c0b0b -->

<!-- START_cf63672063047837975bf747ca416164 -->
## payment/create-advertisement
> Example request:

```bash
curl -X GET \
    -G "http://localhost/payment/create-advertisement" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/payment/create-advertisement"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```

### HTTP Request
`GET payment/create-advertisement`


<!-- END_cf63672063047837975bf747ca416164 -->

<!-- START_f3e727845acaf053c31e6483e436ee50 -->
## api/getAdsCourses
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/getAdsCourses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/getAdsCourses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/getAdsCourses`


<!-- END_f3e727845acaf053c31e6483e436ee50 -->

<!-- START_a79a5cf039be6b6c2b7fbfa9c79d5202 -->
## getAllVeritiedReport
> Example request:

```bash
curl -X GET \
    -G "http://localhost/getAllVeritiedReport" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/getAllVeritiedReport"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET getAllVeritiedReport`


<!-- END_a79a5cf039be6b6c2b7fbfa9c79d5202 -->

<!-- START_5cbbfa84eaf94f0cf69e682675efa11e -->
## getAllPaymentLog
> Example request:

```bash
curl -X GET \
    -G "http://localhost/getAllPaymentLog" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/getAllPaymentLog"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET getAllPaymentLog`


<!-- END_5cbbfa84eaf94f0cf69e682675efa11e -->

<!-- START_d3aa5293c69e5cc2c89b7babbb9d1541 -->
## getAllPostponement
> Example request:

```bash
curl -X GET \
    -G "http://localhost/getAllPostponement" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/getAllPostponement"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET getAllPostponement`


<!-- END_d3aa5293c69e5cc2c89b7babbb9d1541 -->

<!-- START_64d87c5627369b3ec2cb74e28af6644b -->
## getAllUserInfo
> Example request:

```bash
curl -X GET \
    -G "http://localhost/getAllUserInfo" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/getAllUserInfo"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET getAllUserInfo`


<!-- END_64d87c5627369b3ec2cb74e28af6644b -->

<!-- START_88c24e137344623b59f315b53c0e77f7 -->
## admin/log/{no}
> Example request:

```bash
curl -X GET \
    -G "http://localhost/admin/log/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/admin/log/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET admin/log/{no}`


<!-- END_88c24e137344623b59f315b53c0e77f7 -->

<!-- START_8ad5c7f6d1f75bb5024c088f26923198 -->
## api/classes-today
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/classes-today" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/classes-today"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/classes-today`


<!-- END_8ad5c7f6d1f75bb5024c088f26923198 -->

<!-- START_68acd0b93ab884a02970c84e51ae3aac -->
## api/check-class
> Example request:

```bash
curl -X POST \
    "http://localhost/api/check-class" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/check-class"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/check-class`


<!-- END_68acd0b93ab884a02970c84e51ae3aac -->

<!-- START_fb699844bcbda9139106a9662390f918 -->
## api/history-attendances
> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/history-attendances" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/history-attendances"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "message": "Server Error"
}
```

### HTTP Request
`GET api/history-attendances`


<!-- END_fb699844bcbda9139106a9662390f918 -->


