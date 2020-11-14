<?php

/**
 *
 * @param type $uri
 * @return type
 */
function propertyUrl($uri = "")
{
    return base_url("property/" . $uri);
}

function uploadUrl($uri = "")
{
    return base_url("uploads/" . $uri);
}

function systemlogoSrc()
{
    return propertyUrl("images/fbdLogo.png");
}

function favicon()
{
    return propertyUrl("images/favicon.ico");
}

function systemName()
{
    return "Fast Net BD";
}

/*
 *
 * Link reload
 */
function authUrl($uri = "")
{
    return base_url("auth/" . $uri);
}

function loginUrl()
{
    return authUrl('login');
}

function sysUrl($uri = "")
{
    return base_url("sys/" . $uri);
}

function reportUrl($uri = "")
{
    return base_url("report/" . $uri);
}


/**
 * Check session
 * @return boolean
 */
function currentSession()
{
    return isset($_SESSION['user']) ? $_SESSION['user'] : 0;
}

function currentUserInfo($col)
{
    return currentSession()->$col;
}

function currentUserID()
{
    return currentSession() ? currentSession()->eID : 0;
}

function currentUserName()
{
    return currentSession() ? currentSession()->eName : 0;
}

function currentUserType()
{
    return currentSession() ? currentSession()->eDesignation : 0;
}

function currentUserImage()
{
    return currentSession() ? uploadUrl(currentSession()->eImage) : propertyUrl('images/avatar.png');
}


function convertTime($dec)
{
    // start by converting to seconds
    $seconds = ($dec * 3600);
    // we're given hours, so let's get those the easy way
    $hours = floor($dec);
    // since we've "calculated" hours, let's remove them from the seconds variable
    $seconds -= $hours * 3600;
    // calculate minutes left
    $minutes = floor($seconds / 60);
    // remove those from seconds as well
    $seconds -= $minutes * 60;
    // return the time formatted HH:MM:SS
    return lz($hours) . ":" . lz($minutes);
}

//for invoice page msg
function setAlertMsgFromViewPage($msg = "", $msgType = "")
{
    if ($msg) {
        $_SESSION["altMsg"] = $msg;
        $_SESSION["altMsgType"] = $msgType;
    }
}

function RandomString($length)
{
    $keys = array_merge(range(0, 9), range('A', 'Z'));
    $key = "";
    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[mt_rand(0, count($keys) - 1)];
    }
    return $key;
}

function isAdmin()
{
    if (currentUserType() == 'Admin') {
        return true;
    }
}

function isCoAdmin()
{
    if (currentUserType() == 'Co-Admin ') {
        return true;
    }
}
