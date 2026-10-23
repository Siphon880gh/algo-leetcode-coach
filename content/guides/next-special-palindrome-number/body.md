## Precompute

1. For each set of digits from 1 to 9 with at most one odd digit and digit total ≤ 16: half = d / 2 copies of each d; the odd digit (if any) goes in the middle.
2. Every distinct order of half gives half + middle + reverse(half).
3. Sort the 2,296 numbers; answer the first one > n.

Examples → 22, 212. Checked against testing every number up to 30,000.

Using ≥ instead of >: n = 22 → 22 instead of 212.

Time: O(P log P) once, then O(log P) per query, with P = 2,296  
Space: O(P)

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
