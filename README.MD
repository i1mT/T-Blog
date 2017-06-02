Welcome to the T-Blog!
![博客首页](http://i4.buimg.com/4899/f52e108f18befc7e.png)
## 介绍
这是一个轻量级的个人博客系统，整个系统只有3M。

在我以前用其他博客系统的时候，我就想，一个程序员的博客后台怎么能和别人一样呢？

所以它诞生了，T-Blog的后台操作都是用shell命令来完成的，岂不是很酷？
![Shell命令行管理后台](http://i4.buimg.com/4899/3ef892d4321fd62b.png)

## T-Blog的特别之处
除此之外，作为程序员，写博客是一定会用Markdown语句的，所以T-Blog也必须要支持Markdown语法。

你可以通过两种方式发布博文，后台编辑或上传Markdown文件。

集成了评论功能，让你不用再去选择第三方社会化评论系统，小而实用即可不是么？


## 如何安装？
`git clone git@github.com:tfh93121/T-Blog.git`

或下载该仓库的zip压缩包

将解压内容全部上传到你要安装的博客的服务器，访问该路径，会开始安装。

我在这里录了一个视频来讲这个博客系统的安装和一些操作，如果你有需要的话可以看看。

[视频地址]()

## 如何使用
### 后台Shell命令
我将后台命令分为四个部分，他们分别是

**set 设置类**

**article 文章类**

**comment 评论类**

还有三个全局操作**login登录**与**logout退出**以及**clear清屏**

让我先给你介绍上面这三个全局操作(即不用登录可用命令)

`iimt login "你设置的管理用户名" "密码"`登录操作，回车提交之后会改变你的登录状态

`iimt logout`会将当前登录状态设置为false

`clear` 当你觉得界面显示的语句太多的时候，可以用它来清屏

**set 设置类**

`iimt set blogname "你要设置的博客名"` 设置博客名，即博客标题

`iimt set blogdesc "你要设置的博客描述"` 设置博客描述 这会在SEO中起作用

`iimt set blogurl "你要设置的博客首页地址"` 设置博客首页地址

**article 文章类**

`iimt article publish` 发布文章 它会先让你填写一些诸如标题 分类 封面图片地址等信息，之后会进入编辑模式，你可以直接在后台写markdown也可以选择上传文件。

若是你要直接在后台编辑的话，在你写完之后，在末尾写`@END` 回车提交，将会发布这篇你博文。

如果你要上传文件，填写文件在本地的路径之后在末尾写`@UPF` 回车提交，将会读取这个MD文件的内容将其发布。

`iimt article showall "页数"` 这会显示当前所有的文章,若你不填写页数，会显示第一页的内容，并告诉你一共有多少页

`iimt artile update "文章id"` 这会更新该id的文章，操作将会与发布文章相同，你可以先`iimt article showall`来得到id之后来选择更改哪一篇文章。

`iimt article delete "文章id"` 这会删除该id的文章

`iimt article search "要搜索的关键字"` 这会搜索所有包含该关键字的文章并输出，但是不会分页噢，因为搜索结果不会很多。

`iimt article showbycate "分类名" "页数"` 这会显示该分类下的所有文章，当然页数就不用我再说了吧

`iimt article showcomment "文章id" "页数"` 这会显示该id文章的所有评论，也支持页数

**comment 评论类**

`iimt comment delete "评论id"` 这会删除该id的评论

`iimt comment show "页数"`  这会显示所有的评论，支持页数提取 


### 你可能需要自定义的一些地方

>博客首页背景请更改`asset/images/yasuko.jpeg`请使用jpeg格式，否则请自行更改`header.php`63行。

>个人头像请更改`asset/images/avatar.jpg`

>打赏图片请更改`asset/images/admired-weixin.png`

>博客首页标题请更改`header.php`57、58以及个人介绍在67-70行。

>博文页中个人介绍请更改`article.php`74行。
