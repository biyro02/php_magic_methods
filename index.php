class magic_method_class{
  public static $columns = ['id', 'table', 'row', 'column'];
  public $array=[];
  public function __construct(){
    
  }
  public static function createClassAttributes($row){
    $bucket = new static();
    $bucket->rawData = $row;
    foreach (static::$columns as $column) {
            if(isset($row[$column])){
                $bucket->$column = $bucket->array[] = $row[$column];
            }
        }
        return $bucket;
  }
  public function __call($functionName, $parameters=null)
  {
    $colName = strtolower(str_replace('get', '', $functionName));
    if($colName!='all')
    {
      if(isset($this->$colName)){
        return $this->$colName;
      } else {
        return 'There is no function named '.$functionName.'. Please read the signature of this class.';
      }
    } else {
      return $this->array;
    }
  }

  public function toArray()
  {
    return $this->array;
  }
}

$class = new magic_method_class();

$id = $class::createClassAttributes(['id'=>['45354','7675','87686'],'table'=>'mine table', 'row'=>'this is a row']);

print_r($id->getAll());
