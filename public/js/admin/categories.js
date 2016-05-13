new Vue({
    el: '#app',

    data: {
        baseUrl: '/admin/categories',
        nodeFormId: '#form-categories',
        treeId: '#jstree',
        node: false,
        nodeLoading: false,
        sendingForm: false,
        deletingNode: false,
        deletingImage: false
    },

    ready: function () {
        var that = this;

        // Инициализируем дерево
        $(that.treeId).jstree({
            'core' : {
                'data': {
                    'url': function () {
                        return that.baseUrl;
                    },
                    'data': function (node) {
                        return {'id': node.id};
                    },
                },
                'check_callback' : true
            },
            'types' : {
                'default' : {
                    'icon' : '/img/category.png'
                }
            },
            'plugins' : [ 'dnd', 'types', 'wholerow' ]
        }).
        on('select_node.jstree', function (node, selected, e) {
            if (selected.node.original.id == -1){
                $(that.nodeFormId).attr('action', that.baseUrl);
                that.node = selected.node.original;
                that.nodeLoading = false;
                $('#name').focus();
                CKEDITOR.instances.about.setData('');
            } else {
                that.resetNodeForm();
                $(that.nodeFormId).attr('action', that.baseUrl + '/' + selected.node.original.id);
                $.get(that.baseUrl + '/' + selected.node.original.id, function(data) {
                    that.node = data;
                    CKEDITOR.instances.about.setData(that.node.about);
                })
                .fail(function(){
                    sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                })
                .always(function(){
                    that.nodeLoading = false;
                });
            }
        }).
        on('move_node.jstree', function (e, node) {
            var params = {
                'id': node.node.id,
                'parent': node.parent != '#' ? node.parent : '',
                'position': node.position,
                'old_parent': node.old_parent != '#' ? node.old_parent : '',
                'old_position': node.old_position
            };

            $.post(that.baseUrl + '/move', params, function(data) {

            })
            .fail(function(){
                sweetAlert("", "Ошибка при запросе к серсеру", 'error');
            })
            .always(function(){

            });
        });

        $(that.nodeFormId).on('submit', function(e) {
            $('#about').val(CKEDITOR.instances.about.getData());
            that.ajaxFormSubmit(e, that.nodeSaved);
        });
    },

    methods: {
        newNode: function(selectedNode){
            var node = {};
            node.id = -1;
            node.text = 'Категория';
            node.name = 'Категория';
            node.parent_id = selectedNode == '#' ? '' : selectedNode;

            return node;
        },

        addNode: function(){
            var that = this;

            var newNode = $(that.treeId).jstree().get_node(-1);
            if (newNode){
                return;
            }

            var selectedNode = $(that.treeId).jstree().get_selected();
            selectedNode = selectedNode.length ? selectedNode[0] : '#';

            that.resetNodeForm();
            var newNode = that.newNode(selectedNode);
            $(that.treeId).jstree().create_node(selectedNode, newNode);
            if (selectedNode != '#'){
                $(that.treeId).jstree().open_node(selectedNode);
                $(that.treeId).jstree().deselect_node(selectedNode);
            }
            $(that.treeId).jstree().select_node(-1);
        },

        deleteNode: function(){
            var that = this;

            sweetAlert({
                title: "Удаление категории",
                text: "Вы уверены что хотите удалить категорию?",
                type: "info",
                confirmButtonColor: "#F44336",
                confirmButtonText: "Удалить",
                cancelButtonText: "Отмена",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true,
            }, function () {
                var selectedNode = $(that.treeId).jstree().get_selected();
                selectedNode = selectedNode[0];
                that.node = false;

                if (selectedNode == -1){
                    $(that.treeId).jstree().delete_node(-1);
                    sweetAlert.close();
                } else {
                    that.deletingNode = true;
                    $.post(that.baseUrl + '/' + selectedNode, { '_method': 'DELETE' }, function(data){
                        $(that.treeId).jstree().delete_node(selectedNode);
                        sweetAlert.close();
                    })
                    .fail(function(){
                        sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                    })
                    .always(function(){
                        that.deletingNode = false;
                    });
                }
            });
        },

        resetNodeForm: function(){
            var that = this;

            that.node = false;
            that.nodeLoading = true;
            $(that.nodeFormId + ' #image').val('');
            $(that.nodeFormId + ' #image-path').val('');
            var newNode = $(that.treeId).jstree().get_node(-1);
            if (newNode){
                $(that.treeId).jstree().delete_node(-1);
            }
        },

        nodeSaved: function(data){
            var that = this;

            var newNode = $(that.treeId).jstree().get_node(-1);
            if (newNode){
                $(that.treeId).jstree().create_node(newNode.parent, data, 'last');
                $(that.treeId).jstree().delete_node(-1);
            }
            else{
                $("#jstree").jstree().set_text(data.id, data.name);
            }

            if ($(that.nodeFormId + ' #image').val())
            {
                var formData = new FormData();
                formData.append('image', $(that.nodeFormId + ' #image')[0].files[0]);
                formData.append('name', data.name);
                formData.append('_method', 'PUT');

                $.ajax({
                    url: that.baseUrl + '/' + data.id,
                    type: 'POST',
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data){
                        that.node = data;
                        $(that.nodeFormId + ' #image').val('');
                        $(that.nodeFormId + ' #image-path').val('');
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                    }
                });
            }
        },

        ajaxFormSubmit: function (e, successFunction)
        {
            var that = this;

            if (e) {
                e.preventDefault();
            }
            var form = e ? e.target : $(that.nodeFormId);

            // Место для отображения ошибок в форме
            var formStatus = $(form).find('.form-status');
            if (formStatus.length) formStatus.html('');

            // Анимированная кнопка при отправки формы
            var formButton = $(form).find('.form-button').hide();
            if (formButton.length) {
                formButton.hide();
            }
            that.sendingForm = true;

            $.ajax({
                method: $(form).attr('method'),
                url: $(form).attr('action'),
                data: $(form).serialize(),
                success: function (data)
                {
                    successFunction(data);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    if (formStatus.length && jqXHR.status == 422) // Если статус 422 (неправильные входные данные) то отображаем ошибки
                    {
                        var formStatusText = '<div class="card-panel red darken-4 white-text">' + (formStatus.data('errorText') ? formStatus.data('errorText') : '<strong>Ошибка</strong>') + "<ul>";

                        $.each(jqXHR.responseJSON, function (index, value) {
                            formStatusText += "<li>" + value + "</li>";
                        });

                        formStatusText += "</ul></div>";
                        formStatus.html(formStatusText);
                        $('body').scrollTo(formStatus, 500);
                    }
                    else
                    {
                        sweetAlert("", "Ошибка при запросе к серсеру", 'error');
                    }
                },
                complete: function (jqXHR, textStatus)
                {
                    if (formButton.length) {
                        formButton.show();
                    }
                    that.sendingForm = false;
                }
            });
        },
    }

});