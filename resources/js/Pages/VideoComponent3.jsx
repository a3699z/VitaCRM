// Import useRef from React
import React, { useRef } from 'react';

function VideoComponent3() {
  // Create a ref for the video element
  const videoRef = useRef(null);

  // Function to set the srcObject of the video
  const setVideoSource = async () => {
    try {
      const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
      // Set the srcObject of the video element
      videoRef.current.srcObject = stream;
    } catch (error) {
      console.error('Error accessing media devices:', error);
    }
  };

  return (
    <div>
      <button onClick={setVideoSource}>Start Video</button>
      <video ref={videoRef} autoPlay></video>
    </div>
  );
}

export default VideoComponent3;
