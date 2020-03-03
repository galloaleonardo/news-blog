function deleteData(view, id)
{
    var id = id;
    var url = '/admin/' + view + '/:id';
    url = url.replace(':id', id);
    $("#deleteFormIndex").attr('action', url);
}