function confirmDelete(id){
  if(confirm('Delete this employee?')){
    document.getElementById('delId').value = id;
    document.getElementById('delForm').submit();
  }
}
