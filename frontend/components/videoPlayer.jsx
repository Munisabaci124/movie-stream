export default function VideoPlayer({ videoUrl, title }) {
  return (
    <div className="video-container">
      <h3 className="text-lg font-semibold mb-4">{title}</h3>
      <video controls className="w-full max-w-3xl">
        <source src={videoUrl} type="video/mp4" />
        Your browser does not support the video tag.
      </video>
    </div>
  );
}
