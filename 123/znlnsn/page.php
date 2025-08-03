<?php
if(!function_exists('paging')){
    /**
     * 生成分页导航
     * @param int $total 总记录数（用于计算分页）
     * @param int $realTotal 实际总记录数（用于显示）
     * @param int $displayPG 每页显示条数
     * @param string $url 分页链接基础URL
     * @return bool|string 分页导航HTML或false
     */
    function paging($total, $displayPG = 20, $url = ''){
        global $page, $firstCount, $pageNav;

        // 确保每页显示条数为正整数
        $displayPG = max(1, (int)$displayPG);
        $GLOBALS["displayPG"] = $displayPG;

        // 获取当前页码并确保为正整数
        $page = isset($_GET["page"]) ? (int)$_GET["page"] : 1;
        $page = max(1, $page);

        // 处理URL
        if(empty($url)){
            $url = $_SERVER["REQUEST_URI"];
        }

        // 解析URL，处理现有参数
        $parse_url = parse_url($url);
        $url_query = isset($parse_url['query']) ? $parse_url['query'] : '';

        // 移除已存在的page参数
        if($url_query){
            parse_str($url_query, $query_params);
            unset($query_params['page']);
            $new_query = http_build_query($query_params);

            // 重构URL
            $url = $parse_url['path'] . ($new_query ? '?' . $new_query : '');
            $url .= $new_query ? '&page=' : '?page=';
        } else {
            $url .= '?page=';
        }

        // 计算总页数
        $lastpg = $total > 0 ? ceil($total / $displayPG) : 1;
        $page = min($lastpg, $page); // 确保页码不超过总页数

        // 计算起始记录位置
        $firstCount = ($page - 1) * $displayPG;

        // 构建分页导航
        $pageNav = "第<B>" . ($total ? ($firstCount + 1) : 0) . "</B>-<B>" . min($firstCount + $displayPG, $total) . "</B>条, 共<B>{$total}</B>条记录";

        // 如果只有一页，不显示分页按钮
        if($lastpg <= 1){
            return false;
        }

        // 首页
        $pageNav .= "<a href=\"{$url}1\" mce_href=\"{$url}1\">首页</a>";

        // 上一页
        $prepg = $page > 1 ? $page - 1 : 0;
        if($prepg){
            $pageNav .= "<a href=\"{$url}{$prepg}\" mce_href=\"{$url}{$prepg}\">上页</a>";
        } else {
            $pageNav .= "<span class=\"disabled\">上页</span>";
        }

        // 下一页
        $nextpg = $page < $lastpg ? $page + 1 : 0;
        if($nextpg){
            $pageNav .= "<a href=\"{$url}{$nextpg}\" mce_href=\"{$url}{$nextpg}\">下页</a>";
        } else {
            $pageNav .= "<span class=\"disabled\">下页</span>";
        }

        // 尾页
        $pageNav .= "<a href=\"{$url}{$lastpg}\" mce_href=\"{$url}{$lastpg}\">尾页</a>";

        // 页码选择下拉框
        $pageNav .= " 到第<select name='topage' size='1' style='font-size: 12px' onchange='window.location=\"{$url}\"+this.value'>\n";
        for($i = 1; $i <= $lastpg; $i++){
            if($i == $page){
                $pageNav .= "<option value='{$i}' selected>{$i}</option>\n";
            } else {
                $pageNav .= "<option value='{$i}'>{$i}</option>\n";
            }
        }
        $pageNav .= "</select>页, 共{$lastpg}页";

        return $pageNav;
    }
}
?>
