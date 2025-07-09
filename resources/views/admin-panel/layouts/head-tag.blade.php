<meta charset="UTF-8">
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Title -->
<title>پنل مدیریت</title>

<!-- Favicon -->
<link rel="icon" href="{{asset('admin-panel/img/core-img/favicon.png')}}">

<!-- These plugins only need for the run this page -->
<link rel="stylesheet" href="{{asset('admin-panel/css/default-assets/notification.css')}}">

<link rel="stylesheet" href="{{asset('admin-panel/style.css')}}">

<style>
#preloader {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0;
    right: 0;
    background-color: #ffffff;
    z-index: 999999;
    transition: opacity 0.5s ease-in-out;
}

.ont-preloader {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
}

.animation-preloader {
    text-align: center;
}

.spinner {
    width: 50px;
    height: 50px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #3498db;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

