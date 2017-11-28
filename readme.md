### 分类 

```
显示所有分类
url: api/cat/index
@param page      int
@param pagesize  int

@comment 其中返回数据中is_nav 为1 则在导航显示 0 不显示
@return 成功 ['code' => 200, data => array]
        失败 ['code' => 500, data => ErrorMsg]
```
```
添加分类
url: api/cat/store
@param cat       string
@param cat_name  string

@return 成功 ['code' => 200, data => id]
        失败 ['code' => 500, data => ErrorMsg]
```
```
分类信息
url: api/cat/show/id

@return 成功 ['code' => 200, data => array]
        失败 ['code' => 500, data => ErrorMsg]
```
```
修改分类
url: api/cat/update/id
@param cat       string
@param cat_name  string

@return 成功 ['code' => 200, data => true]
        失败 ['code' => 500, data => ErrorMsg]
```
```
删除分类
url: api/cat/destroy/id

@return 成功 ['code' => 200, data => true]
        失败 ['code' => 500, data => ErrorMsg]
```

### 文章 

```
显示所有文章
url: api/post/index
@param page      int
@param pagesize  int

@comment 其中返回数据中is_nav 为1 则在导航显示 0 不显示
@return 成功 ['code' => 200, data => array]
        失败 ['code' => 500, data => ErrorMsg]
```
```
添加文章
url: api/post/store
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
文章信息
url: api/post/show/id

@return 成功 ['code' => 200, data => array]
        失败 ['code' => 500, data => ErrorMsg]
```
```
修改文章
url: api/post/update/id
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
删除文章
url: api/post/destroy/id

@return 成功 ['code' => 200, data => true]
        失败 ['code' => 500, data => ErrorMsg]
```

### 用户

```
添加用户
url: api/user/signup
@param email      string
@param password   string
@param name       string

@return 成功 ['code' => 200, data => true]
        失败 ['code' => 500, data => ErrorMsg]
```
```
登陆
url: api/user/signin
@param email      string
@param password   string

@return 成功 ['code' => 200, data => true]
        失败 ['code' => 500, data => ErrorMsg]
```
```
登出
url: api/user/signout

@return 成功 ['code' => 200, data => true]
```
