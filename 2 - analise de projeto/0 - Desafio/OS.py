import os
import shutil

# Pega o caminho da OneDrive
onedrive_path = os.path.join(os.path.expanduser('~'), 'OneDrive')   

# Junta com a pasta "0 - desafi denise"
pasta = os.path.join(onedrive_path, '0 - desafi denise')

# Verifica se a pasta existe
if not os.path.exists(pasta):
    print("A pasta não foi encontrada!")
    
else:
    # Muda para a pasta
    os.chdir(pasta)
    print("Agora o diretório atual é:", os.getcwd()) #retorna o diretorio atual de trabalho 



 # Lista todos os arquivos da pasta
    arquivos = os.listdir(pasta)

    # Dicionário para organizar os tipos
    tipos = {
        'PDF': [],
        'TXT': [],
        'Excel': [],
        'Imagem': [],
        'Vídeo': [],
        'Outros': []
    }

    # Extensões de cada tipo, aqui declara o ext, q vai ser a var q guarga a extensão do arquivo!!!
    ext_pdf = ['.pdf']
    ext_txt = ['.txt']
    ext_excel = ['.xlsx', '.xls', '.csv']
    ext_img = ['.jpg', '.jpeg', '.png', '.gif', '.bmp']
    ext_video = ['.mp4', '.avi', '.mov', '.mkv', '.wmv']

 # Classifica cada arquivo
    for arquivo in arquivos:
        nome, ext = os.path.splitext(arquivo.lower()) #lower deixa tudo minusculo \\ splitext separa o nome da extensão do arquivo, e da o valor pra Ext!!!

        if ext in ext_pdf:
            tipos['PDF'].append(arquivo)
        elif ext in ext_txt:
            tipos['TXT'].append(arquivo)
        elif ext in ext_excel:
            tipos['Excel'].append(arquivo)
        elif ext in ext_img:
            tipos['Imagem'].append(arquivo)
        elif ext in ext_video:
            tipos['Vídeo'].append(arquivo)
        else:
            tipos['Outros'].append(arquivo)

    # Exibe o resultado
    print("\nArquivos encontrados na pasta:")
    for categoria, lista in tipos.items(): #.items é uma função de python q trabalha a chave e valor do dicionario de uma vez, outro ex .keys e .values
        print(f"\n{categoria}:")
        if lista:
            for item in lista:
                print(f"  - {item}")
        else:
            print("  Nenhum arquivo encontrado.")







    # os.mkdir(pasta_pdf)
    # os.mkdir(pasta_txt)
    # os.mkdir(pasta_excel)
    # os.mkdir(pasta_img)
    # os.mkdir(pasta_vid)

