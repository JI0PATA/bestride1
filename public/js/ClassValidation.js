let count_fields = 0;
let obj_fields = [];

class Validation {
    constructor(el, regexp, errorMsg, ownFunction = null) {
        this._el = el;
        this._regexp = new RegExp(regexp);
        this._errorMsg = errorMsg;
        this._ownFunction = ownFunction;

        count_fields++;
        obj_fields.push(this);

        this._status = false;

        this.bindEvents();
    }

    bindEvents() {
        this._el.on('change', _ => {
            this.checkRegExp();
            this.checkButton();
        });
    }

    checkRegExp() {
        if (!this._regexp.test(this._el.val())) this.error();
        else {
            if (this._ownFunction !== null) this._ownFunction();
            else this.success();
        }
    }

    error(msg = null) {
        if (msg == null) msg = this._errorMsg;

        this._el.parent().parent().addClass('has-error').removeClass('has-success');
        this._el.parent().parent().find('.msg-error .help-block-error').text(msg);

        this._status = false;
    }

    success() {
        this._el.parent().parent().addClass('has-success').removeClass('has-error');
        this._el.parent().parent().find('.msg-error .help-block-error').text('');

        this._status = true;
    }

    checkButton() {
        let errors = false;
        obj_fields.forEach((val, index) => {
            if (val._status === false) {
                errors = true;
            }
            if (index === count_fields - 1 && !errors) Validation.buttonActive();
            else Validation.buttonDisabled();
        });
    }

    static buttonActive() {
        $('#submit_button').removeClass('disabled').attr('type', 'submit');
    }

    static buttonDisabled() {
        $('#submit_button').addClass('disabled').attr('type', 'button');
    }
}
