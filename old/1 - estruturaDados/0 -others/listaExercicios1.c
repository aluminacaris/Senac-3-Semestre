#include <stdio.h>

// 1. Manipulação de Arrays
//  (a) Escreva um programa em C que leia 10 números inteiros e armazene-os em um array. Depois, exiba os números digitados na ordem em que foram inseridos.
//  (b) Modifique o programa para exibir os números na ordem inversa.

void exercicio1()
{                    // procedimento sem retorno - void
    int numeros[10]; //[] define o valor maximo de elementos que o array pode carregar
    int i;

    printf("Digite 10 numeros inteiros:\n"); // mostra no terminal
    for (i = 0; i < 10; i++)                 // loop - i vale 0, enquanto i for menor que 10, some +1 em i
    {
        printf("Numero %d: ", i + 1); // printa qual numero esta sendo colocado (tipo um enumerate em pyto)
        scanf("%d", &numeros[i]);     // input pra colocar os valores dentro da var numeros, que é a var i
    }

    printf("\nNumeros digitados:\n");
    for (i = 0; i < 10; i++)
    {
        printf("%d ", numeros[i]); // vai mostrar os numeros digitados pelo usuario, mostrando os itens q foram inseridos em numeros[i]
    }
    printf("\n");

    printf("\nNumeros digitados na ordem inversa:\n");
    for (i = 9; i >= 0; i--) // i vale 9, enquanto i for maior ou igual a 0, diminua -1 em i
    {
        printf("%d ", numeros[i]); // vai mostrar os numeros digitados pelo usuario invertido, pois o valor de i vai começar no ultimo item do array
    }
    printf("\n");
}

// ==============================================================================================================================

// 2. Cálculo com Arrays
//   (a) Crie um programa que leia um array de 5 números inteiros e calcule a soma de todos os elementos.
//   (b) Modifique o programa para calcular a média dos valores armazenados.

void exercicio2()
{
    int numeros[5]; // maximo de itens no array é 5
    int soma = 0;   // soma vale 0
    int i;
    float media;

    printf("Digite 5 numeros inteiros:\n");
    for (i = 0; i < 5; i++) // loop for é sempre a mesma sintaxe
    {
        printf("Numero %d: ", i + 1); // enumerate do pyto basicamente
        scanf("%d", &numeros[i]);     // input pra user dar os valores de numeros
        soma += numeros[i];           // Equivalente a soma = soma + numeros[i], traduzindo, soma é uma variavel que ganha o valor de soma + numero[i], ou seja ele soma os valores dentro de numeros!!!
    }

    media = (float)soma / 5;
    printf("\nA soma dos numeros eh: %d\n", soma); // mostra o result de soma

    printf("\nA media dos numeros eh: %f", media);
}

// ==============================================================================================================================

// 3. Busca em Arrays
//   (a) Escreva um programa que leia um array de 10 números inteiros e um número adicional. O programa deve verificar se esse número está no array e exibir sua posição.
//   (b) Se o número não estiver no array, exiba uma mensagem informando que ele não foi encontrado.

void exercicio3()
{
    int numeros[3];
    int num2;
    int i;

    for (i = 0; i < 3; i++)
    {
        printf("informe o indicie: %d \n", i);
        scanf("%d", &numeros[i]);
    }

    printf("informe o quarto numero: \n");
    scanf("%d", &num2);

    for (i = 0; i < 3; i++)
    {
        if (numeros[i] == num2)
        {
            printf("\nnumero encontrado!!!\n");
            printf("indice: %d", i);
        }
    }
    if (numeros[i] != num2)
    {
        printf("\nnumero nao encontrado...\n");
    }
}

// ==============================================================================================================================

// 4. Encontrando o Maior e o Menor Número
//   (a) Faça um programa que leia um array de 8 números inteiros e determine o maior e o menor número do array.
//   (b) Exiba também as posições em que esses números aparecem no array.

void exercicio4() 
{
    int numeros[8];                   // maxvalue de array é 7 itens
    int i, maior, menor;              // declara tudo ccomo int
    int pos_maior[8], pos_menor[8];   // Arrays para armazenar posições
    int qtd_maior = 0, qtd_menor = 0; // Contadores de ocorrências

    printf("Digite 8 numeros inteiros:\n");

    // Leitura dos números
    for (i = 0; i < 8; i++) // estr basica de for
    {
        printf("Numero %d: ", i);
        scanf("%d", &numeros[i]);
    }

    maior = menor = numeros[0];      // inicializa todos como o primeiro item do array
    pos_maior[0] = pos_menor[0] = 0; // registra a primeira posição do array como primeira ocorrencia de ambos
    qtd_maior = qtd_menor = 1;       // inicializa todos como 1, pois ja tem uma ocorrencia de cada

    // Encontra maior e menor
    for (i = 1; i < 8; i++)
    {
        if (numeros[i] > maior)
        {
            maior = numeros[i]; // aqui ele vai definir o valor de maior como o indice, sempre q tiver um valor maior ele vai substituir o valor de maior, até acabar o array.
            pos_maior[0] = i;   // reinicia o array, armazenando a prox posição
            qtd_maior = 1;      // esse reseta o contador pra 1
        }
        else if (numeros[i] == maior)
        {
            pos_maior[qtd_maior] = i; // se achar um numero igual a maior, vai add a posição no array de pos_maior
            qtd_maior++;              // aumenta no contador
        }

        if (numeros[i] < menor)
        {
            menor = numeros[i]; // literalmente a mesma coisa mas ao contrario!!!
            pos_menor[0] = i;   // armazena posição
            qtd_menor = 1;
        }
        else if (numeros[i] == menor)
        {
            pos_menor[qtd_menor] = i; // add a pos no array
            qtd_menor++;              // aumenta no cont
        }
    }

    // Exibe resultados
    printf("\nMaior numero: %d\n", maior);
    printf("Posicoes: ");
    for (i = 0; i < qtd_maior; i++)
    {
        printf("%d ", pos_maior[i]);
    }

    printf("\nMenor numero: %d\n", menor);
    printf("Posicoes: ");
    for (i = 0; i < qtd_menor; i++)
    {
        printf("%d ", pos_menor[i]);
    }
    printf("\n");
}

// ==============================================================================================================================

// 5. Contagem de Elementos
//   (a) Crie um programa que leia um array de 10 números inteiros e conte quantos números são pares e quantos são ímpares.
//   (b) Exiba a quantidade de números pares e ímpares encontrados.

void exercicio5()
{
    int numeros[10];
    int pares = 0;
    int impares = 0;
    int i;

    printf("digite 10 numeros inteiros\n");

    for (i = 0; i < 10; i++)
    {
        printf("numero %d\n", i + 1);
        scanf("%d", &numeros[i]);

        if (numeros[i] % 2 == 0)
        {
            pares++;
        }
        else
        {
            impares++;
        }
    }
    printf("\no total de numeros pares eh: %d\n", pares);
    printf("o total de numeros impares eh: %d\n", impares);
}

// ==============================================================================================================================

// 6. Ordenação de Arrays
//   (a) Escreva um programa que leia 5 números inteiros e os exiba em ordem crescente.
//   (b) Modifique o programa para que o usuário possa escolher entre ordem crescente ou decrescente antes de ordenar os números.

void exercicio6()
{
    int numeros[5];
    int de_cresc;
    int i, j, temp;

    printf("insira 5 numeros inteiros\n");

    for (i = 0; i < 5; i++)
    {
        printf("numero %d:", i + 1);
        scanf("%d", &numeros[i]);
    }

    // Ordenação (usando Bubble Sort simples)
    for (i = 0; i < 5; i++)
    {
        for (j = i + 1; j < 5; j++)
        {
            if (numeros[i] > numeros[j])
            {
                // Troca os números se estiverem na ordem errada
                temp = numeros[i];
                numeros[i] = numeros[j];
                numeros[j] = temp;
            }
        }
    }

    printf("gostaria de ver a ordem crescente ou descrescente?\n");
    printf("digite 1 para crescente, 2 para descrescente e 3 para sair\n");

    scanf("%d", &de_cresc);

    if (de_cresc == 1)
    {
        printf("ordem crescente\n");
        for (i = 0; i < 5; i++)
        {
            printf("numero %d: %d \n", i + 1, numeros[i]);
        }
    }

    else if (de_cresc == 2)
    {
        printf("ordem decrescente\n");
        for (i = 4; i >= 0; i--)
        {
            printf("numero %d: %d \n", i + 1, numeros[i]);
        }
    }
}

// ==============================================================================================================================

// 7. Soma de Dois Arrays
//   (a) Escreva um programa que leia dois arrays de 5 números inteiros cada e crie um terceiro array contendo a soma dos elementos correspondentes dos dois primeiros.
//   (b) Exiba os três arrays ao final da execução.

void exercicio7()
{
    int numeros[5];
    int num2[5];
    int num_soma[5];
    int i;

    printf("insira os primeiros 5 numeros inteiros\n");

    for (i = 0; i < 5; i++)
    {
        printf("numero %d\n", i);
        scanf("%d", &numeros[i]);
    }

    printf("insira os ultimos 5 numeros inteiros\n");

    for (i = 0; i < 5; i++)
    {
        printf("numero %d\n", i);
        scanf("%d", &num2[i]);
    }

    for (i = 0; i < 5; i++) // esse faz a soma
    {
        num_soma[i] = numeros[i] + num2[i];
    }

    printf("\nPrimeiro array: "); // printa os itens do array um por um, vale pra todos d baixo
    for (i = 0; i < 5; i++)
    {
        printf("%d ", numeros[i]);
    }

    printf("\nSegundo array: ");
    for (i = 0; i < 5; i++)
    {
        printf("%d ", num2[i]);
    }

    printf("\nArray soma: ");
    for (i = 0; i < 5; i++)
    {
        printf("%d ", num_soma[i]);
    }
}

// ==============================================================================================================================

// 8. Multiplicação de Elementos por um Escalar
//   (a) Faça um programa que leia um array de 6 números inteiros e um número adicional. Multiplique cada elemento do array por esse número e exiba o resultado

void exercicio8()
{
    int numeros[6];
    int num2;
    int times[6];
    int i;
    // int multi;

    printf("insira seis numeros inteiros\n");
    for (i = 0; i < 6; i++)
    {
        printf("numero: %d\n", i + 1);
        scanf("%d", &numeros[i]);
    }

    printf("digite o numero a mais\n");
    scanf("%d", &num2);

    for (i = 0; i < 6; i++)
    {
        times[i] = numeros[i] * num2;
    }

    printf("resultado final\n");
    for (i = 0; i < 6; i++)
    {
        printf("%d ", times[i]);
    }
}

// ==============================================================================================================================

// 9. Soma de Duas Matrizes
//   (a) Faça um programa que leia duas matrizes 3x3 e crie uma terceira matriz que seja a soma das duas primeiras.

void exercicio9()
{
    int matriz1[3][3], matriz2[3][3], matrizSoma[3][3];
    int i, j;

    // Leitura da primeira matriz
    printf("Digite os elementos da primeira matriz 3x3:\n");
    for (i = 0; i < 3; i++) {
        for (j = 0; j < 3; j++) {
            printf("Elemento [%d][%d]: ", i, j);
            scanf("%d", &matriz1[i][j]);
        }
    }

    // Leitura da segunda matriz
    printf("\nDigite os elementos da segunda matriz 3x3:\n");
    for (i = 0; i < 3; i++) {
        for (j = 0; j < 3; j++) {
            printf("Elemento [%d][%d]: ", i, j);
            scanf("%d", &matriz2[i][j]);
        }
    }

    // Soma das duas matrizes
    for (i = 0; i < 3; i++) {
        for (j = 0; j < 3; j++) {
            matrizSoma[i][j] = matriz1[i][j] + matriz2[i][j];
        }
    }

    // Exibindo a matriz soma
    printf("\nMatriz resultante da soma:\n");
    for (i = 0; i < 3; i++) {
        for (j = 0; j < 3; j++) {
            printf("%d\t", matrizSoma[i][j]);
        }
        printf("\n");
    }}

// ==============================================================================================================================

// 10. Matriz Transposta
// (a) Escreva um programa que leia uma matriz 3x2 e exiba sua transposta (uma matriz 2x3 onde as linhas viram colunas e vice-versa).

void exercicio10()
{
    int matriz[3][2];
    int transposta[2][3];
    int i, j;

    // Leitura da matriz 3x2
    printf("Digite os elementos da matriz 3x2:\n");
    for (i = 0; i < 3; i++) {
        for (j = 0; j < 2; j++) {
            printf("Elemento [%d][%d]: ", i, j);
            scanf("%d", &matriz[i][j]);
        }
    }

    // Calculando a transposta
    for (i = 0; i < 3; i++) {
        for (j = 0; j < 2; j++) {
            transposta[j][i] = matriz[i][j];
        }
    }

    // Exibindo a matriz transposta (2x3)
    printf("\nMatriz transposta (2x3):\n");
    for (i = 0; i < 2; i++) {
        for (j = 0; j < 3; j++) {
            printf("%d\t", transposta[i][j]);
        }
        printf("\n");
    }
}

// ==============================================================================================================================

// MENU

int main()
{
    int opcao;
    do
    {
        printf("\nBem-vindo a lista de exercicios 1!\n");
        printf("Informe a opcao desejada:\n");
        printf("1: exercicio 1\n");
        printf("2: exercicio 2\n");
        printf("3: exercicio 3\n");
        printf("4: exercicio 4\n");
        printf("5: exercicio 5\n");
        printf("6: exercicio 6\n");
        printf("7: exercicio 7\n");
        printf("8: exercicio 8\n");
        printf("9: exercicio 9\n");
        printf("10: exercicio 10\n");
        printf("0: sair\n");
        scanf("%d", &opcao);

        switch (opcao)
        {
        case 0:
            printf("Saindo...\n");
            break;
        case 1:
            exercicio1();
            break;
        case 2:
            exercicio2();
            break;
        case 3:
            exercicio3();
            break;
        case 4:
            exercicio4();
            break;
        case 5:
            exercicio5();
            break;
        case 6:
            exercicio6();
            break;
        case 7:
            exercicio7();
            break;
        case 8:
            exercicio8();
            break;
        case 9:
            exercicio9();
            break;
        case 10:
            exercicio10();
            break;

        default:
            printf("Opcao invalida! Tente novamente.\n");
            break;
        }
    } while (opcao != 0); // Continua o loop enquanto a opção for diferente de 0

    return 0;
}