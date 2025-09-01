from bubblesort import bubble_sort

numeros = [64, 34, 25, 12, 22, 11, 90]
print("Lista original:", numeros)

numeros_ordenados = bubble_sort(numeros.copy()) #função cria uma copia exata dos numeros e colocaem lista na function, deixando a lista original sem alterações 
print("Lista ordenada:", numeros_ordenados)