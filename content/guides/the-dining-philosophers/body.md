## Locks plus a limit

Number the forks so philosopher `p` sits between forks `p` and `(p + 1) % 5`.

```python
from threading import Lock, Semaphore

class DiningPhilosophers:
    def __init__(self):
        self.forks = [Lock() for _ in range(5)]
        self.room = Semaphore(4)

    def wantsToEat(self, p, pickLeftFork, pickRightFork, eat,
                   putLeftFork, putRightFork):
        left, right = self.forks[p], self.forks[(p + 1) % 5]
        with self.room:
            with left, right:
                pickLeftFork(); pickRightFork()
                eat()
                putLeftFork(); putRightFork()
```

Five philosophers each holding one fork is the only deadlock; four at the table cannot all be stuck. Taking the lower-numbered fork first is another fix.

Do not take both forks without any rule; all five can grab their left fork and wait forever. Do not use one global lock if you care about concurrency; it lets only one philosopher eat at a time (correct but slow).

Time: O(1) per call, plus waiting  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
