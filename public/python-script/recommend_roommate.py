from sklearn.preprocessing import LabelEncoder
from sklearn.preprocessing import OneHotEncoder
import pandas as pd
import numpy as np
import sys
import ssl

ssl._create_default_https_context = ssl._create_unverified_context

def oneHotEncode(data):
    data_np = data.to_numpy()
    data_np = np.transpose(data_np)

    label_encoder = LabelEncoder()
    onehot_encoder = OneHotEncoder(sparse=False)

    onehot_encoded = []

    cols = data.columns.to_numpy()
    
    for i in range(len(cols) - 1):
        if cols[i] == "Apakah agama anda harus sama dengan teman sekamar anda?":
            continue

        integer_encoded = label_encoder.fit_transform(data_np[i])
        integer_encoded = integer_encoded.reshape(len(integer_encoded), 1)
        temp = onehot_encoder.fit_transform(integer_encoded)

        # normalize data
        if "Bisa keduany" in data_np[i]:
            for j in range(len(data_np[i])):
                if data_np[i][i] == "Bisa keduanya":
                    temp[i] = np.zeros(len(temp[0]))

        if cols[i] == "Agama":
            for j in range(len(data_np[i])):
                if data_np[i + 1][j] == "Tidak":
                    temp[j] = np.zeros(len(temp[0]))
        
        onehot_encoded.append(temp)

    onehot_encoded = list(zip(onehot_encoded[0], onehot_encoded[1], onehot_encoded[2], onehot_encoded[3], onehot_encoded[4], onehot_encoded[5], onehot_encoded[6], onehot_encoded[7], onehot_encoded[8], onehot_encoded[9], onehot_encoded[10], onehot_encoded[11], onehot_encoded[12], onehot_encoded[13]))

    temp = []

    for row in onehot_encoded:
        temp_row = np.array([])

        for col in row:
            temp_row = np.append(temp_row, col)

        temp_row = temp_row.tolist()
        temp.append(temp_row)

    onehot_encoded = temp

    return onehot_encoded

def manhattanDist(row1, row2):
    row1 = np.array(row1)
    row2 = np.array(row2)

    return sum(abs(row1 - row2))

def euclideanDist(row1, row2):
    row1 = np.array(row1)
    row2 = np.array(row2)

    return np.sqrt(sum((row1 - row2) ** 2))
    
sheet_id = '1IAtuBOJOIaz4lKITdoKYM6jmNUM8iOzAVq_EnIcyBIg'
datas = pd.read_csv(f"https://docs.google.com/spreadsheets/d/{sheet_id}/export?format=csv")
# datas = pd.read_csv("data_digitalent.csv")

# hilangin kolom timestamp, nama, kelas, gender
datas.drop(["Timestamp"], axis=1, inplace=True)

def recommendEuclid(name, n=5):
    names = datas["Nama"].values.tolist()
    try:
        idx = names.index(name)
    except:
        return None

    # filter data
    datas_filtered = datas.loc[datas['Gender'] == datas['Gender'][idx]]
    datas_filtered = datas_filtered.loc[datas_filtered['Kelas'] == datas_filtered['Kelas'][idx]]

    new_names = datas_filtered["Nama"].values.tolist()
    new_idx = new_names.index(name)

    datas_filtered.drop(["Nama", "Kelas", "Gender"], axis=1, inplace=True)
    datas_filtered = oneHotEncode(datas_filtered)

    euclid = []

    for data in datas_filtered:
        euclid.append(euclideanDist(datas_filtered[new_idx], data))

    euclid = list(zip(euclid, new_names))
    euclid.pop(new_idx)

    euclid.sort()
    return euclid[0:n-1]

hasil_recommend = recommendEuclid(sys.argv[1], n=8)

if hasil_recommend:
    nama_recommend = ""

    for hasil in hasil_recommend:
        nama_recommend = nama_recommend + hasil[1] + ","

    print(nama_recommend)
else:
    print("Name non found!")