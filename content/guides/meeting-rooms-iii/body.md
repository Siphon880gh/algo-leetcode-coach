## Two heaps

1. Sort meetings by start. `free` = min-heap of rooms 0 … n − 1; `busy` = min-heap of (end, room).
2. For each `[s, e]`: move every `busy` room with `end ≤ s` into `free`.
3. If `free` is not empty, pop the lowest room and push `(e, room)`; otherwise pop `(t, room)` from `busy` and push `(t + e − s, room)`.
4. Count the room; return the lowest room with the largest count.

Examples → 0, 1. Checked against a minute-by-minute simulation on 400 random cases.

Delayed meetings run in start order, and the room that frees first is the one they wait for. Delays pile up to about 5 · 10^10, so use 64-bit times.

Time: O(m log m + m log n)  
Space: O(n)

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
