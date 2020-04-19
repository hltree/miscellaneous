#!/bin/bash

# Mail app
osascript <<EOF
set recipientName to "to"
set recipientAddress to "from"
set theSubject to "This is the Subject!"
set theContent to "Content!\rContent!\rContent!"

tell application "Mail"
    set theMessage to make new outgoing message with properties {subject:theSubject, content:theContent, visible:true}
    tell theMessage
       make new to recipient with properties {name:recipientName, address:recipientAddress}
    end tell
end tell
EOF
