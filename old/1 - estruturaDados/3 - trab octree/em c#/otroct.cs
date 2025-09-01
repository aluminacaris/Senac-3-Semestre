public class OctreeDemo : MonoBehaviour
{
    public int MaxPoints = 100; // numero de pontos a gerar 
    public float WorldSize = 10f; // tamanho do mundo 3D
    private OctreeNode octree; // Raiz da Octree 
    private List<Vector3> points = new List<Vector3>(); // Pontos gerados 

    void Start()
    {
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
            octree.DrawGizmos();
            Gizmos.color = Color.red;
            foreach (var point in points)
            {
                Gizmos.DrawSphere(point, 0.1f);
            }
        }
    }
}