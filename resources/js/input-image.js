/**
 * Classe para upload de imagens
 * @author Gabriel Teixeira
 * @param object config
 * @required CropperJS
 */
class InputImage {

    constructor(config) {
        let self = this;
        this.profile = [];

        // Define a configuração padrão da classe
        this.config = {
            label: 'Arraste Aqui',
            name: 'file',
            namePath: 'imagemProfile',
            thumbHeight: 300,
        }

        // Sobreescreve a configuração padrão da classe
        if (config) {
            this.config = $.extend(true, this.config, config);
        }

        // Cria os elementos HTML
        this.inputPath = new Input();
        this.container = new Div('ip-img');
        this.filePreview = new Div('ip-img-ct');
        this.fileDrop = new Div('ip-img-dp');
        this.fileTitle = new Div('ip-img-tt');
        this.filesImage = new Div('row');
        this.previewContainer = new Ul('ul');
        this.col = new Div('col');
        this.input = new Input();

        // Configura os elementos
        this.inputPath.attr('type', 'hidden');
        this.input.attr('type', 'file');
        this.input.attr('name', 'imagem');
        this.inputPath.attr('name', this.config.namePath);
        this.fileTitle.html(this.config.label);

        // Constroi o layout
        this.filesImage.append(this.previewContainer);
        this.fileDrop.append(this.fileTitle);
        this.fileDrop.append(this.filesImage);
        this.filePreview.append(this.fileDrop);
        this.container.append(this.input);
        this.container.append(this.filePreview);
        this.container.prepend(this.inputPath);
    }

    init() {
        let self = this;

        $(this.input).on('change', function() {

            if (this.files && this.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let imageUrl = e.target.result;
                    self.profile.push(imageUrl);
                    self.inputPath.val(imageUrl);
                    self.previewContainer.append(self.getPreview(imageUrl));
                    self.fileTitle.hide();
                };

                reader.readAsDataURL(this.files[0]);
            }
            self.fileDrop.append(self.filesImage);
        });

        $(this.input).on('click', function() {
            self.updateValue();
        });

    }

    /**
     * Define as preview das imagens
     * @param element image
     */
    getPreview(image) {

        // Define o layout 
        this.previewColumn = new Li('ip-img-tb-ct');
        this.image = new Img('ip-img-tb img-fluid');
        this.deleteContainer = new Div('ip-img-dl');
        this.deleteColumn = new Div();
        this.captionDelete = new Div('tx-r');
        this.cropperContainer = new Div('ip-img-cp');
        this.cropperColumn = new Div();
        this.captionCropper = new Div('tx-l');
        this.delete = new Icon('fas fa-times ip-img-ic');
        this.cropper = new Icon('fas fa-crop ip-img-ic');

        // Configura os elementos
        this.image.attr('src', image);
        this.image.css('max-height', this.config.thumbHeight);

        // Constrói o layout da imagem  
        this.captionCropper.append(this.cropper);
        this.cropperColumn.append(this.captionCropper);
        this.cropperContainer.append(this.cropperColumn);

        this.captionDelete.append(this.delete);
        this.deleteColumn.append(this.captionDelete);
        this.deleteContainer.append(this.deleteColumn);
        this.previewColumn.append(this.image);
        this.previewColumn.append(this.deleteContainer);
        this.previewColumn.append(this.cropperContainer);
        this.setTrash(this.previewColumn, this.delete, this.image);
        this.setCropper(this.previewColumn, this.cropper, this.image);

        return this.previewColumn;

    }

    /**
     * Define a opção de excluir a imagem da preview
     * @param element target
     * @param element btn
     * @param element item
     */
    setTrash(target, btn, item) {
        let self = this;

        btn.on('click', function() {
            $(self.input).val('');
            $(self.inputPath).val('');
            self.profile = [];
            target.remove();
            self.fileTitle.show();
        });
    };


    /**
     * Atualiza o valor do campo
     */
    updateValue() {
        $(this.input).val('');
        $(this.inputPath).val('');
        this.profile = [];
        this.fileTitle.show();
        $(this.previewColumn).remove();
    }

    /**
     * Define a opção de excluir a imagem da preview
     * @param element target
     * @param element btn
     * @param element item
     */
    setCropper(target, btn, item) {
        let self = this;

        btn.on('click', function() {
            self.cropperImage = new Img('img-fluid');
            self.cropperImage.attr('src', $(item).attr('src'));

            let modal = $('#modal-crop');
            let modalBody = modal.find('.modal-body');
            let btnCrop = modal.find('.crop');
            let btnCancel = modal.find('.cancel');

            modalBody.css({ padding: 0 });
            modalBody.append(self.cropperImage);

            $(btnCrop).on('click', function() {
                let result = $(self.cropperImage).cropper('getCroppedCanvas', {
                    fillColor: '#fff',
                    beforeDrawImage: function(canvas) {
                        var context = canvas.getContext('2d');
                        context.imageSmoothingEnabled = false;
                        context.imageSmoothingQuality = 'high';
                    },
                });
                let image = result.toDataURL('image/jpeg');
                self.setUpdatePreview(item, image);
                modalBody.empty();
                $(modal).modal('hide');
            });

            $(btnCancel).on('click', function() {
                modalBody.empty();
                $(modal).modal('hide');
            });

            modal.modal('show');
            modal.on("shown.bs.modal", function() {
                // Configura os elementos
                $(self.cropperImage).cropper({
                    viewMode: 1,
                    aspectRatio: 1 / 1,
                    movable: false,
                    zoomable: false,
                    minCropBoxWidth: 100,
                    minCropBoxHeight: 100,
                });
            });

        });

    }

    // decodeBase64Image(dataString) {
    //     var matches = dataString.match(/^data:([A-Za-z-+\/]+);base64,(.+)$/),
    //         response = {};

    //     if (matches.length !== 3) {
    //         return new Error('Invalid input string');
    //     }

    //     response.type = matches[1];
    //     response.data = new Buffer(matches[2], 'base64');

    //     return response;
    // }


    /**
     * @param element image
     * @param string imageNew
     */
    setUpdatePreview(image, imageNew) {
        this.profile = [];
        $(this.inputPath).val('');
        $(this.inputPath).val(imageNew);
        this.profile.push(imageNew);
        image.attr('src', imageNew);
    }

    /**
     * @returns view
     */
    getView() {
        return this.container;
    }

}