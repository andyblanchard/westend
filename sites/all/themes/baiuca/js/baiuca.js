/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
(function ($) {
    // customize the overlay property according to the different requested page.
    Drupal.behaviors.baiuca = {
        attach: function (context) {

            // http://coveroverflow.com/a/11381730/989439
            function mobilecheck() {
                var check = false;
                (function(a){if(/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
                return check;
            }

            $(".la-anim-1").addClass("la-animate");

            $(".loading_text i").addClass("rotating");

            $(window).load(function() {

                $(".loader,.loading_text").fadeOut();

                $('#masonry_container').masonry({
                    columnWidth: '.grid-sizer',
                    itemSelector: '.item',
                    isFitWidth: true
                });

                $('.front #hero').css("height",$(window).height());

                if(!mobilecheck()){
                    $(".not-logged-in #wrapper_overall,.not-logged-in .navmenu-fixed-left").mCustomScrollbar({
                        advanced:{
                            autoScrollOnFocus: false,
                            updateOnContentResize: true
                        },
                        scrollInertia:100
                    });
                }

            });


            $(window).load(function(){

                /*BLOG DIFERENT COLUMNS SIZES FIX*/

                function fitblogembeds() {

                    var height = $(".view-id-blog_custom.view-display-id-page_1 .view-content .project_images:first,.view-id-blog_custom.view-display-id-page_2 .view-content .project_images:first").find("img");

                    var head_element = $(".view-id-blog_custom.view-display-id-page_1 .view-content .project_images:first,.view-id-blog_custom.view-display-id-page_2 .project_images:first").find("img").closest(".blog_head");

                    var full_element = $(".view-id-blog_custom.view-display-id-page_1 .view-content .node-blog:first,.view-id-blog_custom.view-display-id-page_2 .node-blog:first").find("img").closest(".node-blog");

                    console.log(head_element.height());

                    var video_embed_iframe = $(".view-id-blog_custom.view-display-id-page_1 .view-content iframe,.view-id-blog_custom.view-display-id-page_2 .node-blog iframe").each(function(){
                        $(this).attr("height",height.parent().height() + "px");
                        $(this).attr("width","100%");

                        $(this).closest(".blog_head").attr("style","height:" + head_element.height() + "px;width:100%;");

                        //$(this).closest(".node-blog").attr("style","height:" + full_element.height() + "px;width:100%;");
                    });

                    var video_uploads = $(".view-id-blog_custom.view-display-id-page_1 .view-content .mejs-container,.view-id-blog_custom.view-display-id-page_2 .node-blog .mejs-container").each(function(){

                        $(this).attr("style","height:" + height.parent().height() + "px;width:100%;");
                        //$(this).css("width","100%");
                        $(this).closest(".blog_head").attr("style","height:" + head_element.height() + "px;width:100%;");

                        //$(this).closest(".node-blog").attr("style","height:" + full_element.height() + "px;width:100%;");

                    });
                }

                $( window ).on( 'resize', function() {
                    fitblogembeds();
                });

                fitblogembeds();
            });

            $(window).resize(function(){

                $('.front #hero').css("height",$(window).height());
            });

            $(document).ready(function() {

                $('.flexslider').flexslider();

                //Portfolio

                $('.view-id-work.view-display-id-page_3 .item_inner').hover(function(){
                    $(this).find("div").css({top:$(this).height(),position:'absolute'}).stop().animate({
                        top: 0
                    }, 500,function(){

                        //SAME ON MASONRY
                        $(this).closest(".item_inner").find(".social_icons").stop().fadeIn(300);

                    });
                },function(){

                    $(this).closest(".item_inner").find(".social_icons").stop().hide();

                    $(this).find("div").stop().animate({
                        top:$(this).height()
                    }, 500,function(){

                    });
                });

                $(".arrow_slide_down a").click(function(){

                    if ($(".mCustomScrollBox").length > 0){

                        var elID="#main_container";
                        $(".not-logged-in #wrapper_overall").mCustomScrollbar("scrollTo",elID,{
                            scrollInertia:1000
                        });
                    }
                    else{
                        $("html, body").animate(
                            {
                                scrollTop: $('#main_container').offset().top - 30
                            }
                            , 1000);
                    }



                    return false;

                });

                var menu_link_reservation = $(".work-list .goto_reservation_wrap a");

                menu_link_reservation.click(function(){

                    if ($(".mCustomScrollBox").length > 0){

                        // do something here
                        var elID=".contact_area";
                        $(".not-logged-in #wrapper_overall").mCustomScrollbar("scrollTo",elID,{
                            scrollInertia:1000
                        });
                    }
                    else{
                        $("html, body").animate(
                            {
                                scrollTop: $('.contact_area').offset().top - 30
                            }
                            , 1000);
                    }

                    return false;

                });

                var eventtype = mobilecheck() ? 'touchstart' : 'click';

                var button = $('.navbar-toggle');

                var target_class = button.attr("data-target");

                var target = $(target_class);

                button.bind(eventtype,function(e){

                    if(target.is(':visible')){

                        $("body").animate({
                            left: "0"
                        }, { duration: { duration: 750, queue: false }, queue: false ,complete: function() {
                            $("body").css("left","");
                            $("body").css("overflow","");
                        }});

                        target.animate({
                            left: "-250px"
                        }, { duration: 750, queue: false,complete: function() {

                            target.css("left","").hide();
                            target.css("display","");
                        } });

                    }
                    else{

                        $("body").animate({
                            left: "250px"
                        }, { duration: 750, queue: false,complete: function() {

                            target.css("left","");
                            $("body").css("overflow","hidden");
                        } });

                        target.css("left","-250px").show().animate({
                            left: 0
                        }, { duration: 750, queue: false,complete: function() {


                            target.css("left","");
                        } });
                    }

                });


                /*MAP SHOW HIDE*/
                var view_map = $(".contact_viewmap_button");
                var contact_map = $(".contact_map");
                var contact_form = $(".contact_form");

                view_map.click(function(){
                    contact_map.css("z-index","2");
                    contact_form.css("z-index","1");
                });

                var view_contact_form = $(".contact_vieform_button");

                view_contact_form.click(function(){
                    contact_map.css("z-index","1");
                    contact_form.css("z-index","2");
                });

                /*FULL MAP SHOW HIDE*/
                var view_map_full = $(".contact_viewmap_button_full");
                var contact_map_full = $(".contact_map_full");
                var contact_form_full = $(".white-container");

                view_map_full.click(function(){
                    contact_map_full.css("z-index","2");
                    contact_form_full.css("z-index","1");

                    return false;
                });

                var view_contact_form_full = $(".contact_vieform_button_full");

                view_contact_form_full.click(function(){
                    contact_map_full.css("z-index","1");
                    contact_form_full.css("z-index","2");

                    return false;
                });


                //Menu items animation (fallback for browsers without css3 transition)
                if(!Modernizr.csstransitions) { // Test if CSS transitions are supported
                    $('#block-views-menu-block .image_menu_wrap').each(function(){

                        $(this).hover(function(){

                            $(this).find(".goto_reservation_wrap").animate({
                                top: "60%"
                            }, 200);

                        },function(){

                            $(this).find(".goto_reservation_wrap").animate({
                                top: "300px"
                            }, 200);

                        });

                    });
                }

            });

        }
    };
})(jQuery);



