function promisee(url) {

    return new Promise( (resolve, reject) => {
        fetch(url)
            .then(data => {
                if (data.status == 200) {
                    resolve(data.json());
                } else{
                    console.log('ОШИБКА');
                    reject(data)
                }
            })
    });
}

$('.changeCountryAjax').on('click', function (ev) {
    let url = ev.target.dataset.url;
    promisee(url).then(data =>{
        console.log(data);
    })
});

