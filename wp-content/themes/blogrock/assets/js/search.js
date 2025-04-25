document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("searchToggle");
    const form = document.getElementById("searchForm");
    const icon = toggle?.querySelector("svg");

    if (toggle && form) {
        toggle.addEventListener("click", () => {
            form.classList.toggle("hidden");

            if (form.classList.contains("hidden")) {
                form.classList.add("opacity-0", "pointer-events-none");
                if (icon) {
                    icon.innerHTML = `
                        <circle cx="11" cy="11" r="8"/>
                        <path d="M21 21 16.65 16.65"/>
                    `;
                }
            } else {
                form.classList.remove("opacity-0", "pointer-events-none");
                document.querySelector("#searchInput")?.focus();
                if (icon) {
                    icon.innerHTML = `
                        <path d="M6 6l12 12M6 18L18 6"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    `;
                }
            }
        });

        document.addEventListener("click", (e) => {
            if (!form.contains(e.target) && !toggle.contains(e.target)) {
                form.classList.add("hidden", "opacity-0", "pointer-events-none");
                if (icon) {
                    icon.innerHTML = `
                        <circle cx="11" cy="11" r="8"/>
                        <path d="M21 21 16.65 16.65"/>
                    `;
                }
            }
        });
    }

    const searchInputs = [
        document.querySelector("#searchInput"),
        document.querySelector("#drawerSearch")
    ].filter(Boolean);

    searchInputs.forEach(input => {
        const wrapper = document.createElement("div");
        wrapper.className = "relative w-full";

        const resultsWrapper = document.createElement("div");
        resultsWrapper.className = "absolute bg-gray-lighten left-0 top-full mt-1 w-[300px] shadow-md z-50 hidden";

        const parent = input.parentElement;
        if (parent) {
            parent.replaceChild(wrapper, input);
            wrapper.appendChild(input);
            wrapper.appendChild(resultsWrapper);
        }

        input.classList.add("w-full", "px-4", "py-2");

        input.addEventListener("input", async (e) => {
            const search = e.target.value.trim();

            if (search.length < 2) {
                resultsWrapper.innerHTML = "";
                resultsWrapper.classList.add("hidden");
                return;
            }

            try {
                const res = await fetch(`${window.blogrock.ajax_url}?action=live_search&s=${encodeURIComponent(search)}`);
                const results = await res.json();

                resultsWrapper.innerHTML = results.length
                    ? results.map(post => `
                        <a href="${post.link}" class="block w-[300px] px-4 py-3 bg-gray-lighten hover:bg-white transition text-sm border-t border-gray-darken first:border-t-0">
                            ${post.title}
                        </a>`).join("")
                    : `<div class="px-4 py-3 text-sm w-[300px] text-gray-500">Nothing found</div>`;

                resultsWrapper.classList.remove("hidden");
            } catch (error) {
                console.error("AJAX search error:", error);
            }
        });

        document.addEventListener("click", (e) => {
            if (!wrapper.contains(e.target)) {
                resultsWrapper.classList.add("hidden");
            }
        });
    });
});
