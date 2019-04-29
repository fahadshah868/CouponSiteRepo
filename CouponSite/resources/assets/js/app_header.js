$(document).ready(function() {
    var currentRequest = null;
    $(`.hamburger-overlay-container`).css(`height`, $(document).height() - 122 + `px`);
    $(`.app-header-nav-overlay-container`).css(`height`, $(document).height() - 122 + `px`);
    $(window).resize(function() {
        $(`.hamburger-overlay-container`).css(`height`, `0`);
        $(`.hamburger-overlay-container`).css(`height`, $(document).height() - 122 + `px`);
        $(`.app-header-nav-overlay-container`).css(`height`, `0`);
        $(`.app-header-nav-overlay-container`).css(`height`, $(document).height() - 122 + `px`);
    });
    //search through header search bar 
    $(`#app-header-searchbar`).focus(function(){
        $("#app-header-search-items-container").css('display','block');
    });
    $(`#app-header-searchbar`).on(`input`,function(){
        var title = $.trim($(`#app-header-searchbar`).val());
        $(`#app-header-search-items`).html('');
        if(!title == ``){
            $(`#app-header-searchbar-default-items`).css(`display`,`none`);
            currentRequest = $.ajax({
                type:`GET`,
                url:`/getsearchedresults/`+title,
                data: ``,
                beforeSend: function(){
                    if(currentRequest != null) {
                        currentRequest.abort();
                        $("#app-header-search-loading").css('display','flex');
                    }
                },
                complete: function(){
                    $("#app-header-search-loading").css('display','none');
                },
                success:function(data){
                    var html = "";
                    if(data.stores.length > 0){
                        html = `<div class="app-header-searchbar-heading">Stores</div>`+
                        `<ul>`;
                        $.each(data.stores, function (index, store) {
                            html = html + `<li><a class="app-header-searched-item" href="/store/`+store.secondary_url+`">`+
                            `<div class="app-header-searched-item-img"><img src="`+data.panel_assets_url+store.logo_url+`"></div>`+
                            `<span>`+store.title+`</span>`+
                            `</a></li>`;
                        });
                        html = html + `</ul>`;
                    }
                    if(data.stores.length > 0 && data.categories.length > 0){
                        html = html + `<hr>`;
                    }
                    else if(data.stores.length == 0 && data.categories.length == 0){
                        html = html + "<div style='display: flex; flex-wrap: wrap; justify-content: center; font-size: 16px; font-weight: 500;'>No Result Found</div>";
                    }
                    if(data.categories.length > 0){
                        html = html + `<div class="app-header-searchbar-heading">Categories</div>`+
                        `<ul>`;
                        $.each(data.categories, function (index, category) {
                            html = html + `<li><a class="app-header-searched-item" href="/coupons/`+category.url+`">`+category.title+`</a></li>`;
                        });
                        html = html + "</ul>";
                    }
                    $(`#app-header-search-items`).html(html);
                    $(`#app-header-search-items`).css(`display`,`block`);
                }
            });
        }
        else{
            currentRequest.abort();
            $("#app-header-search-loading").css('display','none');
            $(`#app-header-searchbar-default-items`).css(`display`,`block`);
            $(`#app-header-search-items`).css(`display`,`none`);
        }
    });
    //click on header toggle button
    $(`.menu-toggle`).on(`click`,function(){
        $(`.menu-toggle`).toggleClass(`active`);
        if($(this).hasClass(`active`)){
            $(`#hamburger-overlay-container`).css(`display`,`block`);
        }
        else{
            $(`#hamburger-overlay-container`).css(`display`,`none`);
        }
    });
    //click on header nav links
    $(`.app-header-nav-item-text, .app-header-nav-item-text.fa-angle-down`).click(function(e){
        var header_list_item = $(this).parentsUntil(`.app-header-nav-list`);
        $(`.app-header-nav-item #app-header-nav-overlay-container`).not(header_list_item.find(`#app-header-nav-overlay-container`)).css(`display`,`none`);
        $(`.app-header-nav-item .app-header-nav-item-text`).removeClass(`active-nav-list-item`);
        header_list_item.find(`#app-header-nav-overlay-container`).toggle();
        if(header_list_item.find(`#app-header-nav-overlay-container`).css(`display`) == `block`){
            header_list_item.find(`#app-header-nav-item-text`).addClass(`active-nav-list-item`);
            if(header_list_item.find(`#app-header-nav-item-text`).text() == `Top Stores`){
                if(header_list_item.find(`#app-header-nav-items-container`).children().length > 0){
                    header_list_item.find(`#app-header-nav-loading-container`).css(`display`,`none`);
                    header_list_item.find(`#app-header-nav-items-container`).css(`display`,`block`);
                }
                else{
                    $.ajax({
                        type:`GET`,
                        url:`/getajaxrequest/1`,
                        data: ``,
                        beforeSend: function(){
                            header_list_item.find(`#app-header-nav-loading-container`).css(`display`,`block`);
                            header_list_item.find(`#app-header-nav-items-container`).css(`display`,`none`);
                        },
                        complete: function(){
                            header_list_item.find(`#app-header-nav-loading-container`).css(`display`,`none`);
                            header_list_item.find(`#app-header-nav-items-container`).css(`display`,`block`);
                        },
                        success:function(data){
                            var html = 
                                `<div class="app-header-nav-topitems-container">`;
                                    $.each(data.topstores, function (index, topstore) {
                                        html = html + 
                                        `<a href="/store/`+topstore.secondary_url+`" class="app-header-nav-topitem-container">`+
                                            `<div class="app-header-nav-topitem">`+
                                                `<img src="`+data.panel_assets_url+topstore.logo_url+`">`+
                                                `<span class="app-header-nav-topitem-text">`+topstore.title+`</span>`+
                                            `</div>`+
                                        `</a>`
                                    });
                                html = html +
                                `</div>`+
                                `<div class="app-header-nav-popularitems-container">`+
                                    `<div class="app-header-nav-popularitems-heading">`+
                                        `<span>Popular Stores</span>`+
                                        `<a href="/allstores">See All Stores</a>`+
                                    `</div>`+
                                    `<div class="app-header-nav-popularitems">`+
                                        `<ul>`
                                            $.each(data.popularstores, function (index, popularstore) {
                                                html = html +
                                                `<li>`+
                                                    `<a href="/store/`+popularstore.secondary_url+`">`+
                                                        `<div style="display: flex; flex-direction: row; justify-content: space-between;">`+
                                                            `<span>`+popularstore.title+`</span>`+
                                                            `<span style="white-space: nowrap;">`
                                                                if(popularstore.offers_count == 1){
                                                                    html = html + popularstore.offers_count+` Coupon Available`
                                                                }
                                                                else if(popularstore.offers_count > 1){
                                                                    html = html + popularstore.offers_count+` Coupons Available`
                                                                }
                                                                else{
                                                                    html = html + `No Coupons Available`
                                                                }
                                                            html = html + 
                                                            `</span>`+
                                                        `</div>`+
                                                    `</a>`+
                                                `</li>`
                                            });
                                        html = html +
                                        `</ul>`+
                                    `</div>`+
                                `</div>`
                            header_list_item.find(`#app-header-nav-items-container`).html(html);
                        },
                        error:function(){
                            alert(`Error! something went wrong`);
                        }
                    });
                }
            }
            else if(header_list_item.find(`#app-header-nav-item-text`).text() == `Top Categories`){
                if(header_list_item.find(`#app-header-nav-items-container`).children().length > 0){
                    header_list_item.find(`#app-header-nav-loading-container`).css(`display`,`none`);
                    header_list_item.find(`#app-header-nav-items-container`).css(`display`,`block`);
                }
                else{
                    $.ajax({
                        type:`GET`,
                        url:`/getajaxrequest/2`,
                        data: ``,
                        beforeSend: function(){
                            header_list_item.find(`#app-header-nav-loading-container`).css(`display`,`block`);
                            header_list_item.find(`#app-header-nav-items-container`).css(`display`,`none`);
                        },
                        complete: function(){
                            header_list_item.find(`#app-header-nav-loading-container`).css(`display`,`none`);
                            header_list_item.find(`#app-header-nav-items-container`).css(`display`,`block`);
                        },
                        success:function(data){
                            var html = 
                                `<div class="app-header-nav-topitems-container">`;
                                    $.each(data.topcategories, function (index, topcategory) {
                                        html = html + 
                                        `<a href="/coupons/`+topcategory.url+`" class="app-header-nav-topitem-container">`+
                                            `<div class="app-header-nav-topitem">`+
                                                `<img src="`+data.panel_assets_url+topcategory.logo_url+`">`+
                                                `<span class="app-header-nav-topitem-text">`+topcategory.title+`</span>`+
                                            `</div>`+
                                        `</a>`
                                    });
                                html = html +
                                `</div>`+
                                `<div class="app-header-nav-popularitems-container">`+
                                    `<div class="app-header-nav-popularitems-heading">`+
                                        `<span>Popular Categories</span>`+
                                        `<a href="/allcategories">See All Categories</a>`+
                                    `</div>`+
                                    `<div class="app-header-nav-popularitems">`+
                                        `<ul>`
                                            $.each(data.popularcategories, function (index, popularcategory) {
                                                html = html +
                                                `<li>`+
                                                    `<a href="/coupons/`+popularcategory.url+`">`+
                                                        `<div style="display: flex; flex-direction: row; justify-content: space-between;">`+
                                                            `<span>`+popularcategory.title+`</span>`+
                                                            `<span style="white-space: nowrap;">`
                                                            if(popularcategory.offers_count == 1){
                                                                html = html + popularcategory.offers_count+` Coupon Available`
                                                            }
                                                            else if(popularcategory.offers_count > 1){
                                                                html = html + popularcategory.offers_count+` Coupons Available`
                                                            }
                                                            else{
                                                                html = html + `No Coupons Available`
                                                            }
                                                            html = html +
                                                            `</span>`+
                                                        `</div>`+
                                                    `</a>`+
                                                `</li>`
                                            });
                                        html = html +
                                        `</ul>`+
                                    `</div>`+
                                `</div>`
                            header_list_item.find(`#app-header-nav-items-container`).html(html);
                        },
                        error:function(){
                            alert(`Error! something went wrong`);
                        }
                    });
                }
            }
        }
        else{
            header_list_item.find(`#app-header-nav-item-text`).removeClass(`active-nav-list-item`);
        }
    });
    $(document).click(function(e){
        //click outside the mega dropdown container
        if(!$(e.target).hasClass(`app-header-nav-body-container`) &&                         //click on body container
        !$(e.target).parents(`.app-header-nav-body-container`).length > 0 &&                 //click inside body container
        !$(e.target).hasClass(`app-header-nav-item-text`) &&                                          //click on nav list item text
        !$(e.target).hasClass(`app-header-list-arrow`) &&                                                       //click on nav list item arrow
        !$(e.target).hasClass(`menu-toggle`) &&                                                             //click on hamburger menu
        !$(e.target).parents(`.menu-toggle`).length > 0 &&                                                  //click on inside hamburger menu
        !$(e.target).parents(`.hamburger-menu-list`).length > 0){                                      //click on hamburger menu list items
            $(`.app-header-nav-item .app-header-nav-item-text`).removeClass(`active-nav-list-item`);
            $(`.app-header-nav-overlay-container`).css(`display`,`none`);
            $(`#hamburger-overlay-container`).css(`display`,`none`);
            $(`.menu-toggle`).removeClass(`active`);
        }
        //click outside the app-header-searchbar and searched items container
        if(!$(`#app-header-search-items-container`).is(e.target) &&
        $(`#app-header-search-items-container`).has(e.target).length === 0 &&
        !$(`#app-header-searchbar`).is(e.target)){
            $(`#app-header-search-items-container`).css('display','none');
        }
    });
});