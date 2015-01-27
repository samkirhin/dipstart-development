var BookkeeperScript = function(u,s){
    var self = this;
    this.form = $('#bookkeeperView');
    this.template = this.form.find('.bookkeeperTableTemplate');
    this.summTemplate = this.form.find('.bookkeeperSummTemplate');
    this.searchType = 'DESC';
    this.oldSearch = s;
    this.isSearched = false;
    this.search_field = "";
    this.search_type = "";
    this.search_string = "";
    
    
    
    this.loadList = function () {
        $.post(u, JSON.stringify({
            'sort': self.oldSearch,
            'type': self.searchType,
            'search_field': self.search_field,
            'search_type': self.search_type,
            'search_string': self.search_string
        }), function (response) {
            if (response.data) {
                self.form.find('.bookkeeperTable').empty();
                self.summTemplate.tmpl(response.data.report).appendTo('.bookkeeperTable');
                self.template.tmpl(response.data.data).appendTo('.bookkeeperTable');
                self.form.find('button.approve_payment').on('click', function(){
                    self.setApprove($(this).attr('value'), $(this).attr('pay_method'));
                });
            } else {
            }
        }, 'json');
    }
    
    this.setApprove = function(id, method) {
        $.post('index.php?r=project/payment/approveFromBookkeeper', JSON.stringify({
            'id': id,
            'method': method
        }), function (response) {
            self.loadList();
        }, 'json');
    }
    
    this.addAction = function() {
        self.form.find('button.searching').on('click', function(){
            self.getList($(this).attr('sort'));
        });
        self.form.find('button.send_search').on('click', function() {
            self.searchResult();
        });
        self.form.find('button.clear_search').on('click', function() {
            self.search_field = "";
            self.search_type = "";
            self.search_string = "";
        });
    }
    
    this.loadList();
    this.addAction();
    
    this.searchResult = function() {
        self.search_field = self.form.find(".search_field_select option:selected").val();
        self.search_type = self.form.find(".search_type_select option:selected").val();
        self.search_string = self.form.find(".search_string").val();
        self.loadList();
    }
    
    this.getList = function(newSearch) {
        
            if (newSearch != self.oldSearch) {
                self.searchType = 'DESC'
                self.oldSearch = newSearch;
            } else {
                if (self.searchType == 'DESC') {
                    self.searchType = 'ASC';
                } else {
                    self.searchType = 'DESC';
                }
            }
            self.loadList();
    }
    
}
