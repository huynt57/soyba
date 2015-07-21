<div id="modal2" class="modal" style="width: 50%; height: auto;" >

    <div class="full-width" id="map">
        test
    </div>
</div>

<script type="text/javascript">
    function getPhar(id) {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'pharmacy/getdetail',
            data: {id: id},
            success: function(response)
            {
                var obj = response.data;
               // alert(response);
            //    prettyPrint();
            console.log(obj.id);
                var map;
                map = new GMaps({
                    div: '#map',
                    lat: obj.laititude,
                    lng: obj.longitude,
                });
                map.addMarker({
                    lat: obj.laititude,
                    lng: obj.longitude,
                    title: obj.address,
                    
                });
            },
        });
    }
</script>