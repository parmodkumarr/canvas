function addToWorkarea() {
  var chartName = $('#chartName').val();
  var html = '<div onclick="showChartType()">'+chartName+'</div>';
  $('#chartList').append(html);
}
