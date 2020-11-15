function Div(defaultClass) {
    this.div = $('<div>');
    this.div.addClass(defaultClass);

    return this.div;
}

function Section(defaultClass) {
    this.section = $('<section>');
    this.section.addClass(defaultClass);

    return this.section;
}

function Button(defaultClass) {
    this.button = $('<button>');
    this.button.attr('type', 'button');
    this.button.addClass('btn');
    this.button.addClass(defaultClass);

    return this.button;
}

function Input(defaultClass) {
    this.input = $('<input>');
    this.input.addClass(defaultClass);

    return this.input;
}

function Textarea(defaultClass) {
    this.textarea = $('<textarea>');
    this.textarea.addClass(defaultClass);

    return this.textarea;
}

function Icon(defaultClass) {
    this.icon = $('<i>');
    this.icon.addClass('ic');
    this.icon.addClass(defaultClass);

    return this.icon;
}

function Li(defaultClass) {
    this.li = $('<li>');
    this.li.addClass(defaultClass);

    return this.li;
}

function Ul(defaultClass) {
    this.ul = $('<ul>');
    this.ul.addClass(defaultClass);

    return this.ul;
}

function Label(defaultClass) {
    this.label = $('<label>');
    this.label.addClass(defaultClass);

    return this.label;
}

function Span(defaultClass) {
    this.span = $('<span>');
    this.span.addClass(defaultClass);

    return this.span;
}

function Form(defaultClass) {
    this.form = $('<form>');
    this.form.addClass(defaultClass);

    return this.form;
}

function Link(defaultClass) {
    this.link = $('<a>');
    this.link.addClass(defaultClass);

    return this.link;
}

function Img(defaultClass) {
    this.img = $('<img>');
    this.img.addClass(defaultClass);

    return this.img;
}

function Table(defaultClass) {
    this.table = $('<table>');
    this.table.addClass(defaultClass);

    return this.table;
}

function Thead(defaultClass) {
    this.thead = $('<thead>');
    this.thead.addClass(defaultClass);

    return this.thead;
}

function Tbody(defaultClass) {
    this.tbody = $('<tbody>');
    this.tbody.addClass(defaultClass);

    return this.tbody;
}

function Tr(defaultClass) {
    this.tr = $('<tr>');
    this.tr.addClass(defaultClass);

    return this.tr;
}

function Td(defaultClass) {
    this.td = $('<td>');
    this.td.addClass(defaultClass);

    return this.td;
}

function Th(defaultClass) {
    this.th = $('<th>');
    this.th.addClass(defaultClass);

    return this.th;
}

function Paragraph(defaultClass) {
    this.p = $('<p>');
    this.p.addClass(defaultClass);

    return this.p;
}

function Pre(defaultClass) {
    this.pre = $('<pre>');
    this.pre.addClass(defaultClass);

    return this.pre;
}