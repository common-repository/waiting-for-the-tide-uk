
jQuery(document).ready(function($) {

    var localCache = {};

    var TideAdmin = {

        set_locations : function($ele, locations) {
            for (const slug in locations) {
                $ele.append(`<option value='${slug}'>${locations[slug]}</option>`);
            }
        }
    }
    
    /**
     * Load location of region:
     */
    $(document).on("change", ".tide-opt-region", function() {
        var $this = $(this);
        var $locations = $this.closest("form").find(".tide-opt-location");
        var region = $this.val(); 
        //truncate locations:
        $locations.find("option").remove();
        if (localCache.hasOwnProperty(region)) {
            TideAdmin.set_locations($locations, localCache[region]);
            return;
        }
        $locations.prop("disabled", true);
        $.ajax({                            
            url: ajaxurl,  
            type: "POST",
            data: {
                action: "tide_locations",
                region : this.value
            },        
            success: function(data) { 
                if (typeof data === 'object' && data.hasOwnProperty("locations")) {
                    TideAdmin.set_locations($locations, data.locations);
                    localCache[region] = data.locations;
                }
            },
            error: function() {
                console.warn("Error loading locations", arguments);            
            },
            complete: function() {
                $locations.prop("disabled", false);
            }
        });
    });

    /**
     * Toggle map options:
     */
    $(document).on("click", ".tide-opt-map", function() {
        var $this = $(this);
        var enabled = $this.is(":checked");
        var linked = [
            ".tide-opt-maptype",
            ".tide-opt-mapzoom",
            ".tide-opt-mapkey",
            ".tide-opt-mapwidth",
            ".tide-opt-mapheight"
        ];
        $this.closest(".widget-content").find(linked.join(", ")).each(function(){
            if (enabled) {
                $(this).closest("p").show();
            } else {
                $(this).closest("p").hide();
            }
        });
    });

});
