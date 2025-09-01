import numpy as np

class OctreeNode:
    def __init__(self, center, size, depth=0, max_depth=5, max_elements=8):
        """
        Inicializa um nó da Octree.
        
        Args:
            center (tuple): Centro do nó (x, y, z)
            size (float): Tamanho do nó (largura/altura/profundidade)
            depth (int): Profundidade atual do nó
            max_depth (int): Profundidade máxima permitida
            max_elements (int): Número máximo de elementos antes de subdividir
        """
        self.center = np.array(center)
        self.size = size
        self.depth = depth
        self.max_depth = max_depth
        self.max_elements = max_elements
        self.elements = []
        self.children = []
        self.is_divided = False
    
    def subdivide(self):
        """Subdivide o nó em 8 filhos."""
        if self.is_divided or self.depth >= self.max_depth:
            return
        
        child_size = self.size / 2
        offset = child_size / 2
        
        # Cria os 8 octantes
        for x in [-1, 1]:
            for y in [-1, 1]:
                for z in [-1, 1]:
                    child_center = self.center + np.array([x, y, z]) * offset
                    self.children.append(
                        OctreeNode(
                            child_center, 
                            child_size, 
                            self.depth + 1, 
                            self.max_depth, 
                            self.max_elements
                        )
                    )
        
        self.is_divided = True
        
        # Redistribui os elementos para os filhos
        for element in self.elements:
            for child in self.children:
                if child.contains(element['point']):
                    child.insert(element['point'], element['data'])
                    break
        
        self.elements = []
    
    def contains(self, point):
        """Verifica se um ponto está dentro deste nó."""
        point = np.array(point)
        return np.all(np.abs(point - self.center) <= self.size/2)
    
    def find_child(self, point):
        """Encontra o filho que contém o ponto especificado."""
        for child in self.children:
            if child.contains(point):
                return child
        return None
    
    def insert(self, point, data):
        """Insere um ponto com dados associados na Octree."""
        point = np.array(point)
        
        if not self.contains(point):
            return False
        
        if not self.is_divided and (len(self.elements) < self.max_elements or self.depth == self.max_depth):
            self.elements.append({'point': point, 'data': data})
            return True
        
        if not self.is_divided:
            self.subdivide()
        
        child = self.find_child(point)
        if child:
            return child.insert(point, data)
        
        return False
    
    def query_range(self, center, size):
        """Consulta todos os elementos dentro de um range especificado."""
        results = []
        if not self.intersects(center, size):
            return results
        
        if self.is_divided:
            for child in self.children:
                results.extend(child.query_range(center, size))
        else:
            for element in self.elements:
                point = element['point']
                if np.all(np.abs(point - center) <= size/2):
                    results.append(element)
        
        return results
    
    def intersects(self, center, size):
        """Verifica se este nó intersecta com um range especificado."""
        center = np.array(center)
        return np.all(np.abs(self.center - center) <= (self.size + size)/2)
    
    def __str__(self):
        """Representação em string do nó."""
        indent = '  ' * self.depth
        s = f"{indent}Node(depth={self.depth}, center={self.center}, size={self.size}, elements={len(self.elements)}"
        if self.is_divided:
            for child in self.children:
                s += '\n' + str(child)
        return s


class Octree:
    def __init__(self, center, size, max_depth=5, max_elements=8):
        """
        Inicializa a Octree.
        
        Args:
            center (tuple): Centro da Octree (x, y, z)
            size (float): Tamanho inicial da Octree
            max_depth (int): Profundidade máxima
            max_elements (int): Número máximo de elementos por nó antes de subdividir
        """
        self.root = OctreeNode(center, size, max_depth=max_depth, max_elements=max_elements)
    
    def insert(self, point, data=None):
        """Insere um ponto na Octree."""
        return self.root.insert(point, data)
    
    def query_range(self, center, size):
        """Consulta pontos dentro de um range especificado."""
        return self.root.query_range(center, size)
    
    def __str__(self):
        """Representação em string da Octree."""
        return str(self.root)


# Exemplo de uso
if __name__ == "__main__":
    # Cria uma Octree centrada na origem com tamanho 20
    octree = Octree(center=(0, 0, 0), size=20, max_depth=4)
    
    # Insere alguns pontos aleatórios
    np.random.seed(42)
    for i in range(100):
        point = np.random.uniform(-10, 10, size=3)
        octree.insert(point, f"objeto_{i}")
    
    # Consulta pontos em um range
    print("Pontos no range [-5,-5,-5] a [5,5,5]:")
    results = octree.query_range(center=(0, 0, 0), size=10)
    print(f"Encontrados {len(results)} pontos")
    
    # Imprime a estrutura da Octree (para debug)
    # print(octree)