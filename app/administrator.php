<?php
    $this->admin->register("User");
    $this->admin->lists("User", array("FirstName", "LastName", "UserName", "Email", "IsStaff", "IsSuperuser"));
?>