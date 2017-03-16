<div class="ui center aligned header basic segment">
    <h1>构建知识框架</h1>
    <h4 class="ui grey header">为您提供了一套不断更新的 Web 设计与开发的知识框架。使用这个知识框架，你可以实践自己的想法，做出你想要的网站或应用。</h4>
</div>

<div class="ui container">
    <div class="ui four stackable cards">
        <a class="card"  href="{{ url('course/backend') }}">
            <div class="content">
                <div class="center aligned header">
                    <i class="huge orange terminal icon"></i>
                    <p>后端</p>
                </div>
                <div class="description">
                    <p>开发网站用到的后端,比如PHP框架, 数据库等</p>
                </div>
            </div>
        </a>
        <a class="card"  href="{{ url('course/service') }}">
            <div class="content">
                <div class="center aligned header">
                    <i class="huge green server icon"></i>
                    <p>服务</p>
                </div>
                <div class="description">
                    <p>在开发网站的时候,用到的一些基础服务, 如LNMP环境, Redis服务, 消息服务等</p>
                </div>
            </div>
        </a>

        <a class="card" href="{{ url('course/frontend') }}">
            <div class="content">
                <div class="center aligned header">
                    <i class="huge tv icon"></i>
                    <p>前端</p>
                </div>
                <div class="description">
                    <p>网站前端相关的一些框架, 比如UI框架, JS框架</p>
                </div>
            </div>
        </a>
        <a class="card"  href="{{ url('course/tools') }}">
            <div class="content">
                <div class="center aligned header">
                    <i class="huge brown setting icon"></i>
                    <p>工具</p>
                </div>
                <div class="description">
                    <p>在设计与开发网站的时候，您需要用到一系列的工具，比如编辑器，版本控制，自动化执行任务等等。</p>
                </div>
            </div>
        </a>
    </div>
</div>