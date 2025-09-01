#include <stdio.h>
#include <stdlib.h>
#include <time.h>
#include <stdbool.h>

// Verifica se o array está ordenado
bool isSorted(int arr[], int n) {
    for (int i = 0; i < n - 1; i++) {
        if (arr[i] > arr[i + 1]) {
            return false;
        }
    }
    return true;
}

// Embaralha o array aleatoriamente
void shuffle(int arr[], int n) {
    for (int i = 0; i < n; i++) {
        int j = rand() % n;
        int temp = arr[i];
        arr[i] = arr[j];
        arr[j] = temp;
    }
}

// Implementação do Bogo Sort
void bogoSort(int arr[], int n) {
    srand(time(NULL)); // Inicializa a semente aleatória
    
    int attempts = 0;
    while (!isSorted(arr, n)) {
        shuffle(arr, n);
        attempts++;
        
        // Opcional: Mostrar progresso a cada 1 milhão de tentativas
        if (attempts % 1000000 == 0) {
            printf("Tentativa %d milhões...\n", attempts / 1000000);
        }
    }
    
    printf("Ordenado apos %d tentativas!\n", attempts);
}

int main() {
    // int arr[] = {3, 1, 4}; // 7 elementos
    // int arr[] = {3, 1, 4, 2, 5, 9, 13}; // 7 elementos
    // int arr[] = {3, 1, 4, 2, 5, 9, 13, 37, 20, 15, 6}; // 11 elementos
    int arr[] = {3, 1, 4, 2, 5, 9, 13, 37, 20, 15, 6, 120, 99, 123, 69}; // 15 elementos
    
    int n = sizeof(arr) / sizeof(arr[0]);
    
    printf("Array antes da ordenacao:\n");
    for (int i = 0; i < n; i++) {
        printf("%d ", arr[i]);
    }
    printf("\n");
    
    bogoSort(arr, n);
    
    printf("Array apos a ordenacao:\n");
    for (int i = 0; i < n; i++) {
        printf("%d ", arr[i]);
    }
    printf("\n");
    
    return 0;
}