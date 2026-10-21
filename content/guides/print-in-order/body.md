## Signal after each step

With two events `e1`, `e2`, both initially unset:

- `first`: `printFirst()`; `e1.set()`.
- `second`: `e1.wait()`; `printSecond()`; `e2.set()`.
- `third`: `e2.wait()`; `printThird()`.

Semaphores starting at 0 work the same way (`release` instead of `set`, `acquire` instead of `wait`), as do latches in Java.

Do not busy-wait on a shared counter without synchronization; it wastes CPU and may not see updates. Do not use one lock for all three; a lock does not encode which step comes next.

Time: O(1)  
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
