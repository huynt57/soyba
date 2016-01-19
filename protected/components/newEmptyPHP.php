<div class="divider"></div>
<!-- home content -->
<div id="home" class="container clearfix">

    <div id="room_block">
        <div class="col-xs-12">
            <p style="float:left;">Post</p>
            <div style="float:right;">
                <span class="share_txt">Share this</span>
                <div class="share_icons">
                    <a class="facebook"></a>
                    <a class="twitter"></a>
                    <a class="gplus"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="entry-content">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-md-9 left-content" style="border: none">
                <div class="row">
                    <div class="col-xs-12">
                        <h3 class="title"><%= data.title %>
                        </h3>
                        <hr>



                        <!-- Date/Time -->
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <%= data.createdAt %></p>


                        <div class="divider type2"></div>
                        <p class="content"><%- data.content %></p>
                    </div>

                </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-3">
                <h3 class="title">Other posts
                </h3>
                <div class="divider type2"></div>
                <div class="content other_rooms">
                    <div class="col-xs-12 clearfix">
                        <img alt="luxury hotel" src="../img/uploads/other-rooms-1.png ">
                        <div class="detail">
                            <p class="room_type">Superior Room</p>
                            <p class="room_price"><span style="color: #8E44AD">$720,00</span> /<span style="color: #9b9b9b">pernight</span> </p>
                        </div>
                        <span class="room_link">
                            <i class="glyphicon glyphicon-chevron-right"></i>
                        </span>

                    </div>
                    <div class="col-xs-12 clearfix">
                        <img alt="luxury hotel" src="../img/uploads/other-rooms-2.png ">
                        <div class="detail">
                            <p class="room_type">Family Room</p>
                            <p class="room_price"><span style="color: #8E44AD">$910,00</span> /<span style="color: #9b9b9b">pernight</span> </p>
                        </div>
                        <span class="room_link">
                            <i class="glyphicon glyphicon-chevron-right"></i>
                        </span>
                    </div>
                    <div class="col-xs-12 clearfix">
                        <img alt="luxury hotel" src="../img/uploads/other-rooms-3.png ">
                        <div class="detail">
                            <p class="room_type">Business Class Room</p>
                            <p class="room_price"><span style="color: #8E44AD">$1210,00</span> /<span style="color: #9b9b9b">pernight</span> </p>
                        </div>
                        <span class="room_link">
                            <i class="glyphicon glyphicon-chevron-right"></i>
                        </span>
                    </div>
                    <div class="col-xs-12 clearfix">
                        <img alt="luxury hotel" src="../img/uploads/other-rooms-4.png ">
                        <div class="detail">
                            <p class="room_type">Luxury Room</p>
                            <p class="room_price"><span style="color: #8E44AD">$1720,00</span> /<span style="color: #9b9b9b">pernight</span> </p>
                        </div>
                        <span class="room_link">
                            <i class="glyphicon glyphicon-chevron-right"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>
</div>