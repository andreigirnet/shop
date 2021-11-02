(function() {
    const search = instantsearch({
        appId: 'P53SZUIML8',
        apiKey: '19f54cccab5efbeb0d351b307326a864',
        indexName: 'products',
        urlSync: true
    });

    search.addWidget(
        instantsearch.widgets.hits({
            container: '#hits',
            templates:{
                empty: 'No Results',
                item: function(item){
                    return`
                        <a href="${window.location.origin}/shop/${item.slug}">
                        <div class="result-title">
                            ${item._highlightResult.name.value}
                        </div>
                        <div class="result-details">
                            ${item._highlightResult.details.value}
                        </div>
                        <div class="result-price">
                            $${(item.price / 100).toFixed(2)}
                        </div>
                        <img src="${window.location.origin}/${item.image}" class="algolia-thumb-result" alt="">
                        </a>
                    `
                }
                    //'<em>Hit {{objectID}}</em>: {{{_highlightResult.name.value}}'
            }
        })
    );
    search.addWidget(
      instantsearch.widgets.searchBox({
          container: '#search-box',
          placeholder: 'search for products'
      })
    );

    search.addWidget(
        instantsearch.widgets.pagination({
            container: '#pagination',
            maxPages: 20,
            scrollTo: false
        })
    );

    search.addWidget(
        instantsearch.widgets.stats({
            container: '#stats-container',
        })
    );


    search.start();
})();
