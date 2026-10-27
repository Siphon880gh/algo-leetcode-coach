## Corrections without deletions

- `update(t, p)`: `price[t] = p`; `latest = max(latest, t)`; push `(−p, t)` into a max-heap and `(p, t)` into a min-heap.
- `current()`: `price[latest]`.
- `maximum()`: while the max-heap top's price differs from `price[t]`, pop; return the top.
- `minimum()`: same with the min-heap.

Example 1 → `5, 10, 5, 2`.

A corrected record leaves a stale heap entry; it is detected and discarded only when it reaches the top, so each push is popped at most once. A sorted multiset of prices (erase old, insert new) is an equivalent alternative.

Time: O(log n) amortised per operation  
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
