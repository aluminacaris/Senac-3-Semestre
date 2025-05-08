#include <stdio.h>

void bubbleSort(int array[], int tamanho) {
    for (int i = 0; i < tamanho - 1; i++) {
        // Flag para otimização (se nenhuma troca ocorrer, o array está ordenado)
        int trocou = 0;
        
        for (int j = 0; j < tamanho - i - 1; j++) {
            if (array[j] > array[j + 1]) {
                // Troca os elementos
                int temp = array[j];
                array[j] = array[j + 1];
                array[j + 1] = temp;
                trocou = 1;
            }
        }
        
        // Se não houve trocas, o array já está ordenado
        if (!trocou) break;
    }
}

int main() {
    // int array[] = {3, 1, 4, 2, 5, 9, 13, 37, 20, 15, 6}; // 11 elementos
    int array[] = {3, 1, 4, 2, 5, 9, 13, 37, 20, 15, 6, 120, 99, 123, 69}; // 15 elementos
    int tamanho = sizeof(array) / sizeof(array[0]);
    
    printf("Array antes da ordenação:\n");
    for (int i = 0; i < tamanho; i++) {
        printf("%d ", array[i]);
    }
    
    bubbleSort(array, tamanho);
    
    printf("\nArray após a ordenação:\n");
    for (int i = 0; i < tamanho; i++) {
        printf("%d ", array[i]);
    }
    
    return 0;
}