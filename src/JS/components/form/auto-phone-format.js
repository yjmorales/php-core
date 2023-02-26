/**
 * @author Yenier Jimenez <yjmorales@gmail.com>
 *
 * This component is applied to those input text field supposed to hold a phone number. It converts the value of
 * the field into the value formatted with the pattern: (xxx)xxx-xxxx
 *
 * How to use this module.
 *
 *  1. Including the file on the page
 *
 *      <script src="path_to_file/auto-phone-format.js></script>
 *
 *
 *  2. Right after including the Js file it's needed to Initializing the module:
 *
 *    <script>
 *       const formatter = new AutoPhoneFormatter();
 *       formatter.init();
 *   </script>
 */
function AutoPhoneFormatter() {

    // Publishing public properties.
    this.init = init;

    // Getting the Phone Field reference.
    const $field = $('input.auto-phone-format');

    /**
     * Function that initialize the module.
     */
    function init() {
        // Subscribe the keyup event. Each time a valid numerical key is pressed-and-leaved the formatter function is executed.
        $field.on('keyup', autoFormat);

        // formats the already existing phone number values.
        setupFields();
    }

    /**
     * formats the already existing phone number values.
     *
     * @return {void}
     */
    function setupFields() {
        $field.each((pos, $phoneField) => {
            const value = $($phoneField).val();
            $($phoneField).val(convertValue(value));
        });
    }

    /**
     * A function to convert a text field value into the phone format (###)###-####
     */
    function autoFormat() {
        const $field = $(this);
        let value = $field.val();

        // If there is no text in the field then doesn't apply the formatter function.
        if (value.length === 0) {
            return;
        }

        // Filling out the field with the new formatted output.
        $field.val(convertValue(value));
    }

    /**
     * Converts a 10 digits phone into the respective format (nnn) nnn-nnn
     *
     * @param {string} value value to be formatted.
     *
     * @return string
     */
    function convertValue(value) {
        let output = '';

        // Only the formatter is applied to numerical inputs. So, it replaces all non-numerical inputs with an empty value.
        value = value.replace(/[^0-9]/g, '');

        // Building the output.
        const area = value.substr(0, 3)
            , pre = value.substr(3, 3)
            , tel = value.substr(6, 4);

        if (area.length < 3) {
            output = `(${area}`;
        } else if (area.length === 3 && pre.length < 3) {
            output = `(${area}) ${pre}`;
        } else if (area.length === 3 && pre.length === 3) {
            output = `(${area}) ${pre} - ${tel}`;
        }

        return output;
    }
}