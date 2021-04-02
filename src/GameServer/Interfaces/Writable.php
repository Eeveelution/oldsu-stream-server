<?php
//Writable objects are object that can be written and Represented as a String
interface Writable
{
    public function Write() : string;
}