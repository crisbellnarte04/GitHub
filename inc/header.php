<style>
	header.header {
    position: fixed; /* keep it on top */
    top: 0;
    left: 0;
    width: 100%;
    height: 70px; /* for example */
    background: rgba(0,0,0,0.6);
    display: flex;
    align-items: center;
    padding: 0 20px;
    z-index: 1000; /* on top of everything */
}

</style>
<header class="header" style="background: rgba(0,0,0,0.6); padding: 10px 20px; display:flex; justify-content: space-between; align-items:center;">
    <h2 class="u-name" style="font-family: 'Times New Roman', serif; color: white; font-weight: bold; font-size: 1.5rem;">
        RB LIRIO <b>MEDICAL CLINIC</b>
        <label for="checkbox">
            <i id="navbtn" class="fa fa-bars" aria-hidden="true" style="cursor:pointer; margin-left: 10px;"></i>
        </label>
    </h2>
</header>

<div class="notification-bar" id="notificationBar" style="position: fixed; top: 70px; right: -300px; width: 300px; height: 80%; padding: 20px; background: rgba(0,0,0,0.7); border-radius: 0 0 0 10px; overflow-y: auto; transition: right 0.3s;">
    <ul id="notifications" style="list-style: none; padding-left: 0; color: #fff;">
        <!-- Notifications loaded via AJAX -->
    </ul>
</div>

<script type="text/javascript">
    var openNotification = false;

    const notification = () => {
        let notificationBar = document.querySelector("#notificationBar");
        if (openNotification) {
            notificationBar.classList.remove('open-notification');
            openNotification = false;
        } else {
            notificationBar.classList.add('open-notification');
            openNotification = true;
        }
    }

    let notificationBtn = document.querySelector("#notificationBtn");
    if(notificationBtn){
        notificationBtn.addEventListener("click", notification);
    }
</script>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#notificationNum").load("app/notification-count.php");
        $("#notifications").load("app/notification.php");
    });
</script>
