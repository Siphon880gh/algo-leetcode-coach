## Event-driven assignment

1. `time = max(time, j)`; if no free server, `time = busy.top.time`.
2. Move every busy server with free time ≤ `time` to the free heap.
3. Pop the free top, record its index, push `(time + tasks[j], weight, index)` to busy.

Example 1 → `[2,2,0,2,1,2]`. Example 2 → `[1,4,1,4,1,3,2]`.

Do not tick one second at a time; jumping the clock keeps it O((n + m) log n). Tasks are assigned in order, so a single loop over j handles the queue.

Time: O((n + m) log n)  
Space: O(n)

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
