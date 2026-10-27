## Candidate centres

1. `best = 1`.
2. For each pair `p, q` with `|pq| ≤ 2r`: the midpoint `m`, `h = √(r² − (|pq|/2)²)`, centres `m ± h · perp(unit(pq))`.
3. For each centre, count darts within `r + 1e-7`; update `best`.

`[[-2,0],[2,0],[0,2],[0,-2]]`, r = 2 → 4. `[[-3,0],[3,0],[2,6],[5,4],[0,9],[7,8]]`, r = 5 → 5.

Do not compare distances without an epsilon. An angular sweep gives O(n² log n).

Time: O(n³)  
Space: O(1)

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
