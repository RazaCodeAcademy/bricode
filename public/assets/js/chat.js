// base url of application
// const base_url = "http://localhost/sj-solutionz/concard/";
const base_url = "https://salloumdesign.com/concard/";

// appliction routes
const route = {
    chat_clear: base_url + "conversation/chat/clear",
    search_users: base_url + "conversation/search/users",
    conversation_list: base_url + "conversation/list",
    conversation_chat: base_url + "conversation/chat",
    conversation_send: base_url + "conversation/send/message",
};

// create element
const ele = (id) => {
    return document.getElementById(id);
}

const cls = (id) => {
    return document.querySelector(`.${id}`)
}

// create chat variables
const chatter = {
    participant_id: '',
    new_participant_id: '',
    conversation_id: '',
    last_user_id: '',
    last_msg_created_at: '',
    recipient_name: '',
    recipient_image: '',
    last_message: 'last-message-',
    last_message_time: 'last-message-time-',
    list: ele('chat-list'),
    logo: ele('chat-logo'),
    box: ele('chat-box'),
    new_participant: ele('new-participant'),
    message_head: ele('message-head'),
    message_text: ele('message-text'),
    messages: ele('conversation-messages'),
};

// load list when window load
window.onload = () => {
    chat_list();

}

// load conversation chat
const chat_list = () => {
    $.ajax({
        type: 'GET',
        url: route.conversation_list,
        success: (res) => {
            chatter.list.innerHTML = '';
            if (res.count > 0) {
                const conversations = res.conversations;
                list_loop_over(conversations)
            }
            if (chatter.participant_id) {
                setTimeout(() => {
                    set_atcive(chatter.participant_id);
                }, 200);
            }
        }
    });
}

const list_loop_over = (conversations) => {
    var html = '';
    conversations.forEach((conversation) => {
        html += recipient(conversation);
    });
    setTimeout(() => {
        chatter.list.innerHTML = html;
    }, 100);
}

// get single receipient
const recipient = (conversation) => {
    const user = conversation.recipient;
    const msg = conversation.message;
    return `
    <div id="user-chat-${user.id}">
        <div class="friend-drawer friend-drawer--onhover" onclick="set_atcive(${user.id})" id="user-${user.id}">
            <img class="profile-image"
                src="${user.image}"
                alt="" id="image-${user.id}">
            <div class="text">
                <h6 id="name-${user.id}">${user.first_name} ${user.last_name}</h6>
                <p class="text-muted" id="last-message-${user.id}">${msg.text}</p>
            </div>
            <span class="time text-muted small time-set time-set" id="last-message-time-${user.id}">
            ${msg.created_at != '....' ? moment(msg.created_at).format('LT') : moment().format('LT')}</span>
            </div>
        <hr>
        </div>
    `
}

const set_atcive = (id) => {
    chatter.list.childNodes.forEach((e) => {
        if (e.tagName == "DIV") {
            if (e.firstElementChild.classList.contains('active')) {
                e.firstElementChild.classList.remove('active');
            }

            if (chatter.box.classList.contains('hidden')) {
                chatter.box.classList.remove('hidden')
                chatter.logo.classList.add('hidden')
            }

        }
    });

    if (ele(`user-${id}`)) {
        ele(`user-${id}`).classList.add('active');
        chatter.participant_id = id;

        chatter.recipient_name = ele(`name-${id}`).innerText;
        chatter.recipient_image = ele(`image-${id}`).src;
    } else {
        chatter.box.classList.add('hidden')
        chatter.logo.classList.remove('hidden')
    }

    conversation_head();

    conversation_messages();

    setTimeout(() => {
        scrollBottom();
    }, 800);

}

// load specific user head
const conversation_head = () => {
    var html = `
        <div class="friend-drawer no-gutters friend-drawer--grey">
            <img class="profile-image"
                src="${chatter.recipient_image}"
                alt="">
            <div class="text">
                <h6>${chatter.recipient_name}</h6>
                <p class="text-muted online-status">ONLINE</p>
            </div>
            <span class="Movevert">
                <div class="dropdown">
                    <svg class="dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false" id="dropdownMenuButton1"
                        xmlns="http://www.w3.org/2000/svg" width="28" height="28"
                        viewBox="0 0 24 24"
                        style="fill: rgb(252, 245, 245);transform: ;msFilter:;">
                        <path
                            d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0-6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 12c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z">
                        </path>
                    </svg>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item cursor" onclick="conversation_messages()">Refresh</a></li>
                        <li><a class="dropdown-item cursor" onclick="clear_chat()">Clear Messages</a></li>
                    </ul>
                </div>

            </span>
        </div>
    `;

    chatter.message_head.innerHTML = html;
}


// load specific user messages
const conversation_messages = () => {
    $.ajax({
        type: 'GET',
        url: route.conversation_chat,
        data: {
            participant_id: chatter.participant_id
        },
        success: (res) => {
            chatter.messages.innerHTML = '';
            chatter.conversation_id = res.conversation_id;
            if (res.count > 0) {
                const messages = res.messages;
                var html = '';
                messages.forEach((msg, i) => {
                    if (typeof messages[i + 1] !== 'undefined') {
                        chatter.last_msg_created_at = messages[i + 1].created_at;
                        chatter.last_user_id = messages[i + 1].user_id;
                    } else {
                        chatter.last_msg_created_at = '';
                        chatter.last_user_id = '';
                    }
                    html += message(msg, res.auth_id);
                });

                setTimeout(() => {
                    chatter.messages.innerHTML = html;
                }, 500);
            }
        }
    });
}

// load single message
const message = (msg, auth_id) => {
    if (msg.user_id == auth_id) {
        var html = `
            <div class="row no-gutters">
                <div class="col-md-8 offset-md-4">
                    <div class="chat-bubble chat-bubble--right">
                        ${msg.text}
                    </div>`;
        if (moment(msg.created_at).format('lll') != moment(chatter.last_msg_created_at).format('lll') || chatter.last_user_id != msg.user_id) {
            html += `<p class="time-right time-${msg.user_id}-${get_time(msg.created_at)}">${moment(msg.created_at).format('lll')}</p>`;
        }
        html += `</div>
            </div>
        `;

        return html;
    } else {
        var html = `
            <div class="row no-gutters">
                <div class="col-md-8">
                    <div class="chat-bubble chat-bubble--left">
                        ${msg.text}
                    </div>`;
        if (moment(msg.created_at).format('lll') != moment(chatter.last_msg_created_at).format('lll') || chatter.last_user_id != msg.user_id) {
            html += `<p class="time-right time-${msg.user_id}-${get_time(msg.created_at)}">${moment(msg.created_at).format('lll')}</p>`;
        }
        html += `</div>
            </div>
        `;

        return html;
    }

}

// send message to user
const send_message = () => {
    let text = chatter.message_text.value;
    text = text != '' ? text : cls('emojionearea-editor').innerText;
    cls('emojionearea-editor').innerText = '';
    if (text != '') {
        $.ajax({
            type: 'POST',
            url: route.conversation_send,
            beforeSend: function (request) {
                request.setRequestHeader('Access-Control-Allow-Origin', '*' );
            },

            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                participant_id: chatter.participant_id,
                message: text,
            },
            success: (res) => {
                chatter.message_text.value = '';
                if (res.success == true) {
                    const msg = res.message;
                    ele(`user-${chatter.participant_id}`).style = "object-position: top;"
                    remove_time(`.time-${msg.user_id}-${get_time(msg.created_at)}`);
                    chatter.messages.innerHTML += message(msg, res.auth_id);
                    add_last_message(msg);
                    scrollBottom();
                    swap(ele(`user-chat-${chatter.participant_id}`))
                }
            }
        });
    }
}

const add_last_message = (msg) => {
    ele(chatter.last_message + chatter.participant_id).innerText = msg.text.slice(0, 15) + '...';
    ele(chatter.last_message_time + chatter.participant_id).innerText = moment(msg.created_at).format('LT');
}

// scroll chat to bottom
const scrollBottom = () => {
    var message = document.querySelector(".chat-panel");
    message.scrollTop = message.scrollHeight;
}

// on press enter send message
$(window).on("keydown", function (e) {
    if (e.which == 13) {
        cls('emojionearea-editor').blur();
        send_message();
        cls('emojionearea-editor').focus();
        return false;
    }
});

// debouce to wait for sometime
const debounce = (func, timeout = 500) => {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => { func.apply(this, args); }, timeout);
    };
}

// search users from chat list
const search_users = debounce((search) => {
    if (search.length > 0) {
        $.ajax({
            type: "GET",
            url: route.search_users,
            beforeSend: function (request) {
                request.setRequestHeader('Access-Control-Allow-Origin', '*' );
            },

            data: {
                search: search,
            },
            success: function (res) {
                if (res.count > 0) {
                    list_loop_over(res.conversations);
                } else {
                    chatter.list.innerHTML = '';
                }
            },
        });
    } else {
        chat_list();
    }
});

// clear chat history by the vendor
function clear_chat() {
    $.ajax({
        type: "GET",
        url: route.chat_clear,
        data: {
            conversation_id: chatter.conversation_id
        },
        success: function (res) {
            if (res.success == true) {
                chatter.messages.innerHTML = "";
                ele(`${chatter.last_message + chatter.participant_id}`).innerText = "...";
                ele(`${chatter.last_message_time + chatter.participant_id}`).innerText = moment().format('LT');
            }
        },
    });
}

// convert date to number
const get_time = (date) => {
    date = new Date(date);
    var hour = date.getMinutes();
    var minute = date.getMinutes();
    return hour + '' + minute
}

const remove_time = (e) => {
    const time_rm = document.querySelectorAll(e);
    if (time_rm.length > 0) {
        time_rm.forEach((e) => {
            if (!e.classList.contains('hidden')) {
                e.classList.add('hidden');
            }
        });
    }
}

const add_new_participant = () => {
    chatter.new_participant_id = chatter.new_participant.value;
    var image = ele(`participant-${chatter.new_participant_id}`).getAttribute('img');
    var name = ele(`participant-${chatter.new_participant_id}`).innerText;
    var html = `
        <div id="user-chat-${chatter.new_participant_id}">
        <div class="friend-drawer friend-drawer--onhover" onclick="set_atcive(${chatter.new_participant_id})" id="user-${chatter.new_participant_id}">
            <img class="profile-image"
                src="${image}"
                alt="" id="image-${chatter.new_participant_id}">
            <div class="text">
                <h6 id="name-${chatter.new_participant_id}">${name}</h6>
                <p class="text-muted" id="last-message-${chatter.new_participant_id}">type new...</p>
            </div>
            <span class="time text-muted small time-set time-set" id="last-message-time-${chatter.new_participant_id}">${moment().format('LT')}</span>
        </div>
        <hr>
        </div>`;
    chatter.list.innerHTML = html + chatter.list.innerHTML;

    set_atcive(`${chatter.new_participant_id}`);

    ele('close-popup').click();

    ele(`participant-${chatter.new_participant_id}`).remove();
}

const swap = (a) => {
    const index = Array.from(
        a.parentElement.children
    ).indexOf(a);
    if (index != 0) {
        var b = '';
        chatter.list.childNodes.forEach((e, i) => {
            if (i == 0) {
                let dummy = document.createElement("span")
                a.before(dummy)
                e.before(a)
                dummy.replaceWith(e)
            } else {
                let dummy = document.createElement("span")
                b.before(dummy)
                e.before(b)
                dummy.replaceWith(e)
            }
            b = e;
        })
    }
}
