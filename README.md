# 🌇 Moyu Theme

一款用于个人博客的 WordPress 夕阳液态玻璃主题。

Moyu Theme 使用全屏晚霞背景、低模糊半透明玻璃面板、双栏首页和文章时间线，适合记录技术、生活与持续成长。

[🌐 在线博客](https://www.moyu.loan/) · [📦 下载源码](https://github.com/MoYu-code-bot/Blog/archive/refs/heads/main.zip)

![Moyu Theme 主题预览](screenshot.png)

---

## ✨ 主题特性

### 视觉与动画

- 夕阳晚霞全屏背景与深色沉浸式界面
- 20% 深色玻璃背景，`6px` 轻度模糊，保留清晰的背景细节
- 首次进入当前浏览器会话时播放“墨雨苏醒”入场动画
- 支持点击“跳过”或按 `Esc` 结束动画
- 自动尊重系统“减少动态效果”设置
- 桌面端鼠标流光跟随效果
- 宽屏双栏布局，移动端自动切换为单栏

### 文章与内容

- 首页展示最新 10 篇文章
- 独立文章归档页与分页
- 按年份展示文章时间线
- 支持特色图片、分类、标签、发布日期、更新时间和预计阅读时间
- 支持上一篇/下一篇导航及 WordPress 原生评论系统
- 支持深色代码块和行内代码样式

### 个性化资料

- 可在 WordPress 自定义器中修改网站背景、顶部名称和个人资料
- 可编辑头像、简介、技能、个人标签、网站链接和 GitHub 链接
- 自动展示文章数量、全站浏览量、常用标签和最近更新
- 不采集访客 IP、位置、运营商或浏览器信息

---

## 🚀 安装主题

### 环境要求

- WordPress 6.0 或更高版本
- PHP 7.4 或更高版本

### 从 GitHub 安装

1. 下载仓库源码 ZIP 并解压。
2. 将解压得到的 `Blog-main` 文件夹重命名为 `moyu-theme`。
3. 将整个 `moyu-theme` 文件夹重新压缩为 `moyu-theme.zip`。
4. 登录 WordPress 后台，进入“外观 → 主题 → 安装主题 → 上传主题”。
5. 上传 `moyu-theme.zip`，安装后先实时预览，再启用主题。

### 通过 WebFTP 安装

将整个主题目录上传至：

```text
/wwwroot/wp-content/themes/moyu-theme/
```

不要覆盖 `wp-admin`、`wp-includes` 或 WordPress 根目录文件。

如果从测试主题 `moyu-glass-FB` 切换到 `moyu-theme`，WordPress 会把它识别为一个新主题；启用后请重新检查自定义器中的背景图、头像和文字设置。

---

## ⚙️ 初始配置

### 设置主页和文章页

1. 在“页面”中创建并发布“首页”和“文章”两个页面。
2. 进入“设置 → 阅读”。
3. 将“您的主页显示”设为“一个静态页面”。
4. 主页选择“首页”，文章页选择“文章”，然后保存。

### 创建“关于我”

1. 新建标题为“关于我”的页面。
2. 将固定链接别名设为 `about`。
3. 使用 WordPress 页面编辑器填写个人信息并发布。

### 编辑主题内容

进入“外观 → 自定义”，可以修改：

- 网站背景图片
- 顶部名称
- 个人头像、名称、简介和技能
- 个人网站与 GitHub 链接
- 个人标签、统计标题和最近更新标题
- 页脚版权文字与页脚文案

浏览量仅累计普通前台页面访问，不统计后台、预览、订阅源和管理员访问。

### 设置文章图片

编辑文章时，在右侧“特色图片”面板中选择图片。未设置特色图片时，文章卡片不会重复显示默认图片。

### 开启评论审核

1. 进入“设置 → 讨论”。
2. 勾选“允许他人在新文章上发表评论”。
3. 勾选“评论必须经人工批准”。
4. 在“评论 → 待审”中审核评论。

---

## 🧪 入场动画测试

- 动画在同一个浏览器标签页会话中只播放一次。
- 需要重新测试时，请关闭站点标签页后重新打开，或使用无痕窗口。
- Windows 关闭“动画效果”时，主题会按无障碍设置跳过动画。
- 动画资源位于 `assets/images/intro-ink-ring.png`，逻辑位于 `assets/js/intro.js`。

---

## 📂 项目结构

```text
moyu-theme/
├── assets/
│   ├── images/
│   │   ├── intro-ink-ring.png  # 入场动画水墨光环
│   │   └── sunset-hero.png     # 默认晚霞背景
│   └── js/
│       ├── intro.js            # 入场动画控制
│       └── mouse-glow.js       # 桌面端鼠标流光
├── template-parts/
│   ├── navigation.php          # 顶部导航与搜索
│   ├── sidebar.php             # 个人资料和动态侧栏
│   ├── post-timeline.php       # 文章时间线
│   └── footer.php              # 页脚
├── comments.php                # 评论系统
├── front-page.php              # 首页
├── home.php                    # 文章页入口
├── index.php                   # 归档与搜索结果
├── page.php                    # 普通页面
├── single.php                  # 文章正文
├── functions.php               # 主题功能与自定义器
├── style.css                   # 主题信息与响应式样式
└── screenshot.png              # WordPress 主题预览图
```

---

## 🖼️ 图片建议

- 背景图：3840 × 2160 或更高分辨率的横向图片
- 文章特色图片：16:9 横向图片
- 头像：1:1 正方形图片
- 上传前压缩图片，以减少首页加载时间

---

## 🔧 开发说明

本项目是传统 WordPress PHP 主题，不需要 Node.js、npm 或构建步骤。

```bash
git clone https://github.com/MoYu-code-bot/Blog.git
```

当前主题版本为 `1.18.5`。主题样式版本位于 `style.css`，WordPress 会使用版本号刷新前端资源缓存。

---

## 📝 更新记录

### 1.18.5

- 正式更名为 Moyu Theme
- 新增动态入场动画及跳过功能(如果打开网址没有动态展示，可在系统中设置：“Windows”设置 → 辅助功能 → 视觉效果 → 动画效果)
- 玻璃面板调整为 20% 深色背景和 `6px` 模糊
- 新增减少动态效果支持
- 更新安装、测试与项目结构说明

---

## 🙏 致谢

部分内容功能与 README 组织方式参考了 [Fuwari Enhanced](https://github.com/Besty0728/fuwari)。Moyu Theme 保持独立的 WordPress 实现和现有夕阳液态玻璃结构。

---

> Stay curious, keep learning, and grow a little every day.
