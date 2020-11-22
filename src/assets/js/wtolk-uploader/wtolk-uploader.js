class WtolkUploader {
    constructor(options) {
        this.debug_mode = false;
        this.el = document.querySelector(options.el);
        this.input_name = options.input_name;
        this.field_name = options.field_name;
        this.preview = options.preview;
        this.item_class = 'uploader_file_card';

        this.createContainer();
        this.setListeners();
        this.setSortable();

        if (options.files) {
            this.setFiles(options.files);
            this.files_count = this.files.length;
            this.reloadItems();
        } else {
            this.files = [];
            this.files_count = 0;
        }
        this.loaded_files = [];
        this.loaded_once = true;
    }

    //Создаем контейнер
    createContainer() {
        this.container = document.createElement('div');
        this.container.classList.add('uploader_container');
        this.el.appendChild(this.container);

        this.createHeader();
        this.createFooter();
    }

    //Создаем верхнюю часть
    createHeader() {
        this.header = document.createElement('div');
        this.header.classList.add('uploader_header');
        this.container.appendChild(this.header);

        this.input_pool = document.createElement('div');
        this.input_pool.classList.add('uploader_input_pool');
        this.header.appendChild(this.input_pool);

        this.input_text = document.createElement('label');
        this.input_text.setAttribute('for', 'uploader_');
        this.input_text.innerHTML = 'Переместите сюда файлы или&nbsp;<span class="uploader_text_underlined"> выберите вручную</span>';
        this.input_text.classList.add('uploader_input_text');
        this.input_pool.appendChild(this.input_text);


        this.input = document.createElement('input');
        this.input.classList.add('uploader_input');
        this.input.setAttribute('type', 'file');
        this.input.setAttribute('name', this.input_name);
        this.input.setAttribute('multiple', true);
        this.input.id = 'uploader_';
        this.input_pool.appendChild(this.input);

        this.positions_input = document.createElement('input');
        this.positions_input.setAttribute('type', 'hidden');
        this.positions_input.setAttribute('name', this.field_name+'[uploader][positions]');
        this.container.appendChild(this.positions_input);

        this.remove_input = document.createElement('input');
        this.remove_input.setAttribute('type', 'hidden');
        this.remove_input.setAttribute('name', this.field_name+'[uploader][remove]');
        this.container.appendChild(this.remove_input);
    };

    createFooter() {

        if (this.preview) {

            this.files_list = this.createElement({
                tag: 'div',
                className: 'uploader_files_list',
                id: 'uploader_files_list'
            });

            this.container.appendChild(this.files_list);

        } else {
            let node = [
                {
                    tag: 'table',
                    className: 'table table-condensed table-hover',
                    childNodes: [
                        {
                            tag: 'thead',
                            childNodes: [
                                {
                                    tag: 'tr',
                                    childNodes: [
                                        {
                                            tag: 'th',
                                            html: 'Информация о файле'
                                        },
                                        {
                                            tag: 'th',
                                            html: 'Действия'
                                        }
                                    ]
                                }
                            ]
                        },
                        {
                            tag: 'tbody',
                            id: 'wtolk-uploader-container'
                        }
                    ]
                }
            ];
            let table = this.createNode(node);
            this.container.appendChild(table[0]);

            this.files_list = document.getElementById('wtolk-uploader-container');
        }
    }

    createElement(tag) {
        let elem = document.createElement(tag.tag);

        if (tag.className) elem.className = tag.className;
        if (tag.id) elem.id = tag.id;
        if (tag.html) elem.innerHTML = tag.html;

        if (tag.attributes) {
            for (let attr in tag.attributes) {
                elem.setAttribute(attr, tag.attributes[attr]);
            }
        }

        return elem;
    }

    createNode(node) {
        var dom = [];

        node.forEach(elem => {
            let tag = this.createElement(elem);

            if (typeof elem.childNodes === 'object') {
                let child = this.createNode(elem.childNodes);

                child.forEach(el => tag.appendChild(el));
            }

            dom.push(tag);
        });

        return dom;
    }

    setListeners() {
        this.input.addEventListener('change', () => {
            this.loadFiles();
        });
        let el = this.header.firstElementChild.firstElementChild, k = 3;
        this.header.addEventListener('dragenter', () => {
            el.style.backgroundColor = 'rgba(0,0,0,.1)';
            el.style.padding = WtolkUploader.getIntStyle(el, 'padding') * k + 'px';
        });
        this.header.addEventListener('dragleave', () => {
            el.style.backgroundColor = 'rgba(255,255,255,0)';
            el.style.padding = WtolkUploader.getIntStyle(el, 'padding') / k + 'px';
        });
        this.header.addEventListener('drop', () => {
            el.style.backgroundColor = 'rgba(255,255,255,0)';
            el.style.padding = WtolkUploader.getIntStyle(el, 'padding') / k + 'px';
        });
    }

    static getIntStyle(el, property) {
        let css_val = window.getComputedStyle(el, null).getPropertyValue(property);
        return parseInt(css_val);
    }

    read(f) {
        var reader = new FileReader();
        reader.readAsDataURL(f);
        return new Promise((resolve) => {
            reader.onload = (e) => {
                resolve({
                    sort: this.files_count,
                    path: e.target.result,
                    extension: f.type,
                    name: f.name,
                    uuid: WtolkUploader.getUuid()
                });

            };
        });
    }

    loading() {
        return new Promise(resolve => {
            Object.keys(this.input.files).forEach( (key) => {
                let type = this.input.files[key].type;
                let uuid = WtolkUploader.getUuid();
                if (type.split('/')[0] === 'image') {
                    this.read(this.input.files[key]).then((file) => {
                        this.files.push(file);
                        this.loaded_files.push(this.input.files[key]);
                        this.drawItem(file);
                        this.files_count++;
                    }).then(() => {
                        // resolve();
                    });
                    // reader.readAsDataURL();
                } else {
                    let file = {sort: this.files_count, extension: type, name: this.input.files[key].name, uuid: uuid};
                    this.files.push(file);
                    this.loaded_files.push(this.input.files[key]);
                    this.drawItem(file);
                    this.files_count++;
                    // resolve();
                }
            });
            resolve();
        });
    }

    loadFiles() {
        if (this.checkFiles()) {
            this.loading().then(() => {
                if (!this.loaded_once) {
                    this.updateInputFules()
                }
                this.loaded_once = false;
            });
        } else {
            this.revertUpload();
        }

    }

    updateInputFules() {
        var dT = new ClipboardEvent('').clipboardData || new DataTransfer();

        // dT.items.add(this.input.files.item(i));

        // for (var i = 0; i < this.input.files.length; i++) {
        //     for (var c = 0; c < this.loaded_files.length; c++) {
        //         if (this.loaded_files[c].name !== this.input.files[i].name) {
        //             dT.items.add(this.input.files.item(i));
        //         }
        //     }
        // }

        for (var i = 0; i < this.input.files.length; i++) {
            dT.items.add(this.input.files.item(i));
        }

        for (var j = 0; j < this.loaded_files.length; j++) {
            dT.items.add(this.loaded_files[j]);
        }

        this.input.files = dT.files;
    }

    checkFiles() {
        let result = true;
        this.loaded_files.forEach((file) => {
            for (var i = 0; i < this.input.files.length; i++) {
                if (this.input.files[i].name === file.name) {
                    result = false;
                }
            }
        });
        this.files.forEach((file) => {
            for (var i = 0; i < this.input.files.length; i++) {
                if (this.input.files[i].name === file.name) {
                    result = false;
                }
            }
        });
        return result;
    }

    revertUpload() {
        alert('Один из загружаемых файлов уже загружен. Пожалйста, повторите попытку');
        var dT = new ClipboardEvent('').clipboardData || new DataTransfer();
        if (!this.loaded_once) {
            for (var j = 0; j < this.loaded_files.length; j++) {
                dT.items.add(this.loaded_files[j]);
            }
        }
        this.input.files = dT.files;
    }

    reloadItems() {
        while (this.files_list.firstChild) {
            this.files_list.removeChild(this.files_list.firstChild);
        }

        this.files.forEach((file) => {
            this.drawItem(file)
        });
        this.updatePositions();
    }

    setFiles(files) {
        this.files = files;
        this.files.map((file) => {
            file.type = 'uploded/' + file.extension;
        });
    }

    drawItem(file) {

        if (!this.preview) {
            this.drawItemWithoutPreview(file);
            return false;
        }

        let item = document.createElement('div');
        item.classList.add(this.item_class);

        let file_extension = file.extension.toLowerCase().split('/').pop();

        if (['jpg', 'jpeg', 'png', 'gif'].indexOf(file_extension) !== -1) {

            if (file.id) {
                item.style.backgroundImage = 'url('+ file.url + ')';
            } else {
                item.style.backgroundImage = 'url(' + file.path + ')';
            }

        } else {
            let ext_container = document.createElement('div');
            ext_container.classList.add('uploader_ext_container');

            let ext_row = document.createElement('div');
            ext_row.classList.add('uploader_ext_row');

            let ext = document.createElement('div');
            ext.innerText = '.' + file.name.split('.').pop();
            ext.classList.add('uploader_ext');

            ext_row.appendChild(ext);
            ext_container.appendChild(ext_row);
            item.appendChild(ext_container);
        }

        item.dataset.sort = file.sort;
        if (!file.uuid) {
            file.uuid = WtolkUploader.getUuid();
        }
        item.dataset.uuid = file.uuid;
        if (file.id) {
            item.dataset.id = file.id;
        }
        item.dataset.filename = file.name;

        let remove_btn = document.createElement('i');
        remove_btn.classList.add('uploader_remove_btn');
        remove_btn.classList.add('icon-cross2');
        remove_btn.onclick = () => {
            this.removeItem(file)
        };

        let filename = document.createElement('div');
        filename.classList.add('uploader_filename');
        filename.innerHTML = file.original_name;
        item.appendChild(filename);

        item.appendChild(remove_btn);
        this.files_list.appendChild(item);
        this.updatePositions();
    }

    drawItemWithoutPreview(file) {
        let file_name;
        if (typeof file.original_name !== 'undefined') {
            file_name = file.original_name
        } else {
            file_name = file.name;
        }
        let row = [{
            tag: 'tr',
            className: this.item_class,
            childNodes: [
                {
                    tag: 'td',
                    childNodes: [
                        {
                            tag: 'i',
                            className: 'fa ' + this.getFileFaIcon(file)
                        },
                        {
                            tag: 'a',
                            html: ' ' + file_name
                        }
                    ]
                },
                {
                    tag: 'td',
                    childNodes: [
                        {
                            tag: 'button',
                            className: 'btn-remove',
                            html: 'Удалить',
                            attributes: {
                                type: 'button'
                            }
                        }
                    ]
                }
            ]
        }];
        let tr = this.createNode(row)[0];
        tr.dataset.sort = file.sort;
        tr.dataset.uuid = file.uuid || WtolkUploader.getUuid();
        tr.dataset.filename = file.name;

        file.id && (tr.dataset.id = file.id);

        tr.getElementsByClassName('btn-remove')[0].onclick = () => {
            this.removeItem(file)
        };
        this.files_list.appendChild(tr);
        this.updatePositions();
    }

    getFileFaIcon(file) {
        let ext = {
            doc: 'fa-file-word-o', docx: 'fa-file-word-o', xls: 'fa-file-excel-o', xlsx: 'fa-file-excel-o',
            ppt: 'fa-file-powerpoint-o', pptx: 'fa-file-powerpoint-o', pdf: 'fa-file-pdf-o',
            jpg: 'fa-file-image-o', jpeg: 'fa-file-image-o', pnf: 'fa-file-image-o', gif: 'fa-file-image-o',
            zip: 'fa-file-archive-o', rar: 'fa-file-archive-o', txt: 'fa-file-text-o',
            html: 'fa-file-code-o', css: 'fa-file-code-o', js: 'fa-file-code-o', php: 'fa-file-code-o',
            mp3: 'fa-file-audio-o', aac: 'fa-file-audio-o', ac3: 'fa-file-audio-o', flac: 'fa-file-audio-o',
            avi: 'fa-file-video-o', mp4: 'fa-file-video-o', mpeg: 'fa-file-video-o', mkv: 'fa-file-video-o',
        }

        return typeof(ext[file.extension]) === "undefined" ? 'fa-file-o' : ext[file.extension];
    }

    setSortable() {
        this.log('...Set sortable...');
        Sortable.create(this.files_list, {
            onAdd: () => {
                this.updatePositions()
            },
            onEnd: () => {
                this.updatePositions()
            },
            onRemove: () => {
                this.updatePositions();
            }
        });
    }

    updatePositions() {
        let cards = document.querySelectorAll('.' + this.item_class);
        let positions = [];

        cards.forEach((card) => {
            positions.push(card.dataset);
        });
        positions.forEach(function (item, i, positions) {
            item.sort = i;
            positions[i] = item;
        });
        this.positions_input.value = JSON.stringify(positions);
        console.log(positions);
    }

    removeItem(file) {

        let item_key;
        this.files.forEach((f, k) => {
            if (f.name === file.name) {
                item_key = k;
            }
        });

        if (file.id) {
            let remove_list;
            if (this.remove_input.value === '') {
                remove_list = [];
            } else {
                remove_list = JSON.parse(this.remove_input.value);
            }
            remove_list.push(file.id);
            this.remove_input.value = JSON.stringify(remove_list);
        } else {
            var dT = new ClipboardEvent('').clipboardData || new DataTransfer();

            for (var i = 0; i < this.input.files.length; i++) {
                if (this.input.files[i].name !== file.name) {
                    dT.items.add(this.input.files.item(i));
                }
            }
            this.input.files = dT.files;
        }

        this.files.splice(item_key, 1);
        this.files.forEach((file, key) => {
            file.sort = key + 1;
        });

        let loaded_key;
        Object.keys(this.loaded_files).forEach((k) => {
            if (this.loaded_files[k].name === file.name) {
                loaded_key = k;
            }
        });
        this.loaded_files.splice(loaded_key, 1);

        document.querySelectorAll('.' + this.item_class)[item_key].remove();
        // this.reloadItems();
        this.updatePositions();
    }


    static getUuid() {
        return `f${(~~(Math.random() * 1e8)).toString(16)}`;
    }

    log(msg) {
        if (this.debug_mode) {
            console.log(msg)
        }
    }
}
