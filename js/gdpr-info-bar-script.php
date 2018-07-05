<?php 
    require_once(plugin_dir_path(__DIR__).'constants/constants.option.php');
?>

<script>
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    };

    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    };

    function isIOSAndSafariGreaterThanEqual6(){
        var browserAsString = navigator.userAgent,
            regexp = /(.*) OS ([0-9]*)_(.*)/ig,
            match = regexp.exec(browserAsString),
            iosVersion = (match == null  ? "" : match[2]),
            browserIsMobileSafari = false;

        if (/ AppleWebKit\//.test(browserAsString) && / Safari\//.test(browserAsString) && !/ CriOS/.test(browserAsString) && ( iosVersion>=6)){
            browserIsMobileSafari = true;
        }

        return browserIsMobileSafari;
    }

    function showInfoBar() {
        var gdprInfoBar = document.getElementById('gdpr-nav-element');
        if (!getCookie("is-show-gdpr-nav")){
            document.addEventListener("DOMContentLoaded", function() {  
            gdprInfoBar.style.display = 'block';                           
                <?php 
                    if (GDPR_CHECK_CONTENT_PADDING_TOP_OPTION == 1) {
                        ?>
                            var gdprCSSContent = document.getElementsByClassName('<?php echo GDPR_CSS_CONTENT_OPTION ?>'); 
                            styleGdprCSSContent = window.getComputedStyle(gdprCSSContent[0]),
                            paddingTopGdprCSSContent = styleGdprCSSContent.getPropertyValue('padding-top');  
                            if (gdprCSSContent) {
                                gdprCSSContent[0].style.paddingTop = parseInt(paddingTopGdprCSSContent) + parseInt('<?php echo GDPR_PADDING_TOP_OPEN_INFO_BAR_OPTION ?>') + 'px';
                            }                
                        <?php
                    }

                    if (GDPR_CUSTOM_SCRIPT_OPEN_INFO_BAR_OPTION != '') {
                        printf(htmlspecialchars_decode(GDPR_CUSTOM_SCRIPT_OPEN_INFO_BAR_OPTION));
                    }
                ?>
                //Example custom script for DNVR when opening info bar
                // if (has.mobile && !has.iPad && !isIOSAndSafariGreaterThanEqual6()){
			    //     if (!getCookie("turnoff_smartapp_block")){
                //         document.getElementsByClassName("image-360-vr")[0].classList.add("image-360-vr-narrow-info-bar");
			    //     } else {
                //         document.getElementsByClassName("image-360-vr")[0].classList.add("image-360-vr-info-bar");
                //     }
                //     document.getElementById("smartapp-close-button").addEventListener("click", function(){
                //         document.getElementsByClassName("image-360-vr")[0].classList.remove("image-360-vr-narrow-info-bar");
                //         document.getElementsByClassName("image-360-vr")[0].classList.remove("image-360-vr-info-bar");
                //         document.getElementsByClassName("image-360-vr")[0].classList.remove("image-360-vr-narrow");
                //         if (!getCookie("is-show-gdpr-nav")) {
                //             document.getElementsByClassName("image-360-vr")[0].classList.add("image-360-vr-info-bar");
                //         }
                        
                //         document.getElementById("header-360-image").style.height = "100vh";     
                //     });
                //     return;
                // }

                // document.getElementsByClassName("image-360-vr")[0].classList.add("image-360-vr-info-bar");                
                // document.getElementById("header-360-image").style.height = "calc( 100vh - 100px )";   

                //Custom script for DN-Story
                // var classTopMedia = document.getElementsByClassName("top-mediablock-wrapper")[0];
                // var grpdNavElement = document.getElementById("gdpr-nav-element");
                // var image360 = document.getElementsByClassName("dn-360-top-image-wrapper")[0];
                // var siteHeader = document.getElementsByClassName("site-header")[0];                

                // siteHeader.style.backgroundColor = "white";  
                // siteHeader.style.borderBottom = "1px solid #cccccc";   
                // document.getElementById("js--menu-toggle").style.color = "black";          
                
                // document.getElementsByClassName("logo-dn-small")[0].style.backgroundPosition = "-400px -70px";                                   
                // document.getElementsByClassName("logo-dn-medium")[0].style.backgroundPosition = "-170px 0"; 
                // document.getElementsByClassName("inline-icon-right")[0].style.backgroundPosition = "-400px -430px";  
                // document.getElementsByClassName("visually-hidden")[0].style.height = grpdNavElement.offsetHeight + "px";    
                // document.getElementsByClassName("visually-hidden")[0].style.position = "static";     
                // document.getElementsByClassName("fixed-header")[0].style.top = "auto";                                                                                                                                                                                                                            
                // document.getElementsByClassName("reading-position-indicator")[0].style.display = "none";

                // function changeHeightTopMedia() {
                //     detectIE(function(){
                //         if ( classTopMedia !== undefined && grpdNavElement !== undefined ) {
                //             classTopMedia.style.height = "calc( 100vh - " + grpdNavElement.offsetHeight + "px" +")";   
                //         }

                //         if ( image360 !== undefined && grpdNavElement !== undefined ) {
                //             image360.style.height = "calc( 100vh - " + grpdNavElement.offsetHeight + "px" +")";              
                //         }
                //     });
                // }

                // changeHeightTopMedia();

                // window.addEventListener("resize", function() {
                //     document.getElementsByClassName("visually-hidden")[0].style.height = grpdNavElement.offsetHeight + "px";    
                //     changeHeightTopMedia();
                // });
     
            });
        };
    }

    function detectIE(callback) {
        if (!(navigator.appName == "Microsoft Internet Explorer" ||  !!(navigator.userAgent.match(/Trident/) || navigator.userAgent.match(/rv:11/)) || (typeof $.browser !== "undefined" && $.browser.msie == 1))) {
            callback();
        }
    }

    function closeInfoBar() {
        var gdprInfoBar = document.getElementById('gdpr-nav-element');
        gdprInfoBar.style.display = 'none';
        setCookie("is-show-gdpr-nav", true, 10000);        

        <?php 
            if (GDPR_CHECK_CONTENT_PADDING_TOP_OPTION == 1) {
                ?>
                    var gdprCSSContent = document.getElementsByClassName('<?php echo GDPR_CSS_CONTENT_OPTION; ?>');
                    paddingTop = parseInt(gdprCSSContent[0].style.paddingTop);
                    
                    if (gdprCSSContent) {
                        gdprCSSContent[0].style.paddingTop = paddingTop - parseInt('<?php echo GDPR_PADDING_TOP_OPEN_INFO_BAR_OPTION ?>') + 'px';
                    }   
                <?php
            }

            if (GDPR_CUSTOM_SCRIPT_CLOSE_INFO_BAR_OPTION != '') {
                printf(htmlspecialchars_decode(GDPR_CUSTOM_SCRIPT_CLOSE_INFO_BAR_OPTION));
            }
        ?>        
        //Example custom script for DNVR when closing info bar
        // if (has.mobile && !has.iPad && !isIOSAndSafariGreaterThanEqual6()){
		// 	if (!getCookie("turnoff_smartapp_block")){
        //         document.getElementsByClassName("image-360-vr")[0].classList.remove("image-360-vr-narrow-info-bar");
		// 	} else {
        //         document.getElementsByClassName("image-360-vr")[0].classList.remove("image-360-vr-info-bar");
        //     }
        //     return;
        // }
        // document.getElementsByClassName("image-360-vr")[0].classList.remove("image-360-vr-narrow-info-bar");
        // document.getElementsByClassName("image-360-vr")[0].classList.remove("image-360-vr-info-bar");
        // document.getElementById("header-360-image").style.height = "100vh";  
        // document.getElementsByClassName("psv-canvas")[0].style.height = "100vh"; 

        
        // Custom script for DN-Story
        // var siteHeader = document.getElementsByClassName("site-header")[0];                        
        // var classTopMedia = document.getElementsByClassName("top-mediablock-wrapper")[0];
        // var visuallyHidden = document.getElementsByClassName("visually-hidden")[0];
        // var grpdNavElement = document.getElementById("gdpr-nav-element");
        // var image360 = document.getElementsByClassName("dn-360-top-image-wrapper")[0];
        
        // document.getElementsByClassName("visually-hidden")[0].style.position = "absolute ";     
        // document.getElementsByClassName("fixed-header")[0].style.top = 0;    
        // visuallyHidden.style.height = "1px";  
        // detectIE(function(){
        //     if ( classTopMedia !== undefined ) {
        //         classTopMedia.style.height = "calc( 100vh )";  
        //     }

        //     if ( image360 !== undefined ) {
        //         image360.style.height = "calc( 100vh )";  
        //     }
        // });
    }

    function insertBeforeElement(element, childElement) {
        document.addEventListener("DOMContentLoaded", function() { 
            var elementWantToInsert = document.getElementById(element);
            var childElementWantToInsertBefore = document.getElementById(childElement);
            var gdprInfoBar = document.getElementById("gdpr-nav-element");
            elementWantToInsert.insertBefore(gdprInfoBar, childElementWantToInsertBefore);     
            showInfoBar();                                         
        });
    }

</script>