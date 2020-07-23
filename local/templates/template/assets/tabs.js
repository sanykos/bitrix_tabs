$(function() {

    async function getItems(template, signedParams) {
        let params = new URLSearchParams();
        params.set('template', template)
        params.set('parameters', signedParams)
        let res = await (await fetch(
        '/bitrix/components/bitrix/catalog.section/ajax.php',
        {
            method: 'POST',
            body: params
        }
        )).text();
       $('.swiper-wrapper').html(res);
    }

async function getComponentParams(sectionId) {
    let params = new URLSearchParams();
    params.set('id', sectionId);
        try {
            const result = await fetch('/local/ajax/tabs.php',{
                method: 'POST', 
                body: params,
            });
            const data = await result.json();
            getItems(data.template, data.signedParams);
        } catch(e) {
            console.error(e);
        }
    }
    
    $('body').on('click', '.homepage_items_btns a', function(e) {
        $self = $(this);
        let sectionId = $self.data('id');
        if(!$self.hasClass('selected')) {
            getComponentParams(sectionId);
        }
        $('.homepage_items_btns a').removeClass('selected');
        $self.addClass('selected');
        return false;
    })

})
