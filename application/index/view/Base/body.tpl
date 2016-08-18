{block name="page-wrapper"}
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><php>
                if (is_object($YunzhiMenuM) && $breadCrumbs = $YunzhiMenuM->getBreadCrumbs())
                {
                    for($i = count($breadCrumbs)-1; $i >= 0 ; $i--)
                    {
                        //如果不是第一个元素，增加分隔符号
                        if ($i !== count($breadCrumbs)-1)
                        {
                            echo ">>";
                        }

                        //如果不是最后一个元素，增加a链接
                        if (!$i)
                        {
                            echo $breadCrumbs[$i]["title"];
                        }
                        else
                        {
                            $url = U($breadCrumbs[$i]['controller'] . '/' . $breadCrumbs[$i]['action']);
                            echo "<a href='" . $url . "'>" . $breadCrumbs[$i]['title'] . "</a>";
                        }
                    }
                }
                </php></h1>
            </div>
        </div>
        {block name="body"}
        {/block}
        <div style="clear:both;display:block;width:100%;height:0px"></div>
    </div>
    <!--/#page-wrapper-->
{/block}
