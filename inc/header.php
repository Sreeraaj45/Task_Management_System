<header class="header">
	<h2 class="u-name">Task <b>Management</b>
		<label for="checkbox">
			<i id="navbtn" class="fa fa-bars" aria-hidden="true"></i>
		</label>
	</h2>
	<span class="notification" id="notificationBtn">
		<i class="fa fa-bell" aria-hidden="true"></i>
		<span id="notificationNum"></span>
	</span>
</header>
<div class="notification-bar" id="notificationBar">
	<ul id="notifications">
	
	</ul>
</div>

<style>
	* {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

	.header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #007BFF;
        color: white;
        padding: 15px 20px;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1000;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        animation: fadeIn 0.8s ease-in-out;
    }

	.u-name {
        font-weight: 600;
        font-size: 22px;
    }

    .u-name b {
        font-weight: 700;
        color: #FFD700;
    }

	#navbtn {
        font-size: 24px;
        margin-left: 15px;
        cursor: pointer;
        transition: transform 0.3s ease-in-out;
    }

    #navbtn:hover {
        transform: scale(1.1);
    }

	.notification {
        position: relative;
        cursor: pointer;
        font-size: 20px;
        transition: transform 0.3s ease-in-out;
    }

    .notification:hover {
        transform: scale(1.1);
    }

	#notificationNum {
        background: red;
        color: white;
        font-size: 12px;
        border-radius: 100%;
        font-weight: bold;
    }

	.notification-bar {
        position: fixed;
        top: 60px;
        right: -300px;
        width: 280px;
        background: white;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        transition: right 0.3s ease-in-out;
        z-index: 999;
        padding: 10px;
        max-height: 400px;
        overflow-y: auto;
        animation: slideRight 0.6s ease-in-out;
    }

    .notification-bar.open-notification {
        right: 10px;
    }

    .notification-bar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .notification-bar ul li {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
        transition: background 0.3s ease-in-out;
    }

    .notification-bar ul li:hover {
        background: #f1f1f1;
    }

	/* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideRight {
        from { right: -300px; }
        to { right: 10px; }
    }
</style>

<script type="text/javascript">
	var openNotification = false;

	const notification = ()=> {
		let notificationBar = document.querySelector("#notificationBar");
		if (openNotification) {
			notificationBar.classList.remove('open-notification');
			openNotification = false;
		}else {
			notificationBar.classList.add('open-notification');
			openNotification = true;
		}
	}
	let notificationBtn = document.querySelector("#notificationBtn");
	notificationBtn.addEventListener("click", notification);
</script>

<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function(){

       $("#notificationNum").load("app/notification-count.php");
       $("#notifications").load("app/notification.php");

   });
</script>