import React, { useState, useEffect } from 'react';
import '@patientus/video-lib-wc/patientus-video-wc'; // Ensure this is loaded correctly


function VideoComponent2({start_time, end_time}) {

// Define constants outside the component if they don't change
const VIDEO_ELEMENT = 'patientus-video';
const APPOINTMENT = {
    topic: 'appointment-topic',
    startDateTime: start_time,
    endDateTime: end_time,
    participant: {
            id: 'patient-id',
            firstName: 'Jane',
            lastName: 'Doe',
            gender: 'f',
            email: 'jane.doe@dummy.de',
            type: 'patient',
            imageUrl: 'path-to/patient-avatar-image-url.jpg',
        },
    otherParticipants: [
        {
            id: 'doctor-id',
            title: 'Dr.',
            firstName: 'Max',
            lastName: 'Mustermann',
            gender: 'm',
            email: 'max.mustermann@dummy.de',
            type: 'doctor',
            imageUrl: 'path-to/doctor-avatar-image-url.jpg',
            inviteUrl: 'path-to/invite-url'
        }
    ]
};
const CONFIG = {
    assetsPath: '/assets',
    sessionApiEndpoint: '/video1_api',
    appointment: APPOINTMENT,
    logoUrl: '/build/assets/Logo-CMgHb9Ha.png',
}
const config = JSON.stringify(CONFIG);

//   const [config, setConfig] = useState(null);
  const [videoElement, setVideoElement] = useState(null);

  useEffect(() => {
    // Wait for the next tick to ensure DOM elements are rendered
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

export default VideoComponent2;
