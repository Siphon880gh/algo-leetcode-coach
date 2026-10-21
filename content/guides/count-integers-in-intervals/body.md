## Merge on insert

1. Sorted map `start → end`, `total = 0`.
2. `add(l, r)`: for each stored `[a, b]` with `a ≤ r` and `b ≥ l` (start just before `l`, then forward): remove it, `total −= b − a + 1`, `l = min(l, a)`, `r = max(r, b)`. Insert `[l, r]`, `total += r − l + 1`.
3. `count()`: return `total`.

Example → 6 then 8. Checked against a plain set of integers on 300 random call sequences.

Each interval is inserted once and removed at most once, so the merging is amortised O(log n) per add. A dynamic segment tree over 1 … 10^9 is the other standard choice.

Time: O(log n) amortised per add, O(1) count  
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
