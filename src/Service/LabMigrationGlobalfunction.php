 <?php
 
namespace Drupal\lab_migration\Service;

 class LabMigrationGlobalfunction{

   public function _list_of_labs()
  {
    $lab_titles = array(
        '0' => 'Please select...'
    );
    //$lab_titles_q = $injected_database->query("SELECT * FROM {lab_migration_proposal} WHERE solution_display = 1 ORDER BY lab_title ASC");
    $query = \Drupal::database()->select('lab_migration_proposal');
    $query->fields('lab_migration_proposal');
    $query->condition('solution_display', 1);
    $query->condition('approval_status', 3);
    $query->orderBy('lab_title', 'ASC');
    $lab_titles_q = $query->execute();
    while ($lab_titles_data = $lab_titles_q->fetchObject())
      {
        $lab_titles[$lab_titles_data->id] = $lab_titles_data->lab_title . ' (Proposed by ' . $lab_titles_data->name_title .' '.$lab_titles_data->name . ')';
      }
    return $lab_titles;
  }
 }