## Bottom-up

1. Work on a copy of cost, 0-indexed: node i has children 2i + 1 and 2i + 2.
2. For `i = n/2 − 1 … 0`: `l, r` = children’s path sums; `ans += |l − r|`; `cost[i] += max(l, r)`.
3. Return ans.

Examples → 6, 0.

Raising a child’s own cost fixes every path below it at once, so increments never belong deeper than the sibling level where the difference appears.

Time: O(n)  
Space: O(n) for the copy

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
