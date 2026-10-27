## Turn-taking on a shared counter

```python
from threading import Condition

class FizzBuzz:
    def __init__(self, n):
        self.n, self.i, self.cv = n, 1, Condition()

    def _run(self, test, act):
        while True:
            with self.cv:
                self.cv.wait_for(lambda: self.i > self.n or test(self.i))
                if self.i > self.n:
                    return
                act(self.i)
                self.i += 1
                self.cv.notify_all()

    def fizz(self, printFizz):
        self._run(lambda i: i % 3 == 0 and i % 5 != 0, lambda i: printFizz())
    def buzz(self, printBuzz):
        self._run(lambda i: i % 5 == 0 and i % 3 != 0, lambda i: printBuzz())
    def fizzbuzz(self, printFizzBuzz):
        self._run(lambda i: i % 15 == 0, lambda i: printFizzBuzz())
    def number(self, printNumber):
        self._run(lambda i: i % 3 != 0 and i % 5 != 0, printNumber)
```

The four tests are disjoint and cover every `i`, so exactly one thread can move at each step.

Do not use `notify` (one thread); the woken thread may not own the next number, and the program hangs. Do not forget the `i > n` exit check; otherwise threads wait forever after the last token.

Time: O(n) tokens  
Space: O(1)

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
