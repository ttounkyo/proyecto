
<div class="contenedor">
	<h1>Videos!!</h1>
	<div class="vid">
	    <video controls>
	        <source src="galeria/videos/oceans-clip.mp4" type="video/mp4" />
	    </video>
	</div>
	<div class="vid">
	    <video controls>
	        <source src="galeria/videos/competicion_converted.mp4" type="video/mp4" />
	    </video>
	</div>
	<div class="vid">
		<iframe  src="https://www.youtube.com/embed/L8Gs_eyIPFA" frameborder="0" allowfullscreen>

		</iframe>
	</div>


	<h1>Audios!!</h1>
	<div class="aud">
        (MP3, OGG) canvia ordre i WAV:
        <audio id="audios"controls="controls" preload="none">
            <source src="test_cbr.ogg" type="audio/mpeg" />
            <source src="test_cbr.mp3" type="audio/ogg" />
            <source src="test_cbr.wav" type="audio/wav" />
            Archivo de audio NO soportado
        </audio>
            <div>
            <button onclick="document.getElementById('audios').play()">Play</button>
            <button onclick="document.getElementById('audios').pause()">Pause</button>
            <button onclick="document.getElementById('audios').volume+=0.1">Volumen +</button>
            <button onclick="document.getElementById('audios').volume-=0.1">Volumen -</button>
            </div>
	</div>
	<div class="aud"></div>
	<div class="aud"></div>
</div>

