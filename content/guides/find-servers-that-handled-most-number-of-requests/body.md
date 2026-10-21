## Two structures

1. Pop every busy `(end, s)` with `end ≤ arrival[i]` back into `free`.
2. If `free` is empty, drop the request.
3. Else take the first `s ≥ i % k` in `free`, or the smallest if none; count it; push `(arrival[i] + load[i], s)`.
4. Return servers with the max count.

`k = 3`: `[1,2,3,4,5]`/`[5,2,3,3,3]` → `[1]`. `[1,2,3,4]`/`[1,2,1,2]` → `[0]`. `[1,2,3]`/`[10,12,11]` → `[0,1,2]`.

A server finishing exactly at an arrival is free for it. Do not scan k servers per request; use a sorted set (or a second heap with shifted indices).

Time: O(n log k)  
Space: O(k)

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
