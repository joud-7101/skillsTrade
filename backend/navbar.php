<?php
session_start();

$navbar = '<nav>
<a href="../HTML/homePage.html">Home</a>
<a href="../HTML/Community.html">Community</a>
<a href="../HTML/Skills.html">Explore Skills</a>
<a href="../HTML/MyTrades.html">My Trades</a>
<a href="../HTML/ShareSkill.html">Share Your Skill</a>
<a href="../HTML/ManageRequests.html">Manage Requests</a>';

if (isset($_SESSION['user_id'])) {
    // logged in
    $navbar .= '<a href="../backend/logout.php" class="logout-icon"><i class="fas fa-sign-out-alt"></i> Logout</a>';
} else {
    // logged out
    $navbar .= '    
    <a href="../HTML/Login.html" class="login-icon"><i class="fas fa-sign-in-alt"></i> Login</a>
    <a href="../HTML/Register.html">Register</a>';
}

$navbar .= '</nav>';

echo $navbar;
?>
