## 100 prefix arrays

1. `P[i][v]` = occurrences of `v` in `nums[:i]`.
2. Query `[l, r]`: walk `v = 1 … 100`; present if `P[r + 1][v] − P[l][v] > 0`; track the gap to the previous present value.
3. No gap found (one distinct value) → −1.

Example 1 → `[2,1,4,1]`. Example 2 → `[-1,1,1,3]`.

Equal values never count, since the gap is between distinct values. Sorting each subarray would be O(n log n) per query, far too slow for 2 · 10^4 queries.

Time: O(100 · (n + q))  
Space: O(100 · n)

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
