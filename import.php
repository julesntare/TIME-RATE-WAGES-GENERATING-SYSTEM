<?php

function admin_import() {

  if (isset($_REQUEST['upload'])) {
    $ok = true;
    $file = $_FILES['csv_file']['tmp_name'];
    $handle = fopen($file, "r");
    if ($file == NULL) {
      error(_('Please select a file to import'));
      redirect(page_link_to('admin_export'));
    }
    else {
      while(($filesop = fgetcsv($handle, 1000, ",")) !== false)
        {
          $firstname = $filesop[0];
          $lastname = $filesop[1];
          $username = $filesop[2];
          $gender = $filesop[3];
          $phone = $filesop[4];
          $jobtitle = $filesop[5];
          $salary = $filesop[6];

       
 // If the tests pass we can insert it into the database.       
        if ($ok) {
          $sql = sql_query("
            INSERT INTO `empreg` SET
            `id`='',
            `firstname`='" . sql_escape($firstname) . "',
            `lastname`='" . sql_escape($lastname) . "',
            `username`='" . sql_escape($username) . "',
            `gender`='" . sql_escape($gender) . "',
            `phone`='" . sql_escape($phone) . "',
            `jobtitle`='" . sql_escape($jobtitle) . "',
            `salary`='" . sql_escape($salary) . "',
            `time`='NOW()',
             `date`='CURDATE()'");
        }
      }

      if ($sql) {
        success(_("Your information has imported successfully!"));
        redirect(page_link_to('admin_export'));
      } else {
        error(_('Sorry! There is some problem in the import process.'));
        redirect(page_link_to('admin_export'));
        }
    }
  }
//form_submit($name, $label) Renders the submit button of a form
//form_file($name, $label) Renders a form file box

 return page_with_title("Import Data", array(
   msg(),
  div('row', array(
          div('col-md-12', array(
              form(array(
                form_file('csv_file', _("Import user data from a csv file")),
                form_submit('upload', _("Import"))
              ))
          ))
      ))
  ));
}
?>