<?php
$dataFileName = getcwd() . DIRECTORY_SEPARATOR . 'mydata.txt';
$count = file_exists($dataFileName) ? COUNT(FILE($dataFileName)) : 0;
?>
<HEAD>
 <script type="text/javascript" id="ca_eum_ba" agent=browser src="https://cloud.ca.com/mdo/v1/sdks/browser/BA.js" data-profileUrl="https://collector-axa.cloud.ca.com/api/1/urn:ca:tenantId:CACDNA01-USERSTORE/urn:ca:appId:MSF%20-%20NACentral/profile?agent=browser" data-tenantID="CACDNA01-USERSTORE" data-appID="MSF - NACentral" data-appKey="afcefef0-55cb-11e7-b4bd-09d934e182f7" ></script> 
<HEAD>
<style scoped>
    content {
        height: 100%;
        padding-top: 50px;
    }

    .spinner {
        width: 168px;
        height: 163px;
        background: url(/assets/images/loader.png) no-repeat center center;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
        -webkit-animation: load8 1.1s infinite linear;
        animation: spin 1.1s infinite linear;
    }

    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }
    @keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    #counter {
        display: inline-block;
    }

</style>

<script>

    function updateCount(count) {
        var counter = document.getElementById("counter");
        counter.innerText = count;
    }

    function count() {
        $.ajax({
            url: "/plugins/entries.php",
            data: null,
            success: updateCount,
            dataType: ""
        });
    }

    count();

    setInterval(function() { count(); }, 5000);
</script>

<div class="pure-u-1 centered-text">
    <h3>1. GO TO <a href="http://nacentral.cdbu.io">http://nacentral.cdbu.io</a></h3>
    <h3>2. SUBMIT YOUR FULL NAME</h3>
    <h3>3. SHABANG! YOU'RE IN THE GAME!</h3>

<!--    <h1>--><?//=$count?><!-- Entries in the raffle</h1>-->
    <h1><div id="counter"></div> Entries in the raffle</h1>

    <form action="winners" method="post" name="winnersForm"></form>

    <div id="submitBtn">
        <button onclick="getWinners()"
                class="horizontal-center pure-button pure-button-primary pure-u-1 pure-u-md-1 pure-u-lg-2-3" <?=$count ? "" : "disabled"?>>And the winners are...</button>
    </div>
    <div id="loader" style="display: none;">
        <div class="spinner horizontal-center"></div>
        <h3>Computing...</h3>
    </div>
</div>

<script type="text/javascript">
    function getWinners() {
        var loader = document.getElementById('loader');
        var submitBtn = document.getElementById('submitBtn');

        loader.style.cssText = "display: block !important;";
        submitBtn.style.display = 'none';

        setTimeout(function () {
            document.winnersForm.submit();
        }, 2000);
    }
</script>
