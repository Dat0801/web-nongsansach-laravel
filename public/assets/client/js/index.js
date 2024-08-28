const token = '431a4af1-167f-11ef-9201-0221b0d2310c';
const provinceAPI = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province';
const districtAPI = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district';
const wardAPI = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward';

const getData = async (url) => {
  try {
    const options = {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
        'Token': token
      }
    };
    return (await fetch(url, options)).json();
  }
  catch (error) {
    console.error(error);
  }
};

const createOption = (value, text, code) => {
  const option = document.createElement('option');
  option.value = value;
  option.textContent = text;
  option.setAttribute('code', code);
  return option;
};

const renderData = (data, elementId, elementName, title) => {
  const selectElement = document.getElementById(elementId);
  if (title !== '') {
    selectElement.innerHTML = `<option>Chọn ${title}</option>`;
  }
  data.forEach(item => {
    const option = createOption(item[`${elementName}Name`], item[`${elementName}Name`], item[`${elementName}ID`]);
    selectElement.appendChild(option);
  });
};

document.addEventListener('DOMContentLoaded', async () => {
  const provinceElement = document.getElementById('province');
  const districtElement = document.getElementById('district');
  const wardElement = document.getElementById('ward');
  const { data: provinces } = await getData(provinceAPI);
  renderData(provinces, 'province', 'Province', '');

  provinceElement.addEventListener('change', async function () {
    const selectedOption = this.selectedOptions[0];
    const selectedProvinceId = selectedOption.getAttribute('code');
    const { data: districts } = await getData(`${districtAPI}?province_id=${selectedProvinceId}`);
    renderData(districts, 'district', 'District', 'Quận/Huyện');
    document.getElementById('ward').innerHTML = `<option>Chọn Phường/Xã</option>`;
    document.getElementById('districtSelected') != null ? document.getElementById('districtSelected').remove() : '';
    document.getElementById('wardSelected') != null ? document.getElementById('wardSelected').remove() : '';
  });

  districtElement.addEventListener('change', async function () {
    const selectedOption = this.selectedOptions[0];
    const selectedDistrictId = selectedOption.getAttribute('code');
    if (selectedDistrictId == null) {
      wardElement.selectedIndex = 0;
      return;
    }
    const { data: wards } = await getData(`${wardAPI}?district_id=${selectedDistrictId}`);
    renderData(wards, 'ward', 'Ward', 'Phường/Xã');
  });
});
