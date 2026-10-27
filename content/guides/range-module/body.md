## Keep the invariant: disjoint and sorted

Store the endpoints in two parallel sorted lists, or as a flat sorted list `[l0, r0, l1, r1, …]`.

- `addRange(l, r)`: find every interval with `start ≤ r` and `end ≥ l` (touching counts). Replace them with one interval `[min(l, first.start), max(r, last.end))`.
- `removeRange(l, r)`: find every interval overlapping `[l, r)`. Replace them with up to two pieces: `[first.start, l)` if `first.start < l`, and `[r, last.end)` if `last.end > r`.
- `queryRange(l, r)`: binary search for the last interval with `start ≤ l`; return whether its `end ≥ r`.

With binary search, each operation costs O(log n) to locate plus O(k) for the `k` intervals it merges or removes. Each interval is created once and removed once, so the total is amortized.

A segment tree with lazy "set covered / set uncovered" over compressed or dynamic coordinates also works, at more code.

Do not track individual numbers; ranges go up to 10⁹. Do not forget the half-open convention: `[10, 20)` and `[20, 30)` touch, and adding both covers `[10, 30)`.

Time: O(log n + k) per operation  
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
