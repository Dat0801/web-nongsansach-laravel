var token = '431a4af1-167f-11ef-9201-0221b0d2310c';
var provinceAPI = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/province';
var districtAPI = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/district';
var wardAPI = 'https://online-gateway.ghn.vn/shiip/public-api/master-data/ward';


function getProvinceData() {
  var xhr = new XMLHttpRequest();
  xhr.open('GET', provinceAPI, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.setRequestHeader('Token', token);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      renderProvinceData(response.data);
    }
  };
  xhr.send();
}

function getDistrictData(provinceId) {
  var xhr = new XMLHttpRequest();
  var url = districtAPI + '?province_id=' + provinceId;
  xhr.open('GET', url, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.setRequestHeader('Token', token);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      renderDistrictData(response.data);
    }
  };
  xhr.send();
}

function getWardData(districtId) {
  var xhr = new XMLHttpRequest();
  var url = wardAPI + '?district_id=' + districtId;
  xhr.open('GET', url, true);
  xhr.setRequestHeader('Content-Type', 'application/json');
  xhr.setRequestHeader('Token', token);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      renderWardData(response.data);
    }
  };
  xhr.send();
}

function renderProvinceData(provinces) {
  var provinceSelect = document.getElementById('province');
  var provinceSelected = document.getElementById('provinceSelected');
  provinceSelect.innerHTML = '<option value="" code="">Chọn tỉnh/thành phố</option>';
  for (var i = 0; i < provinces.length; i++) {
    var province = provinces[i];
    var option = document.createElement('option');

    option.value = province.ProvinceName;
    if (provinceSelected && provinceSelected.value !== '') {
      if (province.ProvinceName == provinceSelected.value) {
        option.selected = true;
      }
    }

    option.setAttribute('code', province.ProvinceID);
    option.textContent = province.ProvinceName;
    provinceSelect.appendChild(option);
  }


}

function renderDistrictData(districts) {
  var districtSelect = document.getElementById('district');
  var districtSelected = document.getElementById('districtSelected');
  districtSelect.innerHTML = '<option value="" code="">Chọn quận/huyện</option>';
  for (var i = 0; i < districts.length; i++) {
    var district = districts[i];
    var option = document.createElement('option');
    option.value = district.DistrictName;

    if (districtSelected && districtSelected.value == '' && i == 0) {
      if (district.DistrictName == districtSelected.value) {
        option.selected = true;
      }
    }

    option.setAttribute('code', district.DistrictID);
    option.textContent = district.DistrictName;
    districtSelect.appendChild(option);
  }


}

function renderWardData(wards) {
  var wardSelect = document.getElementById('ward');
  var wardSelected = document.getElementById('wardSelected');
  wardSelect.innerHTML = '<option value="" code="">Chọn phường/xã</option>';
  for (var i = 0; i < wards.length; i++) {
    var ward = wards[i];
    var option = document.createElement('option');
    option.value = ward.WardName;

    if (wardSelected && wardSelected.value == '' && i == 0) {
      if (ward.WardName == wardSelected.value) {
        option.selected = true;
      }
    }

    option.setAttribute('code', ward.wardID);
    option.textContent = ward.WardName;
    wardSelect.appendChild(option);
  }


}

document.addEventListener('DOMContentLoaded', function () {
  getProvinceData();

  var provinceSelect = document.getElementById('province');
  provinceSelect.addEventListener('change', function () {
    var selectedOption = this.selectedOptions[0];
    var selectedProvinceId = selectedOption.getAttribute('code');
    getDistrictData(selectedProvinceId);
  });

  var districtSelect = document.getElementById('district');
  districtSelect.addEventListener('change', function () {
    var selectedOption = this.selectedOptions[0];
    var selectedDistrictId = selectedOption.getAttribute('code');
    getWardData(selectedDistrictId);
  });
});