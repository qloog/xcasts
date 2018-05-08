<div class="ui middle aligned stackable grid container">
    <div class="row">
        <div class="center aligned column">
            <h3 class="ui header">统计</h3>
            <p>我们会定期更新课程, 让你总是可以学到最新的技术</p>
            <div class="ui three statistics">
                <div class="statistic">
                    <div class="value">
                        {{ $courseCount }}
                    </div>
                    <div class="label">
                        课程
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                         {{ $videoCount }}
                    </div>
                    <div class="label">
                        视频
                    </div>
                </div>
                <div class="statistic">
                    <div class="value">
                        {{ $totalDuration }}
                    </div>
                    <div class="label">
                        分钟
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
