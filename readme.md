```
GET（SELECT）：从服务器取出资源（一项或多项）。
POST（CREATE）：在服务器新建一个资源。
PUT（UPDATE）：在服务器更新资源（客户端提供改变后的完整资源）。
PATCH（UPDATE）：在服务器更新资源（客户端提供改变的属性）。
DELETE（DELETE）：从服务器删除资源。
```
### 分类 

```
显示所有分类 GET
url: api/cat
@param page      int
@param pagesize  int

@comment 其中返回数据中is_nav 为1 则在导航显示 0 不显示
@return 成功 ['code' => 200, data => array]
        失败 ['code' => 500, data => ErrorMsg]
```
```
添加分类 POST
url: api/cat
@param cat       string
@param cat_name  string

@return 成功 ['code' => 200, data => id]
        失败 ['code' => 500, data => ErrorMsg]
```
```
分类信息 GET
url: api/cat/id

@return 成功 ['code' => 200, data => array]
        失败 ['code' => 500, data => ErrorMsg]
```
```
修改分类 PATCH
url: api/cat/id
@param cat       string
@param cat_name  string

@return 成功 ['code' => 200, data => true]
        失败 ['code' => 500, data => ErrorMsg]
```
```
删除分类 DELETE
url: api/cat/id

@return 成功 ['code' => 200, data => true]
        失败 ['code' => 500, data => ErrorMsg]
```

### 文章 

```
显示所有文章 GET
url: api/post
@param page      int
@param pagesize  int

@comment 其中返回数据中is_nav 为1 则在导航显示 0 不显示
@return 成功 ['code' => 200, data => array]
        失败 ['code' => 500, data => ErrorMsg]
```
```
添加文章 POST
url: api/post
@param title      string
@param cat_id     int
@param content    text
@param author_id  int
@param tag_id     array
@param cat_name   string

@return 成功 ['code' => 200, data => id]
        失败 ['code' => 500, data => ErrorMsg]
```
```
文章信息 GET
url: api/post/id

@return 成功 ['code' => 200, data => array]
        失败 ['code' => 500, data => ErrorMsg]
```
```
修改文章 PATCH
url: api/post/id
@param title      string
@param cat_id     int
@param content    text
@param author_id  int
@param tag_id     array
@param cat_name   string

@return 成功 ['code' => 200, data => true]
        失败 ['code' => 500, data => ErrorMsg]
```
```
删除文章 DELETE
url: api/post/id

@return 成功 ['code' => 200, data => true]
        失败 ['code' => 500, data => ErrorMsg]
```

### 用户

```
添加用户 POST
url: api/user/signup
@param email      string
@param password   string
@param name       string

@return 成功 ['code' => 200, data => true]
        失败 ['code' => 500, data => ErrorMsg]
```
```
登陆 POST
url: api/user/signin
@param email      string
@param password   string

@return 成功 ['code' => 200, data => true]
        失败 ['code' => 500, data => ErrorMsg]
```
```
登出 POST
url: api/user/signout

@return 成功 ['code' => 200, data => true]
```
