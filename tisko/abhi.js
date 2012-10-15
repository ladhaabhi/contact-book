(function(){
    var g=null,i=this,

    j=function(a,b,c){
        a=a.split(".");
        c=c||i;
        !(a[0]in c)&&c.execScript&&c.execScript("var "+a[0]);
        for(var d;a.length&&(d=a.shift());)!a.length&&void 0!==b?c[d]=b:c=c[d]?c[d]:c[d]={}
    },

    k=function(a){
        var b=typeof a;
        if("object"==b)if(a){
            if(a instanceof Array)return"array";
            if(a instanceof Object)return b;
            var c=Object.prototype.toString.call(a);
            if("[object Window]"==c)return"object";
            if("[object Array]"==c||"number"==typeof a.length&&"undefined"!=typeof a.splice&&"undefined"!=typeof a.propertyIsEnumerable&&
                !a.propertyIsEnumerable("splice"))return"array";
            if("[object Function]"==c||"undefined"!=typeof a.call&&"undefined"!=typeof a.propertyIsEnumerable&&!a.propertyIsEnumerable("call"))return"function"
        }else return"null";
        else if("function"==b&&"undefined"==typeof a.call)return"object";
        return b
    },

    l=function(){
        var a=window.medianet.ads.domains.Caf;
        return"function"==k(a)
    },

    n=function(){
        var a,b="SplitTraffic",c=m;
        j(b,c,a)
    };

    var o=function(a){
        try{
            return!!a.location.href||""===a.location.href
        }catch(b){
            return!1
        }
    };

    var p=function(){
        var a=window,b=2;
        try{
            a.top.document==a.document?b=0:o(a.top)&&(b=1)
        }catch(c){}
        return b
    };

    function q(a,b,c){
        c!=g&&""!==c&&(a+=encodeURIComponent(b)+"="+encodeURIComponent(c)+"&");
        return a
    }

    function _medianet_json_callback(a){
        r();
        var b="medianet_afd_ad_request_done";
        if(window[b])window[b](a)
    }

    function s(a,b){
        var c=document;
        window._medianet_json_callback=_medianet_json_callback;
        if(b){
            var d=c.createElement("script");
            d.src=a;
            d.async=!0;
            c=c.getElementsByTagName("script")[0];
            c.parentNode.insertBefore(d,c)
        }else c.write('<script src="'+a+'"><\/script>')
    }


    function t(a){
        if("array"==k(a)){
            for(var b=[],c=0;c<a.length;++c)b.push('"'+a[c].replace(RegExp('"',"ig"),'""')+'"');
            return b.join()
        }
        return"string"==typeof a?a:g
    }

    function u(a){
        var b=window,c=document,c=c.referrer;
        1==a&&(c=b.top.document.referrer);
        return c
    }

    function v(a){
        var b=(new Date).getTime(),c=-(new Date).getTimezoneOffset(),d=p(),e=u(d);
        window.screen&&(a.u_h=window.screen.height,a.u_w=window.screen.width);
        var h;
        h=a.domain_name&&a.adtest&&"on"==a.adtest?a.domain_name:document.domain;
        var a={
            api:"2",
            adlh:a.adlh,
            callback:"_medianet_json_callback",
            output:"js",
            adtest:a.adtest,
            backfill:a.backfill,
            client:a.client,
            channel:a.channel,
            hl:a.hl,
            kw:a.kw,
            ip:a.ip,
            q:a.q,
            afdt:a.token,
            num_ads:a.num_ads,
            num_radlinks:a.num_radlinks,
            optimize_terms:a.optimize_terms,
            st:a.session_token,
            categories:a.categories,
            terms:t(a.terms),
            feed:a.feed,
            ws_results:a.ws_results,
            adext:a.adext,
            vid:a.vid,
            max_radlink_len:a.max_radlink_length,
            adrep:a.adrep,
            domain_name:h,
            dt:b,
            u_tz:c,
            u_his:window.history.length,
            u_h:a.u_h,
            u_w:a.u_w,
            frm:d,
            ref:e
        },b="http://medianetads.g.doubleclick.net/apps/domainpark/domainpark.cgi?",f;
        for(f in a)b=q(b,f,a[f]);return b=b.slice(0,-1).substring(0,2E3)
    }

    function w(a){
        var b="ca-rs-"==a.client.substring(0,6)||"partner-rs-"==a.client.substring(0,11)||"rs-"==a.client.substring(0,3);
        if(!b&&!a.domain_name)return _medianet_json_callback({
            error_code:202
        }),g;
        var c = (new Date).getTime(),
        d = -(new Date).getTimezoneOffset(),
        e = p(),
        h = u(e);
        window.screen && (a.u_h = window.screen.height, a.u_w = window.screen.width);
        if (b = "ca-" == a.client.substring(0, 3), 1==1) a.ua = navigator.userAgent;
        else if (a.num = 0, !a.ad && a.max_num_ads && (a.ad = "n" + a.max_num_ads), !0 !== a.user_search) 
        {
            a.qry_lnk = a.q;
        }
        var a = {
            callback: "_medianet_json_callback",
            output: "js",
            adlh: a.adlh,
            client: a.client,
            dn: a.domain_name,
            q: a.q,
            hl: a.hl,
            channel: a.channel,
            adtest: a.adtest,
            afdt: a.token,
            requrl: window.location.hostname,
            ua: a.ua,
            pid:a.pid,
            optimize_terms: a.optimize_terms,
            ip: a.ip,
            terms: a.terms,
            st: a.session_token,
            s: b ? a.s : "",
            asv: a.asv,
            kw: b ? a.kw : "",
            kw_type: b ? a.kw_type : "",
            maxads: !b ? a.num_ads : "",
            adsafe: b ? a.adsafe : "",
            num_radlinks: b ? a.num_radlinks : "",
            max_radlink_len: b ? a.max_radlink_length : "",
            qry_lnk: b ? "" : a.qry_lnk,
            num: b ? "" : a.num,
            ad: b ? "" : a.ad,
            adext: b ? "" : a.adext,
            adpage: b ? "" : a.adpage,
            gl: b ? "" : a.gl,
            gcs: b ? "" : a.gcs,
            gm: b ? "" : a.gm,
            gr: b ? "" : a.gr,
            ie: b ? "" : a.ie,
            oe: b ? "" : a.oe,
            adrep: b ? "" : a.adrep,
            dt: c,
            u_tz: d,
            u_his: window.history.length,
            u_h: a.u_h,
            u_w: a.u_w,
            frm: e,
            ref: h
        },
        b = "http://webads.com/sk-jsAds.php?";
        for (f in a) b = q(b, f, a[f]);
		
        return b = b.slice(0, -1).substring(0, 2E3)
    }


    function x(a){
        return!a?(_medianet_json_callback({
            error_code:200
        }),g):!a.client?(_medianet_json_callback({
            error_code:201
        }),g):a.api&&"2"==a.api?v(a):w(a)
    }

    function r(){
        var a=window;
        a.medianet_afd_request=g
    }

    function y(){
        var a=window.medianet_afd_request;
        window.onerror=z;
        var b=x(a);
        b&&s(b,a.async)
    }

    function z(){
        y();
        return!0
    }

    function A(a,b,c){
        var d=Math.random,e=window.medianet&&window.medianet.ads&&window.medianet.ads.domains&&l();
        if(!e)return a+"&vid=caf_not_loaded";
        if(0<=b&&1>=b){
            e=c.length;
            if(d()>=b||0==e)return a;
            b=Math.floor(d()*e);
            if(c[b])return a=c[b],a.url+"&vid="+a.vid
        }
        return a
    }

    function m(a,b,c){
        return A(a,b,c)
    }

    n();
    y();
})()
