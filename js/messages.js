// Edit message
function editMessage(elementId, url) {
    console.log(elementId);
    console.log(url);
    var messageId = "message-".concat(elementId);
    var messageElement = document.getElementById(messageId);
    
    var message = messageElement.innerHTML;
    
    var form_node = document.createElement("form");
    form_node.setAttribute("method", "POST");
    form_node.setAttribute("action", url);
    
    var row_div = document.createElement("div");
    row_div.setAttribute("class", "form-group form-row");
    
    var col_div = document.createElement("div");
    col_div.setAttribute("class", "col");
    
    var input = document.createElement("input");
    input.setAttribute("class", "form-control");
    input.setAttribute("id", "edit");
    input.setAttribute("name", "edit");
    input.setAttribute("type", "text");
    input.setAttribute("value", message);
    
    var button = document.createElement("button");
    button.setAttribute("class", "btn btn-primary");
    button.setAttribute("type", "submit");
    button.textContent = "Edit";
    
    form_node.appendChild(row_div);
    row_div.appendChild(col_div);
    row_div.appendChild(button);
    col_div.appendChild(input);
    
    messageElement.replaceWith(form_node);
    
};

//delete message
function deleteMessage(elementId, url) {
    var messageId = "message-".concat(elementId);
    var messageElement = document.getElementById(messageId);
    
    var form_node = document.createElement("form");
    form_node.setAttribute("method", "POST");
    form_node.setAttribute("action", url);
    
    var div = document.createElement("div");
    div.setAttribute("class", "form-group form-row");
    
    var input = document.createElement("input");
    input.setAttribute("id", "delete");
    input.setAttribute("name", "delete");
    input.setAttribute("type", "hidden");
    input.setAttribute("value", "1");
    
    var button = document.createElement("button");
    button.setAttribute("class", "btn btn-primary mr-2");
    button.setAttribute("type", "submit");
    button.textContent = "Delete Message";
    
    form_node.appendChild(div);
    div.appendChild(input);
    div.appendChild(button);
    
    messageElement.replaceWith(form_node);
          
};
    
