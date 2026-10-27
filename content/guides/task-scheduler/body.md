## Count the idle frame

Let `mx` be the highest task count and `k` the number of tasks with that count.

Lay out the most frequent task with gaps: there are `mx − 1` blocks of length `n + 1` (the task plus `n` cooldown slots), then a final block holding the `k` tied tasks. So

`answer = max(len(tasks), (mx − 1) · (n + 1) + k)`.

Other tasks fill the cooldown slots. If they overflow the frame, no idle time is needed at all, and the answer is just the number of tasks.

A max-heap simulation (each round, run up to `n + 1` tasks with the highest counts) gives the same result in O(total · log 26).

Do not forget the `+ k`: with `A A B B` and `n = 2`, the last block holds both A and B (A B _ A B → 5). Do not drop the `max` with `len(tasks)`; with many distinct tasks the formula can be too small.

Time: O(len(tasks))  
Space: O(1) (26 letters)

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
