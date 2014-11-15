        <?php
            echo $this->Html->script(['jquery.min', 'bootstrap.min', 'jquery.scrollUp.min']);
            echo $this->fetch('importScript');
            echo $this->Html->script('admin');
            echo $this->fetch('pageScript');
        ?>
<script>
    $(function(){
        $.scrollUp({
            scrollName: 'scrollUp',
            scrollDistance: 50,
            scrollFrom: 'top',
            scrollSpeed: 300,
            easingType: 'linear',
            animation: 'fade',
            animationSpeed: 200,
            scrollTrigger: false,
            scrollTarget: false,
            scrollText: '<i class="fa fa-angle-up"></i>',
            scrollTitle: false,
            scrollImg: false,
            activeOverlay: false,
            zIndex: 99
        });
    });
</script>
