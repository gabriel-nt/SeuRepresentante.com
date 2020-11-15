class FloatBtn {

    constructor(config) {

        let self = this;

        // Define a configuração padrão da classe
        this.config = {
            class: 'btn-ac',
            iconDefault: 'ic-apps',
            iconHover: 'ic-apps',
            buttons: []
        };

        // Sobreescreve a configuração padrão da classe
        if (config) {
            this.config = $.extend(true, this.config, config);
        }

        // Cria os elementos HTML
        this.container = new Div('btn-ft-ct');
        this.mainButton = new Button('btn-ft-mn');
        this.mainButtonIcon = new Icon('ft-plus');
        this.mainButtonIconHover = new Icon('ft-edit');

        // Constroi o layout
        this.mainButton.append(this.mainButtonIcon);
        this.mainButton.append(this.mainButtonIconHover);
        this.container.append(this.mainButton);

        if (this.config.buttons.length > 0 && this.config.buttons.length <= 4) {
            this.config.buttons.forEach(config => {
                this.setButton(config);
            });
        }

        // Configura o objeto
        this.mainButtonIcon.addClass(this.config.iconDefault);
        this.mainButtonIconHover.addClass(this.config.iconHover);

        this.mainButton.addClass(this.config.class);
    }

    /**
     * Adiciona um novo botão
     * @param object config 
     */
    setButton(config) {
        let self = this;

        let button = new Button('btn-ft');

        // Cor
        if (config.class) {
            button.addClass(config.class);
        }

        // Ícone
        if (config.icon) {
            let icon = new Icon(config.icon);
            button.append(icon);
        }

        if (this.container.find('button').length <= 4) {
            this.container.append(button);
        }

    }

    /**
     * @returns element
     */
    getFloat() {
        return this.mainButton;
    }

    /**
     * @returns view
     */
    getView() {
        return this.container;
    }
}