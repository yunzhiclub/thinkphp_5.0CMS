
$(function(){
    dataInit();                 //实例化datePicker
});
 /*从数组中移除元素
            sample code:
            var members = new array("zhangsan","lisi","wangwu");
            members.remove("zhangsan");
         */
 Array.prototype.remove = function() {
     var what, a = arguments,
         L = a.length,
         ax;
     while (L && this.length) {
         what = a[--L];
         while ((ax = this.indexOf(what)) !== -1) {
             this.splice(ax, 1);
         }
     }
     return this;
 };




//日期插件
var dataInit = function(){
    $('.date').datetimepicker({
        language:  'zh-CN',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,       //默认视图。2－month.
        minView: 2,         //默认提供的最精确的视图 1-day
        maxView: 4,         //向上点选时，最多能提供前后5年的选择
        forceParse: 0,
        format: 'yyyy-mm-dd'
    });
};

 /**
  * 依据data返回URL值，添加代码
  * @param {[object]} file     [上传文件回传信息]
  * @param {[json string]} data     [uediter返回字符串]
  * @param {[object]} response [uploadify响应请求信息]
  * @param {[string]} fileId 用以存附件的字符串   
  * @param {string}  dom DOM的追加位置
  */
 var addHtml = function(file, data, response, fileId, type) {
     if (fileId === undefined) {
         fileId = "file";
     }
     var fileArray = new Array();
     var fileValue = $("#" + fileId).val();
     if (fileValue !== "") {
         fileArray = fileValue.split(",");
     }
     var jsonData = JSON.parse(data);
     //返回数据成功,则按上传类型追加。
     //失败。则提示失败原因
     if (jsonData.state === 'SUCCESS') {
        if (type == "image")
        {
            $("#" + fileId + "_img ul").append('<li><a href="'+jsonData.url+'" target="_blank"><img src="' + jsonData.url + '" class="img-rounded" /></a><button type="button" data-id="' + jsonData.id+ '" data-url="' + jsonData.url + '" data-type="' + type + '" data-file="' + fileId + '" class="uploaderDelete btn btn-danger btn-xs"><i class="fa fa-times"></i></button></li>');
        }
        else
        {
            console.log(jsonData);
            $("#" + fileId + "_table").append('<tr><td><a target="_blank" href="' + jsonData.url + '">' + jsonData.name + '</a>&nbsp;&nbsp;<a href="javascript:void(0);" data-id="' + jsonData.id+ '" data-url="' + jsonData.url + '" data-type="' + type + '" data-file="' + fileId + '" class="uploaderDelete text-danger"><i class="glyphicon glyphicon-trash"></i></a></td><td>' + jsonData.size/1000 + 'KB</td></tr>');
        }
        fileArray.push(jsonData.id);
        $("#" + fileId).val(fileArray.join(","));
        uploaderDeleteClick();
     }
     else
     {
        alert(jsonData.state);
     }


 }

/**
 * uploaer 实例化
 * @param  {string} ROOT     调用uploader根路径
 * @param  {string} name       操作的DOM关键字
 * @param {string} fileObjName 表单值
 * @param  {sting} btnClass 按钮额外的CLASS
 * @param  {string} btnText  按钮显示文字
 * @param  bool debug 是否启用debug调试
 * @param  string type 附件上传类型（file 或 image）
 * @param { } fileTypeDesc 上传附件格式描述
 * @param {string} fileTypeExts 上传附件扩展名
 * @param {int} fileSizeLimit 附件大小限制
 * @param {int} queueSizeLimit 附件队列限制
 * @param {int} uploadlimit 附件上传最大数
 * @param { sting} value 表单初始值
 * @return {object}          [uploadify]
 */
 var uploader = function(ROOT, name, fileObjName, btnClass, btnText, debug, type, fileTypeDesc, fileTypeExts, fileSizeLimit, queueSizeLimit, uploadLimit, value, callback) {
     if (name === undefined) {
         name = "file";
     }

     //赋值
     // $("#"+ name).val(value);

     var fileId = name + '_upload';
     if (btnClass === undefined) {
         btnClass = "btn btn-primary";
     }

     if (btnText === undefined) {
         btnText = "选择图片";
     }
     $('#' + fileId).uploadify({
         'removeTimeout': 3,
         'buttonText': btnText,
         'buttonClass': btnClass,
         'fileObjName': fileObjName,
         'fileTypeExts': fileTypeExts,
         'fileTypeDesc': fileTypeDesc,
         'fileSizeLimit': fileSizeLimit,
         'queueSizeLimit': queueSizeLimit,
         'uploadLimit': uploadLimit,
         'debug': debug,
         'swf': ROOT + '/lib/uploadify/uploadify.swf',
         'uploader': ROOT + '/yunzhi.php/Attachment/upload?action=upload' + type,
         'onUploadError': function(file, errorCode, errorMsg, errorString) {
             alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
         },
         'onUploadSuccess': function(file, data, response) {
            var dataObject = JSON.parse(data);
             // addHtml(file, data, response, id, type);
            if (typeof(callback) === 'function')
            {
                callback(file, dataObject, response);
            }
            else
            {
                console.log("error:未传入回调函数，或传入的回调类型不正确");
            }
         },
     });
 };

 //只能输入整数
function onlyInteger(obj) {
    var curVal = obj.value + '';
    if(curVal.length > 1) {
        var filterValue = obj.value.replace(/[^\d]/g,'').replace(/^0\d*$/g,'');
        if(obj.value != filterValue) {
            obj.value = filterValue;
        }
    } else {
        obj.value = obj.value.replace(/\D/g,'');
    }
}

//只能输入2位金额
function onlyMoney(obj) {
    var curVal = obj.value + '';
    if(curVal.length > 1) {
        var filterValue = obj.value.replace(/^\D*(\d*(?:\.\d{0,2})?).*$/g, '$1').replace(/^0(\d{1,10}(?:\.\d{0,2})?)*$/g, '');
        if(obj.value != filterValue) {
            obj.value = filterValue;
        }
    } else {
        obj.value = obj.value.replace(/\D/g,'');
    }
}
//只能输入3位重量
function onlyWeight(obj) {
    var curVal = obj.value + '';
    if(curVal.length > 1) {
        var filterValue = obj.value.replace(/^\D*(\d*(?:\.\d{0,3})?).*$/g, '$1').replace(/^0(\d{1,10}(?:\.\d{0,3})?)*$/g, '');
        if(obj.value != filterValue) {
            obj.value = filterValue;
        }
    } else {
        obj.value = obj.value.replace(/\D/g,'');
    }
}
//参数说明：num 要格式化的数字 n 保留小数位
function formatMoney(num,n) {  
    if(num&&n){
        num=parseFloat(num);
        num=String(num.toFixed(n));
        var re=/(-?\d+)(\d{3})/;
        while(re.test(num)) 
        num=num.replace(re,"$1,$2")
        return num; 
    }else{
        return "0.00";
    }
}

//分转元
function fToy(money) {
    return (parseFloat(money).div(100));
}

//元转分
function yTof(money) {
    return (parseFloat(money).mul(100));
}

//除法函数，用来得到精确的除法结果
//说明：javascript的除法结果会有误差，在两个浮点数相除的时候会比较明显。这个函数返回较为精确的除法结果。
//调用：accDiv(arg1,arg2)
//返回值：arg1除以arg2的精确结果
function accDiv(arg1,arg2){
    var t1=0,t2=0,r1,r2;
    try{t1=arg1.toString().split(".")[1].length}catch(e){}
    try{t2=arg2.toString().split(".")[1].length}catch(e){}
    with(Math){
        r1=Number(arg1.toString().replace(".",""))
        r2=Number(arg2.toString().replace(".",""))
        return (r1/r2)*pow(10,t2-t1);
    }
}

//给Number类型增加一个div方法，调用起来更加方便。
Number.prototype.div = function (arg){
    return accDiv(this, arg);
}

//乘法函数，用来得到精确的乘法结果
//说明：javascript的乘法结果会有误差，在两个浮点数相乘的时候会比较明显。这个函数返回较为精确的乘法结果。
//调用：accMul(arg1,arg2)
//返回值：arg1乘以 arg2的精确结果
function accMul(arg1,arg2)
{
    var m=0,s1=arg1.toString(),s2=arg2.toString();
    try{m+=s1.split(".")[1].length}catch(e){}
    try{m+=s2.split(".")[1].length}catch(e){}
    return Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m)
}

// 给Number类型增加一个mul方法，调用起来更加方便。
Number.prototype.mul = function (arg){
    return accMul(arg, this);
}

function accDiv(arg1, arg2) {
    var t1 = 0, t2 = 0, r1, r2;
    try { t1 = arg1.toString().split(".")[1].length } catch (e) { }
    try { t2 = arg2.toString().split(".")[1].length } catch (e) { }
    with (Math) {
        r1 = Number(arg1.toString().replace(".", ""))
        r2 = Number(arg2.toString().replace(".", ""))
        return (r1 / r2) * pow(10, t2 - t1);
    }
}
//给Number类型增加一个div方法，调用起来更加方便。
Number.prototype.div = function(arg) {
    return accDiv(this, arg);
}
function accMul(arg1, arg2) {
    var m = 0, s1 = arg1.toString(), s2 = arg2.toString();
    try { m += s1.split(".")[1].length } catch (e) { }
    try { m += s2.split(".")[1].length } catch (e) { }
    return Number(s1.replace(".", "")) * Number(s2.replace(".", "")) / Math.pow(10, m)
}
Number.prototype.mul = function(arg) {
    return accMul(arg, this);
}
function accAdd(arg1, arg2) {
    var r1, r2, m, c;
    try { r1 = arg1.toString().split(".")[1].length } catch (e) { r1 = 0 }
    try { r2 = arg2.toString().split(".")[1].length } catch (e) { r2 = 0 }
    c = Math.abs(r1 - r2);
    m = Math.pow(10, Math.max(r1, r2))
    if (c > 0) {
        var cm = Math.pow(10, c);
        if (r1 > r2) {
            arg1 = Number(arg1.toString().replace(".", ""));
            arg2 = Number(arg2.toString().replace(".", "")) * cm;
        } else {
            arg1 = Number(arg1.toString().replace(".", "")) * cm;
            arg2 = Number(arg2.toString().replace(".", ""));
        }
    } else {
        arg1 = Number(arg1.toString().replace(".", ""));
        arg2 = Number(arg2.toString().replace(".", ""));
    }
    return (arg1 + arg2) / m
}
Number.prototype.add = function(arg) {
    return accAdd(arg, this);
}

//排序方法
function compareInt(x, y){
    var iNum1 = parseInt(x[0]);//强制转换成int型;
    var iNum2 = parseInt(y[0]);
    if(iNum1 < iNum2){
        return -1;
    }else if(iNum1 > iNum2){
        return 1;
    }else{
        return 0;
    }
}
