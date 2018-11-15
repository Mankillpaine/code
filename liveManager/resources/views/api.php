<html>
    <head>
        <title>api</title>
    </head>
    <body>
    <h2>要进行Token 验证接口如下</h2>
        <ul>

            <li>月收入趋势（曲线图）</li>
            <li>提交方式： Post</li>
            <li>接口：companyDaily/income </li>
            <li>传参：startTime 开始时间 示例（2016-06-01）   endTime  结束时间 示例（2016-06-01）  companyId 工会id    </li>
            <li>返回字段 date 日期   increase_rmb 收入   </li>
        </ul>
    <ul>

        <li>月粉丝趋势（曲线图）</li>
        <li>提交方式： Post</li>
        <li>接口：companyDaily/follower </li>
        <li>传参：startTime 开始时间 示例（2016-06-01）   endTime  结束时间 示例（2016-06-01）  companyId 工会id    </li>
        <li>返回字段 date 日期   increase_follower 粉丝   </li>
    </ul>

    <ul>

        <li>当前在线最高主播 </li>
        <li>提交方式： Post</li>
        <li>接口：starDaily/topOnline</li>
        <li>传参：startTime  示例: 2016-12-28 15:25:13    companyId 工会id   (现在数据只有：2016-12-28 这天的) </li>
        <li>返回字段 platformid 用户id   nickname 昵称  avatar 图像 remark 备注  income 金币收入 rmb 人民币收入 workTime 在线时长 recommend 在榜  online在线人数 starttime 开播时间   </li>
    </ul>
    <ul>

        <li>昨日在线最高主播</li>
        <li>提交方式： Post</li>
        <li>接口：starDaily/topOnline</li>
        <li>传参：startTime 示例：2016-12-28 00:00:00   companyId 工会id    </li>
        <li>返回字段 platformid 用户id   nickname 昵称  avatar 图像 remark 备注  increase_income 金币收入 increase_rmb 人民币收入 workTime 在线时长 recommend 在榜  onlineMax 在线人数 starttime 开播时间   </li>

    </ul>
    <ul>

        <li>日增粉最多主播</li>
        <li>提交方式： Post</li>
        <li>接口：starDaily/topFans</li>
        <li>传参：startTime 示例：2016-12-28 00:00:00   companyId 工会id   total 请求条数（默认为10） page页数 </li>
        <li>返回字段 platformid 用户id   nickname 昵称  avatar 图像 remark 备注  increase_follower 粉丝增长 follower 总粉丝 platname平台名 agentname 经纪人  levename等级 pageNum总页数 page第几页 num返回条数   </li>

    </ul>
    <ul>

        <li>今日总览（实时数据、日平台数据分布）</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/pageIndex</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 liveStar 当前在播   sumLive 日累计上播  sumRmb 当日收入 sumFollower 当日增粉  platStar 活跃主播（sumLive ：占比数） platIncome 日收入（sumRmb ：占比数） platFollower日增粉（sumfollower:日增粉数）  </li>

    </ul>

    <ul>

        <li>今日收入最高主播（每日收入明细）</li>
        <li>提交方式： Post</li>
        <li>接口：starDaily/topIncome</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 liveStar 当前在播   sumLive 日累计上播  sumRmb 当日收入 sumFollower 当日增粉  platStar 活跃主播（sumLive ：占比数） platIncome 日收入（sumRmb ：占比数） platFollower日增粉（sumfollower:日增粉数）  </li>

    </ul>
    <ul>
        <li> 日上播时间最长主播</li>
        <li>提交方式： Post</li>
        <li>接口：starDaily/TopLivetime</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 platformid 用户id   nickname 昵称  avatar 图像 remark 备注  platname平台名  agentname 经纪人名 workTime 在播时长 color 色值 </li>
    </ul>
    <ul>
        <li> 平台增粉榜</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/pageFllower_plat</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 increase_follower 粉丝   platform平台  name 平台名  </li>
    </ul>
    <ul>
        <li> 小組增粉榜</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/groupFollower</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 follower 粉丝   name 经纪人名  </li>
    </ul>
    <ul>
        <li> 平台收入榜</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/pagePlatincome</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 rmb 人民币收入   name 平台名  </li>
    </ul>
    <ul>
        <li> 收入分析 * 本月收入  /累计收入</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/pageIncome</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 monthRmb 本月累计收入   rmb 累计收入  </li>
    </ul>


    <ul>
        <li> 小组贡献榜</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/groupIncome</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 follower 粉丝   name 经纪人名  </li>
    </ul>

    <ul>
        <li> 月达标主播</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/rateStar</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 platformid 用户id irate为1 达标  percent 达标率 increase_rmb 收入 nickname 昵称 avatar 图像 levename等级名称 agentname经纪人名称 platname平台名  </li>
    </ul>

    <ul>
        <li> 月未达标主播</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/rateStar</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 platformid 用户id irate为0 未达标  percent 达标率 increase_rmb 收入 nickname 昵称 avatar 图像 levename等级名称 agentname经纪人名称 platname平台名  </li>
    </ul>

    <ul>
        <li> 日考勤 达标主播/未达标主播</li>
        <li>提交方式： Post</li>
        <li>接口：starDaily/Starperson</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 
            rateStar 达标主播
            unrateStar 未达标主播
            gourps 小组考勤
         </li>
    </ul>
    <ul>
        <li> 日考勤  小组考勤</li>
        <li>提交方式： Post</li>
        <li>接口：starDaily/gourps</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段

        </li>
    </ul>
    <ul>
        <li> 日考勤   未达标主播</li>
        <li>提交方式： Post</li>
        <li>接口：starDaily/unrateStar</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段

        </li>
    </ul>
    <ul>
        <li> 日考勤   达标主播</li>
        <li>提交方式： Post</li>
        <li>接口：starDaily/Starrate</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段

        </li>
    </ul>


    <ul>
        <li> 月增粉明细</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/pageFollower</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 platformid 用户id irate为0 未达标  percent 达标率 increase_rmb 收入 nickname 昵称 avatar 图像 levename等级名称 agentname经纪人名称 platname平台名  </li>
    </ul>

    <ul>
        <li> 主播管理</li>
        <li>提交方式： Post</li>
        <li>接口：stars/filter</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id  </li>
        <li>返回字段
            platform 平台id，平台名
            provient 省份id，省份名
            agent    经纪人id ，经纪人id
            gender   性别（0为女，1为男）
            star     主播数据
            platformid 用户id irate为0 未达标  percent 达标率 increase_rmb 收入 nickname 昵称 avatar 图像 levename等级名称 agentname经纪人名称 platname平台名  </li>
    </ul>

    <ul>     //
        <li> 日考勤单数</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/pageWork</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 workNum 考勤人数   rateNum 达标人数    percent 达标率  </li>

    </ul>     //

    <ul>
        <li> 月达标</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/rateStar</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 workNum 考勤人数   rateNum 达标人数    percent 达标率  </li>

    </ul>
    <ul>
        <li> 月未达标</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/unrateStar</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 workNum 考勤人数   rateNum 达标人数    percent 达标率  </li>

    </ul>
    <ul>
        <li> 月全勤主播表</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/rateStar</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段 platform 平台   province 省份    agent 经纪人  gender性别（0为女|1为男）  </li>

    </ul>

    <ul>
        <li> 月缺勤主播</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/unrateStar</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段  </li>

    </ul>

    <ul>
        <li> 本月考勤明细</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/monthDetail</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段   </li>

    </ul>

    <ul>
        <li> 本月小组考勤</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/monthWork</li>
        <li>传参：startTime 示例：'2016-12-28 15:25:13'   companyId 工会id    </li>
        <li>返回字段   </li>

    </ul>

    <ul>
        <li> 搜索功能</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/search</li>
        <li>传参：keysword 搜索关键字（用户id，昵称）   companyId 工会id    </li>
        <li>返回字段   </li>

    </ul>
    <ul>
        <li> 收入分析单数</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/pageIncome</li>
        <li>传参： startTime 开始时间  companyId 工会id    </li>
        <li>返回字段   </li>

    </ul>

    <ul>
        <li> 粉丝单数</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/pageFollower</li>
        <li>传参： startTime开始时间  companyId 工会id    </li>
        <li>返回字段   </li>

    </ul>

    <ul>
        <li> 日考勤单数</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/pageWork</li>
        <li>传参： startTime开始时间  companyId 工会id    </li>
        <li>返回字段   </li>

    </ul>

    <ul>
        <li> 主播考勤单数</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/starManager</li>
        <li>传参： startTime开始时间  companyId 工会id    </li>
        <li>返回字段   </li>

    </ul>
    <ul>
        <li> 主播直播历史</li>
        <li>提交方式： Post</li>
        <li>接口：starDaily/livehistry</li>
        <li>传参： platform平台  platformid 平台id    </li>
        <li>返回字段 starnum主播总数  avarage 平均在线人数  </li>

    </ul>

    <ul>
        <li> 主播直播状态</li>
        <li>提交方式： Post</li>
        <li>接口：starDaily/starLiveState</li>
        <li>传参： platform平台  platformid 平台id    </li>
        <li>返回字段  </li>

    </ul>
    <ul>
        <li> 主播考勤单数</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/pagemonthWork</li>
        <li>传参： startTime开始时间  companyId 工会id    </li>
        <li>返回字段   </li>

    </ul>
    <ul>
        <li> 月考勤单数</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/pagemonthWork</li>
        <li>传参： startTime开始时间  companyId 工会id    </li>
        <li>返回字段   </li>

    </ul>

    <ul>
        <li> 主播详情</li>
        <li>提交方式： Post</li>
        <li>接口：company_sum/starDetail</li>
        <li>传参： platform平台  platformid 平台id    </li>
        <li>返回字段   </li>

    </ul>

    </body>
</html>