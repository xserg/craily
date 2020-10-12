/**
 * Created by hp on 2/11/2017.
 */
//var PeerConnection = window.RTCPeerConnection || window.webkitRTCPeerConnection;
var URL = window.URL || window.webkitURL || window.msURL || window.oURL;
var getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;

(function() {
    'use strict';

    var prortc;
    if ('undefined' === typeof module) {
        prortc = this.prortc = {};
    } else {
        prortc = module.exports = {};
    }

    prortc.socket = null;
    prortc.selfSocketId = null;
    prortc.iceServers = {
        "iceServers": [{ "urls": ["stun:prortc.com:3478"], "username": "", "credential": "" }, {
            "urls": ["turn:45.55.131.122:3478"],
            "username": "navalp",
            "credential": "codiant2016"
        }]
    };
    prortc.bitrates = { "audio": 50, "video": 100 };
    prortc.peerConnections = {};
    prortc.dataChannels = {};
    prortc.sockets = [];
    prortc.streams = [];
    prortc.numStreams = 0;
    prortc.initializedStreams = 0;
    prortc._events = {};
    prortc.userRole;
    prortc.remoteStreams = {};
    prortc.otherSocketId;
    prortc.IsConnected = false;
    prortc.noOfCourses = 1;
    prortc.isConnecting = false;
    prortc.isCourseEnd = false;
    prortc.isMediaFoundError = false;
    var receiveBuffer = [];
    var receivedSize = 0;

    /**
     * Initialize event
     * @param eventName
     * @param callback
     */
    prortc.on = function(eventName, callback) {
        prortc._events[eventName] = prortc._events[eventName] || [];
        prortc._events[eventName].push(callback);
    };

    /**
     * Execute event
     * @param eventName
     */
    prortc.emit = function(eventName) {
        var events = prortc._events[eventName];
        var args = Array.prototype.slice.call(arguments, 1);
        if (!events) {
            return;
        }
        for (var i = 0, len = events.length; i < len; i++) {
            events[i].apply(null, args);
        }
    };

    /**
     * Check browser support webrtc
     */
    prortc.checkSupport = function() {
        if (!getUserMedia) {
            prortc.emit('webrtc_not_support');
        }
    }

    /**
     * User join signaling room
     * @param message
     */
    prortc.joinRoom = function(message) {
        console.log('room', message.room);
        if (prortc.socket && message.room) {
            prortc.socket.emit('join_room', message);

            prortc.socket.on('room_message', function(data) {
                prortc.emit('room_message', data);
            });

            prortc.socket.on('start_timer', function (data) {
                console.log('timer');
                prortc.emit('start_timer', data);
            });
            prortc.socket.on('get_peers', function(data) {
                prortc.sockets = data.connections;
                prortc.otherSocketId = data.connections[0];
                prortc.selfSocketId = data.socketId;
                prortc.noOfCourses = data.noOfCourses;
                console.log(data);
                prortc.emit('connections', prortc.sockets);
                prortc.emit('ready');
            });

            prortc.socket.on('ice_candidate', function(data) {
                var candidate = new RTCIceCandidate({
                    sdpMLineIndex: data.label,
                    candidate: data.candidate
                });
                console.log('ice');
                prortc.peerConnections[data.socketId].addIceCandidate(candidate);
                prortc.emit('ice_candidate', candidate);

            });

            prortc.socket.on('new_updated_time', function(data) {
                prortc.emit('new_updated_time', data);
            });

            prortc.socket.on('end_updated_time', function (data) {
                prortc.emit('end_updated_time', data);
                
            });

            prortc.socket.on('new_peer', function(data) {
                prortc.sockets.push(data.socketId);
                prortc.emit('new_peer', data);
                prortc.otherSocketId = data.socketId;
                var pc = prortc.createPeerConnection(data.socketId);
                for (var i = 0; i < prortc.streams.length; i++) {
                    var stream = prortc.streams[i];
                    pc.addStream(stream);
                }
                prortc.emit('ready');
                setTimeout(function() {
                    prortc.sendOffers();
                    prortc.isConnecting = true;
                }, 2000);


            });

            prortc.socket.on('remove_peer', function(data) {
                var index = prortc.sockets.indexOf(data.socketId);
                if (index > -1) {
                    prortc.sockets.splice(index, 1);
                }
                delete prortc.peerConnections[data.socketId];
                console.log(" peer connection removed");
                if(!prortc.isMediaFoundError){
                    prortc.emit('disconnected_peer', data);
                } else {
                    prortc.emit('disconnected_peer_wihtout_media', data);
                }
                
            });

            prortc.socket.on('receive_offer', function(data) {
                console.log('receive offer');
                prortc.isConnecting = true;
                prortc.receiveOffer(data.socketId, data.sdp);
                prortc.emit('receive_offer', data);
            });

            prortc.socket.on('receive_answer', function(data) {
                console.log('receive answer');
                prortc.isConnecting = true;
                prortc.receiveAnswer(data.socketId, data.sdp);
                prortc.emit('receive_answer', data);
            });

            prortc.socket.on('stop_sharing', function(data) {
                console.log('stop_sharing');
                prortc.emit('switch_stream', data);
            });


            prortc.socket.on('end_call', function(data) {
                console.log('end call');
                prortc.endCall();
                prortc.isCourseEnd = true;
                prortc.emit('course_ended', data);
            });

            prortc.socket.on('message', function(data) {
                prortc.emit('message', data);
            });

            prortc.socket.on('group_message', function(data) {
                prortc.emit('group_message', data);
            });

            prortc.socket.on('extend_time', function(data) {
                prortc.emit('extend_time', data);
            });

            prortc.socket.on('extend_time_accepted', function(data) {
                prortc.emit('extend_time_accepted', data);
            });

            prortc.socket.on('whiteboard', function(data) {
                prortc.emit('whiteboard', data);
            });

            prortc.socket.on('add_text', function(data) {
                prortc.emit('add_text', data);
            });

            prortc.socket.on('object:modified', function(data) {
                console.log('recieve modified emit', data);
                prortc.emit('object:modified', data);
            });

            prortc.socket.on('object:added', function(data) {
                prortc.emit('object:added', data);
            });

            prortc.socket.on('object:removed', function(data) {
                prortc.emit('object:removed', data);
            });

            prortc.socket.on('path:created', function(data) {
                prortc.emit('path:created', data);
            });

            prortc.socket.on('allow_student', function(data) {
                prortc.emit('allow_student', data);
            });

            prortc.socket.on('room_full', function(data) {
                prortc.emit('room_full', data);
            });

            prortc.emit('connect');
        }
    }

    /**
     * Connect to signaling server
     * @param server
     */
    prortc.init = function(server) {

        prortc.socket = io.connect(server);

        prortc.socket.on('error', function(error) {
            console.log('socket connection error ', error);

        });
        prortc.socket.on('disconnect', function() {
            console.log('socket disconnect');
            prortc.emit('socket_disconnect');
        });

        prortc.socket.on('check_room', function(data) {
            prortc.emit('check_room', data);
        });

    };

    /**
     * Send offers to all connected sockets
     */
    prortc.sendOffers = function() {
        for (var i = 0, len = prortc.sockets.length; i < len; i++) {
            var socketId = prortc.sockets[i];
            prortc.sendOffer(socketId);
        }
        prortc.isConnecting = true;
    };

    prortc.onClose = function(data) {
        prortc.on('close_stream', function() {
            prortc.emit('close_stream', data);
        });
    };

    /**
     * Create all connected user peerconnection
     */
    prortc.createPeerConnections = function() {
        console.log(prortc.sockets);
        for (var i = 0; i < prortc.sockets.length; i++) {
            prortc.createPeerConnection(prortc.sockets[i]);
        }
    };

    /**
     * Create new peerconnection
     * @param id
     * @returns {Window.RTCPeerConnection|*}
     */
    prortc.createPeerConnection = function(id) {
        var config = { "optional": [{ "googIPv6": true }] };
        var pc;
        pc = prortc.peerConnections[id] = new RTCPeerConnection(prortc.iceServers, config);
        var channel = prortc.dataChannels[id] = pc.createDataChannel('datachannel', { reliable: false });
        channel.binaryType = 'arraybuffer';
        pc.ondatachannel = addChannelHandlers;
        pc.onicecandidate = function(event) {
            if (event.candidate) {
                prortc.socket.emit("ice_candidate", {
                    label: event.candidate.sdpMLineIndex,
                    id: event.candidate.sdpMid,
                    candidate: event.candidate.candidate,
                    "socketId": id,
                });
            }
            prortc.emit('ice candidate', event.candidate);
        };

        pc.oniceconnectionstatechange = function(event) {
            console.log('ice connection state ', pc.iceConnectionState);
            if (pc.iceConnectionState === "failed") {
                prortc.emit('ice_failed', { socketId: id });
            }
        };

        pc.onopen = function() {
            prortc.emit('peer connection opened');
        };

        pc.onaddstream = function(event) {
            prortc.remoteStreams[id] = event.stream;
            prortc.otherSocketId = id;
            prortc.attachStream(event.stream, 'remote');
            prortc.emit('remote_stream', event.stream, id);
            prortc.isConnecting = false;
        };
        return pc;
    };

    /**
     * Create datachannel events
     * @param channel
     */
    function addChannelHandlers(event) {
        var channel = event.channel;
        var message = {};
        var content = {};
        channel.onclose = function onclose(event) {
            console.log('datachannel is closed');
        }
        channel.onerror = function onerror(error) {
            console.log('datachannel error');
        }
        channel.onmessage = function(event) {

            try {
                var data = JSON.parse(event.data);
                if (data.type === 'messagePart') {
                    var uuid = data.uuid;
                    if (!content[uuid]) {
                        content[uuid] = [];
                    }
                    content[uuid].push(data.message);
                    if (data.last) {
                        var message = JSON.parse(JSON.stringify(content[uuid].join('')));
                        delete content[uuid];
                        message = JSON.parse(message);
                        if (message.type === 'whiteboard') {
                            prortc.emit('whiteboard', { canvasData: message.canvasJson });
                        }
                    }
                } else if (data.type === 'whiteboard') {
                    prortc.emit('whiteboard', { canvasData: data.canvasJson });
                }

            } catch (error) {
                console.log('data channel message error', error);
            }
        };
        channel.onopen = function onopen(event) {
            console.log('datachannel is open');
        }
    }

    /**
     * Generate random id
     */
    function generateId() {
        function s4() {
            return Math.floor((1 + Math.random()) * 0x10000)
                .toString(16)
                .substring(1);
        }

        return s4() + s4();
    }

    /**
     * Send message using datachannel
     * @param message
     */
    prortc.sendMessage = function(message, text) {
        var channel;
        var chunkSize = 50 * 1000;
        var numberOfPackets = 0;
        var packetSent = 0;
        for (var i = 0; i < prortc.sockets.length; i++) {
            channel = prortc.dataChannels[prortc.sockets[i]];
            if (channel && (channel.readyState === 'open')) {
                if (typeof(message) === 'object') {
                    var message = JSON.stringify(message);
                    numberOfPackets = parseInt(message.length / chunkSize);
                    console.log('length', message.length, numberOfPackets);
                    var uuid = generateId();
                    // channel.send();
                    sendChunkMessage(message);

                    function sendChunkMessage(msg, text) {
                        var data = {
                            type: 'messagePart',
                            uuid: uuid
                        };

                        if (msg) {
                            text = msg;
                            data.packets = parseInt(text.length / chunkSize);
                        }

                        if (text.length > chunkSize) {
                            data.message = text.slice(0, chunkSize);
                        } else {
                            data.message = text;
                            data.last = true;
                        }

                        channel.send(JSON.stringify(data));

                        var textToTransfer = text.slice(data.message.length);

                        if (textToTransfer.length) {
                            setTimeout(function() {
                                sendChunkMessage(null, textToTransfer);
                            }, 100);
                        }
                    }


                }
            } else {
                console.log('datachannel is not in open state');
            }
        }
    };


    /**
     * Return sdp offer constraints
     * @returns {*}
     */
    function getOfferConstraints() {
        if (navigator.mozGetUserMedia) {
            return {
                offerToReceiveAudio: true,
                offerToReceiveVideo: true
            };
        } else {
            return {
                optional: [{
                    DtlsSrtpKeyAgreement: true
                }],
                mandatory: {
                    OfferToReceiveAudio: true,
                    OfferToReceiveVideo: true
                }
            };
        }
    }

    /**
     * Send sdp offer to user
     * @param socketId
     */
    prortc.sendOffer = function(socketId) {
        var pc;
        pc = prortc.peerConnections[socketId];

        console.log('sending offer');
        pc.createOffer(function(session_description) {
            // session_description.sdp = setMediaBitrates(session_description.sdp, prortc.bitrates.audio, prortc.bitrates.video);
            pc.setLocalDescription(session_description);
            prortc.socket.emit("send_offer", {
                "socketId": socketId,
                "sdp": session_description
            });
        }, function(error) {
            console.log('offer error', error);
        }, getOfferConstraints());
    };

    /**
     * Receive sdp offer from user
     * @param socketId
     * @param sdp
     */
    prortc.receiveOffer = function(socketId, sdp) {
        var pc;
        pc = prortc.peerConnections[socketId];
        pc.setRemoteDescription(new RTCSessionDescription(sdp));
        prortc.sendAnswer(socketId);
    };

    /**
     * Send sdp answer to offerer user
     * @param socketId
     */
    prortc.sendAnswer = function(socketId) {
        var pc;
        pc = prortc.peerConnections[socketId];

        console.log('pc state', pc.signalingState)
        pc.createAnswer(function(session_description) {
            // session_description.sdp = setMediaBitrates(session_description.sdp, prortc.bitrates.audio, prortc.bitrates.video);
            pc.setLocalDescription(session_description);
            console.log('sending answer');
            prortc.socket.emit("send_answer", {
                "socketId": socketId,
                "sdp": session_description
            });
            var offer = pc.remoteDescription;
        }, function(error) {
            console.log('answer error', error);
        }, getOfferConstraints());
    };

    /**
     * Receive sdp answer from user
     * @param socketId
     * @param sdp
     */
    prortc.receiveAnswer = function(socketId, sdp) {
        var pc;
        pc = prortc.peerConnections[socketId];
        pc.setRemoteDescription(new RTCSessionDescription(sdp));
    };

    /**
     * Start new call
     * @param option
     * @param onSuccess
     * @param onFail
     */
    prortc.startCall = function(option, onSuccess, onFail) {
        var options;
        onSuccess = onSuccess ||
            function() {};
        onFail = onFail ||
            function() {};

        options = {
            video: !!option.video,
            audio: !!option.audio
        };


        if (getUserMedia) {
            prortc.numStreams++;
            getUserMedia.call(navigator, options, function(stream) {
                prortc.streams.push(stream);
                prortc.initializedStreams++;
                prortc.addStreams();
                onSuccess(stream);

            }, function(error) {
                prortc.isMediaFoundError = true;
                console.log(error);
                onFail(error)
                prortc.emit('media_device_error', error);
            });
        } else {
            prortc.isMediaFoundError = true;
            onFail(error);
            prortc.emit('webrtc_not_support');
        }
    };

    function setMediaBitrates(sdp, audioBitRate, videoBitRate) {
        return setMediaBitrate(setMediaBitrate(sdp, "video", videoBitRate), "audio", audioBitRate);
    }

    /**
     * Set media bit rate
     * @param sdp
     * @param media
     * @param bitrate
     * @returns {*}
     */
    function setMediaBitrate(sdp, media, bitrate) {
        var lines = sdp.split("\n");
        var line = -1;
        for (var i = 0; i < lines.length; i++) {
            if (lines[i].indexOf("m=" + media) === 0) {
                line = i;
                break;
            }
        }
        if (line === -1) {
            console.debug("Could not find the m line for", media);
            return sdp;
        }
        console.debug("Found the m line for", media, "at line", line);

        // Pass the m line
        line++;

        // Skip i and c lines
        while (lines[line].indexOf("i=") === 0 || lines[line].indexOf("c=") === 0) {
            line++;
        }

        // If we're on a b line, replace it
        if (lines[line].indexOf("b") === 0) {
            console.debug("Replaced b line at line", line);
            lines[line] = (navigator.mozGetUserMedia) ? "b=TIAS:" + bitrate : "b=AS:" + bitrate;
            return lines.join("\n");
        }

        // Add a new b line
        console.debug("Adding new b line before line", line);
        var newLines = lines.slice(0, line);
        newLines.push((navigator.mozGetUserMedia) ? "b=TIAS:" + bitrate : "b=AS:" + bitrate);
        newLines.push((navigator.mozGetUserMedia) ? "r=jesup" : '');
        newLines = newLines.concat(lines.slice(line, lines.length));
        console.log(newLines.join("\n"));
        return newLines.join("\n");
    }

    /**
     * Add local stream to all peerconnections
     */
    prortc.addStreams = function() {
        for (var i = 0; i < prortc.streams.length; i++) {
            var stream = prortc.streams[i];
            for (var connection in prortc.peerConnections) {
                prortc.peerConnections[connection].addStream(stream);
            }
        }
    };

    /**
     * Attach stream to element
     * @param stream
     * @param domId
     */
    prortc.attachStream = function(stream, domId) {
        var element = document.querySelector('#' + domId);
        if (navigator.mozGetUserMedia) {
            element.srcObject = stream;
        } else {
            // element.src = URL.createObjectURL(stream);
        }
        element.srcObject = stream;
    };

    /**
     * Detach stream to element
     * @param domId
     */
    prortc.detachStream = function(domId) {
        var element = document.querySelector('#' + domId);
        if (navigator.mozGetUserMedia) {
            element.srcObject = null;
        } else {
            element.src = '';
        }
    };


    /**
     * Set track toggle
     * @param tracks
     */
    prortc.setTrackToggle = function(tracks) {
        for (var i = 0; i < tracks.length; i++) {
            tracks[i].enabled = !(tracks[i].enabled);
        }
    }

    /**
     * Toggle mute video
     */
    prortc.muteVideoToggle = function() {
        var tracks = prortc.streams[0].getVideoTracks();
        prortc.setTrackToggle(tracks);
    }

    /**
     * Toggle mute audio
     */
    prortc.muteAudioToggle = function() {
        var tracks = prortc.streams[0].getAudioTracks();
        prortc.setTrackToggle(tracks);
    }

    /**
     * End webrtc call
     */
    prortc.endCall = function() {
        prortc.detachStream('local');
        prortc.detachStream('remote');
        prortc.socket.emit('end_call', {});
        for (var i = 0; i < prortc.sockets.length; i++) {
            var index = prortc.sockets.indexOf(prortc.sockets[i]);
            if (index > -1) {
                prortc.sockets.splice(index, 1);
            }
            delete prortc.peerConnections[prortc.sockets[i]];
            console.log(" peer connection removed");
            prortc.emit('disconnected_peer', prortc.sockets[i]);
        }
        prortc.socket.disconnect();
    }


    prortc.on('ready', function() {
        prortc.createPeerConnections();
        prortc.addStreams();
    });


}).call(this);