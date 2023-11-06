async function getDataFromJSON(){
    let response = await fetch('json/medical.json');
    let rawData = await response.text();
    let ObjData = JSON.parse(rawData);
    let result = document.getElementById('result')
    
    
    let count = 1;
    for(let i = 0; i < ObjData.length; i++){
        let tr = document.createElement('tr')
        let td1 = document.createElement('td');
        let td2 = document.createElement('td');
        let td3 = document.createElement('td');
        let td4 = document.createElement('td');
        let td5 = document.createElement('td');
        let td6 = document.createElement('td');
        let content1 = count;
        let content2 = ObjData[i].ชื่ออังกฤษ;
        let content3 = ObjData[i].ชื่อไทย;
        let content4 = ObjData[i].ระดับความเสี่ยง;
        let content5 = ObjData[i].ระบบไฟฟ้า;
        let content6 = ObjData[i].การฆ่าเชื้อ;
        td1.innerHTML = content1;
        td2.innerHTML = content2;
        td3.innerHTML = content3;
        td4.innerHTML = content4;
        td5.innerHTML = content5;
        td6.innerHTML = content6;
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        tr.appendChild(td4);
        tr.appendChild(td5);
        tr.appendChild(td6);
        count++;
        result.appendChild(tr);
    }
}
getDataFromJSON();
