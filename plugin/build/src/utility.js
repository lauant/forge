import qs from "qs";
import axios from "axios";

export const capitalize = string => {
    if (typeof string !== "string") return "";
    return string.charAt(0).toUpperCase() + string.slice(1);
};

export const xhr = (req, callback) => {
    
    // if your data props require a fallback, specific it here, otherwise all other props will be dynamically added
    const data = {
        action : req.action || "sba_controller",
        ...req
    };

    const header = req.contentType || "application/x-www-form-urlencoded";

    const options = {
        method  : "POST",
        headers : { "content-type": header },
        data    : qs.stringify(data),
        url     : app_data.ajax_url,
    };

    axios(options).then((response) => {
        callback(response.data);
    });
};

/*!
 * Serialize all form data into a query string
 * (c) 2018 Chris Ferdinandi, MIT License, https://gomakethings.com
 * @param  {Node}   form The form to serialize
 * @return {String}      The serialized form data
 */
export const serialize = (form) => {
    // Setup our serialized data
    var serialized = [];

    // Loop through each field in the form
    for (var i = 0; i < form.elements.length; i++) {
        var field = form.elements[i];

        // Don't serialize fields without a name, submits, buttons, file and reset inputs, and disabled fields
        if (
            !field.name ||
            field.disabled ||
            field.type === "file" ||
            field.type === "reset" ||
            field.type === "submit" ||
            field.type === "button"
        )
            continue;

        // If a multi-select, get all selections
        if (field.type === "select-multiple") {
            for (var n = 0; n < field.options.length; n++) {
                if (!field.options[n].selected) continue;
                serialized.push(
                    encodeURIComponent(field.name) +
                        "=" +
                        encodeURIComponent(field.options[n].value)
                );
            }
        }

        // Convert field data to a query string
        else if (
            (field.type !== "checkbox" && field.type !== "radio") ||
            field.checked
        ) {
            serialized.push(
                encodeURIComponent(field.name) +
                    "=" +
                    encodeURIComponent(field.value)
            );
        }
    }

    return serialized.join("&");
};

export const slugify = text => text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');

export const unSlugify = text => text.replace('-', ' ');

export const getCookie = cookie => {

    var name = cookie + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');

    for(var i = 0; i < ca.length; i++ ) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
  }

export const setCookie = (name,value,days) => {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
