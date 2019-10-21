verrmsg +='<div class="alert alert-success alert-dismissible">';
verrmsg +='<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
verrmsg +='<strong>Success!</strong>  '+response.Message+'';
verrmsg +='</div>';
$("#vaccinationmsg").html(verrmsg);


verrmsg +='<div class="alert alert-warning alert-dismissible">';
verrmsg +='  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
verrmsg +='  <strong>Warning!</strong> '+response.Message+'';
verrmsg +='</div>';
$("#vaccinationmsg").html(verrmsg);


var verrmsg ='';

<label class="control-label">Diagnosis</label>
<input type="text" class="form-control" id="textdiagnosis" placeholder="Enter Diagnosis" required>
onkeypress="javascript:return isNumberKey(event)"
OPD Case Paper Form
Select Date         id="opdselectdate";
Select Visit Type   id="opdvisittype"
Select Symptoms  textsymptoms
Diagnosis   textdiagnosis

instruction+id;
days+id;

nocastrated
noprocedurecas

Artificial Insemination (AI)
aistai
aisooes
aisoror
aissch
aisno

Operation / Surgery
opsust

Delivery
delcadet
delcage
delcbirtdate
delcaidate
delstai
delssch
delstrawno

Infertility
inforo
ints
inpcoi

Pregnacy Diagnosis
pdsaidate
pdtextreport
pdtype
pdprety
pdstai
pdssch
pdstrawno

Procedure
pprocdetail
pdsystem

Treatment
treatment

tyofinoculation
inotype
nofscol
nonvdate
nofscol
selpaymethod
selprecond
animalimgname

/--------------------------
doctorid : 1
animalid:1
visitdate : ‘yyyy-MM-dd’
nextvisitdate : ‘yyyy-MM-dd’
visittype:  “: HQ/Tour/ Camp”
totalsamples : 5
inoculation :’String’     {drop down  user this array =>  [“”, “IM”, “Mouth”, “Skin”]     }
diagnosis : “string”
symptoms :”String”
medicineids :  [“1”,”23”,”25”]     array of ids of medicine
dosages :     [“1-0-1”,” ”, “1-0-0”]  array of dosages  Note : blank string is also applicable.
instructions : [“in morning”, “at night”, “”]    array of instructions
days : [30,40,50]   array of days
fees :  250.56   float
feestype : “cash/upi”
presentcondition : “String”
samplenames:”string”

{
"ArtificialInsemination": {
"AIType": "",
"Status of reproductive organ": "",
"Stage of Oestrus": "",
"Scheme": "",
"StrawNo": ""
},
"Castration": {
"NoOfAnimals": "",
"Procedure": ""
},
"Delivery": {
"AIDate": "",
"AI-TYPE": "",
"CalfBDate": "",
"CalfDetails": "",
"CalfGender": "",
"Scheme": "",
"StrawNo": ""
},
"Infertility": {
"Probable Cause": "",
"Findings of Reproductive Organ": "",
"Treatment Suggested": ""
},
"Other": {
"Treatment": ""
},
"Pregnancy": {
"AIDate": "",
"AI-TYPE": "",
"Pregnancy Tenure": "3",
"Expected Delivery Date": "",
"Pregnant": "No",
"PD Type": "NSPD",
"Scheme": "",
"StrawNo": "",
"Results": "positive"
},
"Surgery": {
"Surgery Name": ""
},
"Treatment": {
"System": "",
"Treatment": ""
}
}
