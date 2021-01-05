function showLoading(submitBtn) {
    $(submitBtn).prop("disabled", true);
    $(submitBtn).html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-bottom: 4px; margin-right: 5px;"></span>Continue to checkout'
    );
    $("#form").submit();
}