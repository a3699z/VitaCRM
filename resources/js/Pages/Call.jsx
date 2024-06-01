import React, { useState, useEffect } from 'react';
import '@patientus/video-lib-wc/patientus-video-wc'; // Ensure this is loaded correctly

// Define constants outside the component if they don't change


function Call({start_time, end_time, participant, otherPacticipant, topic, callKey}) {
    console.log(start_time, end_time, participant, otherPacticipant, topic, callKey)
const VIDEO_ELEMENT = 'patientus-video';
const APPOINTMENT = {
    topic: topic,
    startDateTime: start_time,
    endDateTime: end_time,
    participant: {
            id: participant.uid,
            firstName: participant.username,
            email: participant.email,
            imageUrl: participant.profile_image?'/images/'+participant.profile_image:'/images/default.jpg',

        },
    otherParticipants: [
        {
            id: otherPacticipant.uid,
            firstName: otherPacticipant.username,
            email: otherPacticipant.email,
            imageUrl: otherPacticipant.profile_image?'/images/'+otherPacticipant.profile_image:'/images/default.jpg',
            inviteUrl: '/call/'+callKey
        }
    ]
};
const CONFIG = {
    assetsPath: '/assets',
    sessionApiEndpoint: '/api/call/'+callKey,
    appointment: APPOINTMENT,
    logoUrl: '/build/assets/Logo-CMgHb9Ha.png',
};
const config = JSON.stringify(CONFIG);
  const [videoElement, setVideoElement] = useState(null);

  useEffect(() => {
    setTimeout(async () => {
      const element = document.querySelector(VIDEO_ELEMENT);
      console.log(element)
      if (element) {
        setVideoElement(element);
        element.addEventListener('disconnected', handleCallEnd);
        element.addEventListener('canceled', handleCancel);
        // setConfig(JSON.stringify(CONFIG));
      }

    }, 0); // Adjust timing as needed

    // Cleanup function to remove event listeners
    return () => {
      if (videoElement) {
        videoElement.removeEventListener('disconnected', handleCallEnd);
        videoElement.removeEventListener('canceled', handleCancel);
      }
    };
  }, []); // Empty dependency array means this effect runs once on mount

  const handleCallEnd = () => {
    console.log('user ended the call, do something');
  };

  const handleCancel = () => {
    console.log('user exits, do something');
  };

  return (
    <div>
      <patientus-video config={config}></patientus-video>
      {/* Render your component here */}
    </div>
  );
}

export default Call;
