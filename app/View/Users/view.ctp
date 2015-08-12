<div class="container">
    <legend><?php echo __('User Profile'); ?></legend>
    <div class="row">
        <div class="col-md-2">
            <div>
                <img style="width: 140px; height: 140px;" src="http://besthqimages.mobi/wp-content/uploads/default-profile-picture-png-pictures-2.png" alt="profile's picture" class="img-circle">
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-2 my_header">
                    <p>Name</p>
                </div>
                <div class="col-md-10">
                    <p><?php echo $user ? $user['User']['first_name'] . ' ' . $user['User']['last_name'] : '' ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 my_header">
                    <p>Username</p>
                </div>
                <div class="col-md-10">
                    <p><?php echo $user ? $user['User']['username'] : '' ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 my_header">
                    <p>Email</p>
                </div>
                <div class="col-md-10">
                    <p><?php echo $user ? $user['User']['email'] : '' ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 my_header">
                    <p>Age</p>
                </div>
                <div class="col-md-10">
                    <p><?php echo $user ? $user['User']['age'] : '' ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 my_header">
                    <p>Phone number</p>
                </div>
                <div class="col-md-10">
                    <p><?php echo $user ? $user['User']['phone_number'] : '' ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 my_header">
                    <p>Address</p>
                </div>
                <div class="col-md-10">
                    <p><?php echo $user ? $user['User']['address'] : '' ?></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 my_header">
                    <p>Major</p>
                </div>
                <div class="col-md-10">
                    <p><?php echo $user ? $user['User']['major'] : '' ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-4"><p><a class="btn btn-success pull-right" href="/users/edit/<?php echo $user['User']['id'] ?>">Edit Profile</a></p></div>
            <div class="col-md-8">
            </div>
        </div>
    </div>
</div>