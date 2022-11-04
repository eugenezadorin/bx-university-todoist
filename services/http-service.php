<?php

// @todo check url is valid
function redirect(string $url)
{
	header("Location: $url");
}