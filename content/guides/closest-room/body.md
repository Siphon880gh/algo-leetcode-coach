## Grow the eligible set

1. Rooms by size descending; query indices by `minSize` descending.
2. For each query: insert rooms with `size ≥ minSize` into a sorted id list.
3. Bisect `preferred`; check the ids just below and at the insertion point; prefer the closer, then the smaller.
4. Empty list → −1. Write answers back by original index.

Example 1 → `[3,-1,3]`. Example 2 → `[2,1,3]`.

Processing large requirements first means rooms are only ever added. Use a balanced structure (e.g. `SortedList`) for O(log n) inserts.

Time: O((n + k) log n)  
Space: O(n + k)

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
