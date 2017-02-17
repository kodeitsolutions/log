<?php

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;

function setActive($uri)
{
	return Request::is($uri) ? 'active' : '';
}

function getPath()
{
	return Request::getPathInfo();
}