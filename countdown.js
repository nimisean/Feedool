var d = new Date();
d.setMinutes(d.getMinutes() + 30);
$('#timer').tinyTimer({ to: d });