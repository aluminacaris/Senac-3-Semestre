using UnityEngine;
using System.Collections.Generic;

public class OctreeNode
{
    // Limite de objetos antes de subdividir
    public int Capacity = 4; // se atingir o limite, se subdivide 
    // Profundidade máxima da árvore
    public int MaxDepth = 5; // limite pra evitar subdivisão infinita 

    // Bounding Box (limites do nó)
    public Bounds Bounds { get; private set; } // delimita 3d (X; Y; Z;) || (0,0,0) a (10,10,10)
    // Objetos armazenados neste nó (se for uma folha)
    public List<Vector3> Objects { get; private set; } // os pontos armazenados nesse nó 
    // Filhos (8 subdivisões)
    public OctreeNode[] Children { get; private set; } // subdivs
    // Profundidade atual
    public int Depth { get; private set; } //profundidade atual  

    public OctreeNode(Bounds bounds, int depth) // CONSTRUTOR 
    {
        Bounds = bounds; // espaço 3d q ele cobre 
        Depth = depth; // o nivel de profundidade, sendo 0 a raiz 
        Objects = new List<Vector3>(); // lista vazia pra armazenar pontos  
        Children = null; // começa null pq ainda nao foi subdividido, ou seja nao tem filho
    }

    // Insere um ponto na Octree, aqui q começa a feder 
    public bool Insert(Vector3 point)
    {
        // Se o ponto não estiver dentro deste nó, ignore
        // traduzindo: verifica se o ponto está dentro dos limites do nó 
        if (!Bounds.Contains(point))
            return false;

        // Se há espaço ou ainda não atingiu a capacidade máxima, adicione ao nó atual
        // traduzindo: self-explanatory actually 
        if (Objects.Count < Capacity || Depth >= MaxDepth)
        {
            Objects.Add(point);
            return true;
        }

        // Se não tem filhos ainda, subdivida
        // traduzindo: self-explanatory actually 
        if (Children == null)
            Subdivide(); // chama pra criar 8 filhos 

        // Tente inserir em um dos filhos
        // traduzindo: tenta inserir usando recursão 
        foreach (var child in Children)
        {
            if (child.Insert(point))
                return true;
        }

        return false;
    }

    // Subdivide o nó em 8 filhos
    private void Subdivide()
    {
        Children = new OctreeNode[8];
        Vector3 size = Bounds.size / 2;
        Vector3 center = Bounds.center;

        // cria 8 filhos, cobrindo todos os octantes 
        for (int i = 0; i < 8; i++)
        {
            Vector3 newCenter = center; // calcula o centro e tamanho de cada filho, usando operações bit-a-bit pra determinar a posição de cada octante, b-a-b = algebra booleana, usando And Or Xor e etc, aqueles calculo legal la
            newCenter.x += (i & 1) == 0 ? -size.x / 2 : size.x / 2;
            newCenter.y += (i & 2) == 0 ? -size.y / 2 : size.y / 2;
            newCenter.z += (i & 4) == 0 ? -size.z / 2 : size.z / 2;

            Bounds childBounds = new Bounds(newCenter, size);
            Children[i] = new OctreeNode(childBounds, Depth + 1);
        }

        // Redistribui os objetos antigos para os filhos, cada obj
        foreach (var obj in Objects)
        {
            foreach (var child in Children)
            {
                if (child.Insert(obj))
                    break;
            }
        }
        Objects.Clear(); // limpa os objetos do nó atual 
    }

    // Desenha os limites da Octree (para debug no Unity)
    // cria a visualização pra unity 
    public void DrawGizmos() 
    {
        Gizmos.color = Color.green;
        Gizmos.DrawWireCube(Bounds.center, Bounds.size);

        if (Children != null)
        {
            foreach (var child in Children)
            {
                child.DrawGizmos();
            }
        }
    }
}

// Demo pratica na unity 
public class OctreeDemo : MonoBehaviour
{
    public int MaxPoints = 100; // numero de pontos a gerar 
    public float WorldSize = 10f; // tamanho do mundo 3D
    private OctreeNode octree; // Raiz da Octree 
    private List<Vector3> points = new List<Vector3>(); // Pontos gerados 

    void Start()
    {
        // inicia a octree com um bounding box cobrindo o mundo (caixa delimitadora, traduzindo), em worldSize 
        Bounds worldBounds = new Bounds(Vector3.zero, Vector3.one * WorldSize);
        octree = new OctreeNode(worldBounds, 0);

        // Gera pontos aleatórios e insere na Octree
        for (int i = 0; i < MaxPoints; i++)
        {
            Vector3 randomPoint = new Vector3(
                Random.Range(-WorldSize / 2, WorldSize / 2),
                Random.Range(-WorldSize / 2, WorldSize / 2),
                Random.Range(-WorldSize / 2, WorldSize / 2)
            );
            points.Add(randomPoint);
            octree.Insert(randomPoint);
        }
    }

    void OnDrawGizmos()
    {
        if (octree != null)
        {
            octree.DrawGizmos(); // desenha a octree 
            Gizmos.color = Color.red;
            foreach (var point in points)
            {
                Gizmos.DrawSphere(point, 0.1f); // desenha os pontos
            }
        }
    }
}