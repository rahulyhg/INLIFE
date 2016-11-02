 
<style> video{position:fixed;
      top:50%;
      left:50%;
      min-width:100%;
      min-height:100%;
      width:auto;
      height:auto;
      z-index:-100;
      -webkit-transform:translateX(-50%) translateY(-50%);transform:translateX(-50%) translateY(-50%);
      background:url(../../s3-us-west-2.amazonaws.com/s.cdpn.io/4273/polina.jpg) no-repeat;background-size:cover;
      -webkit-transition:1s opacity;
      transition:1s opacity}
    </style>



    <video autoplay controls poster="../../s3-us-west-2.amazonaws.com/s.cdpn.io/4273/polina.jpg" id="bgvid">
    <source src="<?php echo base_url("resources/video/inlife_intro.mp4"); ?>" type="video/mp4" >

</video>

 


<script>
    var vid = document.getElementById("bgvid");
    vid.onended = function () {
        location.href = "home";
    };
</script>

