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
