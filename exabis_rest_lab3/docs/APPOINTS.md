error id on null in get functionget_moodle_view_details($view_id)-> solved with inicialice variable $result in class get_view($id) in moodle externallib.php

## Errors Moodle

* Undefined constant “BLOCK_EXACOMP_DB_DESCRIPTORS”

  * Method -> block_exaport_list_competencies.
* { [“exception”]=> string(27) “invalid_parameter_exception” [“errorcode”]=> string(16) “invalidparameter” [“message”]=> string(87) “Invalid parameter value detected (Missing required key in single structure: categoryid)” [“debuginfo”]=> string(52) “Missing required key in single structure: categoryid” }

  * Method -> block_exaport_get_category.
* 1array(2) { [“exception”]=> string(5) “Error” [“message”]=> string(57) “Undefined constant “BLOCK_EXACOMP_DB_COMPETENCE_ACTIVITY”” } Category ****************
  Array ( [exception] => Error [message] => Undefined constant “BLOCK_EXACOMP_DB_COMPETENCE_ACTIVITY”}

  * Method -> block_exaport_get_competencies_by_item.
* Error id -> null

  * this error make have problems with title name.
  * Solutions go to externallib.php in moodle and inicialice variable $result
  * example
    * $result =newstdClass();
* 

## Questions Sergey

1. Como podriamos obtener la url completa de los videos que se adjuntan en las vistas.
2.
