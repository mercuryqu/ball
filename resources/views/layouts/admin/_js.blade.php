<script src="{{ asset('statics/admin/js/vendor.js') }}"></script>
<script src="{{ asset('statics/admin/js/app.js') }}"></script>

<script type="text/javascript">
    $(function() {
        $("input.date-range").daterangepicker({
            language : 'zh-CN',
            format : 'YYYY-MM-DD',
            endDate : moment().format('YYYY-MM-DD'),
            maxDate : moment().format('YYYY-MM-DD'),
            locale: {
                customRangeLabel : '自定义',
                applyLabel : '确定',
                cancelLabel : '取消',
                fromLabel : '起始时间',
                toLabel : '结束时间',
                daysOfWeek : [ '日', '一', '二', '三', '四', '五', '六' ],
                monthNames : [ '一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月' ]
            },
            ranges : {
                '今日': [moment().startOf('day'), moment()],
                '昨日': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
                '最近7日': [moment().subtract(6, 'days'), moment()],
                '最近1月': [moment().subtract(1, 'months').add(1, 'days'), moment()],
                '全部时间': [moment('1970-1-1'), moment()]
            },
            minDate : false
        });
    });
</script>