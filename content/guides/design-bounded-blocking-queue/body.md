Implement a thread-safe bounded queue with a given capacity: `enqueue(x)` adds an element, blocking while the queue is full; `dequeue()` removes the oldest element, blocking while the queue is empty; and `size()` returns the current number of elements. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Condition variables

```python
from collections import deque
from threading import Condition, Lock

class BoundedBlockingQueue:
    def __init__(self, capacity):
        self.cap, self.q = capacity, deque()
        lock = Lock()
        self.not_full, self.not_empty = Condition(lock), Condition(lock)

    def enqueue(self, x):
        with self.not_full:
            while len(self.q) == self.cap:
                self.not_full.wait()
            self.q.appendleft(x)
            self.not_empty.notify()

    def dequeue(self):
        with self.not_empty:
            while not self.q:
                self.not_empty.wait()
            x = self.q.pop()
            self.not_full.notify()
            return x

    def size(self):
        with self.not_full:
            return len(self.q)
```

Both conditions share one lock, so every check and change happens under it.

Do not wait with `if`; a woken thread must re-check because of spurious wakeups and competing threads. Do not busy-wait in a loop; it wastes CPU.

Time: O(1) per operation, plus waiting  
Space: O(capacity)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
