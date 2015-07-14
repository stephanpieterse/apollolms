<?php

class ALMS_TestHandler{
    
    //todo import all normal test funcs?
    
    public function insertNewTestItem($name, $desc, $code){
        $query = "INSERT INTO tests(name, description, code, access, questions, misccommands) VALUES('$name', '$desc', '$code', '<access></access>', '<testdata></testdata>', '<commands></commands>')";
        $result = sql_execute($query);
        return true;
	}	

    
}
