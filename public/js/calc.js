function appendSymbol(symbol) {
    document.querySelector('input[name="form[input]"').value += symbol;
}

function clearInput() {
    document.querySelector('input[name="form[input]"').value = '';
}