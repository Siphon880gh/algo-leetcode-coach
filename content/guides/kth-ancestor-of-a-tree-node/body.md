## Powers of two jumps

1. `up[0] = parent`; `up[j][v] = up[j−1][ up[j−1][v] ]` (−1 stays −1), for j up to ⌈log₂ n⌉.
2. Query: for each bit `j` set in k, `v = up[j][v]`; return −1 once `v == −1`.

With parents `[-1,0,0,1,1,2,2]`: (3, 1) → 1, (5, 2) → 0, (6, 3) → −1.

Do not walk parent by parent per query; with up to 5 · 10^4 queries on a chain of 5 · 10^4 nodes that is too slow.

Time: O(n log n) build, O(log k) per query  
Space: O(n log n)

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
