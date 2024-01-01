const imageUpload = document.getElementById('image-upload');
const imagePreview = document.getElementById('image-preview');

imageUpload.addEventListener('change', function() {
  const file = this.files[0];
  if (file) {
    const reader = new FileReader();
    reader.addEventListener('load', function() {
      const image = new Image();
      image.src = this.result;
      imagePreview.innerHTML = '';
      imagePreview.appendChild(image);
    });
    reader.readAsDataURL(file);
  }
});