BiliBili-API摘录
================

首页
----

### 排行榜

>接口：https://api.bilibili.com/x/web-interface/ranking/region?rid=1&day=3&original=0

参数：
* rid 类目ID

    例：
    * 1=动画
    * 3=音乐
    * 168=国创


* day 排行时间

    可选：3/7

### 排行榜页
>接口：https://api.bilibili.com/x/web-interface/ranking/v2?rid=1&type=all

参数：
* rid 类目ID

>接口：https://api.bilibili.com/pgc/season/rank/web/list?day=3&season_type=4


UP主
----

### 用户信息
>接口：https://api.bilibili.com/x/space/acc/info?mid=37870958&jsonp=jsonp

### 用户视频列表
>接口：https://api.bilibili.com/x/space/arc/search?mid=37870958&ps=30&tid=0&pn=1&keyword=&order=pubdate&jsonp=jsonp

### 用户标签
>接口：https://api.bilibili.com/x/space/acc/tags?mid=37870958&jsonp=jsonp

### 用户公告
>接口：https://api.bilibili.com/x/space/notice?mid=37870958&jsonp=jsonp

### 代表作
>接口：https://api.bilibili.com/x/space/masterpiece?vmid=37870958&jsonp=jsonp

### 用户关注
>接口：https://api.bilibili.com/x/relation/stat?vmid=37870958&jsonp=jsonp
