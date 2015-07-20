<div id="modal2" class="modal" style="width: 50%; height: auto;" >

    <div class="full-width" id="map">

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
            //    prettyPrint();
                var map;
                map = new GMaps({
                    div: '#map',
                    lat: obj[0].laititude,
                    lng: -77.028333
                });
                map.addMarker({
                    lat: -12.043333,
                    lng: -77.03,
                    title: 'Lima',
                    details: {
                        database_id: 42,
                        author: 'HPNeo'
                    },
                    click: function(e) {
                        if (console.log)
                            console.log(e);
                        alert('You clicked in this marker');
                    }
                });
                map.addMarker({
                    lat: -12.042,
                    lng: -77.028333,
                    title: 'Marker with InfoWindow',
                    infoWindow: {
                        content: '<p>HTML Content</p>'
                    }
                });
            },
        });
    }
</script>