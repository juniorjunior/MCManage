function createToast(args) {

  /* args in the form of JSON

  example usage:

  createIconToast({
      text: "First name cannot be blank",
      time: 4000,
      class: "failtoast",
      icon: "error"
  });

  */

  args.text = args.text === undefined ? "blank" : args.text;
  args.time = args.time === undefined ? 4000 : args.time;
  args.class = args.class === undefined ? "defaulttoast" : args.class;
  args.icon = args.icon === undefined ? null : args.icon;

  var toastText = "";
  if (args.icon != null) {
    toastText = '<span class="right-align"><i class="material-icons left">' +
      args.icon + '</i>' + args.text + '</span>';
  } else {
    toastText = '<span class="right-align">' + args.text + '</span>';
  }
  M.toast({html: toastText, displayLength: args.time, classes: args.class});
}

function createDefaultToast(text, toasttime) {
  if ( toasttime === undefined ) toasttime = 4000;
  createToast({
    text: text,
    time: toasttime,
    class: "defaulttoast"
  });
}

function createFailToast(text, toasttime) {
  if ( toasttime === undefined ) toasttime = 4000;
  createToast({
    text: text,
    time: toasttime,
    class: "failtoast",
    icon: "error"
  });
}
