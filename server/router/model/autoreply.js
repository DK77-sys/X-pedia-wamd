const {db, dbQuery } = require('../../database/index');
require('dotenv').config();
const {
    default: makeWASocket,
    downloadContentFromMessage
} = require('@adiwajshing/baileys')
const axios = require('axios');
const fs = require('fs');

//const { startCon } = require('./WaConnection');
async function removeForbiddenCharacters(input) {
    let forbiddenChars = ['/', '?', '&', '=', '"']
    for (let char of forbiddenChars) {
        input = input.split(char).join('');
    }
    return input
}
const autoReply = async (msg, sock) => {
   
    try {
        if (!msg.messages) return
        msg = msg.messages[0]

        if (msg.key.remoteJid === 'status@broadcast') return;
        const type = Object.keys(msg.message || {})[0]

        const body = (type === 'conversation' && msg.message.conversation) ? msg.message.conversation : (type == 'imageMessage') && msg.message.imageMessage.caption ? msg.message.imageMessage.caption : (type == 'videoMessage') && msg.message.videoMessage.caption ? msg.message.videoMessage.caption : (type == 'extendedTextMessage') && msg.message.extendedTextMessage.text ? msg.message.extendedTextMessage.text : (type == 'messageContextInfo') && msg.message.listResponseMessage?.title ? msg.message.listResponseMessage.title : (type == 'messageContextInfo') ? msg.message.buttonsResponseMessage.selectedDisplayText : ''
        const d = body.toLowerCase()
        const command = await removeForbiddenCharacters(d);
        const from = msg.key.remoteJid.split('@')[0];
        let bufferImage;
        //  const urlImage = (type == 'imageMessage') && msg.message.imageMessage.caption ? msg.message.imageMessage.caption : null;
        if (type === 'imageMessage') {

            const stream = await downloadContentFromMessage(msg.message.imageMessage, 'image');
            let buffer = Buffer.from([])
            for await (const chunk of stream) {
                buffer = Buffer.concat([buffer, chunk])
            }
            bufferImage = buffer.toString('base64');
        } else {
            urlImage = null;
        }
        if (msg.key.fromMe === true) return;
        let reply;

        const result = await dbQuery(`SELECT * FROM autoreplies WHERE keyword = "${command}" AND device = ${sock.user.id.split(':')[0]} LIMIT 1`);
        if (result.length === 0) {
            const me = sock.user.id.split(':')[0];0

            const getUrl = await dbQuery(`SELECT webhook FROM numbers WHERE body = '${me}' LIMIT 1`);
            const url = getUrl[0].webhook;
            if (url === null) return;
            const r = await sendWebhook({ command: d, bufferImage, from, url });
            if (r === false) return;
            reply = JSON.stringify(r);
        } else {
            reply = process.env.TYPE_SERVER === 'hosting' ? result[0].reply : JSON.stringify(result[0].reply);

        }
        // console.log(reply)
        await sock.sendMessage(msg.key.remoteJid, JSON.parse(reply)).catch((e) => {

        })
        //return;

    } catch (e) {
        console.log(e)
    }
}


async function sendWebhook({ command, bufferImage, from, url }) {
    try {
        const data = {
            message: command,
            bufferImage: bufferImage,
            from: from
        }
        const headers = { 'Content-Type': 'application/json; charset=utf-8' }
        const res = await axios.post(url, data, headers).catch(() => {
            return false;
        })
        return res.data;
    } catch (error) {
        console.log(error)
        return false;
    }

}

module.exports = { autoReply };