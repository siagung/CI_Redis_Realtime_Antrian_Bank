var daftarAngka=new Array("","satu","dua","tiga","empat","lima","enam","tujuh","delapan","sembilan");
function terbilang(nilai){
var temp='';
var hasilBagi,sisaBagi;
var batas=3;//batas untuk ribuan
var maxBagian = 5;//untuk menentukan ukuran array, jumlahnya sesuaikan dengan jumlah anggota dari array gradeNilai[]
var gradeNilai=new Array("","ribu","juta","milyar","triliun");
//cek apakah ada angka 0 didepan ==> 00098, harus diubah menjadi 98
nilai = this.hapusNolDiDepan(nilai);
var nilaiTemp = ubahStringKeArray(batas, maxBagian, nilai);
//ubah menjadi bentuk terbilang
var j = nilai.length;
//var banyakBagian = (j % batas) == 0 ? (j / batas) :Math.round((j / batas) + 0.5f);//menentukan batas array
var banyakBagian = (j % batas) == 0 ? (j / batas) : Math.round(j / batas + 0.5);
var h=0;
for(var i = banyakBagian - 1; i >=0; i-- ){
var nilaiSementara = parseInt(nilaiTemp[h]);
if (nilaiSementara == 1 && i == 1){ temp +="seribu ";}
else {
//temp += this.cekRatusan(nilaiSementara)+" ";
temp +=this.ubahRatusanKeHuruf(nilaiTemp[h])+" ";
//temp +=nilaiTemp[h]+"dan";
temp += gradeNilai[i]+" ";
}
h++;
} 
return temp;
}
function ubahStringKeArray(batas, maxBagian,kata){
var temp= new Array(maxBagian);// maksimal 999 milyar
var j = kata.length;
var banyakBagian = (j % batas) == 0 ? (j / batas) : Math.round(j / batas + 0.5);
for(var i = banyakBagian - 1; i >=0  ; i--){
var k = j - batas;
    if(k < 0) k = 0;
    temp[i]=kata.substring(k,j);
j = k ;
if (j == 0) break;
}
return temp;
}
function ubahRatusanKeHuruf(nilai){
//maksimal 3 karakter
var batas = 2;//membagi string menjadi 2 bagian, misal 123 ==> 1 dan 23
var maxBagian = 2;//untuk deklarasi panjang array
var temp = this.ubahStringKeArray(batas, maxBagian, nilai);
var j = nilai.length;
var hasil="";
//var banyakBagian = ((j % batas) == 0 ? (j / batas) :Math.round((j / batas) + 0.5f));//menentukan batas array
var banyakBagian = (j % batas) == 0 ? (j / batas) : Math.round(j / batas + 0.5);
for(var i = 0; i < banyakBagian ;i++){ 
//cek string yang memiliki panjang lebih dari satu ==> belasan atau puluhan
if(temp[i].length > 1){
    //cek untuk yang bernilai belasan ==> angka pertama 1 dan angka kedua 0 - 9, seperti 11,16 dst
    if(temp[i].charAt(0) == '1'){
    if(temp[i].charAt(1) == '1') {hasil += "sebelas";}
    else if(temp[i].charAt(1) == '0') {hasil += "sepuluh";}
    else hasil += daftarAngka[temp[i].charAt(1) - '0']+ " belas ";
    }
    //cek untuk string dengan format angka  pertama 0 ==> 09,05 dst
    else if(temp[i].charAt(0) == '0') {hasil += daftarAngka[temp[i].charAt(1) - '0'] ;}
    //cek string dengan format selain angka pertama 0 atau 1
    else hasil += daftarAngka[temp[i].charAt(0) - '0']+ " puluh " +daftarAngka[temp[i].charAt(1) - '0'] ;
}else {
//cek string yang memiliki panjang = 1 dan berada pada posisi ratusan
if(i == 0 && banyakBagian !=1){
    if (temp[i].charAt(0) == '1') hasil+=" seratus ";
    else if (temp[i].charAt(0) == '0') hasil+=" ";
    else hasil+= daftarAngka[parseInt(temp[i])]+" ratus ";
}
//string dengan panjang satu dan tidak berada pada posisi ratusan ==> satuan
else hasil+= daftarAngka[parseInt(temp[i])];
}
}
return  hasil;
}
function hapusNolDiDepan(nilai){
while(nilai.indexOf("0") == 0){
nilai = nilai.substring(1, nilai.length);
}
return nilai;
}
 

