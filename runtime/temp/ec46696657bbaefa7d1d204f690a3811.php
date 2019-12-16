<?php /*a:1:{s:33:"/yd/php/tp6.0/view/auth/menu.html";i:1576486778;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>menu</title>
    <link rel="stylesheet" href="/tp6.0/public/static/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/tp6.0/public/static/css/public.css" media="all">
    <style>
        .layui-btn:not(.layui-btn-lg ):not(.layui-btn-sm):not(.layui-btn-xs) {
            height: 34px;
            line-height: 34px;
            padding: 0 8px;
        }
    </style>
</head>
<body>
<div class="layuimini-container">
    <div class="layuimini-main">
        <div>
            <div class="layui-btn-group">
                <button class="layui-btn" id="btn-expand">全部展开</button>
                <button class="layui-btn" id="btn-fold">全部折叠</button>
                <button class="layui-btn" id="btn-add">添加权限</button>
            </div>
            <table id="munu-table" class="layui-table" lay-filter="munu-table"></table>
        </div>
    </div>
</div>
<!-- 操作列 -->
<script type="text/html" id="auth-state">
    <a class="layui-btn layui-btn-primary layui-btn-xs" lay-event="edit">修改</a>
    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>

<script src="/tp6.0/public/static/lib/layui-v2.5.4/layui.js" charset="utf-8"></script>
<script src="/tp6.0/public/static/js/lay-config.js?v=1.0.4" charset="utf-8"></script>
<script src="/tp6.0/public/static/js/jquery.js?v=1.0.4" charset="utf-8"></script>
<script src="/tp6.0/public/static/js/base.js?v=1.0.4" charset="utf-8"></script>
<script>
    layui.use(['table', 'treetable','jquery'], function () {
        var $ = layui.jquery;
        var table = layui.table;
        var treetable = layui.treetable;
        var data = <?php echo $menus; ?>;
        // 渲染表格
        layer.load(2);
        treetable.render({
            treeColIndex: 1,
            treeSpid: 0,
            treeIdName: 'id',
            treePidName: 'pid',
            elem: '#munu-table',
            data: data,
            page: false,
            cols: [[
                {type: 'numbers'},
                {field: 'title', minWidth: 200, title: '权限名称'},
                {field: 'condition', title: '权限标识'},
                //{field: 'condition', title: '菜单url'},
                {field: 'status', title: '状态', templet: function (d) {
                        if (d.status == 1) {
                            return '正常';
                        } else {
                            return '禁用';
                        }
                    }},
                {
                    field: 'type', width: 80, align: 'center', templet: function (d) {
                        if (d.type == 1) {
                            return '<span class="layui-badge layui-bg-gray">菜单</span>';
                        } else {
                            return '<span class="layui-badge-rim">按钮</span>';
                        }
                    }, title: '类型'
                },
                {templet: '#auth-state', width: 120, align: 'center', title: '操作'}
            ]],
            done: function () {
                layer.closeAll('loading');
            }
        });

        $('#btn-expand').click(function () {
            treetable.expandAll('#munu-table');
        });

        $('#btn-fold').click(function () {
            treetable.foldAll('#munu-table');
        });

        $('#btn-add').click(function () {
            var params = {
                'title' : '新增权限',
                'url' : 'add',
            }
            publicMethod.add_method(params);
        });

        //监听工具条
        table.on('tool(munu-table)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;

            if (layEvent === 'del') {
                layer.msg('删除' + data.id);
            } else if (layEvent === 'edit') {
                layer.msg('修改' + data.id);
            }
        });
    });
</script>
</body>
</html>