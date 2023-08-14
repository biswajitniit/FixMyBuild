<div id="photoVideoModal" class="custom-modal" style="display: none;">
    <div class="modal-content">
        <div class="close" style="text-align: end;">
            <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M25.625 14.375L14.375 25.625M14.375 14.375L25.625 25.625" stroke="#F2F2F2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M20 35.625C28.6294 35.625 35.625 28.6294 35.625 20C35.625 11.3706 28.6294 4.375 20 4.375C11.3706 4.375 4.375 11.3706 4.375 20C4.375 28.6294 11.3706 35.625 20 35.625Z" stroke="#F2F2F2" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="media-container">
        </div>
        <a class="prev" data-prev-idx="">❮</a>
        <a class="next" data-next-idx="">❯</a>
    </div>
</div>

@push('scripts')
    <script>
        function openModal(index) {
            const modal = document.getElementById("photoVideoModal");
            const mediaContainer = modal.querySelector(".media-container");
            const modalElements = document.querySelectorAll('.modal-element');
            const type = modalElements[index].tagName;
            let imageContainer = document.getElementById("modal-image");
            let videoContainer = document.getElementById("modal-video");
            index = Number(index);

            if (type === "IMG") {
                const image = document.createElement("img");
                image.src = modalElements[index].src;
                mediaContainer.innerHTML = "";
                mediaContainer.appendChild(image);
            } else if (type === "VIDEO") {
                const video = document.createElement("video");
                video.src = modalElements[index].src;
                video.controls = true;
                console.log(video);
                mediaContainer.innerHTML = "";
                mediaContainer.appendChild(video);
                document.getElementById("photoVideoModal").querySelector(".media-container").appendChild(video);
            }

            console.log('prev', index - 1 === -1 ? modalElements.length - 1 : index - 1);
            console.log('next', index + 1 === modalElements.length ? 0 : index + 1);
            document.querySelector('#photoVideoModal .prev').setAttribute('data-prev-idx', index - 1 === -1 ? modalElements
                .length - 1 : index - 1);
            document.querySelector('#photoVideoModal .next').setAttribute('data-next-idx', (index + 1) % modalElements
                .length);

            modal.style.display = "block";
        }


        document.querySelector("#photoVideoModal a.prev").addEventListener('click', function(event) {
            const prevIdx = parseInt(document.querySelector("#photoVideoModal a.prev").getAttribute('data-prev-idx'));
            openModal(prevIdx);
        });

        document.querySelector("#photoVideoModal a.next").addEventListener('click', function(event) {
            const nextIdx = parseInt(document.querySelector("#photoVideoModal a.next").getAttribute('data-next-idx'));
            openModal(nextIdx);
        });


        const photoVideoModal = document.getElementById("photoVideoModal");
        const closeBtnSvg = photoVideoModal.querySelector(".close svg");
        const closeBtnSvgPath = photoVideoModal.querySelector(".close svg path");
        photoVideoModal.onclick = function(event) {
            if (event.target === closeBtnSvg || event.target === closeBtnSvg || event.target === closeBtnSvgPath) {
                photoVideoModal.querySelector(".media-container").innerHTML = "";
                photoVideoModal.style.display = "none";
            }
        };
    </script>
@endpush
