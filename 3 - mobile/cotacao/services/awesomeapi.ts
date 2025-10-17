let baseUrl = 'https://economia.awesomeacd senacpi.com.br/json/last/';

export const getUSD = async () => {
    try {
        let url = baseUrl + '/last/USD-BRL?token=fff1d6bbe658ecad6727c4c3e4c7a7fdad07bf87882cf7472459cd618366b122'
        const req = await fetch(url);
        const json = await req.json();

        if(json.USDBRL){
            return parseFloat(json.USDBRL.bid);
        }
        }catch (error) {
            return 0;
        }
    }
