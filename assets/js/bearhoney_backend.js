$(function(){
    $("#extensionsList-Loading").fadeIn();
    getExtensionList();
    getNotOpenExtensionList();
    getOpenExtensionList();
    getNeedUpgradeExtensionList();
})


getExtensionList = function(){
//获取扩展列表数据
     $.ajax({
                        type: "POST",
                        async:true,
                        url: document.location.protocol+"/index.php/bh-extension",
                        dateType: "json",
                         data: {
                            "type": 'getUnInstalledExtension',
                        },
                        success: function(data) {
                            json = JSON.parse(data);
                             if(json.data == ''){
                                $("#extensionsList").fadeOut();
                             }
                             else{
                                 $("#extensionsList").fadeIn();
                                 content(json.data);
                             }
                           

                        },
                        complete: function() {
                 $("#extensionsList-Loading").fadeOut();
                 clickInstallBtn();
                        },
                        error: function() {
                         
                        }
                    });
                    function content(lists) {
                    var str = " ";
                    for(var i in lists) {

str += '<tr><td>' + lists[i]['extensionId'] + '</td><td>' + lists[i]['extensionName'] + '</td><td>' + lists[i]['extensionDec'] + '</td><td>' + lists[i]['extensionVersion'] + '</td><td>' + lists[i]['extensionAuthor'] + '</td><td><i class="paw blue icon"></i>未安装</td><td><div class="ui labels"><div class="ui mini blue label install" data-name="' + lists[i]['extensionName'] + '" data-id="' + lists[i]['extensionId'] + '">安装</div></div></td></tr>'
$("#extensionsList").html(str);
}
}


}


getNotOpenExtensionList = function(){
//获取扩展列表数据
     $.ajax({
                        type: "POST",
                        async:true,
                        url: document.location.protocol+"/index.php/bh-extension",
                        dateType: "json",
                         data: {
                            "type": 'getInstalledExtension',
                        },
                        success: function(data) {
                            json = JSON.parse(data);
                            if(json.data == ''){
                                $("#extensionsList_noOpen").fadeOut();
                            }
                            else{
                              $("#extensionsList_noOpen").fadeIn();
                                 content(json.data);
                            }
                        },
                        complete: function() {
                 $("#extensionsList-Loading").fadeOut();
                 clickActivateBtn();
                        },
                        error: function() {
                         
                        }
                    });
                    function content(lists) {
                    var str = " ";
                    for(var i in lists) {
str += '<tr><td>' + lists[i]['extensionId'] + '</td><td>' + lists[i]['extensionName'] + '</td><td>' + lists[i]['extensionDec'] + '</td><td>' + lists[i]['extensionVersion'] + '</td><td>' + lists[i]['extensionAuthor'] + '</td><td><i class="folder outline orange icon"></i>未启用</td><td><div class="ui labels"><div class="ui mini teal label activate" data-name="' + lists[i]['extensionName'] + '" data-id="' + lists[i]['extensionId'] + '">启用</div></div></td></tr>'
$("#extensionsList_noOpen").html(str);
}
}


}



getOpenExtensionList = function(){
//获取扩展列表数据
     $.ajax({
                        type: "POST",
                        async:true,
                        url: document.location.protocol+"/index.php/bh-extension",
                        dateType: "json",
                         data: {
                            "type": 'getActivatedExtension'
                        },
                        success: function(data) {
                            json = JSON.parse(data);
                             if(json.data == ''){
                               $("#extensionsList_Open").fadeOut();
                             }
                             else{
                                 $("#extensionsList_Open").fadeIn();
                                 content(json.data);
                             }
                           

                        },
                        complete: function() {
                 $("#extensionsList-Loading").fadeOut();
                 clickUnactivateBtn();
                        },
                        error: function() {
                         
                        }
                    });
                    function content(lists) {
                    var str = " ";
                    for(var i in lists) {

str += '<tr><td>' + lists[i]['extensionId'] + '</td><td>' + lists[i]['extensionName'] + '</td><td>' + lists[i]['extensionDec'] + '</td><td>' + lists[i]['extensionVersion'] + '</td><td>' + lists[i]['extensionAuthor'] + '</td><td><i class="green checkmark icon"></i>已启用</td><td><div class="ui labels"><div class="ui mini red label unactivate" data-name="' + lists[i]['extensionName'] + '" data-id="' + lists[i]['extensionId'] + '">禁用</div></div></td></tr>'
$("#extensionsList_Open").html(str);
}
}


}

getNeedUpgradeExtensionList = function(){
//获取扩展列表数据
     $.ajax({
                        type: "POST",
                        async:true,
                        url: document.location.protocol+"/index.php/bh-extension",
                        dateType: "json",
                         data: {
                            "type": 'getNeedUpgradeExtension'
                        },
                        success: function(data) {
                            json = JSON.parse(data);
                            if(json == null || json.data == ''){
                                $("#extensionsList_Upgrade").fadeOut();
                            }
                            else{
                              $("#extensionsList_Upgrade").fadeIn();
                                 content(json.data);
                            }
                        },
                        complete: function() {
                 $("#extensionsList-Loading").fadeOut();
                 clickUpgradeBtn();
                        },
                        error: function() {
                         
                        }
                    });
                    function content(lists) {
                    var str = " ";
                    for(var i in lists) {
str += '<tr><td>' + lists[i]['extensionId'] + '</td><td>' + lists[i]['extensionName'] + '</td><td>' + lists[i]['extensionDec'] + '</td><td>' + lists[i]['extensionAuthor'] + '</td><td>' + lists[i]['extensionVersion'] + '</td><td><font color=red>' + lists[i]['extensionNewVersion'] + '</font></td><td><div class="ui labels"><div class="ui mini olive label upgrade" data-name="' + lists[i]['extensionName'] + '" data-id="' + lists[i]['extensionId'] + '">升级</div></div></td></tr>'
$("#extensionsList_Upgrade").html(str);
}
}


}



clickInstallBtn = function(){
    $('.ui.mini.blue.label.install').on('click',function(){
        const extensionId = $(this).attr('data-id');
        layer.confirm('确认是否安装[' + $(this).attr('data-name') + ']扩展？', {
  btn: ['确认安装','取消'],
  title:'安装扩展',
}, function(){
    layer.msg('正在安装扩展，请勿刷新', {icon: 1});
    layer.msg('扩展安装中...', {
  icon: 16
  ,shade: 0.01,
  time: 9999999
});
    $.ajax({
                        type: "POST",
                        async:true,
                        url: document.location.protocol+"/index.php/bh-extension",
                        data: {
                            "type": 'installExtension',
                            "extensionId":extensionId,
                        },
                        dateType: "json",
                        success: function(data) {
                             json = JSON.parse(data);
                             if(json.code == 0){
                             layer.msg(json.message, {icon: 2});
                             }
                             else if(json.code == 1){
                             layer.msg(json.message, {icon: 1});  
                             }
                             else{
                             layer.msg('安装中出现错误，请稍后再试', {icon: 2});    
                             }
                             getExtensionList();
    getNotOpenExtensionList();
    getOpenExtensionList();
    getNeedUpgradeExtensionList();
                        },
                        error: function() {
                            layer.msg('安装中出现错误，请稍后再试', {icon: 2});    
                        }
                    });
  
});
    })
};

clickActivateBtn = function(){
    $('.ui.mini.teal.label.activate').on('click',function(){
        const extensionId = $(this).attr('data-id');
        layer.confirm('确认是否启用[' + $(this).attr('data-name') + ']扩展？', {
  btn: ['确认启用','取消'],
  title:'启用扩展',
}, function(){
    layer.msg('正在启用扩展，请勿刷新', {icon: 1});
    $.ajax({
                        type: "POST",
                        async:true,
                        url: document.location.protocol+"/index.php/bh-extension",
                        data: {
                            "type": 'activateExtension',
                            "extensionId":extensionId,
                        },
                        dateType: "json",
                        success: function(data) {
                             json = JSON.parse(data);
                             if(json.code == 0){
                             layer.msg(json.message, {icon: 2});
                             }
                             else if(json.code == 1){
                            layer.msg(json.message+'5秒后自动刷新页面', {icon: 1});  
                            $('.button.button-primary.csf-top-save.csf-save.csf-save-ajax').click();
                             setTimeout(function(){
                             window.parent.location.reload();
                             },5000);
                             }
                             else{
                             layer.msg('安装中出现错误，请稍后再试', {icon: 2});    
                             }
                             getExtensionList();
                             getNotOpenExtensionList();
                             getOpenExtensionList();
                             getNeedUpgradeExtensionList();
                        },
                        error: function() {
                            layer.msg('安装中出现错误，请稍后再试', {icon: 2});    
                        }
                    });
  
});
    })
};


clickUnactivateBtn = function(){
    $('.ui.mini.red.label.unactivate').on('click',function(){
        const extensionId = $(this).attr('data-id');
        layer.confirm('确认是否禁用[' + $(this).attr('data-name') + ']扩展？', {
  btn: ['确认禁用','取消'],
  title:'禁用扩展',
}, function(){
    layer.msg('正在禁用扩展，请勿刷新', {icon: 1});
    $.ajax({
                        type: "POST",
                        async:true,
                        url: document.location.protocol+"/index.php/bh-extension",
                        data: {
                            "type": 'unactivateExtension',
                            "extensionId":extensionId,
                        },
                        dateType: "json",
                        success: function(data) {
                             json = JSON.parse(data);
                             if(json.code == 0){
                             layer.msg(json.message, {icon: 2});
                             }
                             else if(json.code == 1){
                             layer.msg(json.message+'5秒后自动刷新页面', {icon: 1}); 
                             $('.button.button-primary.csf-top-save.csf-save.csf-save-ajax').click();
                             setTimeout(function(){
                             window.parent.location.reload();
                             },5000);  
                             }
                             else{
                             layer.msg('禁用扩展中出现错误，请稍后再试', {icon: 2});    
                             }
                             getExtensionList();
                             getNotOpenExtensionList();
                             getOpenExtensionList();
                             getNeedUpgradeExtensionList();
                        },
                        error: function() {
                            layer.msg('禁用扩展中出现错误，请稍后再试', {icon: 2});    
                        }
                    });
  
});
    })
};


clickUpgradeBtn = function(){
    $('.ui.mini.olive.label.upgrade').on('click',function(){
        const extensionId = $(this).attr('data-id');
        layer.confirm('确认是否升级[' + $(this).attr('data-name') + ']扩展？', {
  btn: ['确认升级','取消'],
  title:'升级扩展',
}, function(){
    layer.msg('正在升级扩展，请勿刷新', {icon: 1});
    $.ajax({
                        type: "POST",
                        async:true,
                        url: document.location.protocol+"/index.php/bh-extension",
                        data: {
                            "type": 'upgradeExtension',
                            "extensionId":extensionId,
                        },
                        dateType: "json",
                        success: function(data) {
                             json = JSON.parse(data);
                             if(json.code == 0){
                             layer.msg(json.message, {icon: 2});
                             }
                             else if(json.code == 1){
                             layer.msg(json.message+'5秒后自动刷新页面', {icon: 1}); 
                             $('.button.button-primary.csf-top-save.csf-save.csf-save-ajax').click();
                             setTimeout(function(){
                             window.parent.location.reload();
                             },5000);  
                             }
                             else{
                             layer.msg('升级扩展中出现错误，请稍后再试', {icon: 2});    
                             }
                             getExtensionList();
                             getNotOpenExtensionList();
                             getOpenExtensionList();
                             getNeedUpgradeExtensionList();
                        },
                        error: function() {
                            layer.msg('升级扩展中出现错误，请稍后再试', {icon: 2});    
                        }
                    });
  
});
    })
};