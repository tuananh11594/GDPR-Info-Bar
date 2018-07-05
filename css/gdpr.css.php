<?php require_once(plugin_dir_path(__DIR__).'constants/constants.option.php'); ?>


<style>
    #gdpr-nav-element {
        background-color: #f2f2f2;
        padding: 16px;
        text-align: center;
        margin: auto;
        display: none;
    }
    .gdpr-nav-text {
        font-family: <?php echo htmlspecialchars_decode(GDPR_FONT_FAMILY_TEXT_OPTION); ?>;        
        font-size: <?php echo GDPR_FONT_SIZE_TEXT_OPTION; ?>;
        font-style: normal;
        font-stretch: normal;
        line-height: 1.29;
        letter-spacing: 0.2px;
        text-align: center;
        color: #222222;
        display: inline-block;
    }

    .gdpr-nav-button-group {
        width: 100%;
        display: table;
        margin-top: 16px;
    }

    .gdpr-nav-button {
        background: none;
        color: #222222;
        border: 1px solid #222222;
        border-radius: 4px;
        font-family: <?php echo htmlspecialchars_decode(GDPR_FONT_FAMILY_BUTTON_OPTION); ?>;         
        font-size: <?php echo GDPR_FONT_SIZE_BUTTON_OPTION; ?>;
        min-width: 88px;
        height: 30px;
        transition: all 0.3s ease-in-out;
        display: inline-block;
        line-height: 16px;
        letter-spacing: 0.2px;
        text-align: center;
        margin-left: 0px;
        margin-right: 8px;
        margin-top: 0px;
        margin-bottom: 0px;
    }

    .gdpr-nav-button-red {
        background-color: #da000d;
        color: #ffffff;
        border: 1px solid #da000d;
    }
    .gdpr-nav-button:hover {
        background-color: #222222;
        color: #ffffff;
        border: 1px solid #222222;
    }

    @media screen and (max-width: 480px) {
        #gdpr-nav-element {
            padding: 16px 24px;  
        }
    }

    /* Custom CSS Setting Info Bar */
    <?php echo GDPR_CUSTOM_CSS_OPTION; ?>

    /* Example custom css for DN-Story*/
    /* #gdpr-nav-element {
        position: fixed; 
        z-index: 160000; 
        top: 0px; 
        width: 100%
    } */
    
    /* Example custom css for DN-VR
        95 is height of smart app banner, 105 is height of info bar container
    */
    /* .image-360-vr-info-bar, .image-360-vr-info-bar iframe {
	    position: relative;
	    min-height: 100px;
        height: calc( 100vh - 100px); 
    }

    .image-360-vr-narrow-info-bar, .image-360-vr-narrow-info-bar iframe {
	    position: relative;
	    min-height: 100px;
        height: calc( 100vh - 95px - 100px);
    }

    @media (min-width: 320px) and (max-width: 480px) {
        .image-360-vr-info-bar, .image-360-vr-info-bar iframe {
            height: calc( 100vh - 115px); 
        }

        .image-360-vr-narrow-info-bar, .image-360-vr-narrow-info-bar iframe {
	        position: relative;
	        min-height: 100px;
            height: calc( 100vh - 95px - 115px);
        }
    } */
</style>