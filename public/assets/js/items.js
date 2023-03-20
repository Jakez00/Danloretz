

// const video = document.getElementById('video');
// const canvas = document.getElementById('canvas');

// navigator.mediaDevices.getUserMedia({ video: true })
//   .then(stream => {
//     video.srcObject = stream;
//     video.play();
//   })
//   .catch(error => {
//     console.error(error);
//   });


// video.addEventListener('canplay', () => {
// const context = canvas.getContext('2d');
// setInterval(() => {
//     context.drawImage(video, 0, 0, canvas.width, canvas.height);
// }, 100);
// });

// canvas.addEventListener('click', () => {
//     const context = canvas.getContext('2d');
//     const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
//     console.log(imageData); // log imageData object to see if it contains the QR code
//     const code = jsQR(imageData.data, imageData.width, imageData.height, {
//       inversionAttempts: 'dontInvert',
//     });
//     if (code) {
//       console.log('QR code detected:', code.data);
//     } else {
//       console.log('No QR code detected');
//     }
//   });