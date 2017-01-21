@extends('frontend.layouts.master')

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('simplemde/simplemde.min.css') }}">
@endsection

@section('content')
    <div class="ui grid">
        <div class="row"></div>
        <div class="row">
            <div class="thirteen wide column centered">
                <div class="ui grid">
                    <div class="twelve wide column">
                        <div class="ui yellow message">
                            我们希望 Laravel China 能够成为拥有浓厚技术氛围的开发者社区，
                            而实现这个目标，需要我们所有人的共同努力：友善，公平，尊重知识和事实。
                            请严格遵守 - <a class="ui teal">社区发帖和管理规范</a>
                        </div>
                        <div class="ui large middle aligned divided relaxed list padded segment">
                            <form class="ui form success" METHOD="post" action="{{ route('topic.store') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="field">
                                    <label>分类</label>
                                    <select name="category" class="ui fluid search dropdown">
                                        <option value="1">PHP</option>
                                        <option value="2">MySQL</option>
                                        <option value="3">Laravel</option>
                                        <option value="4">Javascript</option>
                                        <option value="5">NodeJS</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label></label>
                                    <input type="text" name="title" placeholder="请填写标题">
                                </div>
                                <div class="ui success message">
                                    <div class="header">Form Completed</div>
                                    <div class="ui bulleted list">

                                        <div class="item">请注意单词拼写，以及中英文排版，<a class="ui teal text colored">参考此页</a></div>
                                        <div class="item">支持 Markdown 格式, <strong>**粗体**</strong>、~~删除线~~、<code>`单行代码`</code>, 更多语法请见这里 <a href="https://github.com/riku/Markdown-Syntax-CN/blob/master/syntax.md">Markdown 语法</a></div>
                                        <div class="item">支持表情，使用方法请见 Emoji 自动补全来咯，可用的 Emoji 请见 :metal: :point_right: Emoji 列表  :star: :sparkles:</div>
                                        <div class="item">上传图片, 支持拖拽和剪切板黏贴上传, 格式限制 - jpg, png, gif</div>
                                        <div class="item">发布框支持本地存储功能，会在内容变更时保存，「提交」按钮点击时清空</div>
                                    </div>
                                </div>
                                <div class="field">
                                    <label></label>
                                    <textarea name="body" id="body" rows="20" placeholder="请使用Markdown格式书写:), 代码片段黏贴时请注意使用高亮语法。"></textarea>
                                </div>
                                <button class="ui button teal" type="submit">发布</button>
                            </form>
                        </div>
                    </div>
                    <div class="four wide column">
                        <div class="ui card">
                            <div class="image">
                                <img src="/images/avatar2/large/kristy.png">
                            </div>
                            <div class="content">
                                <a class="header">Kristy</a>
                                <div class="meta">
                                    <span class="date">Joined in 2013</span>
                                </div>
                                <div class="description">
                                    Kristy is an art director living in New York.
                                </div>
                            </div>
                            <div class="extra content">
                                <a>
                                    <i class="user icon"></i>
                                    22 Friends
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"></div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('simplemde/simplemde.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.ui.dropdown').dropdown();

            var simplemde = new SimpleMDE({
                spellChecker: false,
                autosave: {
                    enabled: true,
                    delay: 1,
                    unique_id: "body"
                },
                forceSync: true
            });
        });
    </script>
@endsection