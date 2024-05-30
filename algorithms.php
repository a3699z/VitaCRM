<?php

////////////////////////////////////////////////////////
/////////////////  depth first search ///////////////////////
////////////////////////////////////////////////////////
$graph =
[
    'A' => ['B', 'C'],
    'B' => ['A', 'D', 'E'],
    'C' => ['A', 'F'],
    'D' => ['B'],
    'E' => ['B', 'F'],
    'F' => ['C', 'E'],
];
function dfs($graph, $start, $visited = array()) {
    $visited[] = $start;
    echo $start . ' ';
    foreach ($graph[$start] as $vertex) {
        if (!in_array($vertex, $visited)) {
            dfs($graph, $vertex, $visited);
        }
    }
}
function dfs_iterative ($graph, $start, $visited = []) {
    $stack = [$start];
    $path = [];
    $visited = [];
    while (count($stack) > 0) {
        $node = array_pop($stack);
        if (!in_array($node, $visited)) {
            $visited[] = $node;
            $path[] = $node;
            foreach ($graph[$node] as $neighbour) {
                if (!in_array($neighbour, $visited)) {
                    $stack[] = $neighbour;
                }
            }
        }
    }
    print_r($path);
}


////////////////////////////////////////////////////////
/////////////////  breadth first search ///////////////////////
////////////////////////////////////////////////////////

function bfs($graph, $start) {
    $queue = [$start];
    $visited = [];
    $visited[] = $start;
    while (count($queue) > 0) {
        $node = array_shift($queue);
        echo $node . ' ';
        foreach ($graph[$node] as $neighbour) {
            if (!in_array($neighbour, $visited)) {
                $queue[] = $neighbour;
                $visited[] = $neighbour;
            }
        }
    }
}

// to get the shortest path bet two connections
$graph = [
    'Alice'=> ['Bob', 'Claire'],
    'Bob'=> ['Alice', 'David', 'Eve'],
    'Claire'=> ['Alice', 'Frank'],
    'David'=> ['Bob'],
    'Eve'=> ['Bob', 'Frank'],
    'Frank'=> ['Claire', 'Eve']
];
function bfs_shortest_path($graph, $start, $target, $visited = array()) {
    // get the shortest path between two nodes
    $queue = new SplQueue();
    $queue->enqueue([$start, [$start]]);
    $visited[] = $start;
    while ($queue->count() > 0) {
        [$node, $path] = $queue->dequeue();
        if ($node == $target) {
            return $path;
        }
        foreach ($graph[$node] as $neighbour) {
            if (!in_array($neighbour, $visited)) {
                $visited[] = $neighbour;
                $new_path = $path;
                $new_path[] = $neighbour;
                $queue->enqueue([$neighbour, $new_path]);
            }
        }
    }
}


////////////////////////////////////////////////////////
/////////////////  Dijkstra's algorithm ///////////////////////
////////////////////////////////////////////////////////



function gcd($a, $b) {
    if ($b == 0) {
        return $a;
    }
    return gcd($b, $a % $b);
}


////////////////////////////////////////////////////////
/////////////////  check if linked list has a cycle///////////////////////
////////////////////////////////////////////////////////


// make a linked list
class ListNode {
    public $value;
    public $next;

    public function __construct($value = 0, $next = null) {
        $this->value = $value;
        $this->next = $next;
    }
}
class LinkedList {
    private $head;

    public function __construct() {
        $this->head = null;
    }

    public function insertAtEnd($value) {
        $newNode = new ListNode($value);
        if ($this->head === null) {
            $this->head = $newNode;
        } else {
            $current = $this->head;
            while ($current->next !== null) {
                $current = $current->next;
            }
            $current->next = $newNode;
        }
    }

    public function display() {
        $current = $this->head;
        while ($current !== null) {
            echo $current->value . " -> ";
            $current = $current->next;
        }
        echo "null\n";
    }

    public function createCycle($pos) {
        if ($pos < 0) {
            return;
        }

        $cycleStart = null;
        $current = $this->head;
        $count = 0;

        while ($current !== null && $current->next !== null) {
            if ($count === $pos) {
                $cycleStart = $current;
            }
            $current = $current->next;
            $count++;
        }

        if ($current !== null && $cycleStart !== null) {
            $current->next = $cycleStart;
        }
    }
    public function hasCycle() {
        if ($this->head === null || $this->head->next === null) {
            return false;
        }

        $slow = $this->head;
        $fast = $this->head;

        while ($fast !== null && $fast->next !== null) {
            $slow = $slow->next;
            $fast = $fast->next->next;

            if ($slow === $fast) {
                return true;
            }
        }
        return false;
    }
}
$linkedList = new LinkedList();
$linkedList->insertAtEnd(1);
$linkedList->insertAtEnd(2);
$linkedList->insertAtEnd(3);
$linkedList->insertAtEnd(4);
$linkedList->display();
$linkedList->createCycle(1);
echo $linkedList->hasCycle();


////////////////////////////////////////////////////////
/////////////////  check if linked list has a cycle///////////////////////
////////////////////////////////////////////////////////
