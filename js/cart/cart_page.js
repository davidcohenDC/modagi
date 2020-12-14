Array.prototype.remove = function(value) {
    for (var i = this.length; i--; ) {
        if (this[i] === value) {
            this.splice(i, 1);
        }
    }
}