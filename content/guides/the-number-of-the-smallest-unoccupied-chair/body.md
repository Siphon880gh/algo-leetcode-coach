## Release, then seat

1. Sort friends by arrival.
2. `busy` = heap of `(leave, chair)`; `free` = heap of chairs; `next = 0`.
3. For each arrival `a`: pop `busy` while `leave ≤ a`, pushing chairs to `free`. Seat on `free.pop()` or `next++`. Stop at the target friend.

`[[1,4],[2,3],[4,6]], 1` → 1. `[[3,10],[1,5],[2,6]], 0` → 2.

Use `≤`: a chair freed at the arrival moment is available. Without the free heap, scanning for the smallest chair costs O(n) per arrival.

Time: O(n log n)  
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
