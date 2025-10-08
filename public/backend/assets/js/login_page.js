(function () {
    const color1 = document.getElementById("gradient_color1");
    const color2 = document.getElementById("gradient_color2");
    const type = document.getElementById("gradient_type");
    const angle = document.getElementById("gradient_angle");
    const angleVal = document.getElementById("angle_val");
    const preview = document.getElementById("gradient_preview");
    const rgbaInput = document.getElementById("login_page_bg_color_rgba");

    // Update preview + input field
    function updateGradient() {
        const c1 = color1.value;
        const c2 = color2.value;
        const deg = angle.value;
        const t = type.value;
        let gradientCSS;

        if (t === "linear") {
            gradientCSS = `linear-gradient(${deg}deg, ${c1}, ${c2})`;
        } else {
            gradientCSS = `radial-gradient(circle, ${c1}, ${c2})`;
        }

        preview.style.background = gradientCSS;
        rgbaInput.value = gradientCSS;
        angleVal.textContent = deg + "°";
    }

    // Event listeners
    [color1, color2, type, angle].forEach((el) => {
        el.addEventListener("input", updateGradient);
    });

    // Initialize preview
    updateGradient();

    // Optional: if user manually types rgba/gradient, reflect it
    rgbaInput.addEventListener("input", () => {
        const val = rgbaInput.value.trim();
        if (
            val.startsWith("linear-gradient") ||
            val.startsWith("radial-gradient")
        ) {
            preview.style.background = val;
        } else if (val.startsWith("rgba") || val.startsWith("#")) {
            preview.style.background = val;
        }
    });
})();
