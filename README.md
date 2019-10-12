# 功能列表
	
> 此文件是 [项目文档编写规范](https://laravel-china.org/courses/laravel-specification/524/project-documentation-specification) 的 readme 编写范例，点击 [我要改进](https://laravel-china.org/courses/articles/523/patches/create) 即可查看其 Markdown 内容。

## 项目概述

* 产品名称：LaraBBS
* 项目代号：ball
* 官方地址：https://laravel-china.org/topics/6592

LaraBBS 是一个简洁的论坛应用，使用 Laravel5.5 编写而成。一步步开发此项目的教程请见 [《Web 开发实战进阶  - 从零开始构建论坛系统》](https://laravel-china.org/topics/6592)。

![](https://lccdn.phphub.org/uploads/images/201711/01/1/xcr6ijTArV.png)

## 功能如下

- 用户认证 —— 注册、登录、退出；
- 个人中心 —— 用户个人中心，编辑资料；
- 用户授权 —— 作者才能删除自己的内容；
- 上传图片 —— 修改头像和编辑话题时候上传图片；
- 表单验证 —— 使用表单验证类；
- 文章发布时自动 Slug 翻译，支持使用队列方式以提高响应；
- 站点『活跃用户』计算，一小时计算一次；
- 多角色权限管理 —— 允许站长，管理员权限的存在；
- 后台管理 —— 后台数据模型管理；
- 邮件通知 —— 发送新回复邮件通知，队列发送邮件；
- 站内通知 —— 话题有新回复；
- 自定义 Artisan 命令行 —— 自定义活跃用户计算命令；
- 自定义 Trait —— 活跃用户的业务逻辑实现；
- 自定义中间件 —— 记录用户的最后登录时间；
- XSS 安全防御；

## 运行环境要求

- Apache 2.4+
- PHP 7.1+
- Mysql 5.7+
- Redis 4.0+
- Memcached 1.4+

## 开发环境部署/安装

本项目代码使用 PHP 框架 [Laravel 5.5](https://d.laravel-china.org/docs/5.5/) 开发，本地开发环境使用 [Laravel Homestead](https://d.laravel-china.org/docs/5.5/homestead)。

下文将在假定读者已经安装好了 Homestead 的情况下进行说明。如果您还未安装 Homestead，可以参照 [Homestead 安装与设置](https://laravel-china.org/docs/5.5/homestead#installation-and-setup) 进行安装配置。

### 基础安装

#### 1. 克隆源代码到本地：

    > git clone https://git.coding.net/ahwangtao/ball.git

#### 2. 安装扩展包依赖

	composer install

#### 3. 生成配置文件

```
cp .env.example .env
```

#### 4. 生成秘钥

```shell
php artisan key:generate
```

你可以根据情况修改 `.env` 文件里的内容，如数据库连接、缓存、邮件设置等：

```
APP_URL=http://ball.work
...
DB_HOST=localhost
DB_DATABASE=ball
DB_USERNAME=homestead
DB_PASSWORD=secret
```

#### 5. 生成数据表及生成测试数据

```shell
$ php artisan migrate --seed
```

### 前端框架安装

1). 安装 node.js

直接去官网 [https://nodejs.org/en/](https://nodejs.org/en/) 下载安装最新版本。

2). 安装 Yarn

请按照最新版本的 Yarn —— http://yarnpkg.cn/zh-Hans/docs/install

3). 安装 Laravel Mix

```shell
yarn install
```

4). 编译前端内容

```shell
// 运行所有 Mix 任务...
npm run dev

// 运行所有 Mix 任务并缩小输出..
npm run production
```

5). 监控修改并自动编译

```shell
npm run watch

// 在某些环境中，当文件更改时，Webpack 不会更新。如果系统出现这种情况，请考虑使用 watch-poll 命令：

npm run watch-poll
```

### 链接入口

* 首页地址：http://ball.work/
* 管理后台：http://ball.work/admin

管理员账号密码如下:

```
username: admin@ball.com
password: password
```

至此, 安装完成 ^_^。

## 服务器架构说明

这里可以放一张大大的服务器架构图，下面是个例子：

![file](https://fsdhubcdn.phphub.org/uploads/images/201705/20/1/1G6aQPAZym.png)

> 上图使用工具 [ProcessOn](https://www.processon.com) 绘制。


## 扩展包使用情况

| 扩展包 | 一句话描述 | 本项目应用场景 |
| --- | --- | --- | --- | --- | --- | --- | --- |
| [overtrue/laravel-lang](https://github.com/overtrue/laravel-lang) | 语言中文库 | 用于返回中文验证信息 |
| [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper) | IDE 开发提示 | 支持 Facade 方法跳转 |
| [davejamesmiller/laravel-breadcrumbs](https://packagist.org/packages/davejamesmiller/laravel-breadcrumbs#4.2.0) | 面包屑导航 | 为页面进行导航 |
| [spatie/laravel-menu](http://laravelacademy.org/post/3733.html) | 菜单栏 | 后台管理菜单栏 |
| [Intervention/image](https://github.com/Intervention/image) | 图片处理功能库 | 用于图片裁切 |
| [guzzlehttp/guzzle](https://github.com/guzzle/guzzle) | HTTP 请求套件 | 请求百度翻译 API  |
| [predis/predis](https://github.com/nrk/predis.git) | Redis 官方首推的 PHP 客户端开发包 | 缓存驱动 Redis 基础扩展包 |
| [barryvdh/laravel-debugbar](https://github.com/barryvdh/laravel-debugbar) | 页面调试工具栏 (对 phpdebugbar 的封装) | 开发环境中的 DEBUG |
| [spatie/laravel-permission](https://github.com/spatie/laravel-permission) | 角色权限管理 | 角色和权限控制 |
| [mewebstudio/Purifier](https://github.com/mewebstudio/Purifier) | 用户提交的 Html 白名单过滤 | 帖子内容的 Html 安全过滤，防止 XSS 攻击 |
| [hieu-le/active](https://github.com/letrunghieu/active) | 选中状态 | 顶部导航栏选中状态 |
| [summerblue/administrator](https://github.com/summerblue/administrator) | 管理后台 | 模型管理后台、配置信息管理后台 |
| [viacreative/sudo-su](https://github.com/viacreative/sudo-su) | 用户切换 | 开发环境中快速切换登录账号 |
| [laravel/horizon](https://github.com/laravel/horizon) | 队列监控 | 队列监控命令与页面控制台 /horizon |


## 自定义 Artisan 命令

| 命令行名字 | 说明 | Cron | 代码调用 |
| --- | --- | --- | --- |
| `ball:calculate-active-user` |  生成活跃用户 | 一小时运行一次 | 无 |
| `ball:sync-user-actived-at` | 从 Redis 中同步最后登录时间到数据库中 | 每天早上 0 点准时 | 无 |

## 队列清单

| 名称 | 说明 | 调用时机 |
| --- | --- | --- |
| TranslateSlug.php | 将话题标题翻译为 Slug | TopicObserver 事件 saved() |
| TopicReplied.php | 通知作者话题有新回复 | 话题被评论以后 |

