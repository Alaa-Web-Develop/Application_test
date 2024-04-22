<?php

//to inforce models implement this methods with different bodies
interface operations{
    function create();
    function read();
    function update();
    function delete();

}