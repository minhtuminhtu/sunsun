(function ($) {
    $.fn.inputFilter = function (inputFilter) {
        return this.on("keydown keyup", function (event) {
            if ((event.key !== 'Backspace') && (event.key !== 'undefined')) {
                let curchr = this.value.length;
                let curval = $(this).val();
                let phone_format;
                if (curchr < 3 && curval.indexOf("(") <= -1) {
                    phone_format = "(" + curval;
                } else if (curchr == 4 && curval.indexOf("(") > -1) {
                    phone_format = curval + ")-";
                } else if (curchr == 5) {
                    if (event.key != ")") {
                        phone_format = this.oldValue + ")-" + event.key
                    } else {
                        phone_format = curval;
                    }
                } else if (curchr == 6 && curval.indexOf("-") <= -1) {
                    if (event.key != "-") {
                        phone_format = this.oldValue + '-' + event.key
                    } else {
                        phone_format = curval;
                    }
                } else if (curchr == 9) {
                    phone_format = curval + "-";
                    $(this).attr('maxlength', '14');
                } else if (curchr == 10) {
                    console.log(event.key);
                    if (event.key != "-") {
                        phone_format = this.oldValue + '-' + event.key
                    } else {
                        phone_format = curval;
                    }
                } else {
                    phone_format = curval;
                }
                let regex = /^[\+]?[(]?[0-9]{0,3}[)]?[-\s\.]?[0-9]{0,3}[-\s\.]?[0-9]{0,6}$/im;
                let test = regex.test(phone_format);
                if (test === true) {
                    $(this).val(phone_format);
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                }
            } else {
                this.oldValue = $(this).val();
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            }

        });
    };

    $('#tel').inputFilter(function (value) {
        return true;
    });
}(jQuery));
