function fecharFeedbackFloat(event) {
    if (event && event.stopPropagation) {
        event.stopPropagation();
    }

    const el = document.getElementById("feedback-float");

    if (el) {
        el.style.transition = "opacity 0.4s ease, transform 0.4s ease";
        el.style.opacity = "0";
        el.style.transform = "translateY(10px)";
        setTimeout(() => {
            el.style.display = "none";
        }, 400);
    }
}
